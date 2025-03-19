<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'institution_id', 'rating', 'comment', 'created_at',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}


    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
