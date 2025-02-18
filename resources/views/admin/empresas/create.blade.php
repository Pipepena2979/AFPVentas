@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="container">
        
        <br>
        {{-- Logo --}}
        <center>
            <img src="{{ asset('/img/logo1.png') }}" width="180px" alt="">
        </center>
        <br>

        <div class="row">
            <div class="col-md-12">
                {{-- Card Box --}}
                <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}" style="box-shadow: 5px 5px 5px 5px #cccccc">

                    <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                        <h3 class="card-title float-none text-center">
                            <b>Registro de una Nueva Empresa</b>
                        </h3>
                    </div>

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="{{ route('admin.empresas.store') }}" method="POST" enctype="multipart/form-data">
                    {{-- <-- TOKEN DE SEGURIDAD DE LARAVEL, INSDISPENSABLE EN LOS FURMULARIOS PARA LOS METODOS POST --> --}}
                    @csrf
                    <div class="row">
                        <!-- Primera Columna para el Logo -->
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" id="file" name="logo" accept="image/*" class="form-control" required>
                                @error('logo')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <center><output id="list"></output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; // Lista de archivos
                                        for (var i = 0, f; f = files[i]; i++) {
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function (theFile) {
                                                return function (e) {
                                                    document.querySelector("#list").innerHTML = [
                                                        '<img class="thumb thumbnail" src="', e.target.result,
                                                        '" width="100%" title="', escape(theFile.name), '"/>'
                                                    ].join('');
                                                };
                                            })(f);
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false);
                                </script>
                            </div>
                        </div>
                    
                        <!-- Segunda Columna con otros campos distribuidos en 3 filas -->
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <!-- Primera fila -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select name="pais" id="pais" class="form-control">
                                            <option value="" disabled selected>Seleccione un País</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-5">
                                    <div class="form-group">
                                        <label for="departamento">Departamento</label>
                                        <div id="respuesta_pais"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad/Muni</label>
                                        <div id="respuesta_depto"></div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Segunda fila -->
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de la Empresa</label>
                                        <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}" class="form-control" required>
                                        @error('nombre_empresa')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_empresa">Tipo de Empresa</label>
                                        <input type="text" name="tipo_empresa" value="{{ old('tipo_empresa') }}" class="form-control" required>
                                        @error('tipo_empresa')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="nit">NIT</label>
                                        <input type="text" name="nit" value="{{ old('nit') }}" class="form-control" required>
                                        @error('nit')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Tercera fila -->
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="moneda" class="form-control">
                                            <option value="" disabled selected>Seleccione la Moneda de su País</option>
                                            @foreach ($monedas as $moneda)
                                            <option value="{{ $moneda->symbol }}">{{ $moneda->symbol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_impuesto">Nombre del Impuesto</label>
                                        <input type="text" name="nombre_impuesto" value="{{ old('nombre_impuesto') }}" class="form-control" required>
                                        @error('nombre_impuesto')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="cantidad_impuesto">Cantidad de Impuesto</label>
                                        <input type="number" name="cantidad_impuesto" value="{{ old('cantidad_impuesto') }}" class="form-control" required>
                                        @error('cantidad_impuesto')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Cuarta fila (si es necesaria) -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_postal">Prefijo Telefónico del País</label>
                                        <select name="codigo_postal" id="codigo_postal" class="form-control">
                                            <option value="" disabled selected>Seleccione el Prefijo Telefónico de su País</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{ $pais->phone_code }}">{{ $pais->phone_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" required>
                                        @error('telefono')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="correo">Correo de la Empresa</label>
                                        <input type="email" name="correo" value="{{ old('correo') }}" class="form-control" required>
                                        @error('correo')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <!-- Quinta fila (si es necesaria) -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input id="pac-input" class="form-control" name="direccion" value="{{ old('direccion') }}" type="text" placeholder="Buscar..." required>
                                        @error('direccion')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <br>
                                        <div id="map" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">Crear Empresa</button>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif

        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initAutocomplete"
        async defer></script>

        <script>
            function initAutocomplete() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    // Coordenadas de Monterrey, N.L., México
                    center: {lat: 25.685088, lng:-100.327482}, //{lat: -33.8688, lng: 151.2195},
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });
        
                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // determina la posicion
        
                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
        
                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();
        
                    if (places.length == 0) {
                        return;
                    }
        
                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];
        
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    /*
                     * Para fines de minimizar las adecuaciones debido a que es este una demostración de adaptación mínima de código, se reemplaza forEach por some.
                     */
                    // places.forEach(function(place) {
                    places.some(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };
        
                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));
        
                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                        // some interrumpe su ejecución en cuanto devuelve un valor verdadero (true)
                        return true;
                    });
                    map.fitBounds(bounds);
                });
            }
        </script>

        {{-- <-- SCRIPT PARA OBTENER LOS DEPARTAMENTOS A PARTIR DEL PAIS CON AJAX  --> --}}
        <script>
            $('#pais').on('change', function() {
                var id_pais = $('#pais').val();
                // alert(pais);

                if(id_pais) {
                    $.ajax({
                        url: "{{ url('/crear-empresa/pais/')}}"+'/'+id_pais,
                        type: "GET",
                        success: function(data) {
                            $('#respuesta_pais').html(data);
                        }
                    });
                } else {
                    alert('Debe Seleccionar un País');
                }
            });
        </script>

        {{-- <-- SCRIPT PARA OBTENER LAS CIUDADES A PARTIR DE LOS DEPARTAMENTOS CON AJAX  --> --}}
        
        <script>
            $(document).on('change', '#deptos', function() {
                var id_departamento = $('#deptos').val();
                // alert(id_departamento);

                if(id_departamento) {
                    $.ajax({
                        url: "{{ url('/crear-empresa/depto')}}"+'/'+ id_departamento,
                        type: "GET",
                        success: function(data) {
                            $('#respuesta_depto').html(data);
                        }
                    });
                } else {
                    alert('Debe Seleccionar un Departamento');
                }
            });
        </script>
@stop
