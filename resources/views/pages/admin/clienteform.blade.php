{{-- PLANTILLA GENERICA PARA CLIENTES --}}

@extends('adminlte::page')

@section('title', 'Formulario Cliente')

@section('content_header')
    <h1>Formulario cliente</h1>
@stop

@section('content')

    @include('components/form-cliente', [
        'cliente' => isset($cliente) ? $cliente : '',
        'modo' => $mode,
    ])


@stop
