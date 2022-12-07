@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1><i class="fas fa-calendar-check"></i> Listado de Eventos</h1>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.css">
    <style>
        #calendar {
            max-width: 70%;
            margin: 0 auto;
            padding-bottom: 5%;
        }
    </style>
@stop

@section('content')
    <div id='calendar'></div>
    <div id="createEventModal" class="modal fade">
        <form action='{{ url('') }}/calendar/crudDate' id="formsubmit" method="GET">
            <input type="hidden" name="tipo" value="1">
            <input type="hidden" value="{{ Auth::user()->id }}" id="id_usuario" name="ID_USUARIO">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4> Añadir un evento </h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                            <span class="sr-only">close</span></button>
                    </div>
                    <div id="modalBody" class="modal-body">
                        <div class="form-group">
                            <input name="title" class="form-control" type="text" placeholder="Event Name"
                                id="title">
                        </div>

                        <div class="form-group form-inline">
                            <div class="input-group date" data-provide="datepicker">
                                <label for="start">Fecha de inicio</label>
                                <input name="start" type="date" id="start" class="form-control">
                            </div>
                            <div class="input-group date" data-provide="datepicker">
                                <label for="start">Fecha de finalizacion</label>
                                <input name="end" type="date" id="end" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control" placeholder="Tipo de evento" id="eventDescription"
                                name="ID_EVENTOS">
                                @foreach ($tipoEventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->evento }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="changeModal" class="modal fade">
        <form action='{{ url('') }}/calendar/crudDate' id="formsubmit2" method="GET">
            <input type="hidden" name="id" id="id_event">
            <input type="hidden" name="tipo" id="tipoAjax" value="2">
            <input type="hidden" value="{{ Auth::user()->id }}" id="id_usuario" name="ID_USUARIO">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4> Actualizar un evento</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                            <span class="sr-only">close</span></button>
                    </div>
                    <div id="modalBody" class="modal-body">
                        <div class="form-group">
                            <input name="title" class="form-control" type="text" placeholder="Event Name"
                                id="title2" required>
                        </div>

                        <div class="form-group form-inline">
                            <div class="input-group date" data-provide="datepicker">
                                <label for="start">Fecha de inicio</label>
                                <input name="start" type="date" id="start2" class="form-control">
                            </div>
                            <div class="input-group date" data-provide="datepicker">
                                <label for="start">Fecha de finalizacion</label>
                                <input name="end" type="date" id="end2" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control" placeholder="Tipo de evento" id="eventDescription"
                                name="ID_EVENTOS" required>
                                @foreach ($tipoEventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->evento }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-grey" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="saveEvent">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        SITEURL = '{{ url('') }}';

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventSources: [{
                    url: SITEURL + '/calendar/crudDate',
                    method: 'get',
                    data: {
                        "_token": $("meta[name='csrf-token']").attr("content"),
                        tipo: 0,
                    },
                    dataType: 'json',
                }, ],

                selectable: true,
                navLinks: true,
                eventDisplay: 'block',

                select: function(start, end, allDay) {
                    $('#createEventModal').modal('show');
                },

                eventClick: function(event) {
                    $('#changeModal').modal('show');
                    var formulario = document.getElementById('formsubmit2')
                    var title = document.getElementById('title2')
                    title.value = event.event._def.title
                    var idEvent = document.getElementById('id_event')
                    idEvent.value = event.event._def.publicId


                }
            }, );

            calendar.render();
        });
    </script>
@stop
@section('footer')
    {{-- Este div aunque no tenga uso real es para que aparezca el footer en la parte de abajo --}}
    <div></div>
@stop
