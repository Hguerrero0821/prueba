<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\AccessUser;

use function PHPUnit\Framework\isNull;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(AccessUser::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu:: all();

       /*  $id = 80;
        $menus = Menu::find($id);
        $submenus = Submenu::where('menu_id','=',$menus->id)->get();
 */


        return view('menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('menus.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  $this->validate($request, [
            'name' => 'required|unique:menu,name'



        ]);

        $input = Request()->all();


        $salida = Menu::create($input);

        // dd($request);
        for($i = 0; $i < sizeof($request->submenu_name); $i++)
            {
                $submenu[] = [
                    'menu_id' => $salida->id,
                    'name' => $request->submenu_name[$i],
                ];
            }
            $salida2 = Submenu::insert($submenu); */

            DB::beginTransaction();
             $menus = new Menu();

            $menus->name = $request->get('name');
            $menus->url = $request->get('url');
            $menus->save();

            //hijos new
            //dd($request);
            //$sql = $request->get('submenu_name');
            $sql = $request->get('submenu_url');
            $cant = count($sql);

            if($cant > 0) {

                for($i=0;$i < $cant;$i++) {

                    $submenu_name = $request->get('submenu_name')[$i];
                    $submenu_url = $request->get('submenu_url')[$i];

                    $submenus[] =  [

                        'menu_id'=> $menus->id,
                        'name'=> $submenu_name,
                        'url'=> $submenu_url
                    ];

                }
            }


           /*  foreach($request->get('submenu_name','submenu_url') as $i) {
                dd($request);
                $submenus = new Submenu();
                $submenus->name = $i;
                $submenus->url = $i;
                $submenus->menu_id = $menus->id;
                $submenus->save();


            } */

            Submenu::insert($submenus);

            DB::commit();

        return redirect('menus');
    }


    /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* $menu = Menu::with('submenu')->get()->find($id);
        return view('menus.editar',compact('menu')); */
        $menu = Menu::find($id);
        //$menus = Menu::find($id);
        $submenus = Submenu::where('menu_id','=',$menu->id)->get();
        return view('menus.editar', compact('menu','submenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
/*
        $this->validate($request, [
            'name' => 'required',
        ]);

        $menu = Menu::find($id)->update($request->all());
        return redirect('menus'); */
        DB::beginTransaction();
        $menu = Menu::find($id);
        $menu->name = $request->get('name');
        $menu->url = $request->get('url');
        $menu->save();



        //hijos update
        $reg_new_id =request()->submenus_id;
        $reg_new_submenu = request()->submenus_name;
        $reg_submenu_url = request()->submenus_url;

        //Cargo un Arreglo del Modelo, pero solo con el campo id
        $reg_ori_submenu= (Submenu::where('menu_id','=',$menu->id)->get())->pluck('id')->toArray();
        //carga un arreglo con los Ids que se van a eliminar o se eliminaron en el Blade
        $reg_del_submenus = array_diff($reg_ori_submenu,$reg_new_submenu);

        //Elimino los Ids que están en la base de datos, pero no en el arreglo de la pagina.
        Submenu::destroy($reg_del_submenus);


        for($i = 0; $i < sizeof($reg_new_submenu); $i++) {

            Submenu::updateOrCreate(
                [
                        'id' => $reg_new_id[$i] == null ? 0 : $reg_new_id[$i]
                ],

                [
                    'menu_id'=> $id,
                    'name'=>$reg_new_submenu[$i],
                    'url' => $reg_submenu_url[$i]
                ]
        );
    }
        DB::commit();


        return redirect('menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        //Menu::destroy($id);
        session()->flash('menu-eliminado-mensaje','Menu Eliminado: ' . $menu->name);




        return redirect('menus');
    }


}
