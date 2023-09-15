<?php

namespace App\Http\Resources\Consultant;

use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Slot\SlotResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantResource extends JsonResource
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
            'gender' => $this->gender->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'notes' => $this->notes,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'slots' => SlotResource::collection($this->availableSlots),
            'countries' => CountryResource::collection($this->countries),
        ];
    }
}
