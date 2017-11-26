/**
 * Created by Zerg on 11.07.2017.
 */
var App = function() {

    this.init = function() {
        $('.top-current-lang').click(function(e) {
            $('.top-languages-list').toggleClass('open');
            e.stopPropagation();
        });

        $(window).click(function() {
            $('.top-languages-list').removeClass('open');
        });

        $(window).scroll(function() {
            if($(window).scrollTop() > 0) {
                $("header").css({opacity: .8});
            } else {
                $("header").css({opacity: 1});
            }
            if($(window).scrollTop() + $(window).height() > ($(document).height()  - 100)) $("footer").css({opacity: 1});
            else $("footer").css({opacity: 0});
        });

        if($(window).scrollTop() + $(window).height() > ($(document).height()  - 100)) $("footer").css({opacity: 1});
        else $("footer").css({opacity: 0});
    }

}

var app = new App();

$(function() {
    app.init();
});