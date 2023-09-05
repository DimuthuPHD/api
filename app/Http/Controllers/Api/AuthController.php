<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
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

            return response('registered Successfully', 200);
        } catch (\Throwable $th) {
            throw $th;

            return response('registerations.error', 400);
        }
    }

    public function login(LoginRequest $request)
    {
        try {

            if ($request->user_type == 'job_seeker') {
                if (Auth::guard('job_seekers')->attempt($request->except('user_type'))) {
                    $user = Auth::guard('job_seekers')->user();
                    $token = $user->createToken('job_seeker_token', ['job_seekers'])->plainTextToken;

                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'user_type' => 'job_seeker',
                    ]);
                }
            } elseif ($request->user_type == 'consultant') {
                if (Auth::guard('consultants')->attempt($request->except('user_type'))) {
                    $user = Auth::guard('consultants')->user();
                    $token = $user->createToken('job_seeker_token', ['consultants'])->plainTextToken;

                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'user_type' => 'consultant',
                    ]);
                }
            }

            return response()->json(['error' => 'Unauthorized'], 401);

        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['error' => 'Loging Error. Please try again'], 401);
        }
    }
}
