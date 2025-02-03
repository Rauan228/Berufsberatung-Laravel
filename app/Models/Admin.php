<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Указываем, что это за таблица
    protected $table = 'admins';

    // Поля, которые можно массово заполнять
    protected $fillable = ['name', 'email', 'password'];

    // Для безопасного хранения пароля
    protected $hidden = ['password'];
}
