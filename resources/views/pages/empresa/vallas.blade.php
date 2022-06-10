{{-- Extiende de la plantilla --}}
@extends('adminlte::page')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Titulo de la ventana --}}
@section('title', 'Vallas')

{{-- Cabecera de la pagina --}}
@section('content_header')
    <h1>Vallas</h1>
    {{-- Parte superior filtro + añadir --}}
    <div class="row d-flex mb-4 mt-3 pt-1">
        <div class="col mx-auto d-flex flex-row justify-content-between">
            <div class="col-10 p-0">
                <input type="text" class="mr-2 w-50 rounded shadow-lg border border-0 p-2" placeholder="Filtrar por..."
                    id="filtro"></input>
            </div>
            <a href="{{ url('/vallas/vallaform') }}" class="col-2 col-sm-1">
                <button class="btn btn-primary w-100 h-100">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        </div>
    </div>
@stop

@section('content')
    {{-- Cuerpo de la vista, utilizamos el componente cardvalla con cada una de las vallas de nuestra base de datos --}}

    @foreach ($vallas->reverse() as $valla)
        @include('components/cardvalla', ['valla' => $valla, 'modo' => 'show'])
    @endforeach

    {{-- footer --}}

@stop

    @if (session()->has('succ1'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'La valla ha sido creada con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('succ1');
        @endphp
    @endif
    @if (session()->has('succ2'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'La valla ha sido actualizada con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('succ2');
        @endphp
    @endif
    @if (session()->has('succ3'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: 'La valla ha sido borrada con exito',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('succ3');
        @endphp
    @endif
    @if (session()->has('error1'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al crear la valla',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error1');
        @endphp
    @endif
    @if (session()->has('error2'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al actualizar la valla',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error2');
        @endphp
    @endif
    @if (session()->has('error3'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al borrar la valla',
                timer: 2000,
                showConfirmButton: false,
            })
        </script>
        @php
            session()->forget('error3');
        @endphp
    @endif



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    window.onload = () => {
        const filtro = document.querySelector('#filtro');
        const cards = document.querySelectorAll('.claseFiltro');

        // Cada vez que el usuario introduce una letra en el filtro se ejecuta este listener
        filtro.addEventListener('input', (e) => {
            const targetValue = e.target.value.toLowerCase();
            // Le ponemos un timeout para que al usuario no le salga instantáneo
            cards.forEach((el) => {
                // Cogemos los valores de alias y direccion de las cards
                const alias = el.children[0].children[0].children[0].children[1].children[0].children[2].children[1].children[1].value.toString().toLowerCase();
                const direccion = el.children[0].children[0].children[0].children[1].children[0].children[2].children[3].children[1].value.toString().toLowerCase();

                // Si el alias o la direccion no contiene el valor del input, la carta
                // de la valla se oculta
                if (!alias.includes(targetValue) && !direccion.includes(targetValue)) {
                    el.style.display = 'none'
                } else {
                    el.style.display = 'flex'
                }
            })
        })
    }
</script>
