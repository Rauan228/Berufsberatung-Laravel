<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specialization extends Model {
    protected $table = 'specializations';

    protected $fillable = [
        'name',
        'qualification_id',
        'description',
        'about1',
        'about2',
        'about3'
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }

    public function institutions() {
        return $this->belongsToMany(Institution::class, 'institution_specialties', 'university_specialization_id', 'institution_id')
                    ->withPivot('cost', 'duration');
    }
    
}
