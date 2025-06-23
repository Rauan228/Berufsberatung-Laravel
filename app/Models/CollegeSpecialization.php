<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollegeSpecialization extends Model
{
    protected $table = 'college_specializations';

    protected $fillable = [
        'name',
        'college_qualification_id',
        'description',
        'about1',
        'about2',
        'about3',
        'requirements',
        'opportunities',
        'skills'
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(CollegeQualification::class, 'college_qualification_id');
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class, 'college_institution_specs', 'college_specialization_id', 'institution_id')
                    ->withPivot('cost', 'duration');
    }
} 