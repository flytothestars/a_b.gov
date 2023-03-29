<?php


namespace App\Http\Middleware;
use \Illuminate\Support\Facades\App;
use Closure;

class SetLocale
{
    public function handle($request, Closure $next) {
        if (session()->has('locale')) {
            App::setlocale(session()->get('locale'));
        }
        return $next($request);
    }
}
