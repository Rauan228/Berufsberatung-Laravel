<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Добавляем для аутентификации
use Illuminate\Notifications\Notifiable; // Добавляем для уведомлений (опционально)
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // Изменяем наследование на Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable; // Добавляем Notifiable для уведомлений

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userApplications()
    {
        return $this->hasMany(UserApplication::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function ban()
    {
        $this->update(['is_banned' => true]);
    }

    public function unban()
    {
        $this->update(['is_banned' => false]);
    }

    public function isBanned()
    {
        return $this->is_banned;
    }
}