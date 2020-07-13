<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class ProtectPaymentRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $patterns = ['/https*:\/\/.+\/admin\/flats\/\d+/', '/https*:\/\/.+\/admin\/home_admin/'];
        $previousUrl = $request->session()->get('_previous')['url'];
        $filter = array_filter($patterns, function($a) use ($previousUrl) {return preg_match($a, $previousUrl);});
        return $filter ? $next($request) : abort(403);  //dd($previousUrl, $filter);
    }
}
