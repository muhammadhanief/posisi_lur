<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Titlee' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    {{-- leaftlet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- end of leaftlet --}}
    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
    @stack('styles')
</head>

<body class="font-sans antialiased">
    {{ $slot }}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1D8voXSZT8KK2KIWGaznsSeZLHrHddwg&callback=initMap">
    </script> --}}
    {{-- <script src="http://maps.googleapis.com/maps/api/js"></script> --}}
    </script>
    {{-- <script>
        function initialize() {
            var propertiPeta = {
                center: new google.maps.LatLng(-8.5830695, 116.32919191),
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            };

            var peta = new google.maps.Map(
                document.getElementById("map-canvas"),
                propertiPeta
            );

            // membuat Marker
            // var marker = new google.maps.Marker({
            //     position: new google.maps.LatLng(-8.5830695, 116.3202515),
            //     map: peta,
            // });
        }
        // event jendela di-load
        google.maps.event.addDomListener(window, "load", initialize);
    </script> --}}
    <script>
        function initialize() {
            var map2 = L.map("map").setView([-8.5830695, 116.32919191], 9);
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map2);
            // var marker = L.marker([51.5, -0.09]).addTo(map);
            // var circle = L.circle([51.508, -0.11], {
            //     color: "red",
            //     fillColor: "#f03",
            //     fillOpacity: 0.5,
            //     radius: 500,
            // }).addTo(map);
            // var polygon = L.polygon([
            //     [51.509, -0.08],
            //     [51.503, -0.06],
            //     [51.51, -0.047],
            // ]).addTo(map);
            // marker
            //     .bindPopup("<b>Hello world!</b><br>I am a popup.")
            //     .openPopup();
            // circle.bindPopup("I am a circle.");
            // polygon.bindPopup("I am a polygon.");
        }

        // event jendela di-load
        // google.maps.event.addDomListener(window, "load", initialize);
    </script>
    @stack('scripts')
</body>

</html>
