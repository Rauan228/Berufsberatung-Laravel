<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualification_name',
        'global_specialty_id',
    ];

    public function globalSpecialty()
    {
        return $this->belongsTo(GlobalSpecialty::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
    
}


