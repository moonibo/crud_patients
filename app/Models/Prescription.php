<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'prescriber_id',
        'patient_id',
        'consultation_id',
        'record_id',
        'doses_per_day',
        'days',
    ];

}
