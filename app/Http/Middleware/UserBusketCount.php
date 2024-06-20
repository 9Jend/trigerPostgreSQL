<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBusketCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $busket = \App\Models\Busket::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);
        \Illuminate\Support\Facades\View::share('busketProductCount', $busket->products()->count());

        return $next($request);
    }
}
