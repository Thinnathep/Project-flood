<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !Auth::user()->hasRole(...$roles)) {
            return redirect('/'); // เปลี่ยนเส้นทางหากไม่มีบทบาทที่ต้องการ
        }

        return $next($request);
    }

}

