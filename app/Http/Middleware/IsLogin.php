<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
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
        if(!empty(session()->get('user')['user_name']) || !empty(session()->get('user')['user_id']) ) {
            return $next($request);
        }else{
            return redirect('admin/login')->with('errors','请注意素质');
        }
        return $next($request);
    }
}
