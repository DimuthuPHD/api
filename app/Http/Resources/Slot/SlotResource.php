<?php

namespace App\Http\Resources\Slot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotResource extends JsonResource
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
            'date' => $this->date,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            // 'consultant' => $this->consultant->first_name,
        ];
    }
}
