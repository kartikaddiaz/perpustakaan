<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
   protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');
}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
