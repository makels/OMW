/**
 * Created by Zerg on 18.01.2016.
 */
var GisEditor = function() {

  this.editorBuffer = [];

  this.currentTool = null;

  this.moduleLayers = {};

  // Current Layer Id
  this.layerId = null;

  // The type of current layer
  this.layerType = null;

  // Legend layer
  this.layerLegend = null;

  // Init Editor
  this.init = function() {
    this.initModuleLayers();
    var scope = this;
    $("#editor_layers").change(function() {
      scope.layerChange();
    });

    this.initColorPanel();
  }

  this.initModuleLayers = function() {
    this.moduleLayers.vector = new OpenLayers.Layer.Vector("subjectsVector");
    this.moduleLayers.markers = new OpenLayers.Layer.Markers("subjectsMarkers");
    appMap.MapInstance.addLayer(this.moduleLayers.vector);
    appMap.MapInstance.addLayer(this.moduleLayers.markers);
  }

  this.clearLayer = function() {
    this.moduleLayers.vector.destroy();
    this.moduleLayers.markers.destroy();
    this.initModuleLayers();
  }

  this.hideLayer = function() {
    this.moduleLayers.vector.setVisibility(false);
    this.moduleLayers.markers.setVisibility(false);
  }

  this.showLayer = function() {
    this.moduleLayers.vector.setVisibility(true);
    this.moduleLayers.markers.setVisibility(true);
  }

  this.initColorPanel = function() {
    var scope = this;
    $(".color_group .wrapper").click(function() {
      if($(this).hasClass("selected")) {
        $(this).removeClass("selected");
        scope.disableTool();
      } else {
        $(".color_group .wrapper.selected").removeClass("selected");
        $(this).addClass("selected");
        scope.enableDrawTool(this);
      }
    });
  }

  // Clear Buffer
  this.clearBuffer = function() {
    this.editorBuffer = [];
  }

  // Change Current Layer
  this.layerChange = function() {
    this.clearLayer();
    this.clearBuffer();
    this.layerId = $("#editor_layers").val();
    if(this.layerId == "map") {
      this.showMapEditor();
      return;
    }
    this.getGeometryLayer(this.layerId);
  }

  // Display Layer By Id
  this.displayLayer = function(geometry) {
    this.layerInfo = geometry.layer;
    this.layerType = this.layerInfo.ltype;
    this.layerLegend = JSON.parse(geometry.layer.legend);
    switch (this.layerType) {
      case "line":
        this.showLineEditor();
        this.displayLinesLayer(geometry);
        break;
      case "point":
        this.showMarkerEditor();
        this.displayPointsLayer(geometry);
        break;
      case "polygon":
        this.showPolyEditor();
        this.displayPolygonsLayer(geometry);
        break;
    }
  }

  // Get Layer Geometry
  this.getGeometryLayer = function(layerId) {
    var scope = this;
    appMap.showMask();
    $.ajax({
      url: "/modules/editor/editor/getGeometry",
      type: "post",
      dataType: "json",
      data: {
        "layerId" : layerId
      },
      success: function(geometry) {
        appMap.hideMask();
        scope.displayLayer(geometry);
      },
      error: function() {
        appMap.hideMask();
      }
    });
  }

  this.displayLinesLayer = function(geometry) {
    var scope = this;
    $.each(geometry.geometry, function(index, line) {
      var points = line.geometry.split(" ");
      var pointsData = [];
      for(var i = 0; i < points.length; i = i + 2) {
        pointsData.push({
          "lat": Number(points[i]),
          "lng": Number(points[i+1])
        });
      }

      var lineData = [];

      for(var l = 0; l < pointsData.length - 1; l++) {
        lineData.push({
          "lat" : pointsData[l].lat,
          "lng" : pointsData[l].lng,
          "right" : pointsData[l+1].lat,
          "top" : pointsData[l+1].lng
        });
      }

      appMap.displayLines(scope.moduleLayers.vector, lineData, scope.layerInfo.prj, scope.layerLegend.styles[Number(line.path)]);
    });
  }

  this.displayPointsLayer = function(geometry) {
    var scope = this;
    $.each(geometry.geometry, function(index, line) {
      var points = line.geometry.split(" ");
      var pointsData = [];
      for(var i = 0; i < points.length; i = i + 2) {
        pointsData.push({
          "lat": Number(points[i]),
          "lng": Number(points[i+1]),
          "style": scope.layerLegend.styles[Number(line.path)]
        });
      }
      appMap.displaySymbols(scope.moduleLayers.vector, pointsData, scope.layerInfo.prj);
    });
  }

  this.displayPolygonsLayer = function(geometry) {
    var scope = this;
    $.each(geometry.geometry, function(index, line) {
      var points = line.geometry.split(" ");
      var pointsData = [];
      for(var i = 0; i < points.length; i = i + 2) {
        pointsData.push({
          "lat": Number(points[i]),
          "lng": Number(points[i+1]),
        });
      }
      appMap.displayPoly(scope.moduleLayers.vector, pointsData, scope.layerInfo.prj, scope.layerLegend.styles[Number(line.path)]);
    });
  }

  this.showMapEditor = function() {
    this.hideEditor();
    $("#editor_add_map").show();
    $("#editor_actions_map_buttons").show();
    this.updateModuleSize();
  }

  this.showLineEditor = function() {
    this.hideEditor();
    $("#editor_add_line").show();
    $("#editor_color_palette").show();
    $("#editor_actions_line_buttons").show();
    this.updateModuleSize();
  }

  this.showMarkerEditor = function() {
    this.hideEditor();
    $("#editor_add_marker").show();
    $("#editor_marker_palette").show();
    $("#editor_actions_marker_buttons").show();
    this.updateModuleSize();
  }

  this.showPolyEditor = function() {
    this.hideEditor();
    $("#editor_add_poly").show();
    $("#editor_color_palette").show();
    $("#editor_actions_poly_buttons").show();
    this.updateModuleSize();
  }

  this.hideEditor = function() {
    $("#editor_add_map").hide();
    $("#editor_add_line").hide();
    $("#editor_add_marker").hide();
    $("#editor_add_poly").hide();
    $("#editor_marker_palette").hide();
    $("#editor_color_palette").hide();

    $("#editor_actions_map_buttons").hide();
    $("#editor_actions_line_buttons").hide();
    $("#editor_actions_marker_buttons").hide();
    $("#editor_actions_poly_buttons").hide();
  }

  this.updateModuleSize = function() {
    var moduleItem = $("#editor_module_content");
    var height = $(moduleItem).find(".module-content").height() + 10;
    $(moduleItem).height(height);
  }

  // DRAW TOOLS

  this.enableDrawTool = function(el) {
    var color, marker;
    if(this.currentTool != null) this.disableTool();
    switch (this.layerType) {
      case "line":
        color = $(el).attr("color");
        this.enableLineEditor(color);
        break;
      case "poly":
        color = $(el).attr("color");
        this.enablePolyEditor(color);
        break;
      case "marker":
        marker = $(el).attr("marker");
        this.enableMarkerEditor(marker);
        break;
    }
  }

  // EDITORS

  // Line Editor
  this.enableLineEditor = function(color) {
    var scope = this;
    var stylingLayer = this.getStylingLayer(color);

    this.currentTool = new OpenLayers.Control.DrawFeature(
      stylingLayer, OpenLayers.Handler.Path, {
        featureAdded: function(feature) {
          var fData = scope.getGeometryData(feature);
          scope.saveFeature({
            layerId: scope.layerId,
            fData: fData
          });
        }
      });

    appMap.MapInstance.addControl( this.currentTool );
    this.currentTool.activate();
  }

  // Poly Editor
  this.enablePolyEditor = function(color) {

  }

  // Marker Editor
  this.enableMarkerEditor = function(marker) {

  }

  // Disable current tool
  this.disableTool = function() {
    this.currentTool.destroy();
  }

  this.getStylingLayer = function(color) {

    var style = OpenLayers.Util.applyDefaults({
      strokeColor: color,
      strokeWidth: 3,
    }, OpenLayers.Feature.Vector.style['default']);

    var temporarystyle = OpenLayers.Util.applyDefaults({
      strokeColor: color,
      strokeWidth: 3,
    }, OpenLayers.Feature.Vector.style['temporary']);

    var styleMap = new OpenLayers.StyleMap({
      "default": new OpenLayers.Style(style),
      "temporary": new OpenLayers.Style(temporarystyle)
    });

    var layer = new OpenLayers.Layer.Vector('editor_layer', { styleMap: styleMap });

    appMap.MapInstance.addLayer(layer);

    return layer;
  }

  this.getGeometryData = function(feature) {
    var bounds = feature.geometry.getBounds();
    var geometry = [];
    $.each(feature.geometry.components, function(index, cmp) {
      geometry.push(cmp.x);
      geometry.push(cmp.y);
    });

    return {
      x: bounds.left,
      y: bounds.bottom,
      right: bounds.right,
      top: bounds.top,
      geometry: geometry.join(" ")
    };
  }

  // SAVER
  this.saveFeature = function(data) {
    $.ajax({
      url: "/modules/editor/editor/save",
      type: 'post',
      dataType: 'json',
      data: {
        data: data
      },
      success: function(result) {
        debugger;
      }
    });
  }

}

var gisEditor = new GisEditor();

$(function() {
  appMap.registerModule({
    title: "Редактор",
    instance: gisEditor
  });
});