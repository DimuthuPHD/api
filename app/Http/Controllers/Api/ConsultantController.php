<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Consultant\ConsultantCollection;
use App\Http\Resources\Consultant\ConsultantResource;
use App\Models\Consultant;
use App\Services\ConsultantService;

class ConsultantController extends Controller
{
    protected ConsultantService $consultantService;

    public function __construct(ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
    }

    public function index()
    {
        try {

            return new ConsultantCollection($this->consultantService->getFiltered());

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }

    public function show(Consultant $consultant)
    {
        try {
            if ($consultant->availableSlots->count() > 0) {
                return new ConsultantResource($consultant);
            }

            return response()->json(['error' => 'Not Found', 'data' => []], 404);
        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
