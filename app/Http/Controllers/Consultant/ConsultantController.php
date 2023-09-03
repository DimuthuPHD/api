<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consultant\StoreConsultantRequest;
use App\Http\Requests\Consultant\UpdateConsultantRequest;
use App\Models\Consultant;
use App\Models\Country;
use App\Models\Gender;
use App\Models\JobType;
use App\Services\ConsultantService;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    private ConsultantService $consultantService;

    public function __construct(ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consultant.index')->withConsultants($this->consultantService->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultant.create')
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray())
            ->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withCountries(Country::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsultantRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt('password');
            $data['status'] = isset($data['status']) ? 1 : 0;
            $data['email_verified_at'] = null;
            $consultant = $this->consultantService->store($data);

            if ($consultant) {
                if ($request->has('countries')) {
                    $consultant->countries()->sync($request->countries);
                }
                if ($request->has('job_types')) {
                    $consultant->jobTypes()->sync($request->job_types);
                }
            }

            return redirect()->route('consultant.index')->withSuccess('Consultant created Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('Consultant creating error')->withInput($request->validated());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultant $consultant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultant $consultant)
    {
        return view('consultant.edit')->withConsultant($consultant)
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray())
            ->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withCountries(Country::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsultantRequest $request, Consultant $consultant)
    {
        try {
            $data = array_filter($request->validated());
            $data['status'] = isset($data['status']) ? 1 : 0;
            if ($request->has('countries')) {
                $consultant->countries()->sync($request->countries);
            }
            if ($request->has('job_types')) {
                $consultant->jobTypes()->sync($request->job_types);
            }
            $consultant->update($data);

            return redirect()->route('consultant.index')->withSuccess('Consultant updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('Consultant updating error')->withInput($request->validated());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultant $consultant)
    {
        //
    }

    public function slots(Consultant $consultant, Request $request)
    {
        $data = view('appointment.slots', ['slots' => $consultant->slots, 'default' => $request->default_slot])->render();

        return response()->json(['slots' => $data, 'success' => true]);

    }
}
