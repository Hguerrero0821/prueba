<?php

namespace App\Providers;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Submenu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {

            if(isset(Auth::user()->id)) {


                $usuarios_submenus =DB::table('roles_usuarios as A')
                ->join('rol_menus as B','A.rol_id', '=', 'B.rol_id')

                ->join('submenu as D','D.id', '=', 'B.submenu_id')

                ->join('menu as F','F.id', '=', 'D.menu_id')
                ->select(
                     'A.rol_id', 'B.submenu_id', 'D.menu_id','A.user_id','D.name as name2',
                      'D.url', 'F.name as name3'
                )
                ->where('A.user_id','=',Auth::user()->id)
                ->orderBy('F.id','asc')
                ->orderBy('D.id','asc')
                ->get();

            // Accedemos a las variables de domio del env
            $url_host = config('app.url');
            $url_port = config('app.port');
            // Cargamos todos los url de los submenus y le cambiamos el valor
            // concatenando el valos del archivo env
               for($i = 0;count($usuarios_submenus)>$i; $i++) {

                    $usuarios_submenus[$i]->url = $url_host.$url_port.$usuarios_submenus[$i]->url;

                }

                $view->with(['gbl_menus'=>$usuarios_submenus]);

                }

        });
    }
}
