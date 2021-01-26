<?php

namespace App\Http\Middleware\Warehouse;

use Closure;

class Admin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        if (auth()->user()->access_level >= 1) {
            return $next($request);
        }

        return redirect('home')->with('error', 'You have not admin access');

    }
}
