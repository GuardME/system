<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        echo 'The Middleware for access role runs everytime a http request is a made';
        $userRole  = auth()->user()->role;
        $currentRouteName = Route::currentRouteName();

        echo 'userRole: ' . $userRole.'</br>';
        echo 'Current Route Name: ' . $currentRouteName . '</br>';

        exit;
        return $next($request);
    }
}
