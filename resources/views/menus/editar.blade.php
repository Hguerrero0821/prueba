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

                        {!! Form::model($menu, ['method' => 'PUT','route' => ['menus.update', $menu->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del menú padre</label>
                                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="url">Descripción</label>
                                    {!! Form::text('url', null, array('class' => 'form-control')) !!}
                                </div>




                                <table class="table">

                                    <thead class="table-dark">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">submenú (hijos)</th>
                                    </thead>

                                    <tbody>
                                        <table class="table" id="submenus_table">
                                            <?php
                                            for ($i=0; $i < sizeof($submenus); $i++) {
                                                echo '<tbody><tr class="row">';
                                                $tr_input = '<td class="col-0">';
                                                $tr_input = $tr_input . '<input type="text" name="submenus_id[]" id="submenu_update_id"';
                                                $tr_input = $tr_input . 'class="form-control form-control-md"';
                                                $tr_input = $tr_input . 'value="' . $submenus[$i]['id'] . '" hidden/>';
                                                $tr_input = $tr_input . '</td>';
                                                echo PHP_EOL . "\t\t\t\t\t\t\t\t\t\t\t" . $tr_input . PHP_EOL;

                                                $tr_input = '<td class="col-sm-2">';
                                                $tr_input = $tr_input . '<label class="form-label" for="form3Example1m">Nombre submenu</label>';
                                                $tr_input = $tr_input . '<input type="text" name="submenus_name[]" id="submenu_update_name"';
                                                $tr_input = $tr_input . 'class="form-control form-control-md"';
                                                $tr_input = $tr_input . 'value="' . $submenus[$i]['name'] . '"/>';
                                                $tr_input = $tr_input . '</td>';
                                                echo "\t\t\t\t\t\t\t\t\t\t\t" . $tr_input . PHP_EOL;

                                                $tr_input = '<td class="col-sm-3">';
                                                $tr_input = $tr_input . '<label class="form-label" for="form3Example1m">URL</label>';
                                                $tr_input = $tr_input . '<input type="text" name="submenus_url[]" id="submenu_update_url"';
                                                $tr_input = $tr_input . 'class="form-control form-control-md"';
                                                $tr_input = $tr_input . 'value="' . $submenus[$i]['url'] . '"/>';
                                                $tr_input = $tr_input . '</td>';
                                                echo "\t\t\t\t\t\t\t\t\t\t\t" . $tr_input . PHP_EOL;
                                                $tr_input = '<td class="col-sm-2">';
                                                $tr_input = $tr_input . '<button id="delete_row_dir" name="delete_row_dir" ';
                                                $tr_input = $tr_input . 'type="button" style="background-color: #b21f2d ;color: white;font-weight: bold" ';
                                                $tr_input = $tr_input . 'onclick="BotonEliminarDir(this)">- Eliminar</button>';
                                                $tr_input = $tr_input . '</td>';
                                                echo "\t\t\t\t\t\t\t\t\t\t\t" . $tr_input . PHP_EOL;

                                                echo "\t\t\t\t\t\t\t\t\t\t\t</tr></tbody>" . PHP_EOL;
                                            }
                                        ?>
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
                                        onclick="BotonAgregarDir(this)">+ Nuevo submenu</button>
                                </div>
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
        <script>
           function BotonAgregarDir(element) {
           var table = document.getElementById('submenus_table');
           var tbody = document.createElement('tbody');
           tbody.className = "card-body p-md-6 text-black";
           var tr = document.createElement('tr');
           tr.className = "row"
           var rowhtml = table.children[0];

    //Se reemplaza "checked" para que no se inserte el row con el checkbox activo.
    tr.innerHTML = (rowhtml.innerHTML).replace("checked", "");
    console.log(tr.children[0]);
    console.log(tr.children[1]);
    var cont= 0;

    //se resetean los valores de todos los inputs
    tr.children[cont++].children["submenus_id[]"].setAttribute('value', "");
    tr.children[cont++].children["submenus_name[]"].setAttribute('value', "");
    tr.children[cont++].children["submenus_url[]"].setAttribute('value', "");

    tbody.appendChild(tr);
    table.appendChild(tbody);

}

function BotonEliminarDir(element) {
    try {


        var table = document.getElementById('submenus_table');
        var cntRows = table.children.length;
        var rowClicked = element.parentNode.parentNode.parentNode
         console.log(element.parentNode.parentNode.parentNode);

        if (cntRows >1)
        {
            for (i=0; i < cntRows; i++){

                        rowClicked.remove();
            }
        }
    }
    catch (e) {
        alert(e);
    }
}

</script>
@endsection
