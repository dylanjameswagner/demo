<?php

/* google map javascript api */
/* https://developers.google.com/maps/documentation/javascript/ */
/* https://console.developers.google.com/project */
/* http://www.mapstylr.com/map-style-editor/ */

    $map_id = rand();
    $marker = array(
        'title' => 'Richmond, VA',
        'lat'   => 37.524661,
        'lng'   => -77.4932614,
    );
?>
<script>

    function initializeMap() {
        var LatLng = <?php echo json_encode($marker, JSON_NUMERIC_CHECK); ?>;
        // var LatLng = {
        //     'title' : 'Richmond, VA',
        //     'lat'   : 37.524661,
        //     'lng'   : -77.4932614,
        // };

        var Map = new google.maps.Map(document.getElementById('map<?php echo '-' . $map_id; ?>'), {
            center : LatLng,
            zoom   : 10, // 1-21

            // draggable              : false,
            // scrollwheel            : false,
            // panControl             : false,
            // zoomControl            : false,
            // mapTypeControl         : false,
            // scaleControl           : false,
            // streetViewControl      : false,
            // overviewMapControl     : false,
            // disableDefaultUI       : true,
            // disableDoubleClickZoom : true,
        }); // Map

        var Marker = new google.maps.Marker({
            map      : Map,
            position : LatLng,
            title    : LatLng.title,

            clickable : false,

            // icon : {
            //     url    : 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
            //     size   : new google.maps.Size(32, 32),
            //     origin : new google.maps.Point(0, 0),
            //     anchor : new google.maps.Point(16, 32),
            //     // url    : '<?php // echo get_stylesheet_directory_uri(); ?>/public/images/map-marker.png',
            //     // size   : new google.maps.Size(12, 12),
            //     // origin : new google.maps.Point(0, 0),
            //     // anchor : new google.maps.Point(6, 6),
            // },
            // shape: {
            //     coords: [1, 1, 1, 20, 18, 20, 18, 1],
            //     type: 'poly',
            // },
        }); // Marker
    } // initializeMap

    function loadMapScript() {
        var key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
        var script       = document.createElement('script');
            script.async = true,
            script.defer = true,
            script.src   = 'https://maps.googleapis.com/maps/api/js?key=' + key + '&callback=initializeMap';

        document.body.appendChild(script);
    }

    window.onload = loadMapScript;

</script>
<div id="map<?php echo '-' . $map_id; ?>" class="map" style="height: 500px;"></div>
