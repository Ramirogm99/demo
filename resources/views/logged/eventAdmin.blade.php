@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <h1><i class="fas fa-calendar-check"></i> Listado de Eventos</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-sm btn-primary create-button" data-toggle="modal" data-target="#modalmessage3"><i
                        class="fas fa-plus"></i> Añadir eventos</button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive">
                        <table id="tablaestados" style="width:100%; border: 0;"
                            class="table table-hover table-striped table-bordered table-sm display">
                            <thead class="thead-tabla">
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;" data-field="id">ID</th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="evento">Nombre
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="color">Fondo
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="borde">Borde
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="texto">Texto
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;" data-field="Acciones"
                                        id="acciones" class="max-width:100px">Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventos as $evento)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; ">{{ $evento->id }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $evento->evento }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ $evento->backgroundColor }} <input type="color"
                                                value="{{ $evento->backgroundColor }}" disabled></td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $evento->borderColor }}
                                            <input type="color" value="{{ $evento->borderColor }}" disabled>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $evento->textColor }}
                                            <input type="color" value="{{ $evento->textColor }}" disabled>
                                        </td>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" id="delete_button"
                                                data-bs-target="#modalmessage" data-bs-whatever="{{ $evento->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>

                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" id="edit_button"
                                                data-bs-target="#modalmessage2" data-bs-whatever="{{ $evento->id }}"><i
                                                    class="fas fa-pencil-alt"></i></button>

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
    {{-- MODAL LANZADO AL TRATAR DE ELIMINAR --}}

    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de operación
                        de borrado</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> ¿Está seguro de que desea eliminar los datos?</p>
                    <p>Esta operación no puede deshacerse </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <p></p>
                    @if (isset($evento))
                        <a href="{{ url('') }}/event/delete/{{ $evento->id }}" id="modal_url" class='btn btn-danger'>Eliminar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalmessage2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                        cambio
                        de datos</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (isset($evento))
                    <form action="{{ url('') }}/event/update/{{ $evento->id }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="evento">Nombre de evento</label> <input type="text" name="evento"
                                        value="" class="form-control input-lg" id="nameEvent" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">

                                    <label for="backgroundColor">Color del fondo</label> <input type="color"
                                        name="backgroundColor" value="#FFFFFF"
                                        class="form-control input-lg" id="backgroundColor" required>
                                </div>
                                <div class="form-group col-md-4">

                                    <label for="textColor">Color del texto</label> <input type="color" name="textColor"
                                        value="#FFFFFF" class="form-control input-lg" id="textColor" required>
                                </div>
                                <div class="form-group col-md-4">

                                    <label for="borderColor">Color del borde</label> <input type="color"
                                        name="borderColor" value="#FFFFFF"
                                        class="form-control input-lg" id="borderColor" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <p></p>
                            @if (isset($evento))
                                <button type="submit" class='btn btn-success'>Guardar</button>
                            @endif
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalmessage3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                        cambio
                        de datos</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('') }}/event/save" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="evento">Nombre de evento</label> <input type="text" name="evento"
                                    value="" class="form-control input-lg" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">

                                <label for="backgroundColor">Color del fondo</label> <input type="color"
                                    name="backgroundColor" value="#FFFFFF" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4">

                                <label for="textColor">Color del texto</label> <input type="color" name="textColor"
                                    value="#FFFFFF" class="form-control input-lg" required>
                            </div>
                            <div class="form-group col-md-4">

                                <label for="borderColor">Color del borde</label> <input type="color" name="borderColor"
                                    value="#FFFFFF" class="form-control input-lg" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <p></p>
                        <a href="" id="modal_url" class='btn btn-success'>Guardar</a>
                    </div>
                </form>
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

    <script await>
        $(document).ready(function() {
            var Modal = document.getElementById('modalmessage')
            Modal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an AJAX request here
                $('#modalmessage').find("a").first().attr("href", "{{ url('') }}/event/delete/" +
                recipient);

            })
            var Modal2 = document.getElementById('modalmessage2')
            Modal2.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever')
                var text = document.getElementById('textColor');
                var border = document.getElementById('borderColor');
                var background = document.getElementById('backgroundColor');
                var name = document.getElementById('nameEvent');
                const response = fetch("{{url('')}}/event/ajaxEvent/"+recipient,{
                    method: "GET",
                }).then(r => r.json())
                .then(data => {
                
                    name.value = data.evento;
                    text.value = data.textColor;
                    border.value = data.borderColor; 
                    background.value = data.backgroundColor;
                })

                // If necessary, you could initiate an AJAX request here
                $('#modalmessage2').find("form").first().attr("action", "{{ url('') }}/event/update/" +
                recipient);

            })
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
