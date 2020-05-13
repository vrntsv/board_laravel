function toggleMap() {
    var loc = document.getElementById("location");
    if (loc.style.display === "none") {
        loc.style.display = "block";
        document.getElementById('addLocation').value = 'True';
        document.getElementById('addLocationButton').innerHTML = 'Don`t add location';
    } else {
        loc.style.display = "none";
        document.getElementById('addLocation').value = 'False';
        document.getElementById('addLocationButton').innerHTML = 'Add location';

    }
}


var geocoder;
var map;
var marker;

function initMap() {
    var latitude = Number(document.getElementById("la").value);
    var longitude = Number(document.getElementById("lo").value);
    var uluru = {
        lat: latitude,
        lng: longitude
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: uluru
    });
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: uluru
    });

    google.maps.event.addListener(marker, 'dragend',
        function(marker) {

            var latLng = marker.latLng;
            currentLatitude = latLng.lat();
            currentLongitude = latLng.lng();
            $("#la").val(currentLatitude);
            $("#lo").val(currentLongitude);
            geocoder = new google.maps.Geocoder();
            codeAddress(geocoder, map);

        }
    );
}


