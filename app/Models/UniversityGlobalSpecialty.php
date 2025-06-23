<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UniversityGlobalSpecialty extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function qualifications(): HasMany
    {
        return $this->hasMany(UniversityQualification::class);
    }
} 