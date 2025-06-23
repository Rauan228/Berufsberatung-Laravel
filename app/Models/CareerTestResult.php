<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institution_type',
        'answers',
        'summary',
        'suggestions',
    ];

    protected $casts = [
        'answers' => 'array',
        'suggestions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 