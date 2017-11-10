/**
 * Created by Zerg on 20.12.2015.
 */
var Map = function() {

  // CONSTANTS
  this.mapElId = 'op-map';

  this.themePath = "modules/map/css/style.css";

  this.projection = "EPSG:900913";

  this.displayProjection = "EPSG:4326";

  this.defaultUnit = "m";

  this.mapMaxZoom = 18;

  this.maxResolution = 156543.0339;

  this.maxExtend = MapProvider.MAX_EXTEND;

  this.mapBounds = MapProvider.BOUNDS_UKRAINE;

  this.mapMinZoom = 6;

  // PROPS

  this.MapInstance = null;

  this.MapControls = [];

  this.MapControlPanel = null;

  this.Layers = [];

  this.MapEventsHandler = new MapEventsHandler(this);

  this.Modules = [];

  // METHODS

  // Main initialization
  this.init = function() {

    // Init Map Controls
    this.initMapControls();

    // Init Map Events Handler
    this.MapEventsHandler.init();

    // Init Map
    this.initMap();

    // Init Layers
    this.initLayers();

    // Finish initialization and render map
    this.renderMap();

    // Call Listener event
    this.callListener();

  }

  // Register module to map
  this.registerModule = function(module) {
    this.Modules.push(module);
  }

  this.callListener = function() {
    $.each(this.Modules, function(index, module) {
      if(module.instance.init)
        module.instance.init();
    });
  }

  // Initialization map
  this.initMap = function() {

    var options = {
      alt_img: app.system_config.tiles_path + "/none.png",
      controls: this.MapControls,
      projection: new OpenLayers.Projection(this.projection),
      displayProjection: new OpenLayers.Projection(this.displayProjection),
      numZoomLevels: this.mapMaxZoom,
      minZoom: this.mapMinZoom,
      maxZoom: this.mapMaxZoom,
      theme: this.themePath,
      units: this.defaultUnit,
      maxResolution: this.maxResolution,
      maxExtent: this.maxExtend
    };

    this.MapInstance = new OpenLayers.Map(this.mapElId, options);
  }

  // Initialization map controls
  this.initMapControls = function() {

    // ZOOM
    var ZoomControl = new OpenLayers.Control.PanZoom();
    this.MapControls.push(ZoomControl);

    // MAP CONTROL PANEL
    this.MapControlPanel = new MapControlPanel();
    this.MapControlPanel.Map = this;
    this.MapControls.push(this.MapControlPanel.controlPanel);

    // NAVIGATION
    var navigation = new OpenLayers.Control.Navigation();
    this.MapControls.push(navigation);

    // MOUSE
    var MousePosition = new OpenLayers.Control.MousePosition();
    this.MapControls.push(MousePosition);

    // SCALE LINE
    var ScaleControl = new OpenLayers.Control.ScaleLine({
      //geodesic:true,
      bottomOutUnits:""
    });
    this.MapControls.push(ScaleControl);

    window.setTimeout(function() {
      ScaleControl.update();
    }, 1000);

  }

  // Initialization layers
  this.initLayers = function() {
    var BaseLayer = new OpenLayers.Layer.TMS( "Карта", "", {
      buffer:0,
      type: 'png',
      getURL: MapProvider.scanexProvider,
      alpha: true,
      isBaseLayer: true
    });
    this.Layers.push(BaseLayer);
  }

  // Rendering main map
  this.renderMap = function() {
    var scope = this;
    this.MapInstance.addLayers(this.Layers);
    this.displayBounds(this.mapBounds);
    window.setTimeout(function() {
      scope.MapInstance.zoomTo(8);
    }, 1000);
  }

  this.showMask = function() {
    $("#map-loading").show();
    $("#" + this.mapElId).css({
      opacity: 0.5
    });
  }

  this.hideMask = function() {
    $("#map-loading").hide();
    $("#" + this.mapElId).css({
      opacity: 1
    });
  }

  // Zoom to bound
  this.displayBounds = function(bounds) {
    this.MapInstance.zoomToExtent(bounds);
  }

  // Update map size
  this.updateSize = function() {
    this.MapInstance.updateSize();
  }

  // Getting points
  this.getPointsByGeometryLine = function(str) {
    var coords = str.split(' ');
    var points = [];
    for(var i = 0; i < coords.length; i += 2) {
      points.push({
        lat: coords[i],
        lng: coords[i+1]
      });
    }
    return points;
  }

  // DISPLAY MAP OBJECTS

  // Display points
  this.displayPoints = function(layer, coords, prj) {
    var scope = this;
    var points = [];
    $.each(coords, function(index, coord) {
      point = new OpenLayers.Geometry.Point(Number(coord.lat), Number(coord.lng));
      point = point.transform(prj, scope.projection);
      points.push(new OpenLayers.Feature.Vector(point));
    });

    layer.addFeatures(points);
  }

  // Display polygons
  this.displayPoly = function(layer, poly, prj, style) {
    var scope = this;
    var points = [];

    $.each(poly, function(index, coord) {
      var point = new OpenLayers.Geometry.Point(Number(coord.lat), Number(coord.lng));
      point = point.transform(prj, scope.projection);
      points.push(point);
    });
    var ring = new OpenLayers.Geometry.LinearRing(points);
    var geometry = new OpenLayers.Geometry.Polygon([ring]);

    if(style === undefined) {
      var default_style = OpenLayers.Feature.Vector.style['default'];
      style = OpenLayers.Util.extend({}, default_style);
      style.strokeColor = "blue";
      style.strokeWidth = 1;
      style.pointRadius = 2;
      style.fillOpacity = 0.2;
      style.strokeLinecap = "butt";
    }

    var polygonFeature = new OpenLayers.Feature.Vector(geometry, null, style);
    layer.addFeatures([polygonFeature]);
  }

  // Display symbols
  this.displaySymbols = function(layer, symbols, prj) {
    var scope = this;
    $.each(symbols, function(index, symbol) {
      symbol.style.cursor = "pointer";
      symbol.style.title = symbol.title;
      var point = new OpenLayers.Geometry.Point(Number(symbol.lat), Number(symbol.lng)).transform(prj, scope.projection);
      var feature = new OpenLayers.Feature.Vector(point, null, symbol.style);
      layer.addFeatures([feature]);
    });
  }

  // Display markers
  this.displayMarkers = function(layer, markers, prj) {
    var scope = this;
    var size = new OpenLayers.Size(21,25);
    var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);

    $.each(markers, function(index, marker) {
      var point, icon;
      icon = new OpenLayers.Icon(marker.icon, size, offset);
      icon.imageDiv = $("<div class='map-marker-wrapper' title='" + marker.title + "'><img src='' /></div>")[0];
      point = new OpenLayers.LonLat(Number(marker.lat), Number(marker.lng));
      point = point.transform(prj, scope.projection);
      layer.addMarker(new OpenLayers.Marker(point,icon));
    });
  }

  // Display Lines
  this.displayLines = function(layer, lines, prj, style) {
    var scope = this;
    $.each(lines, function(index, line) {
      var points = [
        (new OpenLayers.Geometry.Point(Number(line.lat), Number(line.lng))).transform(prj, scope.projection),
        (new OpenLayers.Geometry.Point(Number(line.right), Number(line.top))).transform(prj, scope.projection)
      ];

      var line_str = new OpenLayers.Geometry.LineString(points);

      if(style === undefined) {
        style = {
          strokeColor: '#0000ff',
          strokeOpacity: 1,
          strokeWidth: 3
        };
      }

      var lineFeature = new OpenLayers.Feature.Vector(line_str, null, style);
      layer.addFeatures([lineFeature]);
    });
  }

}

var appMap = new Map();

$(function() {
  appMap.init();
})