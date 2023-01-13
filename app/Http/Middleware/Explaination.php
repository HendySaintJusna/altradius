<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Explaination
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (\Cookie::get('explaination') == null && \Cookie::get('explaination-finish') != null) {

            return $next($request);

        } else {

            return response()->make(view('explaination'));
            // return view('explaination');

        }

    }


}
