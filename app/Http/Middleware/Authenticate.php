<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Periksa apakah permintaan mengharapkan JSON
        if (!$request->expectsJson()) {
            // Arahkan ke halaman login jika tidak terautentikasi
            return route('login');
        }
    }
}
