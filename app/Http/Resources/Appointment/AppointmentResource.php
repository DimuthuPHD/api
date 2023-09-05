<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'job_seeker' => $this->jobSeeker->full_name,
            'consultant' => $this->slot->consultant->full_name,
            'date' => $this->slot->date,
            'from' => $this->slot->time_from,
            'to' => $this->slot->time_to,
            'created on' => $this->created_at,
            'status' => $this->status->name,
        ];

    }
}
