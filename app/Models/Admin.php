<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins'; // Явно указываем таблицу

    protected $guarded = [];

    protected $hidden = ['password'];
}
