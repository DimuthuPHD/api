<?php

namespace App\Services;

use App\Models\JobSeeker;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Collection;

class JobseekerService extends BaseService
{
    public function __construct(JobSeeker $jobSeeker)
    {
        $this->model = $jobSeeker;
    }

    public function store(array $data): JobSeeker
    {
        return $this->model->create($data);
    }

    public function activeList(): Collection
    {
        return $this->model->with('gender')->where(['status' => 1])->get();
    }
}
