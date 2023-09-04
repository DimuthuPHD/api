<?php

namespace App\Http\Resources\Consultant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConsultantCollection extends ResourceCollection
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
            'data' => ConsultantResource::collection($this->collection),
        ];
    }
}
