<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JobSeeker\UpdateProfileRequest;
use App\Http\Resources\JobSeeker\JobSeekerCollection;
use App\Models\JobSeeker;
use App\Services\JobseekerService;
use Illuminate\Support\Facades\Hash;

class JobSeekerController extends Controller
{
    protected JobseekerService $jobSeekerService;

    public function __construct(JobseekerService $jobSeekerService)
    {
        $this->jobSeekerService = $jobSeekerService;
    }

    public function updateProfile(JobSeeker $job_seeker, UpdateProfileRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($job_seeker->update($data)) {
                return $this->apiRsponse(true, [], [
                    'user' => $job_seeker,
                ]);
            } else {

                return $this->apiRsponse(false, ['update' => 'Error Updating user'], []);
            }
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['update_user' => 'System error. Please try again']);
        }
    }

    public function list()
    {
        $job_seekers =  new JobSeekerCollection($this->jobSeekerService->activeList());
        return $this->apiRsponse(true, [], $job_seekers);
    }
}
