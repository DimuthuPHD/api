<?php

namespace App\Services;

use App\Models\JobSeeker;
use App\Services\Base\BaseService;

class JobseekerService extends BaseService
{
    public function __construct(JobSeeker $jobSeeker)
    {
        $this->model = $jobSeeker;
    }

    public function store(array $data) :JobSeeker
    {
        return $this->model->create($data);
    }
}
