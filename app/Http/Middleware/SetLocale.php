<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if locale is in session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
        // Check if locale is in cookie
        elseif ($request->hasCookie('locale')) {
            app()->setLocale($request->cookie('locale'));
        }
        // Use default locale
        else {
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
