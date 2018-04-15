<?php

namespace App\Http\Middleware;

use Closure;
use App\App\Components\AdminPanelMenu;

class AdminMenu
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
        AdminPanelMenu::menu($request->user());

        return $next($request);
    }
}
