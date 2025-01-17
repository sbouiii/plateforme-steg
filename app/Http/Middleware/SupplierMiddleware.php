<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupplierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('supplier')->check()) {
            return redirect()->route('supplier.login');
        }
        return $next($request);
    }
}
