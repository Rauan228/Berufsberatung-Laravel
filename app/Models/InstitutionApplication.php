<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class InstitutionApplication extends Model
{
    protected $fillable = [
        'institution_id',
        'institution_name',
        'email',
        'password',
        'verified',
    ];

    protected $hidden = [
        'password',
    ];

    // Мутатор для хеширования пароля
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    // Удаляем boot, так как мутатор достаточно
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}