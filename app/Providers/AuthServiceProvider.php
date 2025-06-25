<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\SessionGuard;

use Closure;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        SessionGuard::macro('refresh', function () {
            /** @var \Illuminate\Auth\SessionGuard $this */
            $user = $this->user();
            $this->logout();
            return $user;
        });

        SessionGuard::macro('factory', function () {
            /** @var \Illuminate\Auth\SessionGuard $this */
            $provider = $this->getProvider();
            // هنا نعيد ال provider نفسه (عادة يكون UserProvider)
            return $provider;
        });
    }
}
