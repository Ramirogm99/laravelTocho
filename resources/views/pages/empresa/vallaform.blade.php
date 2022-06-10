{{-- Extiende de la plantilla --}}
@extends('adminlte::page')

{{-- Titulo de la ventana --}}
@section('title', 'Formulario')

{{-- Cabecera de la pagina --}}
@section('content_header')
    <h1>Formulario Valla</h1>
@stop

{{-- Contenido de la página --}}
@section('content')
    {{-- Dentro de la vista renderizamos dependiendo del modo (ya que usamos el mismo formulario tanto para ver como para editar) --}}
    @include('components/cardvalla', ['valla' => isset($valla) ? $valla : '', 'modo' => $mode])

@stop
