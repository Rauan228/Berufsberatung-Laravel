<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Institution extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'institutions';

    // Используем $fillable вместо $guarded
    protected $fillable = [
        'name',
        'description1',
        'description2',
        'description3',
        'location',
        'email',
        'phone',
        'website',
        'verified',
        'logo_url',
        'photo_url',
        'dormitory',
        'grants',
        'password', // Убедимся, что password включен
    ];

    protected $hidden = [
        'password',
    ];

    


    public function events()
    {
        return $this->hasMany(EventsCalendar::class);
    }

    public function specializations() {
        return $this->belongsToMany(Specialization::class, 'institution_specialties')
                    ->withPivot('cost', 'duration'); // Добавляем поля cost и duration
    }
// Мутатор для хеширования пароля
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
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