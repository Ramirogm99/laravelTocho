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
        <p>Estimado cliente {{ $mensaje['nombre']}}</p>
        <p>Notificamos mediante este correo la proximidad a la finalización del contrato de su alquiler de vallas</p>
        
        <ul>
            @foreach ($contratos as $contract)
            <li>Nombre del contrato  :{{ $contract['nombre_contrato'] }}</li>
            <li>Fecha de finalizacion : {{$contract['fecha_fin']}}</li>
            @endforeach
        </ul>
        <ul>
            @foreach($vallas as $valla)
                <li>Nombre de la valla :{{ $valla['nombre_valla'] }}</li>
                <ul>
                    <li>Direccion : {{ $valla['direccion'] }}</li>
                    <li>Latitud : {{ $valla['latitud'] }}</li>
                    <li>Longitud : {{ $valla['longitud'] }}</li>
                    <li><a
                            href="https://www.google.es/maps/search/?api=1&query={{ $valla['latitud'] }},{{ $valla['longitud'] }}">Ver
                            en maps</a></li>
                </ul>
            @endforeach
        </ul>
        <p>Recordarle que conforme a lo acordado en el contrato quedará automáticamente renovado por el mismo periodo de tiempo si no expresa su deseo de cancelarlo.</p>

        <h3>Atentamente, Saile Publicidad Exterior, S.L.</h3>
        <span></span>
        <a href="">Ir a SAILE</a>
    </div>
</body>

</html>
