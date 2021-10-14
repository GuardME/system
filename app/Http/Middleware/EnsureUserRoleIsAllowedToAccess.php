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
        try {
            $userRole  = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();
            if (in_array($currentRouteName, $this->userAccessRole()[$userRole])){
                return $next($request);
            } else {
                abort(403, 'Tidak Mendapatkan Access Role');
            }
        } catch (\Throwable $th) {
            abort(403, 'Tidak Mendapatkan Access Role');
        }
    }

    private function userAccessRole()
    {
        return [
            'user' => [
                'dashboard',
                'users',
                'user-permission'
            ],
            'admin' => [
                'pages',
            ]
            ];
    }
}
