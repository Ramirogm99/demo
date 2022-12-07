@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h1>Editor de usuario</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <form method="post" action='{{ url("users/save") }}' class="my_form row"
                enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
                
                <div class="col-12">
                    <div class="card card-primary card-outline">

                        {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                        <div class="card-header">
                            <h3 class="card-title">Editor de usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">

                                    <label for="f_inicio">Nombre de usuario</label> <input type="text" name="name"
                                        value="" class="form-control input-lg" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email">Email del usuario</label><input type="email" name="email"
                                        value="" class="form-control input-lg" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Contraseña</label><input type="password" name="password"
                                        value="" class="form-control input-lg" required>
                                </div>
                            </div>
                        </div>
                        {{-- FOOTER DEL FORMULARIO --}}
                        <div class="col-12">
                            <div class="card-footer">
                                <a href="{{ url('users') }}" class="btn btn-secondary float-left">Volver</a>


                                <button id='submit' type="button" name="mysubmit" value="Guardar" data-toggle="modal"
                                    data-target="#modalmessage" class="btn btn-warning float-right">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                                        inserción/actualización</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Desea guardar los cambios? </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button id='submit' type="submit" name="mysubmit" value="Guardar"
                                        formMethod="post" formaction='{{ url("users/save") }}'
                                        class="btn btn-primary ml-2 ">
                                        Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
