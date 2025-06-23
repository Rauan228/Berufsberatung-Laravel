<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupApplicationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_application_id',
        'user_id',
        'role',
    ];

    public function groupApplication()
    {
        return $this->belongsTo(GroupApplication::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 