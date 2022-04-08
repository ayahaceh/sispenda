<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekRoleMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles) // Tambah $group utk mengirim role usernya apa
    {
        if (in_array($request->user()->user_group, $roles)) {  // jika user role = $role
            return $next($request); // Lanjutkan sesuai request
        }
        return redirect('/forbiden');
    }
}
