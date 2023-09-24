<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
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
        if ($request->hasHeader("Accept-Language")) {
            /**
             * If Accept-Language header found then set it to the default locale
             */
            $locale = $request->header("Accept-Language");
            if (Locale::where('name', $locale)->count() <= 0) return response()->json(['message'=>'lang not found'],404);
            App::setLocale($locale);
        }
        return $next($request);
    }
}
