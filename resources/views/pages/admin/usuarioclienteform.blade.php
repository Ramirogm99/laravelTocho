{{-- PAGINA DE CREACION DE USUARIOS QUE SON CLIENTES --}}
@extends('adminlte::page')

@section('title', 'Usuarios')


@section('content_header')
    <h1>Formulario de creacion de usuarios</h1>
@stop

@section('content')
@include('components/form-usuariocliente', ['cliente' => isset($cliente) ? $cliente : '' ])

@stop