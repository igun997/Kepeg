<?php

namespace App\Http\Middleware;

use Closure;
// use App\Helpers\Sess;
class Pegawai
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
      if (verify("level","pegawai")) {
        return $next($request);
      }
      return redirect("login")->withErrors(["msg"=>"Akses Terbatas Silahkan Login"]);
    }
}
