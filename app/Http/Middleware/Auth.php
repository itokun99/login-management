<?php

namespace App\Http\Middleware;

use Closure;

class Auth
{
    protected function needAuth(){
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth_header = $request->header('Authorization');
        if(!$auth_header) return $this->needAuth();
        $api_token = explode(' ', $request->header('Authorization'));
        if(count($api_token) != 2 && !$api_token[1]) return $this->needAuth();
        $request->token = $api_token[1];
        return $next($request);
    }
}
