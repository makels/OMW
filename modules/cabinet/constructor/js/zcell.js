/**
 * Created by ZERG on 01.12.2017.
 */
var ZCell = function(r, c) {

    this.position = {
        row: r,
        col: c
    }

    this.width = 80;

    this.height = 20;

    this.text = "";

    this.html = "";

    this.init = function() {
        var style = [];
        style.push("width: " + this.width + "px");
        style.push("height: " + this.height + "px");
        style = style.join(";");
        this.html = "<td style='" + style + "' id='zcell_" + this.position.row +"_" + this.position.col + "' row='" + this.position.row + "' coll='" + this.position.col + "'>" + this.text + "</td>";
    }

    this.init();
}