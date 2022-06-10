@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
@stop

@section('content')
    <section class="section-50">
        <div class="container">

            @if (Auth::user()->auth_level > 7)
                <div class="notification-ui_dd-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                <h3 class="card-title">Notificaciones</h3>
                                </div>
                                @if ($nombreCliente == null)
                                <div class="row">
                                    <div class="col-4 m-3">
                                    <p>No hay notificaciones</p>
                                    </div>
                                </div>
                                @else
                                    <div class="row">
                                        <div class="col-4 m-3">
                                            <a href="{{ url('notificaciones/borrar') }}" class='btn btn-danger'>Eliminar
                                                todas
                                                las notificaciones</a>
                                        </div>
                                        <div class="col-4 m-auto">
                                            <a href="{{ url('notificaciones/notificacionSend') }}" class='btn btn-primary'>Enviar correo a todos los usuarios</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                @foreach ($nombreCliente as $nombre)
                                    <div class="row">
                                        <div class="notification-list notification-list--unread">
                                            <div class="notification-list_content">
                                                <div class="notification-list_img">
                                                    <div class="col-7">
                                                        <p>El/La cliente : {{ $nombre['name'] }} tiene un contrato
                                                            a
                                                            punto de
                                                            expirar</p>
                                                    </div>
                                                    <div class="col-7">
                                                        <p>El id del contrato es : {{ $nombre['id_contrato'] }}</p>
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="{{ url('') }}/contratos/show/{{ $nombre['id_contrato'] }}"
                                                            class='btn btn-sm btn-dark'><i class="fas fa-eye"></i></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
            @endif
        </div>
        </div>
        </div>
        </div>
        @endif
    </section>  
    @stop
    @section('css')
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap);

            body {
                font-family: "Roboto", sans-serif;
                background: #EFF1F3;
                min-height: 100vh;
                position: relative;
            }

            h3 {
                color: grey
            }

            .section-50 {
                padding: 50px 0;
            }

            .m-b-50 {
                margin-bottom: 50px;
            }

            .dark-link {
                color: #333;
            }

            .heading-line {
                position: relative;
                padding-bottom: 5px;
            }

            .heading-line:after {
                content: "";
                height: 4px;
                width: 75px;
                background-color: #29B6F6;
                position: absolute;
                bottom: 0;
                left: 0;
            }

            .notification-ui_dd-content {
                margin-bottom: 30px;
            }

            .notification-list {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 20px;
                margin-bottom: 7px;
                background: #fff;
                -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
            }

            .notification-list--unread {
                border-left: 2px solid #29B6F6;
            }

            .notification-list .notification-list_content {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }

            .notification-list .notification-list_content .notification-list_img img {
                height: 48px;
                width: 48px;
                border-radius: 50px;
                margin-right: 20px;
            }

            .notification-list .notification-list_content .notification-list_detail p {
                margin-bottom: 5px;
                line-height: 1.2;
            }

            .notification-list .notification-list_feature-img img {
                height: 48px;
                width: 48px;
                border-radius: 5px;
                margin-left: 20px;
            }

        </style>
    @stop
