{{-- FORMULARIO CONTRATO --}}
<p class="d-none">{{ date_default_timezone_set('Europe/Madrid') }}</p>

<section class="content">
    <div class="box">
        <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
        <div class="box-body">
            <form action="{{ url('vallas/filtroDisponibles') }}" class="my_form row" enctype="multipart/form-data"
                method="post" accept-charset="utf-8" autocomplete="off">
                @csrf

                <div class="col-12">
                    <div class="card card-primary card-outline">

                        {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- FECHA INICIO --}}


                                <div class="form-group col-md-6">

                                    <label for="f_inicio">Fecha de inicio*</label> <input type="datetime-local"
                                        name="f_inicio" id="f_inicio"
                                        value="{{ str_replace(' ', 'T', date('Y-m-d H:i')) }}" id="f_inicio"
                                        class="form-control input-lg" required>
                                </div>

                                {{-- FECHA FIN --}}
                                <div class="form-group col-md-6">
                                    <label for="f_fin">Fecha de vencimiento*</label> <input type="datetime-local"
                                        name="f_fin" id="f_fin"
                                        value="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime('+1 day'))) }}"
                                        min="{{ str_replace(' ', 'T', date('Y-m-d H:i')) }}"
                                        class="form-control input-lg" required>
                                </div>
                                <div class="form-group col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">

                    <div class="card card-primary">
                        <div class="card-footer mx-auto">


                            <button type="button" name="mysubmit" data-toggle="modal" data-target="#modalmessage"
                                class="btn btn-primary ">Filtrar</button>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de
                                    inserción/actualización
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro de que desea realizar la operación? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session()->has('succ'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'El correo ha sido enviado con éxito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('succ');
        @endphp
    @endif
    @if (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el correo',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error');
        @endphp
    @endif

</section>
