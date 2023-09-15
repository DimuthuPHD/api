<?php

namespace App\Services;

use App\Models\Consultant;
use App\Services\Base\BaseService;

class ConsultantService extends BaseService
{
    public function __construct(Consultant $consultant)
    {
        $this->model = $consultant;
    }

    public function store(array $data): Consultant
    {
        return $this->model->create($data);
    }

    public function getFiltered()
    {

        $query = $this->model->query()
            ->when(request()->has('country'), function ($q) {
                $q->whereHas('countries', function ($countries) {
                    $countries->whereIn('slug', request()->country);
                });
            })->when(request()->has('job_type'), function ($q) {
                $q->whereHas('jobTypes', function ($jobTypes) {
                    $jobTypes->whereIn('name', request()->job_type);
                });
            })
            ->where(['status' => 1])
            ->whereHas('availableSlots', function ($slots) {
                $slots->whereDoesntHave('appointment', function ($appointment) {
                    $appointment->whereIn('status', [3, 4]);
                });
            })
            ->get();

        return $query;
    }
}
