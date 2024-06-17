<?php

namespace App\Providers;

use App\Doctrine\Types\PointType;
use Doctrine\DBAL\Types\Type;
use Flat3\Lodata\EntitySet;
use Flat3\Lodata\Facades\Lodata;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (!Type::hasType('point')) {
            Type::addType('point', PointType::class);
        }

    }
}
