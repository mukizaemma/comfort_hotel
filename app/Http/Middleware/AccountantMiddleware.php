<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        // Allow Super Admin (role_id = 1) and Accountant (role_id = 3)
        if (!auth()->check() || (!$user->isSuperAdmin() && !$user->isAccountant())) {
            abort(403, 'Unauthorized access. Accountant or Super Admin access required.');
        }

        return $next($request);
    }
}
