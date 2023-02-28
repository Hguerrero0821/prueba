@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <center><h3 class="page__heading">Tabla de Roles y Permisos</h3></center>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- Boton para crear rol --}}
                        <a class="btn btn-primary" href="{{ route('roles.create') }}">Crear Rol</a>



                            <table class="table table-striped mt-3">
                                <thead style="background-color:#00008B">
                                    <th style="color:#fff;">Roles</th>
                                    <th style="color:#fff;">Descripcion del rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->descripcion }}</td>
                                    <td>
                                        {{-- Boton para editar rol --}}
                                            <a class="btn btn-warning" href="{{ route('roles.edit',$role->id) }}">Editar</a>

                                        {{-- Boton para borrar rol --}}
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
