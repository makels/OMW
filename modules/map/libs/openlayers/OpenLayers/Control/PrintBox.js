/**
 * Created by Zerg on 09.01.2016.
 */

/**
 * @requires OpenLayers/Control.js
 * @requires OpenLayers/Handler/Box.js
 */

/**
 * Class: OpenLayers.Control.PrintBox
 *
 * Inherits from:
 *  - <OpenLayers.Control>
 */
OpenLayers.Control.PrintBox = OpenLayers.Class(OpenLayers.Control, {
  /**
   * Property: type
   * {OpenLayers.Control.TYPE}
   */
  type: OpenLayers.Control.TYPE_TOOL,

  /**
   * Method: draw
   */
  draw: function() {
    this.handler = new OpenLayers.Handler.Box( this,
      {done: this.zoomBox}, {keyMask: this.keyMask} );
  },

  /**
   * Method: zoomBox
   *
   * Parameters:
   * position - {<OpenLayers.Bounds>} or {<OpenLayers.Pixel>}
   */
  zoomBox: function (position) {
    var scope = this;
    if (position instanceof OpenLayers.Bounds) {
      var bounds,
        targetCenterPx = position.getCenterPixel();
      if (!this.out) {
        var minXY = this.map.getLonLatFromPixel({
          x: position.left,
          y: position.bottom
        });
        var maxXY = this.map.getLonLatFromPixel({
          x: position.right,
          y: position.top
        });
        bounds = new OpenLayers.Bounds(minXY.lon, minXY.lat,
          maxXY.lon, maxXY.lat);
      } else {
        var pixWidth = position.right - position.left;
        var pixHeight = position.bottom - position.top;
        var zoomFactor = Math.min((this.map.size.h / pixHeight),
          (this.map.size.w / pixWidth));
        var extent = this.map.getExtent();
        var center = this.map.getLonLatFromPixel(targetCenterPx);
        var xmin = center.lon - (extent.getWidth()/2)*zoomFactor;
        var xmax = center.lon + (extent.getWidth()/2)*zoomFactor;
        var ymin = center.lat - (extent.getHeight()/2)*zoomFactor;
        var ymax = center.lat + (extent.getHeight()/2)*zoomFactor;
        bounds = new OpenLayers.Bounds(xmin, ymin, xmax, ymax);
      }
      // always zoom in/out
      var lastZoom = this.map.getZoom(),
        size = this.map.getSize(),
        centerPx = {x: size.w / 2, y: size.h / 2},
        zoom = this.map.getZoomForExtent(bounds),
        oldRes = this.map.getResolution(),
        newRes = this.map.getResolutionForZoom(zoom);
      if (oldRes == newRes) {
        this.map.setCenter(this.map.getLonLatFromPixel(targetCenterPx));
      } else {
        var zoomOriginPx = {
          x: (oldRes * targetCenterPx.x - newRes * centerPx.x) /
          (oldRes - newRes),
          y: (oldRes * targetCenterPx.y - newRes * centerPx.y) /
          (oldRes - newRes)
        };
        this.map.zoomTo(zoom, zoomOriginPx);
      }
      if (lastZoom == this.map.getZoom() && this.alwaysZoom == true){
        this.map.zoomTo(lastZoom + (this.out ? -1 : 1));
      }
    } else if (this.zoomOnClick) { // it's a pixel
      if (!this.out) {
        this.map.zoomTo(this.map.getZoom() + 1, position);
      } else {
        this.map.zoomTo(this.map.getZoom() - 1, position);
      }
    }
    window.setTimeout(function() {
      scope.printBox(position);
    }, 1000);

  },

  /**
   * Method: printBox
   *
   * Parameters:
   * position - {<OpenLayers.Bounds>} or {<OpenLayers.Pixel>}
   */
  printBox: function (position) {
    var width = position.right - position.left;
    var height = position.bottom - position.top;
    var wnd = window.open('', 'Друк', 'height=500, width=800');
    var viewport = this.map.getViewport();
    var content = viewport.innerHTML;
    //var style="<style> #print-wrap .olMapViewport { overflow: visible !important; left: " + position.left * -1 + "px; top: " + position.top * -1 + "px;}</style>";
    wnd.document.write('<html><head><title>Друк</title></head><body><div id="print-wrap">' + content + '</div></body></html>');
    wnd.document.close();
    wnd.print();
  },

  CLASS_NAME: "OpenLayers.Control.PrintBox"
});
