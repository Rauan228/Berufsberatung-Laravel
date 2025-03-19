<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionSpecialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'specialty_id', 'specialty_name',
    ];

    public function specialty()
    {
        return $this->belongsTo(GlobalSpecialty::class);
    }
}
