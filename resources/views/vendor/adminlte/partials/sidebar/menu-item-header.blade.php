<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-header {{ $item['class'] ?? '' }} badge text-wrap">

    <hr>
    {{ is_string($item) ? $item : $item['header'] }}
    <hr>

    {{-- Para quitar el estilo quitar la clase badge text-wrap --}}

</li>
