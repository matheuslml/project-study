<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PersonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $person
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $person)
    {
        if (Auth::person()?->userType() === $person) {
            return $next($request);
        }

        //flash(sprintf('Você não tem acesso em %s', URL::previous()), 'danger');
        return redirect(RouteServiceProvider::HOME);
    }
}
