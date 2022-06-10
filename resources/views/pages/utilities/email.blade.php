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
        @if ($texto == null)
        <p>Estimado {{$cliente}}</p>
        <p>Notificamos mediante este correo las vallas que se encuentran disponibles en el período de tiempo que usted ha manifestado</p>
        @else
        <p>Estimado cliente {{ $cliente }} </p>
        <p>{{ $texto }}</p>
        @endif
        <ul>
            @for ($i = 0; $i < count($vallas); $i++)
                <li>Nombre de la valla : {{ $vallas[$i]->alias }}</li>
                <ul>
                    <li>Direccion : {{ $vallas[$i]->direccion }}</li>
                    <li>Latitud : {{ $vallas[$i]->latitud }}</li>
                    <li>Longitud : {{ $vallas[$i]->longitud }}</li>
                    <li><a
                            href="https://www.google.es/maps/search/?api=1&query={{ $vallas[$i]->latitud }},{{ $vallas[$i]->longitud }}">Ver
                            en maps</a></li>
                </ul>
            @endfor
        </ul>
        <a href="">Ir a SAILE</a>
    </div>
</body>

</html>
