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

            return new AppointmentCollection($appointments);

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
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

            if (! $is_job_seeker_avaiable) {
                throw ValidationException::withMessages([
                    'job_seeker' => 'The job seeker is not available at this time',
                ]);
            }

            if (! $is_slot_avaiable) {
                throw ValidationException::withMessages([
                    'slot' => 'Selected slot is not available',
                ]);
            }

            $appointment = $this->appointmentService->store($data);

            return response()->json([
                'data' => $appointment,
                'message' => 'Success',
            ], 200);

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);

        }
    }

    public function availableSlots(AvailableSlotsRequest $request)
    {
        $user = $request->has('consultant_id') ? Consultant::find($request->consultant_id) : request()->user();

        if ($user) {
            $slots = new SlotCollection($user->availableSlots);
        } else {
            return response('error', 400);
        }

        return $slots;

    }

    public function getLoggedInUserAppoinmtnes()
    {
        $user = request()->user();
        if ($user->tokenCan('consultants')) {
            $appointments = Appointment::join('slots', 'appointments.slot_id', '=', 'slots.id')->where('slots.consultant_id', $user->id)->get('appointments.*');
        } elseif ($user->tokenCan('job_seekers')) {
            $appointments = $user->appointments;
        } else {
            return response('error', 400);
        }

        return $appointments;
    }
}
