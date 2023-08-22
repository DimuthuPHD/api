<?php

namespace App\Models;

use App\Traits\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class Appointment extends Model
{
    use HasFactory, AuditTrait;

    protected $fillable = [
        'job_seeker_id',
        'consultant_id',
        'date',
        'time_from',
        'time_to',
        'status_id',
        'notes',
    ];

    public function consultant()
    {
        return $this->belongsTo(User::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    // public function stasuses()
    // {
    //     return $this->hasMany(Activity::class, 'properties->attributes->status_id');
    // }

    // public function getLatestStatusAttribute()
    // {
    //     $latestLog = $this->stasuses()->latest()->first();
    //     $latestStatus_id = $latestLog ? $latestLog?->properties['attributes']['status_id'] : null;

    //     return AppointmentStatus::find($latestStatus_id);
    // }
}
