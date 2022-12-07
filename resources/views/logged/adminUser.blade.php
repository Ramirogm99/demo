@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
 <h1><i class="fas fa-user"></i> Listado de Usuarios</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="users/add" class="btn btn-primary"><i class="fas fa-plus"></i>Añadir usuarios</a>
                
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive">
                        <table id="tablaestados" style="width:100%; border: 0;"
                            class="table table-hover table-striped table-bordered table-sm display">
                            <thead class="thead-tabla">
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;" data-field="id">ID</th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="Estados">Nombre
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="Estados">Email
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="Estados">Activado
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="Acciones"
                                        id="acciones" class="max-width:100px">Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; ">{{ $usuario->id }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $usuario->name }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $usuario->email }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if ($usuario->borrado == 0)
                                                Sí
                                            @else
                                                No
                                            @endif
                                        </td>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-sm btn-danger delete-button" data-toggle="modal"
                                            data-target="#modalmessage" data-val="{{ $usuario->id }}"><i
                                                class="fas fa-trash-alt"></i></button>
                                            
                                            <a href="{{ url('') }}/users/edit/{{ $usuario->id }}"
                                                class='btn btn-sm btn-primary'><i class="fas fa-pencil-alt"></i></a>

                                            {{-- Boton borrar que envia a un modal --}}

                                        </td>
                                    </tr>
                                @endforeach

                                {{-- MODAL LANZADO AL TRATAR DE ELIMINAR --}}

                                <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación
                                                    de borrado</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p> ¿Está seguro de que desea eliminar los datos?</p>
                                                <p>Esta operación no puede deshacerse </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <p></p>
                                                @if (isset($usuario))
                                                    <a href="{{ url('') }}/users/delete/{{ $usuario->id }}"
                                                        class='btn btn-danger'>Eliminar</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @stop

                            @section('js')

                                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                                <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                                </script>

                                <script async>
                                    $(document).ready(function() {
                                        $('#tablaestados').DataTable({
                                            "lengthMenu": [20, 50, 100, 200, 500, 1000],
                                            language: {
                                                "decimal": "",
                                                "emptyTable": "No hay información",
                                                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                                "infoPostFix": "",
                                                "thousands": ",",
                                                "lengthMenu": "Mostrar: <br>_MENU_ Entradas",
                                                "loadingRecords": "Cargando...",
                                                "processing": "Procesando...",
                                                "search": "Buscar:<br>",
                                                "zeroRecords": "Sin resultados encontrados",
                                                "paginate": {
                                                    "first": "Primero",
                                                    "last": "Ultimo",
                                                    "next": "Siguiente",
                                                    "previous": "Anterior"
                                                }
                                            },
                                            columnDefs: [{}],
                                            aaSorting: [
                                                [0, 'asc']
                                            ],

                                        });
                                    })
                                </script>

                            @stop
