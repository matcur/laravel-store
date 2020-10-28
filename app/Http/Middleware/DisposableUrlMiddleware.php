<?php

namespace App\Http\Middleware;

use App\DisposableUrl\DisposableUrl;
use Closure;
use Illuminate\Http\Request;

class DisposableUrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $sessionKeyPrefix
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $sessionKeyPrefix)
    {
        $sessionDisposableUrl = DisposableUrl::getFromSession($sessionKeyPrefix);
        if ($sessionDisposableUrl != $request->disposable_url)
            abort(401);

        DisposableUrl::forgetFromSession($sessionKeyPrefix);

        return $next($request);
    }
}
