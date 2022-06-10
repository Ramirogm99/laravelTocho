@extends('adminlte::page')

@section('title', 'Mapas')

@section('content_header')
    <h1>Mapas Contratos</h1>
@stop

@section('content')


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Mapa vallas contratadas</h3>

            <div class="card-tools">
                <!-- This will cause the card to maximize when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                        class="fas fa-expand"></i></button>
                <!-- This will cause the card to collapse when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                <!-- This will cause the card to be removed when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
        <div class="card-body" style="min-height:600px">
            <div id="map" style="min-height:600px"></div>
            <div id="legend" class="bg-white border border-dark px-3 pb-1" style="display:none;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="font-weight-bold" style="margin-right: 10px">LEYENDA</div>
                    </div>
                </div>
            </div>

        <div class="card-footer">
            <div class="col-6">
                <select id="selectContrato" class="form-control">
                    <option value="" selected disabled>Seleccione un contrato</option>

                    @foreach ($contratos as $contrato)
                    
                        <option value="{{ $contrato->id }}">{{ $contrato->id }}-{{ $contrato->d_social }}</option>
                    @endforeach
                    <option value="all">Todos</option>
                </select>

            </div>
        </div>
    </div>

@stop

@section('js')

    <script>
        const token = document.querySelector("#csrfToken");

        // AJAX PRINCIPAL
        const vallasArray = async () => {
            const res = await fetch('../vallas/ajaxRequest', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token.value,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({

                    tipo: 'mapasContrato'
                })
            });
            const array = await res.json();

     

            return array;
        }

        // AJAX CONTRATOS
        const vallasArray2 = async (id_contrato) => {
            const res = await fetch('../vallas/ajaxRequest', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token.value,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    contrato: id_contrato,
                    
                    tipo: 'mapasContratoId'
                })
            });
            const array = await res.json();

            return array;

     
        }

        let vallas;

        function iniciar(contrato = 'none') {
            var mapOptions = {

                center: new google.maps.LatLng(37.90004841138487, -4.733331026209888),
                zoom: 12.67,
                maxZoom: 18,
                minZoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            let vallasmap = [];

            if (contrato == 'none' || contrato == 'all') {

                vallas = vallasArray();

            } else {
                vallas = vallasArray2(contrato);
            }

            // let svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"/></svg>';

            vallas.then((res) => {

               
                    res.forEach((element) => {
                        var place = new google.maps.LatLng(element.latitud, element.longitud);
                        var icon = {
                            path: 'M 19,43L 22,43L 22,42L 19,42L 19,19L 57,19L 57,42L 54,42L 54,43L 57,43L 57,46L 40,46L 40,57L 36,57L 36,46L 19,46L 19,43 Z M 48,42L 48,43L 51,43L 51,42L 48,42 Z M 42,42L 42,43L 45,43L 45,42L 42,42 Z M 37,42L 37,43L 39,43L 39,42L 37,42 Z M 31,42L 31,43L 34,43L 34,42L 31,42 Z M 25,42L 25,43L 28,43L 28,42L 25,42 Z M 20,20.0001L 20,41L 55.9999,41L 55.9999,20.0001L 20,20.0001 Z M 21,21.0001L 54.9999,21.0001L 54.9999,40L 21,40L 21,21.0001 Z',
                            scale: 1,
                            fillColor: element.color,
                            fillOpacity: 1,
                            strokeColor: 'black',
                            strokeWeight: 1,
                        };


                        var img = {
                            url: element.norte ? `{{url('')}}/public/storage/${element.alias}/${element.norte}`: `{{url('')}}/public/storage/saile1.jpg`,
                            scaledSize: new google.maps.Size(120, 72)
                        };

                        var marker = new google.maps.Marker({
                            position: place,
                            title: element.alias,
                            map: map,
                            icon: icon,
                            animation: google.maps.Animation.DROP
                        });
                    

                    

                    let infoWindow = new google.maps.InfoWindow({
                        content: "<p>" + "<b>ID: </b>" + element.alias + "</p>" +
                            `<a data-target='#myModal' data-toggle='modal'> <img src='${img.url}'' width="500" height="500"></a>`,
                        minWidth: 550,
                        minHeight: 600,

                    });
                    vallasmap.push(infoWindow);

                        marker.addListener('click', function (e) {
            
                        infoWindow.open(map, marker);
                        });

                });

                let getLegend = document.getElementById('legend');
                dupNode = getLegend.cloneNode(true);
                dupNode.classList.add('legendActive');

                dupNode.removeAttribute('style');
                let legend = dupNode;   

                

                    
                    
                let div = document.createElement('div');
                div.innerHTML = `<br>
                 @foreach($materiales as $material)
                 <div class="row mb-1" >
                                <div style="width:100px"> {{$material->tipo}} </div>
                                <div class="col-md-1" style="background-color:{{$material->color}}; width:10px; "></div>
                                <br>
                            </div>  
                @endforeach
                 `;
                
                    legend.appendChild(div);
            

                map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

            


            google.maps.event.addListener(map, 'click', function() {
                vallasmap.forEach(valla => {
                    valla.close();
                });
            });

            google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
                //this part runs when the mapobject is created and rendered
                google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
                    //this part runs when the mapobject shown for the first time

                });

            });

        })

        let selectContrato = document.querySelector("#selectContrato");
        selectContrato.addEventListener('change', function(e) {
            console.log(e.target.value);
            iniciar(e.target.value);
        });
    }
    </script>

    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCOaXdpxSzffcIU5sc_LAX8ARB9JnLhCjA&callback=iniciar"></script>

@stop
