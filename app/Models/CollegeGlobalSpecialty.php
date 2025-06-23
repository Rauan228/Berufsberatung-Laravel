<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CollegeGlobalSpecialty extends Model
{
    protected $fillable = ['name', 'description'];

    public function collegeQualifications(): HasMany
    {
        return $this->hasMany(CollegeQualification::class, 'college_global_specialty_id');
    }
} 