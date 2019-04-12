<?php

declare(strict_types=1);

namespace App\Providers;

use App\Database\CustomConnectionFactory;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Application;

class DatabaseConnectionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        DB::extend('custom', function (array $config, ?string $name) {
            return app(CustomConnectionFactory::class)->make($config, $name);
        });
    }
}