    {{-- FORMULARIO USUARIOS --}}

    <section class="content">
        <div class="box">
            <input type="hidden" id="urlapp" value="http://localhost/alquiler/">
            <div class="box-body">
                {{-- AL RELLENAR EL FORMULARIO SE ENVIARA LA INFORMACION A CREARUSUARIO EN LA RUTA --}}
                {{-- Dependiendo del modo que se le pase, accede a una ruta u otra --}}
                <form action="{{ url('usuarios/insert') }}" class="my_form row" enctype="multipart/form-data"
                    method="post" accept-charset="utf-8" autocomplete="off" id="datos">
                    @csrf
                    <input type="hidden" id="csrfToken" value="{{ csrf_token() }}" name="csrfToken">
                    <div class="col-12">
                        <div class="card card-primary card-outline">

                            {{-- CABECERA DEL FORMULARIO DE EDITAR --}}
                            <div class="card-header">
                                <h3 class="card-title">Formulario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="" data-original-title="Abrir/Cerrar">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>


                            {{-- CUERPO DEL FORMULARIO DE CREAR --}}
                            <div class="card-body row">
                                {{-- CLIENTES --}}
                                <div class="form-group col-md-8">
                                    <label for="id_cliente">Cliente*</label>
                                    <select name="id" id="id_cliente"
                                        class="form-control input-lg select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="" selected disabled>Seleccionar cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" data-select2-id="2">
                                                {{ $cliente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- NOMBRE --}}
                                <div class="form-group col-md-8">
                                    <label for="nombre">Nombre*</label> <input type="text" name="name" value=""
                                        id="nombre" class="form-control input-lg" required>
                                </div>

                                {{-- USUARIO --}}
                                <div class="form-group col-md-4">
                                    <label for="username">Usuario*</label> <input type="text" name="username" value=""
                                        id="username" class="form-control input-lg" required>
                                </div>

                                {{-- CONTRASEÑA --}}
                                <div class="form-group col-md-4">
                                    <label for="passwd">Contraseña*</label> <input type="password" name="password"
                                        value="" class="form-control input-lg" autocomplete="new-password"
                                        id="password">


                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label> <input type="email" name="email" value=""
                                        id="email" class="form-control input-lg  " required
                                        pattern='^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}$'>


                                </div>

                                {{-- AVATAR --}}
                                <div class="form-group col-4">
                                    <label for="avatar">Avatar</label> <input type="file" name="avatar" value=""
                                        id="input" accept="image/*" class="form-control input-lg">
                                </div>

                            </div>


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
                    <h3 class="card-title">Acciones</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="" data-original-title="Abrir/Cerrar">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                {{-- CUERPO DEL 2 FORMULARIO --}}
                <div class="card-body row">
                    <div class="col-md-12 row">
                        <input type="hidden" name="equipo_id" value="1">
                        <input type="hidden" name="actualiza" value="0">
                        <input type="hidden" name="auth_level" value="1">
                    </div>
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script>
                        $(document).ready(function() {
                            $(".select2").select2({
                                width: '300px',
                                height: 'resolve',
                            });
                            $(".select2-container--default .select2-selection--single .select2-selection__rendered").css(
                                "margin-top", "-2px");
                        })
                    </script>
                </div>


                {{-- FOOTER DEL FORMULARIO --}}


                <div class="card-footer">
                    <a href="{{ url('/') }}" class="btn btn-secondary float-left">Volver</a>

                    <button type="button" id="guardar" name="" data-toggle="modal" data-target="#modalmessage"
                        class="btn btn-primary float-right">Guardar</button>

                </div>

            </div>
        </div>
        {{-- --------------------------------------------------------------------------------------------------------------------------- --}}
        {{-- --------------------------------------------------------------------------------------------------------------------------- --}}

        {{-- MODAL INSERCCION --}}

        <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de inserción
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea realizar la operación? </p>
                        <p>La contraseña del usuario es : <input type="text" disabled value="" id="contra"></p>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let nombre = document.querySelector('#nombre');
        let contraseña = document.querySelector('#password');
        let email = document.querySelector('#email');
        let usuario = document.querySelector('#username');
        let contra = document.querySelector('#contra');
        //funcion para randomizar la contraseña para los usuarios
        function generatePasswordRand(length, type) {
            switch (type) {
                case 'num':
                    characters = "0123456789";
                    break;
                case 'alf':
                    characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    break;
                case 'rand':
                    //FOR ↓
                    break;
                default:
                    characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#$%&?¿*";
                    break;
            }
            var pass = "";
            for (i = 0; i < length; i++) {
                if (type == 'rand') {
                    pass += String.fromCharCode((Math.floor((Math.random() * 100)) % 94) + 33);
                } else {
                    pass += characters.charAt(Math.floor(Math.random() * characters.length));
                }
            }
            return pass;
        }
        $(document).ready(function(e) {
            
            //Esta funcion sirve para mostrat la contraseña que ha generado automaticamente la funcion de arriba
            $('#guardar').on('click', (e) => {

                contra.value = contraseña.value;

            });
            
            
            $('#id_cliente').on('change', async (e) => {
                const response = await fetch(`../clientes/clienteUser`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector("#csrfToken").value,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: e.target.value
                    }),
                })

                const result = await response.json();


                nombre.value = result.nombre;
                email.value = result.email;
                usuario.value = result.d_social;
                contraseña.value = generatePasswordRand(8);

            })
        });


        // selector.addEventListener('change' , (e) => {

        //     console.log(e.value);
        // });
    </script>
