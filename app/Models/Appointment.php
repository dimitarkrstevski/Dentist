<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'type_id',
        'description',
        'time'
    ];

    public function examinations(): BelongsToMany
    {
        return $this->belongsToMany(Examination::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctors');
    }

    public function patients() :HasMany
    {
        return $this->hasMany(Patient::class);
    }

}
