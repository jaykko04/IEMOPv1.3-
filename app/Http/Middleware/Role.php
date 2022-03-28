<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {
         if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('/rtyuiodkasfaksdfnmvcnlvfagylrvfvDAV/error/a/qdfghjkdlaswuq/1dasnjd/asd123o12t4e7tgykfga26et8of1yfe19e7rd1fo2g31t307812t4g812ypodwte812o6');

    $user = Auth::user();

    if($user->role == $role)
      return $next($request);
    return redirect('/rtyuiodkasfaksdfnmvcnlvfagylrvfvDAV/error/a/qdfghjkdlaswuq/1dasnjd/asd123o12t4e7tgykfga26et8of1yfe19e7rd1fo2g31t307812t4g812ypodwte812o6');
    }

}
