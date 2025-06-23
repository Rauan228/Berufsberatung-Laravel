<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UniversityQualification extends Model
{
    protected $fillable = [
        'qualification_name',
        'university_global_specialty_id',
        'description'
    ];

    public function globalSpecialty(): BelongsTo
    {
        return $this->belongsTo(UniversityGlobalSpecialty::class, 'university_global_specialty_id');
    }

    public function specializations(): HasMany
    {
        return $this->hasMany(UniversitySpecialization::class);
    }
} 