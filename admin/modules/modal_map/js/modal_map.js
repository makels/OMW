/**
 * Created by ZERG on 21.10.2017.
 */
var ModalMap = function() {

    this.mapWnd = null;

    this.marker = null;

    this.order_id = 0;

    this.washer_id = 0;

    this.map = null;

    this.init = function() {
        var scope = this;
        this.mapWnd = new ZWindow({
            width: 800,
            height: 600,
            title: "Адрес",
            text: "<div style='width: 100%;height: 550px;' id='map_address'></div>",
            buttons: [
                {
                    id: "save_btn",
                    text: "Сохранить",
                    click: function() {
                        var position = scope.marker.getPosition();
                        var lat = position.lat();
                        var lng = position.lng();
                        if(scope.order_id > 0) {
                            scope.updatePosition(scope.order_id, lat, lng);
                            document.location.href = "/admin/orders";
                        }
                        if(scope.washer_id > 0) {
                            scope.updateWasherPosition(scope.washer_id, lat, lng);
                            document.location.href = "/admin/washers";
                        }
                    }
                },
                {
                    text: "Отмена",
                    click: function() {
                        scope.mapWnd.hide();
                    }
                }
            ]
        });
    }

    this.open = function(id, lat, lng) {
        this.order_id = id;
        if(this.map == null) {
            var mapProp= {
                center:new google.maps.LatLng(lat,lng),
                zoom:13
            };
            this.map = new google.maps.Map(document.getElementById("map_address"),mapProp);
            this.marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                draggable: true,
                map: this.map
            });
        }
        this.mapWnd.show();
    }

    this.openWasher = function(id, lat, lng) {
        this.washer_id = id;
        if(this.map == null) {
            var mapProp= {
                center:new google.maps.LatLng(lat,lng),
                zoom:13
            };
            this.map = new google.maps.Map(document.getElementById("map_address"),mapProp);
            this.marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                draggable: true,
                map: this.map
            });
        }
        this.mapWnd.show();
    }

    this.openWashers = function(washers) {
        $("#save_btn").hide();
        var scope = this;
        if(this.map == null) {
            var mapProp= {
                center:new google.maps.LatLng(washers[0].lat,washers[0].lng),
                zoom:13
            };
            this.map = new google.maps.Map(document.getElementById("map_address"),mapProp);
            $.each(washers, function(index, washer) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(washer.lat, washer.lng),
                    //draggable: true,
                    map: scope.map,
                    title: "Имя: " + washer.name + " Тел. " + washer.phone + " Адрес: " + washer.address
                });
            });

        }
        this.mapWnd.show();
    }

    this.openOrders = function(orders) {
        $("#save_btn").hide();
        var scope = this;
        if(this.map == null) {
            var mapProp= {
                center:new google.maps.LatLng(orders[0].lat,orders[0].lng),
                zoom:13
            };
            this.map = new google.maps.Map(document.getElementById("map_address"),mapProp);
            $.each(orders, function(index, order) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(order.lat, order.lng),
                    //draggable: true,
                    map: scope.map,
                    title: "Имя: " + order.name + " Тел. " + order.phone + " Адрес: " + order.address
                });
            });

        }
        this.mapWnd.show();
    }

    this.updatePosition = function (id, lat, lng) {
        $.ajax({
            url: '/admin/api/update_position',
            type: 'post',
            dataType: 'json',
            data: {
                order_id: id,
                lat: lat,
                lng: lng
            },
            success: function(result) {
                //debugger;
            },
            error: function() {
                //app.alert("Не удалось сохранить новую позицию");
            }

        });
    }

    this.updateWasherPosition = function (id, lat, lng) {
        $.ajax({
            url: '/admin/api/update_washer_position',
            type: 'post',
            dataType: 'json',
            data: {
                washer_id: id,
                lat: lat,
                lng: lng
            },
            success: function(result) {
                //debugger;
            },
            error: function() {
                //app.alert("Не удалось сохранить новую позицию");
            }

        });
    }
    
}

var modalMap = new ModalMap();

$(function() {
    modalMap.init();
});