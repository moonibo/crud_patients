<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class RegisteredPrescriber extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'registered_prescribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'mail',
        'password',
        'prescriber_id'
    ];

    public function prescriber(): BelongsTo
    {
        return $this->belongsTo(Prescriber::class);
    }

}
