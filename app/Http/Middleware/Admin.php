<?php

namespace App\Http\Middleware;

use Closure;
class Admin
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
       if (verify("level","admin") || verify("level","atasan")) {
         return $next($request);
       }
       return redirect("login")->withErrors(["msg"=>"Akses Terbatas Silahkan Login"]);
    }
}
