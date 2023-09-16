<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppointmentStoreRequest;
use App\Http\Requests\Api\AppointmentUpdateRequest;
use App\Http\Requests\Api\AvailableSlotsRequest;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Http\Resources\Appointment\AppointmentResource;
use App\Http\Resources\Slot\SlotCollection;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Consultant;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\Mail;
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
                return $this->apiRsponse(false, ['job_seeker_id' => 'The job seeker is not available at this time']);
            }

            if (!$is_slot_avaiable) {
                return $this->apiRsponse(false, ['slot_id' => 'Selected slot is not available']);
            }

            $appointment = $this->appointmentService->store($data);

            Mail::send(['mail.appointment.create.job_seeker', $appointment], function ($message) use ($appointment) {
                $message->to($appointment->jobSeeker->email)->subject('ppointment Created');
            });
            Mail::send(['mail.appointment.create.consultant', $appointment], function ($message) use ($appointment) {
                $message->to($appointment->consultant->email)->subject('ppointment Created');
            });

            return $this->apiRsponse(true, [], [
                'appointment' => $appointment,
            ]);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }
    }

    public function update(AppointmentStoreRequest $request, Appointment $appointment)
    {
        try {

            $data = $request->validated();
            $is_job_seeker_avaiable = $this->appointmentService->isJobSeekerAvailable($data, $request->slot_id, $appointment->id);
            $is_slot_avaiable = $this->appointmentService->isSlotAvailable($request->slot_id, $appointment->id);

            if (!$is_job_seeker_avaiable) {
                return $this->apiRsponse(false, ['job_seeker_id' => 'The job seeker is not available at this time']);
            }

            if (!$is_slot_avaiable) {
                return $this->apiRsponse(false, ['slot_id' => 'Selected slot is not available']);
            }

            $appointment->update($data);

            return $this->apiRsponse(true, [], [
                'appointment' => $appointment,
            ]);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment = new AppointmentResource($appointment);
        $stasuses =  AppointmentStatus::all()->pluck('name', 'id')->toArray();

        return $this->apiRsponse(true, [], [
            'appointment' => $appointment,
            'stasuses' => $stasuses,
        ]);
    }


    public function availableSlots(AvailableSlotsRequest $request)
    {
        $user = $request->has('consultant_id') ? Consultant::find($request->consultant_id) : request()->user();
        if ($user) {
            $slots = new SlotCollection($user->availableSlots);
        } else {
            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }

        return $this->apiRsponse(true, [], $slots);
    }

    public function getLoggedInUserAppoinmtnes()
    {
        $user = request()->user();
        if ($user->tokenCan('consultants')) {
            $appointments = Appointment::select('appointments.*')->join('slots', 'appointments.slot_id', '=', 'slots.id')->where('slots.consultant_id', $user->id)->paginate(10);
        } elseif ($user->tokenCan('job_seekers')) {
            $appointments = $user->appointments()->paginate(10);
        } else {
            return $this->apiRsponse(false, ['system_error' => 'System error. please conract administrator']);
        }

        return $appointments;
    }
}
