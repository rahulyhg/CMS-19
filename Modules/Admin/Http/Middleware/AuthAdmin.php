<?php
/**
 * Created by PhpStorm.
 * User: pss
 * Date: 02/03/2018
 * Time: 16:40
 */

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
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
        if (!Auth::guard('admin')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('admin/login');
            }
        }
        return $next($request);
    }
}