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

            $jobTypes = new JobTypeCollection(JobType::get());

            return $this->apiRsponse(true, [], $jobTypes);
        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }
}
