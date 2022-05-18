<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isConnected
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
        $connected = 17;
        if ($connected == 17){
           return  redirect("faq/");
        }else{
            return redirect("login");
        }
        return $next($request);
    }
}
