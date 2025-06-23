<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Добавляем для аутентификации
use Illuminate\Notifications\Notifiable; // Добавляем для уведомлений (опционально)
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable // Изменяем наследование на Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes; // Добавляем Notifiable для уведомлений и SoftDeletes для мягкого удаления

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'deleted_at'
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
}