<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobType\JobTypeCollection;
use App\Http\Resources\JobType\JobTypeResource;
use App\Models\JobType;

class JobTypeController extends Controller
{
    public function index()
    {
        try {

            return new JobTypeCollection(JobType::get());

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }

    public function show(JobType $jobType)
    {
        try {
            return new JobTypeResource($jobType);
        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
