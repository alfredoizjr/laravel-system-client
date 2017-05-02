<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
class validateUserFirstSingUp
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
        $userCount = User::count();
        if($userCount > 0 && !Auth::check()){
          return redirect('/');
        }
        return $next($request);
    }
}
