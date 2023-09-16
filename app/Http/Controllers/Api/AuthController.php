<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Consultant;
use App\Models\JobSeeker;
use App\Services\JobseekerService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected JobseekerService $JobseekerService;

    public function __construct(JobseekerService $JobseekerService)
    {
        $this->JobseekerService = $JobseekerService;
    }

    public function register(RegisterRequest $request)
    {
        try {

            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $data['status'] = 1;
            $this->JobseekerService->store($data);

            return $this->apiRsponse(true, [], ['registered' => 'registered Successfully']);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['registered' => 'registeration failed'],);
        }
    }

    public function login(LoginRequest $request)
    {
        try {

            if ($request->user_type == 'job_seeker') {
                if (Auth::guard('job_seekers')->attempt($request->except('user_type'))) {
                    $user = Auth::guard('job_seekers')->user();
                    $token = $user->createToken('job_seeker_token', ['job_seekers'])->plainTextToken;

                    $jobSeeker = JobSeeker::find($user->id);
                    $jobSeekerDtl = [
                        'id' => $jobSeeker?->id,
                        'gender' => $jobSeeker?->gender?->name,
                        'first_name' => $jobSeeker?->first_name,
                        'last_name' => $jobSeeker?->last_name,
                        'full_name' => $jobSeeker?->full_name,
                        'email' => $jobSeeker?->email,
                        'telephone' => $jobSeeker?->telephone,
                        'notes' => $jobSeeker?->notes,
                        'address' => $jobSeeker?->address,
                        'created_at' => $jobSeeker?->created_at,
                        'updated_at' => $jobSeeker?->updated_at,
                    ];

                    $data = [
                        'access_token' => $token,
                        'user' => $jobSeekerDtl,
                        'token_type' => 'Bearer',
                        'user_type' => 'job_seeker',
                    ];

                    return $this->apiRsponse(true, [], $data);
                }
            } elseif ($request->user_type == 'consultant') {
                if (Auth::guard('consultants')->attempt($request->except('user_type'))) {
                    $user = Auth::guard('consultants')->user();
                    $token = $user->createToken('job_seeker_token', ['consultants'])->plainTextToken;

                    $consultant = Consultant::find($user->id);
                    $consultantDtl = [
                        'id' => $consultant?->id,
                        'gender' => $consultant?->gender?->name,
                        'first_name' => $consultant?->first_name,
                        'last_name' => $consultant?->last_name,
                        'full_name' => $consultant?->full_name,
                        'email' => $consultant?->email,
                        'telephone' => $consultant?->telephone,
                        'notes' => $consultant?->notes,
                        'address' => $consultant?->address,
                        'created_at' => $consultant?->created_at,
                        'updated_at' => $consultant?->updated_at,
                    ];


                    return $this->apiRsponse(true, [], [
                        'access_token' => $token,
                        'user' => $consultantDtl,
                        'token_type' => 'Bearer',
                        'user_type' => 'consultant',
                    ]);
                }
            }

            return $this->apiRsponse(false, ['password' => 'Invalid Credentials. Please try again with correct details']);
        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['error' => 'Loging Error. Please try again'], 401);
        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return $this->apiRsponse(true, [], ['message' => 'Logged out successfully']);
    }
}
