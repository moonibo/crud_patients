<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $fillable = [
        'name'
    ];

    public function step()
    {
        return $this->belongsToMany(Step::class);
    }
}
