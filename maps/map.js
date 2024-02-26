$('.map').each(function (index, Element) {
    var coords = $(Element).text().split(",");
    if (coords.length != 3) {
        $(this).display = "none";
        return;
    }
    var latlng = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
    var myOptions = {
        zoom: parseFloat(coords[2]),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: false,
        mapTypeControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    };
    var map = new google.maps.Map(Element, myOptions);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map
    });
});
