/**
 * Created by Zerg on 18.01.2016.
 */

var FrontierHandler = function() {

  this.moduleLayers = {};

  this.init = function() {
    this.initModuleLayers();
    this.loadSymbols();
    this.selectLayersInit();
  }

  this.initModuleLayers = function() {
    this.moduleLayers.vector = new OpenLayers.Layer.Vector("frontierSymbols");
    appMap.MapInstance.addLayer(this.moduleLayers.vector);
  }

  this.clearLayer = function() {
    this.moduleLayers.vector.destroy();
    this.initModuleLayers();
  }

  this.hideLayer = function() {
    this.moduleLayers.vector.setVisibility(false);
  }

  this.showLayer = function() {
    this.moduleLayers.vector.setVisibility(true);
  }

  this.loadSymbols = function() {
    $.ajax({
      url: "/modules/frontier/frontier/symbols",
      type: 'post',
      dataType: 'json',
      success: function(symbols) {
        $.each(symbols, function(index, symbol) {
          OpenLayers.Renderer.symbol[symbol.s_name] = symbol.s_body.split(',').map(Number);
        });
      }
    });
  }

  this.selectLayersInit = function() {
    var scope = this;
    var layers;
    $('.mod_frontier_layers').change(function() {
      scope.clearLayer();
      layers = [];
      $.each($('.mod_frontier_layers:checked'), function(index, el) {
        layers.push($(el).val());
      });
      $.ajax({
        url: "/modules/frontier/frontier/objects",
        type: 'post',
        dataType: 'json',
        data: {
          layers: layers
        },
        success: function(objects) {
          appMap.displaySymbols(scope.moduleLayers.vector, objects, "EPSG:4326");
        }
      });
    });
  }

}

var frontier = new FrontierHandler();

$(function() {
  appMap.registerModule({
    title: "ІС Геліос",
    instance: frontier
  });
});
