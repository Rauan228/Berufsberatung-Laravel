<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';
    protected $fillable = [
        'name', 'description1', 'description2', 'description3', 'location', 'email', 'phone', 'website', 'verified', 'logo_url', 'photo_url', 'dormitory', 'grants'
    ];

    public function events()
    {
        return $this->hasMany(EventsCalendar::class);
    }

    public function specializations() {
        return $this->belongsToMany(Specialization::class, 'institution_specialties')
                    ->withPivot('cost', 'duration'); // Добавляем поля cost и duration
    }

    public function grants()
    {
        return $this->hasMany(Grant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

     public function averageRating()
     {
         return $this->reviews()->avg('rating') ?? 0; // Если отзывов нет, возвращаем 0
     }

     public function likes() {
        return $this->belongsToMany(User::class, 'likes', 'institution_id', 'user_id');
    }   
    

    public function institutionApplications()
    {
        return $this->hasMany(InstitutionApplication::class);
    }
}