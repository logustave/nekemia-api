<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', "*")
            ->header('Access-Control-Allow-Methods', "GET, POST, PUT, DELETE, PATCH, OPTIONS")
            ->header('Access-Control-Allow-Headers', "Accept, Origin, Access-Control-Allow-Credentials, X-Requested-With, Content-Type, Authorization");
    }
}
