<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\File;
use App\Policies\FilePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapeo de modelos a sus policies.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Aquí registras tu policy:
        File::class => FilePolicy::class,
    ];

    /**
     * Registra los servicios de autenticación / autorización.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
