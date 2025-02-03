<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'website',
    ];

    public function events()
    {
        return $this->hasMany(EventsCalendar::class);
    }

    public function specialties()
    {
        return $this->hasMany(InstitutionSpecialty::class);
    }

    public function grants()
    {
        return $this->hasMany(Grant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
