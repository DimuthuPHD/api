<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.profile')->withUser($user)->withCountries(Country::active()->orderBy('name')->get()->pluck('name', 'id')->toArray());

    }

    public function update(UpdateProfileRequest $request, User $user)
    {

        try {
            if ($request->has('countries')) {
                $user->countries()->sync($request->countries);
            }
            $user->update(array_filter($request->validated()));

            return redirect()->route('user.profile')->withSuccess('User updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('user updating error')->withInput($request->validated());
        }

    }
}
