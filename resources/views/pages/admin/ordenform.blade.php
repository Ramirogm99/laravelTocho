{{-- PLANTILLA GENERICA PARA CLIENTES --}}

@extends('adminlte::page')

@section('title', 'Orden')

@section('content_header')
    <h1>Orden</h1>
@stop

@section('content')

    @include('components/form-orden', [
        'orden' => isset($orden) ? $orden : '',
        'modo' => $mode,
        'vallas' => $vallas,
    ])


@stop
