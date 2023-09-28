<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'prescriber_id',
        'patient_id',
        'start_date',
        'end_date',
    ];

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'record_allergies');
    }

    public function pathologies()
    {
        return $this->belongsToMany(Pathology::class, 'record_pathologies');
    }

}
