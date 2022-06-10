    {{-- FORMULARIO USUARIOS --}}

    <section class="content">
        <div class="box">
            <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
            <div class="box-body">
                {{-- AL RELLENAR EL FORMULARIO SE ENVIARA LA INFORMACION A CREARUSUARIO EN LA RUTA --}}
                {{-- Dependiendo del modo que se le pase, accede a una ruta u otra --}}
                @if ($modo == 'edit')
                    <form action='{{ url("usuarios/update/$usuario->id") }}' class="my_form row"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
                    @elseif($modo == 'create')
                        <form action="{{ url('usuarios/insert') }}" class="my_form row"
                            enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
                        @else
                            <form action="" class="my_form row" enctype="multipart/form-data" method="post"
                                accept-charset="utf-8" autocomplete="off">
                @endif

                @csrf
                <input type="hidden" name="token" value="b2697287">
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

                        {{-- CUERPO DEL FORMULARIO DE EDITAR --}}
                        <div class="card-body row">

                            {{-- NOMBRE --}}
                            <div class="form-group col-md-8">
                                <label for="nombre">Nombre*</label> <input type="text" name="name"
                                    value="{{ $usuario ? $usuario->name : '' }}" id="nombre"
                                    class="form-control input-lg" {{ $modo == 'show' ? 'readonly' : '' }} required>
                            </div>

                            {{-- USUARIO --}}
                            <div class="form-group col-md-4">
                                <label for="username">Usuario*</label> <input type="text" name="username"
                                    value="{{ $usuario ? $usuario->username : '' }}" id="username"
                                    class="form-control input-lg" {{ $modo == 'show' ? 'readonly' : '' }} required>
                            </div>

                            {{-- CONTRASEÑA --}}
                            <div class="form-group col-md-4">
                                <label for="passwd">Contraseña*</label> <input type="password" name="password" value=""
                                    class="form-control input-lg" {{ $modo == 'show' ? 'readonly' : '' }}
                                    autocomplete="new-password"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">


                            </div>

                            {{-- EMAIL --}}
                            <div class="form-group col-md-4">
                                <label for="email">Email</label> <input type="email" name="email"
                                    value="{{ $usuario ? $usuario->email : '' }}" id="email"
                                    class="form-control input-lg  " {{ $modo == 'show' ? 'readonly' : '' }} required
                                    pattern='^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}$'>


                            </div>

                            {{-- AVATAR --}}
                            @if ($modo == 'create' || $modo == 'edit')
                                <div class="form-group col-4">
                                    <label for="avatar">Logotipo</label> <input type="file" name="avatar" value=""
                                        id="input" accept="image/*" class="form-control input-lg"
                                        {{ $modo == 'show' ? 'readonly' : '' }}>
                                </div>
                            @endif

                        </div>
                        {{-- PREVIEW AVATAR --}}
                        <div class="form-group col-12 h-200px text-center" id="preview">

                            <img id="avatar"
                                src="@if ($modo != 'create') {{ url('') }}\storage\{{ $usuario->avatar }} @endif"
                                style="object-fit: contain;  max-width:300px; max-height: 300px; margin: 0 auto; transform: translateX(-11%)">



                            {{-- PREVIEW DE LA IMAGEN --}}




                        </div>
                        <div class="form-group col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2 FORMULARIO --}}
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                {{-- CABECERA DEL 2 FORMULARIO --}}
                <div class="card-header">
                    <h3 class="card-title">Otros</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="" data-original-title="Abrir/Cerrar">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                {{-- CUERPO DEL 2 FORMULARIO --}}
                <div class="card-body row">
                    <div class="col-md-12 row"></div>
                    <input type="hidden" name="equipo_id" value="1">
                    <input type="hidden" name="actualiza" value="0">
                    <div class="form-group col-md-3">
                        <label for="auth_level">Nivel Usuario</label>
                        <select name="auth_level" id="auth_level_user"
                            class="form-control input-lg select2 select2-hidden-accessible" data-select2-id="auth_level"
                            {{ $modo == 'show' ? 'disabled' : '' }} tabindex="-1" aria-hidden="true">
                            <option value="1" data-select2-id="2">Cliente</option>
                            <option value="3">Usuario</option>
                            <option value="7">Gerente</option>

                        </select>
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script>
                            $(document).ready(function() {
                                $(".select2").select2({
                                        width: '300px',
                                        height: 'resolve',
                                    });
                                    $(".select2-container--default .select2-selection--single .select2-selection__rendered").css("margin-top", "-2px");

                                // Mensaje customizado para poder introducir correctamente la contraseña
                                $("input[name=password]")[0].oninvalid = function() {
                                    this.setCustomValidity(
                                        "Mínimo 8 caracteres, al menos una minúscula, una mayúscula, un número y un caracter especial"
                                    );
                                };

                                // Con un click eliminamos el mensaje customizado anterior
                                $("input[name=CheckBox]")[0].onclick = function() {
                                    this.setCustomValidity("");
                                };
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- FOOTER DEL FORMULARIO --}}

        <div class="col-12">
            <div class="card card-primary">
                <div class="card-footer">
                    <a href="{{ url('usuarios') }}" class="btn btn-secondary float-left">Volver</a>

                    @if ($modo != 'show')
                        <button type="button" name="" data-toggle="modal" data-target="#modalmessage"
                            class="btn btn-primary float-right">Guardar</button>
                    @endif
                </div>
            </div>
        </div>
        {{-- --------------------------------------------------------------------------------------------------------------------------- --}}
        {{-- --------------------------------------------------------------------------------------------------------------------------- --}}

        {{-- MODAL INSERCCION / ACTUALIZACION --}}

        <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de inserción/actualización
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
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function(e) {

            $('#input').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
