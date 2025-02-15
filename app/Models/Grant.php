<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'grant_name', 'amount', 'application_deadline',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}

