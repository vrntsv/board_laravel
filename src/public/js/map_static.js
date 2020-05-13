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
        animation: google.maps.Animation.DROP,
        position: uluru
    });

}