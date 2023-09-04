<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'date',
        'time_from',
        'time_to',
    ];

    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
