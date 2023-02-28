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

                        {!! Form::model($roles, ['method' => 'PUT','route' => ['rolesmenu.update', $roles->id]]) !!}
                        <div class="row">
                                        <tbody>
                                            <tr class="row">
                                                <td>
                                                <select class="select w-100" name="New_rol_id" id="New_rol_id" >
                                                    @foreach ($roles_names as $roles_name)
                                                        <option
                                                            value="{{$roles_name->id}}"
                                                            @if ($roles_name->id == Request::segment(2))
                                                                selected
                                                            @endif>
                                                            {{$roles_name->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                 </td>

                                            </tr>
                                        </tbody>
                                <table class="table">
                                <tbody>
                                    <table class="table" id="products_table">
                                        <thead>
                                            <tr>
                                                <th>Submenus</th>
                                                <th>CREAR</th>
                                                <th>EDITAR </th>
                                                <th>ELIMINAR</th>
                                                <th>ELIMINAR ROW</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles_menus as $roles_menu)
                                                <tr class="">
                                                    <td>
                                                        <select class="select w-100" name="New_submenu_id[]" id="New_submenu_id" >
                                                            @foreach ($submenus as $submenu)
                                                                <option
                                                                    value="{{$submenu->id}}"
                                                                    @if ($submenu->id == $roles_menu->submenu_id)
                                                                        selected
                                                                    @endif>
                                                                    {{$submenu->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        CREAR
                                                        <select name="submenu_crear[]" id="">
                                                            <option value="0">No</option>
                                                            <option
                                                                @if ($roles_menu->crear ?? '' == '1')
                                                                    selected
                                                                @endif
                                                                value="1"
                                                            >Si
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        EDITAR
                                                        <select name="submenu_editar[]" id="">
                                                            <option value="0">No</option>
                                                            <option
                                                            @if ($roles_menu->editar ?? '' == '1')
                                                                selected
                                                            @endif
                                                            value="1"
                                                            >Si
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        ELIMINAR
                                                        <select name="submenu_eliminar[]" id="">
                                                            <option value="0">No</option>
                                                            <option
                                                            @if ($roles_menu->eliminar ?? '' == '1')
                                                                selected
                                                            @endif
                                                            value="1"
                                                            >Si
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="">
                                                        <button id="delete_row_dir"
                                                                name="delete_row_dir"
                                                                type="button"
                                                                style="background-color: #b21f2d ;color: white;font-weight: bold"
                                                                class="js-delete-row-dir"> - Eliminar </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            <div class="form-outline">
                                <div class="col-md-15">
                                    <button
                                        id="add_row_dir"
                                        name="add_row_dir"
                                        type="button"
                                        style="background-color: lightskyblue;color: white;font-weight: bold"
                                        class="js-add-row-dir">+ Otro submenu</button>
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
        @endsection
        @section('third_party_scripts')
<script>
    $(document).ready(function(){
        $('.js-add-row-dir').click(function(){
            $('#products_table tbody:last').append('<tr>'+
                $('#products_table tbody').find('tr:first').html()+'</tr>'
            );
            $('#products_table tbody tr:last td:first select').prop('selectedIndex',0);
            $(".js-delete-row-dir").unbind();
            $(".js-delete-row-dir").click(deleteRow);
        });
        let deleteRow = function(){
            let identifire = $(this).closest('tr');
            let count_table = $('#products_table tbody tr').length;
            if(count_table > 1){
                identifire.remove();
            } else
                alert("Este rol requiere al menos un submenu!!!")
        };
        $('.js-delete-row-dir').click(deleteRow);

    });
 </script>
@endsection
''
