<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class InstitutionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id', 'institution_name', 'email', 'password', 'verified'
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

        // Обновляем поле verified в таблице institutions при изменении verified в institution_applications
        static::updated(function ($institutionApplication) {
            $institution = $institutionApplication->institution;
            if ($institution) {
                $institution->verified = $institutionApplication->verified;
                $institution->save();
            }
        });

        // При создании новой заявки также синхронизируем verified
        static::created(function ($institutionApplication) {
            $institution = $institutionApplication->institution;
            if ($institution) {
                $institution->verified = $institutionApplication->verified;
                $institution->save();
            }
        });
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}