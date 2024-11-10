<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        $pin = $request->header('pin');

        if($pin == 1234){
            return $next($request);
        }
        else{
//            return response()->json('unauthorized', 401);
            return redirect('/');
        }

    }
}
