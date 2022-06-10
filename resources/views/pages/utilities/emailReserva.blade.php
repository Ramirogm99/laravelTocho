<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Email</title>
    <script></script>
</head>

<body>

    <div>
        <p>El cliente {{ $cliente }}</p>
        <p>En este periodo de tiempo : {{$fechas['f_inicio']}} hasta {{$fechas['f_fin']}}</p>
        <p>Ha pedido una reserva de estas vallas
        </p>

        <ul>
            @foreach ($vallas as $valla)
                <li>Nombre de la valla :{{ $valla->alias }}</li>
                <ul>
                    <li>Direccion : {{ $valla->direccion }}</li>
                    <li>Latitud : {{ $valla->latitud }}</li>
                    <li>Longitud : {{ $valla->longitud }}</li>
                    <li><a
                            href="https://www.google.es/maps/search/?api=1&query={{ $valla->latitud }},{{ $valla->longitud }}">Ver
                            en maps</a></li>
                </ul>
            @endforeach
        </ul>
        <span></span>
        <a href="http://localhost/alquiler_laravel/">Ir a SAILE</a>
    </div>
</body>

</html>
