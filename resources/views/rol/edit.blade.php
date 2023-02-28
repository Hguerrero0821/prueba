@extends('layouts.app')

@section('content')

    <head>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Menú</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::model($roles, ['method' => 'PUT','route' => ['roles.update', $roles->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Rol</label>
                                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    {!! Form::text('descripcion', null, array('class' => 'form-control')) !!}
                                </div>

                                <table class="table">
                                <thead class="table-dark">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Usuarios</th>
                                </thead>

                                <tbody>
                                    <table class="table" id="usuarios_table">

                                        @foreach($users_rol as $u_r)
                                        <tbody>
                                            <tr class="row">
                                                <td>
                                                <select class="select w-100" name="New_usuario_id[]" id="New_usuario_id" >
                                                    @foreach ($usuarios as $usuario)
                                                        <option
                                                            value="{{$usuario->id}}"
                                                            @if ($usuario->id == $u_r->user_id)
                                                                selected
                                                            @endif>
                                                            {{$usuario->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                 </td>
                                                <td class="col-sm-2">
                                                    <button id="delete_row_dir"
                                                            name="delete_row_dir"
                                                            type="button"
                                                            style="background-color: #b21f2d ;color: white;font-weight: bold"
                                                            onclick="BotonEliminarDir(this)"> - Eliminar </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach

                                        {{-- @foreach ($users_roles as $key => $value)
                                        <tbody>
                                            <tr class="row">
                                                <td>
                                                    {{$users_roles['rol_id']}}
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach --}}

                                        {{-- @foreach ($users_roles as $users_rol)
                                        <tbody>
                                            <tr class="row">
                                                <td>
                                                <select class="select w-100" name="New_usuario_id[]" id="New_usuario_id" >
                                                    @foreach ($usuarios as $usuario)
                                                            <option value="{{$usuario->id}}" @if($users_rol->user_id == $usuarios->id) selected @endif> {{$usuario->name}} </option>
                                                    @endforeach
                                                </select>
                                                    {{$users_rol['rol_id']}}
                                                </td>
                                                <td class="col-sm-2">
                                                    <button id="delete_row_dir"
                                                            name="delete_row_dir"
                                                            type="button"
                                                            style="background-color: #b21f2d ;color: white;font-weight: bold"
                                                            onclick="BotonEliminarDir(this)"> - Eliminar </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach --}}

                                    </table>

                            </tbody>
                        </table>
                            <div class="form-outline">
                                <div class="col-md-5">
                                    <button
                                        id="add_row_dir"
                                        name="add_row_dir"
                                        type="button"
                                        style="background-color: lightskyblue;color: white;font-weight: bold"
                                        onclick="BotonAgregarDir(this)">+ Nuevo usuario</button>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                    </form>
                    {!! Form::close() !!}
        </section>
<script>
            function BotonAgregarDir(element) {
            var table = document.getElementById('usuarios_table');
            var tbody = document.createElement('tbody');
            tbody.className = "card-body p-md-6 text-black";
            var tr = document.createElement('tr');
            tr.className = "row"
            var rowhtml = table.children[0];

     //Se reemplaza "checked" para que no se inserte el row con el checkbox activo.
     tr.innerHTML = (rowhtml.innerHTML).replace("selected", "");
     var cont= 0;

     tbody.appendChild(tr);
     table.appendChild(tbody);

 }

 function BotonEliminarDir(element) {
     try {


         var table = document.getElementById('usuarios_table');
         var cntRows = table.children.length;
         var rowClicked = element.parentNode.parentNode.parentNode
          console.log(element.parentNode.parentNode.parentNode);

         if (cntRows >1)
         {
             for (i=0; i < cntRows; i++){

                         rowClicked.remove();
             }
         }
         else
            alert("No puede eliminar todos los usuarios!!!")
     }
     catch (e) {
         alert(e);
     }
 }

 </script>
@endsection
