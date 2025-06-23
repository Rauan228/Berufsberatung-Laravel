<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsCalendar extends Model
{
    use HasFactory;

    protected $table = 'events_calendar';

    protected $fillable = [
        'institution_id',
        'event_name',
        'event_date',
        'description',
        'event_type',
        'application_schema',
    ];

    protected $casts = [
        'application_schema' => 'array',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function userApplications()
    {
        return $this->hasMany(UserApplication::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groupApplications()
    {
        return $this->hasMany(GroupApplication::class);
    }
}
