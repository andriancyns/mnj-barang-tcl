<?php

namespace App\Providers;

use App\Models\Barang;
use App\Policies\BarangPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        Barang::class => BarangPolicy::class,
    ];
}
