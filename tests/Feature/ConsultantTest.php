<?php

use App\Http\Resources\Consultant\ConsultantCollection;
use App\Http\Resources\Consultant\ConsultantResource;
use App\Models\Consultant;
use App\Models\Slot;

it('can get a list of consultants', function () {
    $consultant = Consultant::factory()->create();

    // Mock the ConsultantService to return data
    $consultantService = $this->mock(ConsultantService::class);
    $consultantService->shouldReceive('getFiltered')->andReturn([$consultant]);

    $this->get('/api/consultants')
        ->assertStatus(200)
        ->assertResource(ConsultantCollection::make([$consultant]));
});

it('can get a single consultant', function () {
    $consultant = Consultant::factory()->create();

    $slots = Slot::factory()->create([
        'consultant_id' => $consultant->id,
    ]);

    $this->get("/api/consultants/$consultant->id")
        ->assertStatus(200)
        ->assertResource(ConsultantResource::make($consultant));
});
