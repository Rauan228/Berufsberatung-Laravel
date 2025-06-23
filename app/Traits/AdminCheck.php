<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminCheck
{
    protected function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    protected function checkAdmin()
    {
        if (!$this->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
    }
} 