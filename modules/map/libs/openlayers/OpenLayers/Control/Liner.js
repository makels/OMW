/**
 * Created by Zerg on 25.12.2015.
 */


OpenLayers.Control.Liner = OpenLayers.Class(OpenLayers.Control, {

  type: OpenLayers.Control.TYPE_TOGGLE,

  draw: function() {
    this.handler = new OpenLayers.Handler.Path( this,
      {done: this.liner}, {keyMask: this.keyMask} );
  },

  liner: function(res) {
    var mapPrj = this.map.getProjection();
    var resp = res.transform(mapPrj, "EPSG:4326");
    var length = Math.ceil(resp.getGeodesicLength());
    if(length > 1000) {
      length = (length / 1000) + ' км';
    } else {
      length = (length) + ' м';
    }

    if(this.eventListeners != null && typeof(this.eventListeners.done) != 'undefined')
      this.eventListeners.done(length);
  },

  CLASS_NAME: "OpenLayers.Control.Liner"
});