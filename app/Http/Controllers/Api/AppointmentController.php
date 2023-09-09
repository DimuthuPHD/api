<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppointmentStoreRequest;
use App\Http\Requests\Api\AvailableSlotsRequest;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Http\Resources\Slot\SlotCollection;
use App\Models\Appointment;
use App\Models\Consultant;
use App\Services\AppointmentService;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    private AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index()
    {
        try {
            $appointments = $this->getLoggedInUserAppoinmtnes();
            $appointments =  new AppointmentCollection($appointments);

            return $this->apiRsponse(true, [], [
                'appointments' => $appointments,
            ]);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {
        try {

            $data = $request->validated();
            $data['status_id'] = 1;

            $is_job_seeker_avaiable = $this->appointmentService->isJobSeekerAvailable($data, $request->slot_id, null);
            $is_slot_avaiable = $this->appointmentService->isSlotAvailable($request->slot_id);

            if (!$is_job_seeker_avaiable) {
                throw ValidationException::withMessages([
                    'job_seeker' => 'The job seeker is not available at this time',
                ]);
            }

            if (!$is_slot_avaiable) {
                throw ValidationException::withMessages([
                    'slot' => 'Selected slot is not available',
                ]);
            }

            $appointment = $this->appointmentService->store($data);

            return $this->apiRsponse(true, [], [
                'appointment' => $appointment,
            ]);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }
    }

    public function availableSlots(AvailableSlotsRequest $request)
    {
        $user = $request->has('consultant_id') ? Consultant::find($request->consultant_id) : request()->user();

        if ($user) {
            $slots = new SlotCollection($user->availableSlots);
        } else {
            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }

        return $this->apiRsponse(true, [], [
            'slots' => $slots,
        ]);
    }

    public function getLoggedInUserAppoinmtnes()
    {
        $user = request()->user();
        if ($user->tokenCan('consultants')) {
            $appointments = Appointment::join('slots', 'appointments.slot_id', '=', 'slots.id')->where('slots.consultant_id', $user->id)->paginate(10);
        } elseif ($user->tokenCan('job_seekers')) {
            $appointments = $user->appointments()->paginate(10);
        } else {
            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }

        return $appointments;
    }
}
