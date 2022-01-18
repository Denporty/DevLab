<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Inertia\Inertia;
use Illuminate\Http\Request;

class VerifyAdmin
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
        if(!$request->user()->admin) {
            return Inertia::render('FrontOffice/Animation/Index');
        }
        return $next($request);
    }
}
