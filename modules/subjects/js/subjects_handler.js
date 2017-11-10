/**
 * Created by Zerg on 18.01.2016.
 */

var SubjectsHandler = function() {

  this.moduleLayers = {};

  this.tree = null;

  this.tree_selector = "#subjects-wrapper-id";

  this.init = function() {
    var scope = this;
    this.initModuleLayers();
    this.tree = $(this.tree_selector).dynatree({
      imagePath: '/theme/images/icons/',
      checkbox: true,
      selectMode: 3,
      children: subjectsNodes,
      onSelect: function(select, node) {
        var selNodes = node.tree.getSelectedNodes();
        var data = [];
        $.each(selNodes, function(index, node) {
          data.push({
            key: node.data.key,
            icon: node.data.icon,
            title: node.data.title
          });
        });
        scope.loadLayers(data);
      },
      onClick: function(node, event) {
        if( node.getEventTargetType(event) == "title" )
          node.toggleSelect();
      },
      onKeydown: function(node, event) {
        if( event.which == 32 ) {
          node.toggleSelect();
          return false;
        }
      },

      onExpand: function() {
        var height = $('#subjects-wrapper-id').height();
        $('#menu-subjects-wrap').height(height + 50);
      },
      cookieId: "module-subjects-dynatree",
      idPrefix: "module-subjects-dynatree-"
    });
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

  this.loadLayers = function(data) {
    var scope = this;
    appMap.showMask();
    $.ajax({
      url: '/modules/subjects/subjects/layers',
      type: 'post',
      dataType: 'json',
      data: {
        list: data
      },
      success: function(layers) {
        appMap.hideMask();
        scope.drawLayers(layers);
      },
      error: function() {
        scope.drawLayers(layers);
      }
    });
  }

  this.drawLayers = function(layers) {
    this.clearLayer();
    var scope = this;
    $.each(layers, function(index, layer) {
      $.each(layer.data, function(index, subject) {
        switch(subject.type) {
          case 'point':
            scope.drawPoint(subject);
            break;
          case 'line':
            scope.drawLines(subject);
            break;
          case 'polygon':
            scope.drawPolygon(subject);
          default:
            break;
        }
      });
    })
  }

  this.drawPoint = function(layer) {
    appMap.displayMarkers(this.moduleLayers.markers, [{
      lat: layer.x,
      lng: layer.y,
      icon: layer.path,
      title: layer.title
    }], layer.prj != "EPSG:900913");
  }

  this.drawLines = function(layer) {
    var lines = [];
    var points = appMap.getPointsByGeometryLine(layer.geometry);
    for(var i = 0; i < points.length - 1; i++) {
      lines.push({
        lat: points[i].lat,
        lng: points[i].lng,
        right: points[i+1].lat,
        top: points[i+1].lng
      });
    }
    appMap.displayLines(this.moduleLayers.vector, lines, layer.prj);
  }

  this.drawPolygon = function(layer) {
    var points = appMap.getPointsByGeometryLine(layer.geometry);
    appMap.displayPoly(this.moduleLayers.vector, points, layer.prj);
  }

}

var subjectsHandler = new SubjectsHandler();
$(function() {
  appMap.registerModule({
    title: "Тематичний зміст",
    instance: subjectsHandler
  });
});
