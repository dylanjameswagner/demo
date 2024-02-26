<?php

/* google map javascript api */
/* https://developers.google.com/maps/documentation/javascript/ */
/* https://console.developers.google.com/project */
/* http://www.mapstylr.com/map-style-editor/ */

    $map_id = rand();
    $markers = array(
        array(
            'title'   => 'Richmond, VA',
            'lat'     => 37.524661,
            'lng'     => -77.4932614,
            'address' => '123 W Main St<br> Richmond, VA 12345',
            'toll'    => '800-000-0000',
            'phone'   => '804-000-0000',
            'fax'     => '804-000-0000',
            'contact' => 'John Smith',
            'email'   => 'jsmith@example.com',
        ),
        array(
            'title' => 'Glen Allen, VA',
            'lat'   => 37.6646975,
            'lng'   => -77.487898,
        ),
        array(
            'title' => 'Sandston, VA',
            'lat'   => 37.510608,
            'lng'   => -77.3158954,
        ),
        array(
            'title' => 'Bon Air, VA',
            'lat'   => 37.5188014,
            'lng'   => -77.5720844,
        ),
        array(
            'title' => 'Chester, VA',
            'lat'   => 37.3495459,
            'lng'   => -77.440081,
        ),
    );
?>
<script>

    function initializeMap() {
        var Markers = <?php echo json_encode($markers, JSON_NUMERIC_CHECK); ?>;
        // var Markers = [
        //     {
        //         'title'   : 'Richmond, VA',
        //         'lat'     : 37.524661,
        //         'lng'     : -77.4932614,
        //         'address' : '123 W Main St<br> Richmond, VA 12345',
        //         'toll'    : '800-000-0000',
        //         'phone'   : '804-000-0000',
        //         'fax'     : '804-000-0000',
        //         'contact' : 'John Smith',
        //         'email'   : 'jsmith@example.com',
        //     },
        //     {
        //         'title':'Glen Allen, VA',
        //         'lat':37.6646975,
        //         'lng':-77.487898,
        //     },
        //     {
        //         'title':'Sandston, VA',
        //         'lat':37.510608,
        //         'lng':-77.3158954,
        //     },
        //     {
        //         'title':'Bon Air, VA',
        //         'lat':37.5188014,
        //         'lng':-77.5720844,
        //     },
        //     {
        //         'title':'Chester, VA',
        //         'lat':37.3495459,
        //         'lng':-77.440081,
        //     }
        // ];

        var Map = new google.maps.Map(document.getElementById('map<?php echo '-' . $map_id; ?>'), {
            // center : new google.maps.LatLng(37.6, -95.665), // United States
            center : new google.maps.LatLng(37.524661, -77.4932614), // Richmond, VA
            zoom   : 11, // 1-21

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

            // overviewMapControlOptions : { opened : false },
            // mapTypeId : google.maps.MapTypeId.ROADMAP,
            // styles    : [
            //     {
            //         "featureType":"all",
            //         "elementType":"labels",
            //         "stylers":[{"visibility":"off"}]
            //     },
            //     {
            //         "featureType":"all",
            //         "elementType":"geometry.fill",
            //         "stylers":[{"visibility":"off"}]
            //     },
            //     {
            //         "featureType":"water",
            //         "elementType":"geometry.fill",
            //         "stylers":[{"visibility":"on"},{"color":"#1384b0"}]
            //     },
            //     {
            //         "featureType":"landscape",
            //         "elementType":"geometry",
            //         "stylers":[{"visibility":"on"},{"color":"#54c5f2"}]},
            //     {
            //         "featureType":"administrative.country",
            //         "elementType":"geometry.stroke",
            //         "stylers":[{"color":"#1384b0"},{"weight":1}]
            //     },
            //     {
            //         "featureType":"administrative.province",
            //         "elementType":"geometry.stroke",
            //         "stylers":[{"color":"#1384b0"}]
            //     },
            //     {
            //         "featureType":"road",
            //         "elementType":"all",
            //         "stylers":[{"visibility":"off"}]
            //     }
            // ],
        }); // Map

        var LatLngBounds = new google.maps.LatLngBounds();
        var InfoWindow = new google.maps.InfoWindow();

        // Markers
        for (var i = 0; i < Markers.length; i++) {
            // var Markers = Markers[i];
            var Marker = new google.maps.Marker({
                map      : Map,
                position : {lat: Markers[i].lat, lng: Markers[i].lng},
                title    : Markers[i].title,
                // zIndex: Marker[3]

                // clickable : false,

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

            LatLngBounds.extend(Marker.position);

            google.maps.event.addListener(Marker, 'click', (function(Marker, i) {
                return function() {

                    InfoWindow.setContent(
                        '<div class="text">'
                            + (typeof(Markers[i].title) != 'undefined' ? '<h3 class="heading">' + Markers[i].title + '</h3>' : '')
                            + (typeof(Markers[i].address) != 'undefined' ? '<address class="address">' + Markers[i].address + '</address>' : '')
                            + (typeof(Markers[i].toll) != 'undefined' || typeof(Markers[i].phone) != 'undefined' || typeof(Markers[i].fax) != 'fax' ? '<p class="numbers">' : '')
                                + (typeof(Markers[i].toll) != 'undefined' ? '<span class="free"><span class="label">Free:</span> <a href="tel:1' + Markers[i].toll.replace(/[^0-9\.] + /g,'') + '">' + Markers[i].toll + '</a></span><br/> ' : '')
                                + (typeof(Markers[i].phone) != 'undefined' ? '<span class="phone"><span class="label">Tel:</span> <a href="tel:1' + Markers[i].phone.replace(/[^0-9\.] + /g,'') + '">' + Markers[i].phone + '</a></span><br/> ' : '')
                                + (typeof(Markers[i].fax) != 'undefined' ? '<span class="fax"><span class="label">Fax:</span> <a href="tel:1' + Markers[i].fax.replace(/[^0-9\.] + /g,'') + '">' + Markers[i].fax + '</a></span>' : '')
                            + (typeof(Markers[i].toll) != 'undefined' || typeof(Markers[i].phone) != 'undefined' || typeof(Markers[i].fax) != 'fax' ? '</p><!--.numbers-->' : '')
                            + (typeof(Markers[i].contact) != 'undefined' || typeof(Markers[i].email) != 'undefined' ? '<p class="email">' : '')
                                + (typeof(Markers[i].contact) != 'undefined' ? '<a href="mailto:' + Markers[i].email + '">' + Markers[i].contact + '</a>' : '')
                                + (typeof(Markers[i].contact) != 'undefined' && typeof(Markers[i].email) != 'undefined' ? ' - ' : '')
                                + (typeof(Markers[i].email) != 'undefined' ? '<a href="mailto:' + Markers[i].email + '">' + Markers[i].email + '</a>' : '')
                            + (typeof(Markers[i].contact) != 'undefined' || typeof(Markers[i].email) != 'undefined' ? '</p>' : '')
                        + '</div>'
                    );
                    InfoWindow.open(Map, Marker);

                    // google.maps.event.addListener(InfoWindow, 'closeclick', function() {
                    //     // do something
                    // });
                }
            })(Marker, i));
        } // for

        // extend bounds with unmarked latlng
        // LatLngBounds.extend(new google.maps.LatLng(37.7582885, -77.4733764)); // Ashland, VA
        // LatLngBounds.extend(new google.maps.LatLng(38.636405, -77.2584145)); // Woodbridge, VA

        // set bounds
        Map.fitBounds(LatLngBounds);
        // Map.center = LatLngBounds.getCenter();

        // set minimum zoom
        // FIXME this doesnt work
        // var Zoom = Map.getZoom() - 1;
        // Map.setZoom(Zoom > 11 ? Zoom : 11);

        // reset zoom
        // FIXME doesnt seem to work
        // var listener = google.maps.event.addListener(Map, 'idle', function() {
        //     // map.setZoom(4);
        //     google.maps.event.removeListener(listener);
        // });

/* https://developers.google.com/fusiontables/docs/samples/mouseover_map_styles?hl=en */
/* https://developers.google.com/maps/documentation/javascript/fusiontableslayer */

        // austrailia
        // var Layer = new google.maps.FusionTablesLayer({
        //     query: {
        //         select: 'geometry',
        //         from: '1ertEwm-1bMBhpEwHhtNYT47HQ9k2ki_6sRa-UQ'
        //     },
        //     styles: [{
        //         polygonOptions: {
        //             fillColor: '#00FF00',
        //             fillOpacity: 0.3
        //         }
        //     }, {
        //         where: 'birds > 300',
        //             polygonOptions: {
        //                 fillColor: '#0000FF'
        //         }
        //     }, {
        //         where: 'population > 5',
        //             polygonOptions: {
        //                 fillOpacity: 1.0
        //         }
        //     }]
        //     });
        // Layer.setMap(Map);

        // var georssLayer = new google.maps.KmlLayer({
        //     url: 'http://api.flickr.com/services/feeds/geo/?g=322338@N20&lang=en-us&format=feed-georss'
        // });
        // georssLayer.setMap(Map);

        // var ctaLayer = new google.maps.KmlLayer({
        //     url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
        //     map: Map
        // });

        // var ctaLayer = new google.maps.KmlLayer({
        //     url: 'cb_2014_us_state_500k.kml',
        //     map: Map
        // });

        /* US GB DE*/
        // // https://www.google.com/fusiontables/data?docid=1N2LBk4JHwWpOY4d9fobIn27lfnZ5MDy-NoqqRpk&pli=1#rows:id=1
        // // https://developers.google.com/maps/documentation/javascript/layers#fusion_table_styles
        // var world_geometry = new google.maps.FusionTablesLayer({
        //     query: {
        //         select: 'geometry',
        //         from: '1N2LBk4JHwWpOY4d9fobIn27lfnZ5MDy-NoqqRpk',
        //         where: "ISO_2DIGIT IN ('US', 'GB', 'DE')",
        //     },
        //     map: Map,
        //     // suppressInfoWindows: true
        // });

        /* VA counties */
        /* https://support.google.com/fusiontables/answer/1182141?hl=en */
        /* https://www.google.com/fusiontables/data?docid=1xdysxZ94uUFIit9eXmnw1fYc6VcQiXhceFd_CVKa#rows:id=3 */
        /* https://mapsengine.google.com/10446176163891957399-05024755807944746507-4/mapview/?authuser=0 */
        /* http://www.mob-rule.com/gmap.html */
        /* horsley
            Middlesex County
            Lancaster County
            Mathews County
            Northumberland County
            Gloucester County
            Westmoreland County
            Richmond County
            Essex County
            King & Queen County
        */
        // var Counties = new google.maps.FusionTablesLayer({
        //     map: Map,
        //     // suppressInfoWindows: true,
        //     query: {
        //         select: 'geometry',
        //         from: '1xdysxZ94uUFIit9eXmnw1fYc6VcQiXhceFd_CVKa',
        //         where: "\
        //             'State Abbr.' = 'VA'\
        //             AND 'County Name' IN ('Middlesex', 'Lancaster', 'Mathews', 'Northumberland', 'Gloucester', 'Westmoreland', 'Richmond', 'Essex', 'King and Queen')\
        //             ",
        //             // AND 'County num' = 760\
        //         styles: [
        //             {
        //                 polygonOptions: {
        //                     fillColor: '#FF9900',
        //                     fillOpacity: 0.3
        //                 }
        //             }
        //          // {
        //         //     where: 'birds > 300',
        //         //     polygonOptions: {
        //         //         fillColor: "#rrggbb",
        //         //         strokeColor: "#rrggbb",
        //         //         strokeWeight: "int"
        //         //     },
        //         //     polylineOptions: {
        //         //         strokeColor: "#rrggbb",
        //         //         strokeWeight: "int"
        //         //     },
        //         // }
        //         ],
        //     }
        // });
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
<div id="map<?php echo '-' . $map_id; ?>" class="map" style="height: 1024px;"></div>
