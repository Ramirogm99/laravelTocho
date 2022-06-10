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
        <p>Notificamos mediante este correo la reposición de la cartelería de su valla X (¿nombre valla o enlace a valla?) conforme a lo suscrito en el contrato X.
        </p>
        
        <ul>
            @foreach ($contratos as $contract)
            <li>Nombre del contrato  :{{ $contract['nombre_contrato'] }}</li>
            <li>Fecha de finalizacion : {{$contract['fecha_fin']}}</li>
            @endforeach
        </ul>
        <h3>Atentamente, Saile Publicidad Exterior, S.L.</h3>
        <span></span>
        <a href="">Ir a SAILE</a>
    </div>
</body>

</html>
