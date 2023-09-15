<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Consultant\UpdateProfileRequest;
use App\Http\Resources\Consultant\ConsultantCollection;
use App\Http\Resources\Consultant\ConsultantResource;
use App\Http\Resources\Country\CountryCollection;
use App\Models\Consultant;
use App\Services\ConsultantService;
use Illuminate\Support\Facades\Hash;

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
            $consultants =  new ConsultantCollection($this->consultantService->getFiltered());
            return $this->apiRsponse(true, [],  $consultants);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system' => 'System Error'], []);
        }
    }

    public function show(Consultant $consultant)
    {
        try {
            if ($consultant->availableSlots->count() > 0) {
                $consultant =  new ConsultantResource($consultant);
                return $this->apiRsponse(true, [],  $consultant);
            }

            return $this->apiRsponse(false, ['system' => 'System Error'], []);
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['system' => 'System Error'], []);
        }
    }

    public function updateProfile(Consultant $consultant, UpdateProfileRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->has('countries')) {
                $consultant->countries()->sync($request->countries);
            }

            if ($request->has('job_types')) {
                $consultant->jobTypes()->sync($request->job_types);
            }

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($consultant->update($data)) {
                return $this->apiRsponse(true, [], [
                    'user' => $consultant,
                ]);
            } else {

                return $this->apiRsponse(false, ['update' => 'Error Updating user'], []);
            }
        } catch (\Throwable $th) {
            throw $th;

            return $this->apiRsponse(false, ['update_user' => 'System error. Please try again']);
        }
    }

    public function myCountries()
    {

        $countries = request()->user()->countries->pluck('id')->toArray();

        return $this->apiRsponse(true, [], $countries);
    }

    public function myJobTypes()
    {
        $jobTypes = request()->user()->jobTypes->pluck('id')->toArray();
        return $this->apiRsponse(true, [], $jobTypes);
    }
}
