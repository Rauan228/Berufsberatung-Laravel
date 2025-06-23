<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniversitySpecialization extends Model
{
    protected $fillable = [
        'name',
        'university_qualification_id',
        'description'
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(UniversityQualification::class, 'university_qualification_id');
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class, 'institution_specialties', 'university_specialization_id', 'institution_id')
            ->withPivot('cost', 'duration');
    }
} 