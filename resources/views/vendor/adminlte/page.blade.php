@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop


@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if (!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

    </div>

        {{-- Footer --}}
        <footer class="main-footer m-0 w-100 p-2">

            <div class="float-right d-none d-sm-block">
                <strong>Copyright © 2022 <a target="_blank" href="https://toplevelsl.eu"><img style="width: 90px"
                            src="http://192.168.1.51/tiendas.toplevelsl.eu//assets/img/top.jpeg"></a>.</strong>

            </div>
            <div class=" d-none d-sm-inline-block">
                <b>Versión</b> 0.0.1
            </div>
        </footer>

        {{-- Right Control Sidebar --}}
        @if (config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
