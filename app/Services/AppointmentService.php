<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Slot;
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

    public function isJobSeekerAvailable(array $data, $slot, $id = null): bool
    {
        $data['id'] = $id;
        $slot = Slot::find($slot);
        $exsist = $this->model->where('job_seeker_id', $data['job_seeker_id'])
            ->whereNotIn('status_id', [4, 3])
            ->wherehas('slot', function ($query) use ($slot) {
                $query
                    ->where('date', $slot->date)
                    ->whereBetween('time_from', [$slot->time_from, $slot->time_to])
                    ->orWhereBetween('time_to', [$slot->time_from, $slot->time_to])
                    ->orWhere(function ($query) use ($slot) {
                        $query->where('time_from', '<=', $slot->time_from)
                            ->where('time_to', '>=', $slot->time_to);
                    });
            })
            ->where('id', '!=', $data['id'])->exists();

        return $exsist ? false : true;
    }

    public function isSlotAvailable($slot_id, $id = null): bool
    {
        $exsist = $this->model->whereNotIn('status_id', [4, 3])
            ->where(['slot_id' => $slot_id])
            ->where('id', '!=', $id)->exists();

        return $exsist ? false : true;
    }

    public function filter(array $data)
    {
        $query = $this->model->with('status')->orderBy('created_at', 'desc');

        $query->when(isset($data['date_from']), function ($q) use ($data) {
            return $q->whereHas('slot', function ($q) use ($data) {
                $q->where('date', '>=', $data['date_from']);
            });
        });

        $query->when(isset($data['date_to']), function ($q) use ($data) {
            return $q->whereHas('slot', function ($q) use ($data) {
                $q->where('date', '<=', $data['date_to']);
            });
        });

        $query->when(isset($data['time_from']), function ($q) use ($data) {
            return $q->whereHas('slot', function ($q) use ($data) {
                $q->where('time_from', '>=', $data['time_from']);
            });
        });

        $query->when(isset($data['time_to']), function ($q) use ($data) {
            return $q->whereHas('slot', function ($q) use ($data) {
                $q->where('time_to', '<=', $data['time_to']);
            });
        });

        $query->when(isset($data['consultant']), function ($q) use ($data) {
            return $q->whereHas('slot', function ($q) use ($data) {
                $q->whereHas('consultant', function ($q) use ($data) {
                    $q->where('email', 'like', '%'.$data['consultant'].'%');
                });
            });
        });

        $query->when(isset($data['job_seeker']), function ($q) use ($data) {
            return $q->whereHas('jobSeeker', function ($q) use ($data) {
                $q->where('email', 'like', '%'.$data['job_seeker'].'%');
            });
        });

        // Assuming you want to filter appointments based on the authenticated consultant
        // if (auth()->user()->isConsultant()) {
        //     $query->whereHas('slot', function ($q) {
        //         $q->where(['consultant_id' => auth()->user()->id]);
        //     });
        // }

        return $query;
    }
}
