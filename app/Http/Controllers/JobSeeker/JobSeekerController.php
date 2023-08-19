<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorejobSeekerRequest;
use App\Http\Requests\UpdatejobSeekerRequest;
use App\Models\EducationLevel;
use App\Models\Gender;
use App\Models\JobSeeker;
use App\Models\JobType;
use App\Services\JobseekerService;
use Illuminate\Http\Request;

class JobSeekerController extends Controller
{
    private JobseekerService $jobseekerService;

    public function __construct(JobseekerService $jobseekerService)
    {
        $this->jobseekerService = $jobseekerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('job-seeker.index')
            ->withJobSeekers($this->jobseekerService->orderBy('created_at', 'desc')->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job-seeker.create')->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withEducationLeves(EducationLevel::all()->pluck('name', 'id')->toArray())
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorejobSeekerRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = isset($data['password']) ? $data['password'] : 'secret';
            $data['password'] = bcrypt($data['password']);
            $data['status'] = isset($data['status']) ? 1 : 0;
            $this->jobseekerService->store($data);

            return redirect()->route('job-seeker.index')->withSuccess('Job Seeker Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('Job Seeker Updating Error')->withInput($request->validated());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jobSeeker $jobSeeker)
    {
        return view('job-seeker.edit')->withJobSeeker($jobSeeker)
            ->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withEducationLeves(EducationLevel::all()->pluck('name', 'id')->toArray())
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejobSeekerRequest $request, JobSeeker $jobSeeker)
    {
        try {
            $data = $request->validated();
            $data['password'] = isset($data['password']) ? $data['password'] : 'secret';
            $data['password'] = bcrypt($data['password']);
            $data['status'] = isset($data['status']) ? 1 : 0;
            $jobSeeker->update($data);

            return redirect()->route('job-seeker.index')->withSuccess('Job Seeker Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('Job Seeker Updating Error');
        }
    }
}
