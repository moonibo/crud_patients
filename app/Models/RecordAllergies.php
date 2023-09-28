<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordAllergies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'record_id',
        'allergy_id',
    ];

    public function records()
    {
        return $this->belongsToMany(Record::class);
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class);
    }

}
