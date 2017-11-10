/**
 * Created by ZERG on 23.09.2017.
 */
var Washers = function() {
    this.washerPlace = null;

    this.init = function() {

    }

    this.initAutocomplete = function() {
        var scope = this;
        this.washerPlace = new google.maps.places.Autocomplete(document.getElementById('washer_autocomplete'), {types: ['geocode']});
        this.washerPlace.addListener('place_changed', function() {
            var place = scope.washerPlace.getPlace();
            $('input[name="washer[lat]"]').val(place.geometry.location.lat());
            $('input[name="washer[lng]"]').val(place.geometry.location.lng());
        });
    }
}

var washers = new Washers();

$(function() {
    washers.init();
});