<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = $request->user();
            if ($user->hasRole('Student')) {

                return $next($request);
            } else if ($user->hasRole('Teacher')) {
                return redirect(route('Teacher_home'));
            } else if ($user->hasRole('Admin')) {
                return redirect(route('Admin_home'));
            } else {
                return abort(404);
            }
        }
    }
}
