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
        'slot_id',
        'status_id',
        'notes',
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
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
