<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class MateMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(Session::get('mate') == null)
            return $request->path();
            return 'not_login';
		return $next($request);
	}

}
