<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'surname',
        'mail',
        'gender',
        'prescriber_id',
    ];

    /*protected $dispatchesEvents = [
        'saving' => \App\Events\PatientsUpdated::class,
    ];


    public function setGenderAttribute($value)
    {
        return $this->attributes["gender"] = $value === "H" ? 0 : 1;
    }*/
}
