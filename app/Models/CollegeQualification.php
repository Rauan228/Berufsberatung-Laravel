<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollegeQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualification_name',
        'college_global_specialty_id',
        'description'
    ];

    /**
     * Get the global specialty that owns the qualification.
     */
    public function collegeGlobalSpecialty(): BelongsTo
    {
        return $this->belongsTo(CollegeGlobalSpecialty::class, 'college_global_specialty_id');
    }

    /**
     * Get the specializations for this qualification.
     */
    public function specializations(): HasMany
    {
        return $this->hasMany(CollegeSpecialization::class, 'college_qualification_id');
    }
} 