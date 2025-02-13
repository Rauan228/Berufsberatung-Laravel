<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSpecialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialty_name',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}
