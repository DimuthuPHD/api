<?php

namespace App\Http\Resources\Slot;

use Carbon\Carbon;
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
            'time_from' => Carbon::parse($this->time_from)->format('h:i:A'),
            'time_to' => Carbon::parse($this->time_to)->format('h:i:A'),
            // 'consultant' => $this->consultant->first_name,
        ];
    }
}
