<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class InstitutionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'institution_name', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    // Авто-хеширование пароля перед сохранением
    public static function boot()
    {
        parent::boot();
        static::creating(function ($institutionApplication) {
            $institutionApplication->password = Hash::make($institutionApplication->password);
        });
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    // Доступ к флагу верификации через связанный институт
    public function getVerifiedAttribute()
    {
        return $this->institution->verified ?? false;
    }
}

