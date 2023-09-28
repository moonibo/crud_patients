<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
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
        'step_id',
        'doses_per_day',
        'days'
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function pathologies()
    {
        return $this->belongsToMany(Pathology::class, 'prescription_pathologies');
    }

}
