<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class getLogline
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
        

        // $check = User::where('id',Auth::id())->value('logline');

        // if ($check != null) {
        //     return $next($request);
        // }

        // return redirect('logline');
        
        return $next($request);


    }
}
