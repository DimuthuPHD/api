<?php

namespace App\Services;

use App\Models\Appointment;
use App\Services\Base\BaseService;

class AppointmentService extends BaseService
{
    protected $model;

    public function __construct(Appointment $appointment)
    {
        $this->model = $appointment;
    }

    public function store(array $data): Appointment
    {
        return $this->model->create($data);
    }

    public function isConsultantAvailable(array $data, $id = null): bool
    {
        $data['id'] = $id;
        $exsist = $this->model->where('consultant_id', $data['consultant_id'])
            ->where('date', $data['date'])
            ->whereNotIn('status_id', [4, 3])
            ->where(function ($query) use ($data) {
                $query->whereBetween('time_from', [$data['time_from'], $data['time_to']])
                    ->orWhereBetween('time_to', [$data['time_from'], $data['time_to']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('time_from', '<=', $data['time_from'])
                            ->where('time_to', '>=', $data['time_to']);
                    });
            })

            ->where('id', '!=', $data['id'])->exists();

        return $exsist ? false : true;
    }

    public function isJobSeekerAvailable(array $data, $id = null): bool
    {
        $data['id'] = $id;
        $exsist = $this->model->where('job_seeker_id', $data['job_seeker_id'])
            ->where('date', $data['date'])
            ->whereNotIn('status_id', [4, 3])
            ->where(function ($query) use ($data) {
                $query->whereBetween('time_from', [$data['time_from'], $data['time_to']])
                    ->orWhereBetween('time_to', [$data['time_from'], $data['time_to']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('time_from', '<=', $data['time_from'])
                            ->where('time_to', '>=', $data['time_to']);
                    });
            })
            ->where('id', '!=', $data['id'])->exists();

        return $exsist ? false : true;
    }
}
