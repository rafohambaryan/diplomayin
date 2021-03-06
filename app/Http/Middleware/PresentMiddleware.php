<?php

namespace App\Http\Middleware;

use App\Models\Present;
use Closure;

class PresentMiddleware
{

    public function handle($request, Closure $next, $token)
    {
        if (!Present::where('url', $token)->first()) {
            return abort(404);
        }
        return $next($request);
    }
}
