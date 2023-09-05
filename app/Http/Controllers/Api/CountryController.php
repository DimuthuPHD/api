<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryCollection;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        try {

            return new CountryCollection(Country::get());

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }

    public function show(Country $country)
    {
        try {
            return new CountryResource($country);
        } catch (\Throwable $th) {
            throw $th;

            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
