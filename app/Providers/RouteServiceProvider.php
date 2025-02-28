<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Здесь ты можешь зарегистрировать привязку маршрутов.
     */
    public function boot()
    {
        $this->routes(function () {
          

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
