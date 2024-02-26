<?php

/* google static map api */
/* https://developers.google.com/maps/documentation/staticmaps/ */
/* https://console.developers.google.com/project */
/* dylan@teamcolab.com - Google Static Maps API - AIzaSyBHXVjRxqfJJwetvzVJQuRpetKSv0qEdQk */

    $markers = array(
        'Richmond, VA', // 37.524661, -77.4932614, 12z
        'Glen Allen, VA',
        'Sandston, VA',
        'Bon Air, VA',
        'Chester, VA',
    );

    $visible = array(
        // 'USA',
        // 'Virgina, USA',
    );

    $marker_style = array(
        // 'icon'   => 'icon:http://www.google.com/support/enterprise/static/geo/cdate/art/icons/my_location_16.png', // does not support https
        // 'shadow' => 'shadow:false',
        // 'size'   => 'size:mid', // default normal, tiny, mid, small
        // 'color'  => 'color:0xeb5d5b', // color=0xeb5d5b // #eb5d5b // $brand-salmon
    );

    $map_style = array(
        // horsley
        // 'feature:landscape|element:all',
        // 'feature:water|element:geometry|color:#ff0000',
        // 'feature:administrative|element:country.geometry.stroke|visibility:off',

        // whitlock
        // FIXME this doesnt work
        // 'feature:all|element:labels|visibility:off|element:geometry.fill|visibility:off',
        // 'feature:road|element:all|visibility:off',
        // 'feature:water|element:all|color:0x1384b0',
        // 'feature:landscape|element:all|color:0x54c5f2',
        // 'feature:administrative.country|element:geometry.stroke|color:0x1384b0|weight:1',
        // 'feature:administrative.province|element:geometry.stroke|color:0x1384b0',
        'feature:poi|visibility:simplified',
    );

// src="https://maps.googleapis.com/maps/api/staticmap?sensor=false
// &key=AIzaSyBHXVjRxqfJJwetvzVJQuRpetKSv0qEdQk
// &size=640x640
// &scale=2
// &format=JPEG
// &visible=Virgina%2C+USA
// &style=
// &markers=Richmond%2C+VA%7CGlen+Allen%2C+VA%7CSandston%2C+VA%7CBon+Air%2C+VA%7CChester%2C+VAfeature:road.local|element:geometry|color:0x00ff00|weight:1|visibility:on
// &feature:landscape|element:geometry.fill|color:0x000000|visibility:on
// &feature:administrative|element:labels|weight:3.9|visibility:on|inverse_lightness:true
// &feature:poi|visibility:simplified"

    $parameters = array(
        'key'    => 'AIzaSyBHXVjRxqfJJwetvzVJQuRpetKSv0qEdQk',
        // 'center' => 'United States', // required with no markers
        // 'zoom'   => '10', // required with no markers // 1-21
        'size'   => '640x640', // required max 640x640
        'scale'  => '2', // default 1, 2 // ppi multiplier
        'format' => 'JPEG', // default PNG, GIF, JPEG
        'maptype' => 'roadmap', // default roadmap, satellite, hybrid, terrain
        'visible' => implode('|', $visible),
        // 'style' => implode('|', $map_style),
        'style'   => implode('&style=', $map_style),
        // 'style'   => 'feature:landscape|element:all|color:0x54c5f2',
        'markers' => (!empty($marker_style) ? implode('|', $marker_style) . '|' : null) . implode('|', $markers),
    );

    // echo '&' . str_replace('|', ' | ', str_replace('&', '<br>&', urldecode(http_build_query($parameters)))) . '<br>';

    $api = 'https://maps.googleapis.com/maps/api/staticmap?sensor=false&';

    $image_url = $api . http_build_query($parameters);

    echo '<img alt="map" src="' . $image_url . '">';
