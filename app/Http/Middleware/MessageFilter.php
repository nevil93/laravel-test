<?php

namespace App\Http\Middleware;

use Closure;

class MessageFilter
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
        $msg = [
            substr($request->get('message'), 0, 50),
            substr($request->get('message'), 50, 50),
            substr($request->get('message'), 100, 50)
        ];

        $message = implode(array_reverse($msg));

        $request->merge(['message' => $message]);

        return $next($request);
    }
}
