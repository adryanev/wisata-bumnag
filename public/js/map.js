function initialize() {

    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    const locationInput = document.getElementById('address-input');
    // console.log(locationInput);
    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;

    const latitude = parseFloat(document.getElementById("address-latitude").value) || -1.192706;
    const longitude = parseFloat(document.getElementById("address-longitude").value) || 100.432786;
    const map = new google.maps.Map(document.getElementById('address-map'), {
        center: {lat: latitude, lng: longitude},
        zoom: 12
    });
    const marker = new google.maps.Marker({
        map: map,
        position: {lat: latitude, lng: longitude},
        volatility: true,
        draggable: true
    });
    marker.setVisible(true);

    const autocomplete = new google.maps.places.Autocomplete(locationInput,{
    componentRestrictions: { country: 'id' },
    });
    autocomplete.key = 'address';
    autocompletes.push({input: locationInput, map: map, marker: marker, autocomplete: autocomplete});

    google.maps.event.addListener(autocomplete, 'place_changed', debounce(function () {
        marker.setVisible(false);
            const place = autocomplete.getPlace();

            geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    setLocationCoordinates(autocomplete.key, lat, lng);
                }
            });
            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                input.value = "";
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
    },500));
    google.maps.event.addListener(marker, 'dragend', debounce(function(marker) {
        var latLng = marker.latLng;
            geocoder.geocode({
                'location': latLng
              }, function(results, status) {
                if (status === 'OK') {
                  if (results[0]) {
                    locationInput.value = results[0].formatted_address;
                  } else {
                    window.alert('No results found');
                  }
                } else {
                  window.alert('Geocoder failed due to: ' + status);
                }
              });

         setLocationCoordinates(autocomplete.key,  latLng.lat(), latLng.lng());
        },500));


}
const debounce = (func, delay) => {
    let debounceTimer
    return function() {
        const context = this
        const args = arguments
            clearTimeout(debounceTimer)
                debounceTimer
            = setTimeout(() => func.apply(context, args), delay)
    }
}
function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
}
