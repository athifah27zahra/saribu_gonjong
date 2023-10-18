<div class="card-body">
    <div class="googlemaps" id="googlemaps"></div>
    <script>
        initMap();
        map.setCenter({
            lat: -0.02243720,
            lng: 100.34884565
        });
    </script>
    <div id="legend"></div>
    <script>
        $('#legend').hide();
        getLegend();
    </script>
</div>