<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class AccessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $parcial_url = request()->segment(1);
        //dd(Route::currentRouteAction());
            // dd($parcial_url);
        // dd($parcial_url);
        $usuarios_submenus =DB::table('roles_usuarios as A')
                ->join('rol_menus as B','A.rol_id', '=', 'B.rol_id')

                ->join('submenu as D','D.id', '=', 'B.submenu_id')

                ->join('menu as F','F.id', '=', 'D.menu_id')
                ->select(
                     'A.rol_id', 'B.submenu_id', 'D.menu_id','A.user_id','D.name as name2',
                      'D.url', 'F.name as name3','B.crear','B.editar','B.eliminar'
                )
                ->where('A.user_id','=',Auth::user()->id)
                ->where('D.url','=', $parcial_url)
                ->orderBy('F.id','asc')
                ->orderBy('D.id','asc')
                ->get();
            // dd($usuarios_submenus[0]->crear);

            if(count($usuarios_submenus)>0){
                $route = Route::currentRouteAction();
                $action = explode('@',$route)[1];
                if ( ($action == 'index')
                    || (in_array($action, array('create','store')) && $usuarios_submenus[0]->crear ?? 0 == 1)
                    || (in_array($action, array('edit','update')) && $usuarios_submenus[0]->editar ?? 0 == 1)
                    || (in_array($action, array('destroy')) && $usuarios_submenus[0]->eliminar ?? 0 == 1)
                ){
                    return $next($request);
                }

            }
            return redirect('/home');



    }
}
