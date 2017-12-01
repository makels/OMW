/**
 * Created by ZERG on 01.12.2017.
 */
var ZDoc = function() {

    this.layout = null;

    this.data = [];

    this.create = function() {
        for(var r = 0; r <= 40; r++) {
            var row = [];
            for(var c = 0; c <= 100; c++) {
                var cell = new ZCell(r, c);
                row.push(cell);
            }            
            this.data.push(row);
        }
        this.render();
    }
    
    this.load = function(data) {
        
    }
    
    this.save = function() {
        
    }

    this.render = function() {
        var width = 0;
        var height = 0;
        var cnt = "";
        $.each(this.data, function(index, row) {
            width = 0;
            height += row[0].height;
            cnt += "<tr row='" + index + "'>";
            $.each(row, function(index, cell) {
                width += cell.width;
                cnt += cell.html;
            });
            cnt += "</tr>"
        });
        cnt = "<table style='width: " + width + "px; height: " + height + "px'>" + cnt + "</table>";
        this.layout = cnt;
    }
    
}