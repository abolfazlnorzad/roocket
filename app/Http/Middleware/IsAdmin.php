<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    use ApiResponser;


    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() and auth()->user()->is_admin)
            return $next($request);

        return $this->errorResponse("You do not have permission to access",403);
    }
}
