<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato</title>
</head>

<body>
    @php
        $dia = date('j');
        $mes = date('M');
        switch ($mes) {
            case 'January':
                $mes = 'ENERO';
                break;
            case 'February':
                $mes = 'FEBRERO';
                break;
            case 'March':
                $mes = 'MARZO';
                break;
            case 'April':
                $mes = 'ABRIL';
                break;
            case 'May':
                $mes = 'MAYO';
                break;
            case 'June':
                $mes = 'JUNIO';
                break;
            case 'July':
                $mes = 'JULIO';
                break;
            case 'August':
                $mes = 'AGOSTO';
                break;
            case 'September':
                $mes = 'SEPTIEMBRE';
                break;
            case 'October':
                $mes = 'OCTUBRE';
                break;
            case 'November':
                $mes = 'NOVIEMBRE';
                break;
            case 'December':
                $mes = 'DICIEMBRE';
                break;
            default:
                break;
        }
        $ano = date('Y');
    @endphp
    <style>

        .Cliente,
        .Empresa {
            position: fixed;
            bottom: 2.5%;
        }

        .Cliente {

            font-size: 15px;
            float: left;
        }

        .Empresa {
            margin-right: 10%;
            font-size: 15px;
            float: right;
        }

        .fecha {
            margin-left: 60%;
            font-size: 12px;
        }

        .firma {
            font-size: 17px;
            margin-left: 10%;
        }

        table.blueTable {
            page-break-inside: avoid;
            border: 1px solid #000000;
            background-color: #EEEEEE;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 7px 0px;
        }

        table.blueTable tbody td {
            font-size: 10px;
        }

        table.blueTable thead {
            background: #1C6EA4;
            border-bottom: 0px solid #444444;
        }

        table.blueTable thead th {
            font-size: 12px;
            font-weight: bold;
            color: #FFFFFF;
            text-align: center;
            border-left: 0px solid #D0E4F5;
        }

        table.blueTable thead th:first-child {
            border-left: none;
        }

        table.blueTable tfoot td {
            font-size: 12px;
        }

        table.blueTable tfoot .links {
            text-align: right;
        }

        table.blueTable tfoot .links a {
            display: inline-block;
            background: #1C6EA4;
            color: #FFFFFF;
            padding: 2px 8px;
            border-radius: 5px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px 0;
        }

    </style>
    <table class="blueTable">
        <thead>
            <tr>
                <th colspan="8">DATOS DE CLIENTE</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">NOMBRE : </td>
                <td colspan="2">{{ $cliente->nombre }}</td>
                <td colspan="2">DENOMINACIÓN SOCIAL : </td>
                <td colspan="2">{{ $cliente->d_social }}</td>
            </tr>
            <tr>
                <td colspan="2">DIRECCIÓN : </td>
                <td colspan="2">{{ $cliente->direccion }}</td>
                <td colspan="2">CIF : </td>
                <td colspan="2">{{ $cliente->CIF }}</td>
            </tr>
            <tr>
                <td>C.P : </td>
                <td>{{ $cliente->codpost }}</td>
                <td>LOCALIDAD : </td>
                <td colspan="2">{{ $cliente->localidad }}</td>
                <td>PROVINCIA : </td>
                <td colspan="2">{{ $cliente->provincia }}</td>
            </tr>
            <tr>
                <td colspan="4">REPRESENTANTE : </td>
                <td colspan="4">{{ $cliente->representante }}</td>
            </tr>
            <tr>
                <td colspan="2">TELÉFONO : </td>
                <td colspan="2">{{ $cliente->telefono }}</td>
                <td colspan="2">EMAIL : </td>
                <td colspan="2">{{ $cliente->email }}</td>
            </tr>
        </tbody>
    </table>
    <div class="content"></div>
    <table class="blueTable">
        <thead>
            <tr>
                <th colspan="8">DATOS DE EMPRESA</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">NOMBRE : </td>
                <td colspan="4">{{ $datos->nombre_fiscal }}</td>
            </tr>
            <tr>
                <td colspan="2">DIRECCIÓN : </td>
                <td colspan="2">{{ $datos->direccion }}</td>
                <td colspan="2">CIF : </td>
                <td colspan="2">{{ $datos->CIF }}</td>
            </tr>
            <tr>
                <td>C.P : </td>
                <td>{{ $datos->codpost }}</td>
                <td>LOCALIDAD : </td>
                <td colspan="2">{{ $datos->localidad }}</td>
                <td>PROVINCIA : </td>
                <td colspan="2">{{ $datos->provincia }}</td>
            </tr>
            <tr>
                <td colspan="4">REPRESENTANTE : </td>
                <td colspan="4">{{ $datos->representante }}</td>
            </tr>
            <tr>
                <td colspan="2">TELÉFONO : </td>
                <td colspan="2">{{ $datos->telefono }}</td>
                <td colspan="2">EMAIL : </td>
                <td colspan="2">{{ $datos->email }} / {{ $datos->email2 }}</td>
            </tr>
        </tbody>
    </table>
    <div class="content"></div>
    @php
        $i = 1;
    @endphp
    @foreach ($vallasAsoc as $valla)
        <table class="blueTable">
            <thead>
                <tr>
                    <th colspan="8">CONDICIONES PARTICULARES {{ $i }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">DIRECCIÓN EMPLAZAMIENTO : </td>
                    <td colspan="4">{{ $valla['vallas']->direccion }}</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td>CIUDAD : </td>
                    <td>{{$valla['vallas']->localidad}}</td>
                    <td>LOCALIDAD : </td>
                    <td> {{$valla['vallas']->localidad}}</td>
                    <td colspan="2">CAMPAÑA : </td>
                    <td colspan="2"> {{$facturacion->campana? $facturacion->campana : $cliente->nombre}}</td>
                </tr>
                <tr>
                    <td colspan="2">FECHA DE INICIO : </td>
                    <td colspan="2">{{ $contrato->f_inicio }}</td>
                    <td colspan="2">FECHA DE FINALIZACION : </td>
                    <td colspan="2">{{ $contrato->f_fin }}</td>

                </tr>
                <tr>
                    <td colspan="2">TAMAÑO : </td>
                    <td colspan="2">@isset($valla['vallas']->tamano)
                        {{$valla['vallas']->tamano}}
                    @endisset</td>
                    {{-- {{ $valla->ancho }} X {{$valla->alto}} --}}
                    <td colspan="2">MATERIAL : </td>
                    <td colspan="2">{{ $valla['material']->tipo }}</td>

                </tr>
                <tr>
                    <td colspan="4">RESPONSABLE DEL SUMINISTRO : </td>
                    <td colspan="4">{{$valla['precio_produccion']? 'Saile': $cliente->nombre}}</td>
                </tr>
                <tr>
                    <td colspan="4">FABRICACIÓN : </td>
                    <td colspan="4">{{$valla['precio_produccion']? $valla['precio_produccion'].'€' : 'NO'}}</td>
                </tr>
            </tbody>
        </table>
        <div class="content"></div>
        @php
            $i++;
        @endphp
    @endforeach

    <table class="blueTable">
        <thead>
            <tr>
                <th colspan="8">CONDICIONES PARTICULARES {{ $i }}</th>
               
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">FORMA DE PAGO : </td>
                <td colspan="4">{{$facturacion->f_pago? $facturacion->f_pago : ''}}</td>
            </tr>
            <tr>
                <td colspan="4">Nº DE CUENTA : </td>
                <td colspan="4">{{$facturacion->n_cuenta? $facturacion->n_cuenta : ''}}</td>
            </tr>
            <tr>
                <td colspan="4">PLAZO DE PAGO : </td>
                <td colspan="4">{{$facturacion->plazo_pag_i? $facturacion->plazo_pag_i : 'indefinido'}} - {{$facturacion->plazo_pag_f? $facturacion->plazo_pag_f : 'indefinido'}} </td>

            </tr>
            <tr>
                <td colspan="8">OBSERVACIONES : </td>
            </tr>
            <tr>
                <td colspan="8">{{$facturacion->observaciones? $facturacion->observaciones : ''}}</td>
            </tr>
        </tbody>
    </table>
    <div class="content"></div>

    <div class="fecha">
        <h3>CORDOBA A {{ $dia }} DE {{ $mes }} DEL {{ $ano }}</h3>
    </div>

    <div class="firma">

        <p class="Cliente">
            {{ $cliente->nombre }}
        </p>
        <p class="Empresa">
            {{ $datos->nombre_fiscal }}
            <img src="" alt="">
        </p>


    </div>


</body>

</html>
