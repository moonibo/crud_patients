<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionPathologies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'prescription_id',
        'pathology_id',
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class);
    }

    public function pathologies()
    {
        return $this->belongsToMany(Pathology::class);
    }

}
