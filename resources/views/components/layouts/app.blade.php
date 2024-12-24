<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="https://flowbite.com/images/logo.svg">

    {{-- leaftlet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- end of leaftlet --}}

    {{-- start geojson vt --}}
    <script src="https://unpkg.com/geojson-vt@3.2.0/geojson-vt.js"></script>
    <script src="{{ asset('js/leaflet-geojson-vt.js') }}"></script>
    {{-- end geojson vt --}}

    {{-- dropzone.js --}}
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    {{-- end dropzone.js --}}

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div>
        @include('layouts.navigation')
    </div>
    <div>
        {{-- <div class="flex flex-col flex-1 w-full"> --}}
        {{-- ini navbar --}}
        @include('layouts.menu')
        {{-- <main class="h-full overflow-y-auto"> --}}
        {{-- bg-gray-100 --}}
        <main class="flex-1 p-2 bg-orange-300">
            {{ $slot }}
        </main>
    </div>


    {{-- </div> --}}

    @livewireScripts
    {{-- livewire alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    {{-- end livewire alert --}}

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var map2; // Variabel untuk peta
        var markersGroup; // LayerGroup global
        var geojsonLayers; // LayerGroup GeoJSON
        function initialize() {
            // Inisialisasi peta
            map2 = L.map("map").setView([-7.048929, 110.492233], 8);
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map2);

            // Inisialisasi LayerGroup kosong
            markersGroup = L.layerGroup().addTo(map2);
            geojsonLayers = L.layerGroup().addTo(map2);

            // Contoh marker awal (opsional)
            var hydMarker = new L.Marker([-7.048929, 110.492233]);
            var hydMarker2 = new L.Marker([-7.051947, 110.499730]);

            // Event Listener: Klik Marker untuk Buka Google Maps
            hydMarker.on('click', function() {
                var lat = hydMarker.getLatLng().lat; // Ambil Latitude
                var lng = hydMarker.getLatLng().lng; // Ambil Longitude

                // URL Google Maps
                var googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;

                // Redirect ke Google Maps
                window.open(googleMapsUrl, '_blank');
            });

            // Tambahkan marker awal ke LayerGroup
            markersGroup.addLayer(hydMarker);
            markersGroup.addLayer(hydMarker2);
        }

        window.onload = function() {
            initialize();
        };
    </script>
    @stack('scripts')
</body>

</html>
