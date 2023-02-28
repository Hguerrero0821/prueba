@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <center><h3 class="page__heading">Tabla de Roles y perfiles</h3></center>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @can('crear-rol')
                        <a class="btn btn-primary" href="{{ route('roles.create') }}">Nuevo</a>
                        @endcan


                            <table class="table table-striped mt-2">
                                <thead style="background-color:#00008B">
                                    <th style="color:#fff;">Roles</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('editar-rol')
                                            <a class="btn btn-warning" href="{{ route('rol.edit',$role->id) }}">Editar</a>
                                        @endcan

                                        @can('borrar-rol')
                                            {!! Form::open(['method' => 'DELETE','route' => ['rol.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
