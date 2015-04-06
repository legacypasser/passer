<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class MateMiddleware {

    public static $VERIFY = 'mate_number';
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(Session::get(MateMiddleware::$VERIFY) == null)
            return 'not_login';
		return $next($request);
	}

}
