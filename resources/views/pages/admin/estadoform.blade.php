{{-- PLANTILLA GENERICA PARA CLIENTES --}}

@extends('adminlte::page')

@section('title', 'Estado')

@section('content_header')
    <h1>Estado</h1>
@stop

@section('content')

    @include('components/form-estado', [
        'estado' => isset($estado) ? $estado : '',
        'modo' => $mode,
    ])


@stop
