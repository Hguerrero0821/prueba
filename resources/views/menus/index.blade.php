@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <center><h3 class="page__heading">Mantenimiento de Menús</h3></center>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">

                          <a class="btn btn-primary" href="{{ route('menus.create') }}">Crear Menú</a>


                          <table class="table table-striped mt-3">
                              <thead class="table-dark">
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre del menú</th>
                                  <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                                @foreach ($menus as $menu)
                                  <tr>
                                    <td style="display: none;">{{ $menu->id }}</td>
                                    <td>{{ $menu->name }}</td>

                                    <td>

                                        <a class="btn btn-warning" href="{{ route('menus.edit',$menu->id) }}">Editar</a>

                                        {!! Form::open(['method' => 'DELETE','route' => ['menus.destroy', $menu->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}

                                    </td>

                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                          <div class="pagination justify-content-end">

                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection
