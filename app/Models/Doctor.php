<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'user_id',
        'short_bio'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointments', 'doctor_id');
    }

}
