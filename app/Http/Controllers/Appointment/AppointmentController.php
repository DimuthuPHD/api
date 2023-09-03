<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Consultant;
use App\Models\JobSeeker;
use App\Services\AppointmentService;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    private AppointmentService $appointmentService;

    private UserService $userService;

    public function __construct(AppointmentService $appointmentService, UserService $userService)
    {
        $this->appointmentService = $appointmentService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $appointments = $this->appointmentService->filter((array_filter($request->all())));

        if ($request->has('export')) {

            $pdf = Pdf::loadView('exports.appointments', ['appointments' => $appointments->get()])
                ->setPaper('a4', 'landscape')
                ->setOption('margin-top', 20)
                ->setOption('margin-bottom', 20)
                ->setOption('margin-left', 20)
                ->setOption('margin-right', 20)
                ->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);

            return $pdf->download('appintments_'.Carbon::parse(now())->format('y_m_d').'_'.bin2hex(random_bytes(2)).'.pdf');

        }

        return view('appointment.index')->withData($appointments->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointment.create')
            ->withJobSeekers(JobSeeker::where(['status' => 1])->get()->pluck('full_name', 'id')->toArray())
            ->withConsultants(Consultant::all()->pluck('full_name', 'id')->toArray())
            ->withStatuses(AppointmentStatus::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();
            $data['status_id'] = 1;

            $is_job_seeker_avaiable = $this->appointmentService->isJobSeekerAvailable($data, $request->slot_id, null);
            $is_slot_avaiable = $this->appointmentService->isSlotAvailable($request->slot_id);

            if (! $is_job_seeker_avaiable) {
                throw ValidationException::withMessages([
                    'job_seeker_id' => 'The job seeker is not available at this time',
                ]);
            }

            if (! $is_slot_avaiable) {
                throw ValidationException::withMessages([
                    'slot_id' => 'Selected slot is not available',
                ]);
            }

            $appointment = $this->appointmentService->store($data);

            return redirect()->route('appointment.index')->withSuccess('Appointment created Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('appointment creating error')->withInput($request->validated());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointment.edit')
            ->withModel($appointment)
            ->withJobSeekers(JobSeeker::orderBy('first_name')->get()->pluck('full_name', 'id')->toArray())
            ->withConsultants(Consultant::all()->pluck('full_name', 'id')->toArray())
            ->withStatuses(AppointmentStatus::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Appointment $appointment)
    {
        try {
            $data = $request->validated();
            $is_job_seeker_avaiable = $this->appointmentService->isJobSeekerAvailable($data, $request->slot_id, $appointment->id);
            $is_slot_avaiable = $this->appointmentService->isSlotAvailable($request->slot_id, $appointment->id);

            if (! $is_job_seeker_avaiable) {
                throw ValidationException::withMessages([
                    'job_seeker_id' => 'The job seeker is not available at this time',
                ]);
            }

            if (! $is_slot_avaiable) {
                throw ValidationException::withMessages([
                    'slot_id' => 'Selected slot is not available',
                ]);
            }

            $appointment->update($data);

            return redirect()->route('appointment.index', ['role' => $appointment->role_name])->withSuccess('Appointment Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('Appointment Updating error');
        }
    }
}
