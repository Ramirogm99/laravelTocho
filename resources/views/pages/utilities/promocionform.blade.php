{{-- PLANTILLA GENERICA PARA CLIENTES --}}

@extends('adminlte::page')

@section('title', 'Formulario Promocion')

@section('content_header')
    <h1>Formulario promocion</h1>
@stop

@section('content')

    @include('components/form-promocion', [
        'promocion' => isset($promocion) ? $promocion : '',
        'contratos' => isset($contratos) ? $contratos : '',
        'id' => isset($promocion) ? $promocion->id : '',
        'modo' => $mode,
    ])


@stop
