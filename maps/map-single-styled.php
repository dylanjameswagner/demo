<?php

/* google map */
/* http://www.mapstylr.com/map-style-editor/ */

    $markers = isset($context['markers']) ? $context['markers'] : array();

?>
<script>

    function initializeMap(){
        var markers = [
            [37.875218132350035,-76.24328152222898,'White Caps Estate',true]
        ];

        // var markersIcon = {
        //     url    : '<?php echo get_stylesheet_directory_uri().'/public/images/marker-12.png'; ?>',
        //     size   : new google.maps.Size(12,12),
        //     origin : new google.maps.Point(0,0),
        //     anchor : new google.maps.Point(6,6),
        // };

        var map = new google.maps.Map(document.getElementById('map'),{
            // center : new google.maps.LatLng(37.6,-95.665), // United States
            // center : new google.maps.LatLng(37.6194526,-76.5855287), // Horsley RE
            center : new google.maps.LatLng(37.875218132350035,-76.24328152222898),
            zoom   : 15, // 1-20
            // zoomControl               : false,
            // disableDoubleClickZoom    : true,
            // draggable                 : true,
            // scrollwheel               : false,
            // mapTypeControl            : false,
            // scaleControl              : false,
            // panControl                : false,
            // streetViewControl         : false,
            // overviewMapControl        : false,
            // overviewMapControlOptions : { opened : false },
        }); // map

        // init infowindow
        var infoWindow = new google.maps.InfoWindow();

        for (i = 0; i < markers.length; i++){
            // // set marker
            // if (markers[i][3]){
            //     markersicon = ''; }
            //     markersIcon = {
            //         url    : 'http://dev.whitlock.com.php54-4.ord1-1.websitetestlink.com/wp/wp-content/themes/whitlock/public/images/marker-32.png', // '<?php echo get_stylesheet_directory_uri().'/public/images/marker-32.png'; ?>',
            //         size   : new google.maps.Size(12,12),
            //         origin : new google.maps.Point(0,0),
            //         anchor : new google.maps.Point(6,6),
            //     };
            // endif;

            marker = new google.maps.Marker({
                position : new google.maps.LatLng(markers[i][0],markers[i][1]),
                map      : map,
                icon     : markersIcon,
                title    : markers[i][2],
                desc     : markers[i][2],
            });

            // var contentString =
            //  '<div id="content">'
            //  +'<h1>CONTENT</h1>'
            //  +'</div>';

            // var infowindow = new google.maps.InfoWindow({
            //  content: contentString
            // });

            // set for fitBounds
            bounds.extend(marker.position);

            google.maps.event.addListener(marker,'click',(function(marker,i){
                return function () {

                    infoWindow.setContent(
                        '<div class="text">'
                            +'<h1 class="heading">'+markers[i][2]+'</h1>'
                            // +'<address class="address">'+markers[i][3]+'</address>'
                            // +(markers[i][4] != 'toll' || markers[i][5] != 'phone' || markers[i][6] != 'fax' ? '<p class="numbers">' : '')
                            //     +(markers[i][4] != 'toll' ? '<span class="free"><span class="label">Free:</span> <a href="tel:1'+markers[i][4].replace(/[^0-9\.]+/g,'')+'">'+markers[i][4]+'</a></span><br/> ' : '')
                            //     +(markers[i][5] != 'phone' ? '<span class="phone"><span class="label">Tel:</span> <a href="tel:1'+markers[i][5].replace(/[^0-9\.]+/g,'')+'">'+markers[i][5]+'</a></span><br/> ' : '')
                            //     +(markers[i][6] != 'fax' ? '<span class="fax"><span class="label">Fax:</span> <a href="tel:1'+markers[i][6].replace(/[^0-9\.]+/g,'')+'">'+markers[i][6]+'</a></span>' : '')
                            // +(markers[i][4] != 'toll' || markers[i][5] != 'phone' || markers[i][6] != 'fax' ? '</p>' : '')
                            // +(markers[i][7] != 'name' || markers[i][8] != 'email' ? '<p class="email">' : '')
                            //     +(markers[i][7] != 'name' ? '<a href="mailto:'+markers[i][8]+'">'+markers[i][7]+'</a>' : '')
                            //     +(markers[i][7] != 'name' && markers[i][8] != 'email' ? ' - ' : '')
                            //     +(markers[i][8] != 'email' ? '<a href="mailto:'+markers[i][8]+'">'+markers[i][8]+'</a>' : '')
                            // +(markers[i][7] != 'name' || markers[i][8] != 'email' ? '</p>' : '')
                        +'</div>'
                    );
                    infoWindow.open(map, marker);

                    // google.maps.event.addListener(infoWindow,'closeclick',function(){
                        // do something
                    // });
                }
            })(marker,i));
        }

        // compute for fitBounds
        // map.fitBounds(bounds);

        var listener = google.maps.event.addListener(map,'idle',function(){
            // map.setZoom(4);
            google.maps.event.removeListener(listener);
        });
    }

    function loadMapScript() {
        var script      = document.createElement('script');
            script.type = 'text/javascript';
            script.src  = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initializeMap';

        document.body.appendChild(script);
    }

    window.onload = loadMapScript;

</script>
<div id="map" style="padding-top: 54.6%"></div>
