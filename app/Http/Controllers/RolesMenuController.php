<?php

namespace App\Http\Controllers;
use App\Models\Roles;
use App\Models\RolMenu;
use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;
use App\Http\Middleware\AccessUser;

class RolesMenuController extends Controller
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
        //$roles = Roles::all()->pluck('name','id');
        $roles_menus = Roles::has('RolMenu')->get();
        return view('RolMenu.index',compact('roles_menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all();
        $submenus = Submenu:: All();
        return view('RolMenu.crear',compact('roles','submenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        // dd($request->all());
        //Se cargan y guarda los roles y submenus seleccionados
         $role = new RolMenu();
         $role = $request->get('rol_id');
         $sql = $request->get('submenu_id');
         //Se cuentan cuantos datos vienen de la seleccion
         $cant = count($sql);
        //  dd($request);
         if($cant > 0) {

            for($i=0;$i < $cant;$i++) {

                $submenu_id = $request->get('submenu_id')[$i];
                $submenu_crear = $request->get('submenu_crear')[$i];
                $submenu_editar = $request->get('submenu_editar')[$i];
                $submenu_eliminar = $request->get('submenu_eliminar')[$i];

                $rol_menu[] =  [

                    'rol_id'=> $role,
                    'submenu_id'=> $submenu_id,
                    'crear'=> $submenu_crear,
                    'editar'=>$submenu_editar,
                    'eliminar'=>$submenu_eliminar
                ];

            }
        }
        RolMenu::insert($rol_menu);

        DB::commit();

        return redirect('rolesmenu');

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
        $roles_names = Roles::all();
        $roles = Roles::find($id);
        $submenus = Submenu:: all();
        $roles_menus = RolMenu::where('rol_id','=',$roles->id)->get();
        return view('RolMenu.edit',compact('roles','submenus','roles_menus','roles_names'));
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
         DB::beginTransaction();
         $role = Roles::find($id);
         $roles_name = $request->get('New_rol_id');
        //  dd($roles_name );
         $reg_new_submenus = $request->get('New_submenu_id');
        //  dd($reg_new_submenus );
         $reg_ori_submenus= (RolMenu::where('rol_id','=',$role->id)->get())->pluck('submenu_id')->toArray();

         $reg_del_submenus = array_diff($reg_ori_submenus,$reg_new_submenus);

         RolMenu::where('submenu_id', $reg_del_submenus)->delete();

         for($i = 0; $i < sizeof($reg_new_submenus) ; $i++) {
            // delete
            $currentRolMenu =  RolMenu::where('rol_id',$id)->where('submenu_id',$reg_new_submenus[$i]);

            if($currentRolMenu){

                $currentRolMenu->delete();
            }
            $submenu_crear = $request->get('submenu_crear')[$i];
            $submenu_editar = $request->get('submenu_editar')[$i];
            $submenu_eliminar = $request->get('submenu_eliminar')[$i];

            // create
            RolMenu::create(
                 [
                         'rol_id' => $roles_name,
                         'submenu_id'=>$reg_new_submenus[$i],
                         'crear'=> $submenu_crear,
                         'editar'=>$submenu_editar,
                         'eliminar'=>$submenu_eliminar
                 ]
         );
     }
         DB::commit();


         return redirect('rolesmenu');
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("rol_menus")->where('rol_id',$id)->delete();
        return redirect('rolesmenu');
    }
}
