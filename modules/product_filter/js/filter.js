/**
 * Created by Zerg on 18.06.2017.
 */
var ProductFilter = function() {

    this.filter = {
        side: document.filter.side,
        type: document.filter.type,
        size: document.filter.size
    }

    this.init = function() {
        this.initHandlers();
    }

    this.initHandlers = function() {
        var scope = this;
        $('.filter_side').click(function(e) {
                e.preventDefault();
                $('.filter_side').css({fill: "#000"});

                if(scope.filter.side == $(this).attr("side")) {
                    scope.filter.side = "all";
                    scope.setFilter();
                    return;
                }

                $(this).css({fill: "#1f7ed2"});
                scope.filter.side = $(this).attr("side");
                scope.setFilter();
        });

        $('.filter_type').click(function(e) {
            e.preventDefault();
            $('.filter_type').css({fill: "#000"});

            if(scope.filter.type == $(this).attr("filter_type")) {
                scope.filter.type = "all";
                scope.setFilter();
                return;
            }

            $(this).css({fill: "#1f7ed2"});
            scope.filter.type = $(this).attr("filter_type");
            scope.setFilter();
        });

        $('#filter_size').change(function() {
            scope.filter.size = $(this).val();
            scope.setFilter();
        });
    }

    this.setFilter = function() {
        window.location.href = '/products?side=' + this.filter.side + '&type=' + this.filter.type + '&size=' + this.filter.size;
    }


}

var productFilter = new ProductFilter();

$(function() {
    productFilter.init();
})