{{-- PLANTILLA GENERICA PARA CLIENTES --}}

@extends('adminlte::page')

@section('title', 'Material')

@section('content_header')
    <h1>Material</h1>
@stop

@section('content')

    @include('components/form-material', [
        'material' => isset($material) ? $material : '',
        'modo' => $mode,
    ])


@stop
