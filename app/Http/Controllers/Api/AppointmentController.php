<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::guard('sanctum')->user();
            return new AppointmentCollection(Appointment::where(['job_seeker_id' => $user->id])->get());

        } catch (\Throwable $th) {
            throw $th;

            return response('error', 400);
        }
    }
}
