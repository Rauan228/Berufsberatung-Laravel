<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
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
