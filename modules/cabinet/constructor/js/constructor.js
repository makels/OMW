/**
 * Created by ZERG on 26.11.2017.
 */
var TplEditor = function() {

    this.container = null;

    this.document = null;

    this.init = function(config) {
        this.container = config.cnt;
        if(this.document == null) {
            this.document = new ZDoc();
            this.document.create();
            this.refresh();
        }
    }

    this.refresh = function() {
        $("#" + this.container).html(this.document.layout);
        this.initHandlers();
    }

    this.initHandlers = function() {
        var scope = this;
        $("#" + this.container).find("td").click(function() {
            $("#" + scope.container).find("td").removeClass("active");
            $(this).addClass("active");
        });

        $(window).resize(function() {
            scope.resize();
        });

        this.resize();

    }

    this.resize = function() {
        
    }

}
