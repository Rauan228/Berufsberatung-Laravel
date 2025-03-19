<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model {
    protected $fillable = ['name', 'qualification_id'];

    public function qualification() {
        return $this->belongsTo(Qualification::class);
    }


    public function institutions() {
        return $this->belongsToMany(Institution::class, 'institution_specialties');
    }
    
}
