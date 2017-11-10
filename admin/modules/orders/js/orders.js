/**
 * Created by ZERG on 23.09.2017.
 */
var Orders = function() {

    this.orderPlace = null;

    this.init = function() {
        var date_time = $("input[name='order[date_time]']").val();
        if(date_time != "") date_time = moment(date_time); else date_time = moment();
        //$('#order_date_id').val(date_time.format("DD.MM.YYYY HH:mm"));
        $('#order_date_id').daterangepicker({
            startDate: date_time,
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "locale": {
                "format": "DD.MM.YYYY HH:mm",
                "separator": " - ",
                "applyLabel": "Выбрать",
                "cancelLabel": "Отмена",
                "fromLabel": "С",
                "toLabel": "По",
                "customRangeLabel": "Дополнительно",
                "daysOfWeek": [
                    "Вс",
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб"
                ],
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 1
            }
        }, function(start) {
            $("input[name='order[date_time]']").val(start.format("YYYY-MM-DD HH:mm"));
        });
    }

    this.initAutocomplete = function() {
        var scope = this;
        this.orderPlace = new google.maps.places.Autocomplete(document.getElementById('order_autocomplete'), {types: ['geocode']});
        this.orderPlace.addListener('place_changed', function() {
            var place = scope.orderPlace.getPlace();
            $('input[name="order[lat]"]').val(place.geometry.location.lat());
            $('input[name="order[lng]"]').val(place.geometry.location.lng());
        });
    }
}

var orders = new Orders();

$(function() {
    orders.init();
});