<?php

namespace App\Providers;

use App\Models\Publicacion;
use App\Models\Usuario;
use App\Policies\PublicacionPolicy;
use App\Policies\UsuarioPolicy;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Usuario::class => UsuarioPolicy::class,
        Publicacion::class => PublicacionPolicy::class,
        \App\Models\Carpeta::class => \App\Policies\CarpetaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
