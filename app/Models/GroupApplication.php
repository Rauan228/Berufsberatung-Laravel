<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'institution_id',
        'team_name',
        'status',
        'payload',
    ];

    public function event()
    {
        return $this->belongsTo(EventsCalendar::class, 'event_id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function members()
    {
        return $this->hasMany(GroupApplicationMember::class);
    }

    protected $casts = [
        'payload' => 'array',
    ];
} 