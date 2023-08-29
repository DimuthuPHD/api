<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consultant\StoreConsultantRequest;
use App\Http\Requests\Consultant\UpdateConsultantRequest;
use App\Models\Consultant;
use App\Models\Country;
use App\Models\Gender;
use App\Models\JobType;
use App\Services\ConsultantService;

class ConsultantController extends Controller
{
    private ConsultantService $consultantService;

    public function __construct(ConsultantService $consultantService)
    {
        $this->consultantService = $consultantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consultant.index')->withConsultants($this->consultantService->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultant.create')
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray())
            ->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withCountries(Country::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsultantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultant $consultant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultant $consultant)
    {
        return view('consultant.edit')->withConsultant($consultant)
            ->withGenders(Gender::all()->pluck('name', 'id')->toArray())
            ->withJobTypes(JobType::all()->pluck('name', 'id')->toArray())
            ->withCountries(Country::all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsultantRequest $request, Consultant $consultant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultant $consultant)
    {
        //
    }
}
