/**
 * Created by ZERG on 26.11.2017.
 */
var Messages = {

    show: function() {
        window.setTimeout(function() {
            $('.messages-wrapper').fadeTo( "slow" , 1);
            window.setTimeout(function() {
                Messages.hide();
            }, 3000);
        }, 500);
    },

    hide: function() {
        $('.messages-wrapper').fadeTo( "slow" , 0);
    },

    alert: function(msg) {
        $('.messages-wrapper').html(msg);
        this.show();
    }

}