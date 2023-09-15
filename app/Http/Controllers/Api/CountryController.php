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

            $countries =  new CountryCollection(Country::get());
            return $this->apiRsponse(true, [], $countries);
        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }
}
