<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'health_id',
        'user_id'
    ];

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class);
    }

    public function user() :HasOne
    {
        return $this->hasOne(User::class);
    }

    public function appointments() : BelongsToMany
    {
        return $this->belongsToMany(Appointment::class);
    }
}
