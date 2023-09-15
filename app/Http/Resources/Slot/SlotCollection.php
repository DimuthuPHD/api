<?php

namespace App\Http\Resources\Slot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SlotCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'data' => SlotResource::collection($this->collection),
        ];
    }
}
