<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordPathologies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'record_id',
        'pathology_id',
    ];

    public function records()
    {
        return $this->belongsToMany(Record::class);
    }

    public function pathologies()
    {
        return $this->belongsToMany(Pathology::class);
    }

}
