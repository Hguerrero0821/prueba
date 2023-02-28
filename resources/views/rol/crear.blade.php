@extends('layouts.app')

    @section('content')
    <head>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>

    <section class="section">
        <div class="section-header">
            <center><h3 class="page__heading">ROLES Y PERMISOS</h3></center>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert" >
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Rol</label>
                                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripción del rol</label>
                                    {!! Form::text('descripcion', null, array('class' => 'form-control')) !!}
                                </div>

                            </div>


                            <div class="card-body">
                                <table class="table" id="products_table">
                                    <thead>
                                        <tr>
                                            <th>USUARIOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="product0">

                                            <td>
                                                <select class="select w-100" name="usuario_id[]" id="usuario_id" >
                                                    <option value="0" >Ninguno</option>

                                                    @foreach ($usuarios as $usuario)
                                                            <option value="{{$usuario->id}}" >{{$usuario->name}}</option>
                                                    @endforeach

                                                </select>
                                            </td>

                                            <td>

                                            </td>
                                            <td>
                                                <button id='' type = "button" class="pull-right btn btn-danger js-action-eliminar">ELIMINAR</button>
                                            </td>
                                        </tr>
                                        <tr id="product1"></tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="add_row" class="btn btn-default pull-left">+ Agregar Otro</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                    </form>
                    {!! Form::close() !!}
        </section>

    @endsection
    @section('third_party_scripts')


    <script>
        $(document).ready(function(){
            let row_number = 1;
            $("#add_row").click(function(e){
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).append($('#products_table tbody tr:first').html().toString());
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                console.log($('#product' + row_number +' td:last button'));
                row_number++;
                $(".js-action-eliminar").unbind();
                $(".js-action-eliminar").click(functionDelete);


            });
            let functionDelete = function(e){
                e.preventDefault();
                let identifire = $(this).closest('tr').attr('id');
                let count_table = $('#products_table tbody tr').length - 1;
                console.log(count_table);
                if(count_table > 1){
                    $("#" + identifire ).remove();
                } else
                        alert("Este rol requiere al menos un submenu!!!")
            };
            $(".js-action-eliminar").click(functionDelete);
    });
</script>
@endsection




