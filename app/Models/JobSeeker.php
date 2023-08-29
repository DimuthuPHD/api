<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class JobSeeker extends Model
{
    use HasFactory, HasApiTokens;

    protected $guard = 'api';

    protected $fillable = [
        'gender_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'address',
        'telephone',
        'email',
        'job_type_id',
        'education_level_id',
        'work_experience',
        'notes',
        'email_verified_at',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'job_seeker_id', 'id');
    }
}
