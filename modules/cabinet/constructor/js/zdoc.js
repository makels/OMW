/**
 * Created by ZERG on 01.12.2017.
 */
var ZDoc = function() {

    this.layout = null;

    this.width = 0;

    this.height = 0;

    this.data = [];

    this.init = function() {
        this.width = 0;
        this.height = 0;
        var scope = this;
        $.each(this.data, function(r, row) {
            scope.width = 0;
            scope.height += row[0].height;
            $.each(row, function(c, cell) {
                scope.width += cell.width;
            });
        });
    }

    this.create = function() {
        for(var r = 0; r < 40; r++) {
            var row = [];
            for(var c = 0; c < 100; c++) {
                var cell = new ZCell(r, c);
                row.push(cell);
            }            
            this.data.push(row);
        }
        this.init();
        this.render();
    }
    
    this.load = function(data) {
        
    }
    
    this.save = function() {
        
    }

    this.render = function() {
        var scope = this;
        var cnt = "<table cellpadding='0' cellspacing='0' style='width: " + scope.width + "px; height: " + scope.height + "px'>";
        $.each(this.data, function(index, row) {
            cnt += "<tr row='" + index + "'>";
            $.each(row, function(index, cell) {
                cnt += cell.html;
            });
            cnt += "</tr>"
        });
        cnt += "</table>";
        this.layout = cnt;
    }

}