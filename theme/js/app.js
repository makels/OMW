/**
 * Created by Zerg on 11.07.2017.
 */
var App = function() {

    this.init = function() {
        var scope = this;
        $('#moreNews1').click(function() {
            scope.loadNextNews(3);
        });
    }

    this.loadNextNews = function(from) {
        var scope = this;
        $.ajax({
            url: "/news?from=" + from,
            type: "get",
            success: function(res) {
                if(res == "") {
                    $('#moreNews1').hide();
                    $('.noMoreNews').show();
                }
                $('#news-items').append(res);
                var from = $('.news__item').length - 1;
                $('#moreNews1').off("click").click(function() {
                    scope.loadNextNews(from);
                });
            }
        });
    }



}

var app = new App();

$(function() {
    app.init();
});