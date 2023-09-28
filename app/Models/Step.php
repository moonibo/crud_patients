<?php

namespace App\Models;

use App\Core\MyPatients\Domain\Prescriber\Services\PrescriberFinder;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'method_id',
        'name'
    ];

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }
}
