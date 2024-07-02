<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->get('locale') || !session()->get('locales')){
            Auth::logout();
            return redirect()->route('auth.se-connecter');
        }
        return $next($request);
    }
}
