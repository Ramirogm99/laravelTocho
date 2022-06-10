{{-- PAGINA PRINCIPAL --}}

<?php if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
} ?>

@extends('adminlte::page')

@section('title', 'Pagina principal')


@section('content_header')
    <h1>PAGINA PRINCIPAL</h1>
@stop

@section('content')

@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
