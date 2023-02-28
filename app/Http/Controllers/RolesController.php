<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\RolesUsuarios;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\AccessUser;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware(AccessUser::class);
     }

    public function index()
    {
        $roles = Roles::all();
        return view('rol.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::all();
        $usuarios = User:: All();
        return view('rol.crear',compact('roles','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = Roles::all();
        DB::beginTransaction();

        $role = new Roles();
        $role->name = $request->get('name');
        $role->descripcion = $request->get('descripcion');
        $role->save();
        //usuarios
        $sql = $request->get('usuario_id');
        // dd($sql);
        $cant = count($sql);

        if($cant > 0) {

            for($i=0;$i < $cant;$i++) {

                $user_name = $request->get('usuario_id')[$i];

                $users[] =  [

                    'rol_id'=> $role->id,
                    'user_id'=> $user_name
                ];

            }
        }
        RolesUsuarios::insert($users);

        DB::commit();

        return redirect('roles');

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
        $roles = Roles::find($id);
        $usuarios = User::all();
        $users_rol = RolesUsuarios::where('rol_id','=',$roles->id)->get('user_id');
        //dd($usuarios[0]->RolesUsuarios()->where('rol_id','=',$roles->id)->first());
        return view('rol.edit',compact('roles','users_rol','usuarios'));

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
        //$roles = Roles::paginate(5);
        DB::beginTransaction();
        $roles = Roles::find($id);
        $roles->name = $request->get('name');
        $roles->descripcion = $request->get('descripcion');
        $roles->save();

        //hijos update
        $reg_new_users = request()->New_usuario_id;
        //dd($reg_new_users);

        //Cargo un Arreglo del Modelo, pero solo con el campo id
        //$reg_ori_users= (RolesUsuarios::where('rol_id','=',$roles->id)->get())->pluck('user_id')->toArray();
        $reg_ori_users= (RolesUsuarios::where('rol_id','=',$id)->get())->pluck('user_id')->toArray();
        //dd($reg_ori_users);
        //carga un arreglo con los Ids que se van a eliminar o se eliminaron en el Blade
        $reg_del_users = array_diff($reg_ori_users,$reg_new_users);
        //dd($reg_del_users);
        //Elimino los Ids que están en la base de datos, pero no en el arreglo de la pagina.
        //RolesUsuarios::destroy($reg_del_users,'user_id');*<j
        RolesUsuarios::where('user_id', $reg_del_users)->delete();
        //dd($reg_del_users);
        for($i = 0; $i < sizeof($reg_new_users); $i++) {

            RolesUsuarios::updateOrCreate(
                [
                        'rol_id' => $id == null ? 0 : $id,
                        'user_id'=>$reg_new_users[$i]
                ]
        );
    }
        DB::commit();


        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roless")->where('id',$id)->delete();
        return redirect('roles');
    }
}
