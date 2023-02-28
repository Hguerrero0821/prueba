@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <center><h3 class="page__heading">Tabla de Roles X Menu</h3></center>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        {{-- Boton para crear rol x menu --}}
                        <a class="btn btn-primary" href="{{ route('rolesmenu.create') }}"> CREAR ROL X MENU</a>



                            <table class="table table-striped mt-3">
                                <thead class="table-dark">
                                    <th style="color:#fff;">Roles</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                        @foreach ($roles_menus as $roles_menu)

                                                <tr>
                                                        <td>{{ $roles_menu->name }}</td>

                                                    <td>
                                                        {{-- Boton para editar roles x menu --}}
                                                            <a class="btn btn-warning" href="{{ route('rolesmenu.edit',$roles_menu->id) }}">Editar</a>


                                                        {{-- Boton para eliminar rol x menu --}}
                                                            {!! Form::open(['method' => 'DELETE','route' => ['rolesmenu.destroy', $roles_menu->id],'style'=>'display:inline']) !!}
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
