<?php

namespace App\Http\Resources\JobType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobTypeCollection extends ResourceCollection
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
            'data' => JobTypeResource::collection($this->collection),
        ];
    }
}
