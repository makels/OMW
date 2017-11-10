/**
 * Created by Zerg on 18.01.2016.
 */
var LayersModuleHandler = {
  changeLayer : function() {
    var map = $("#layer_map_type_id").val();
    switch (map) {
      case 'none':
        this.removeLayer();
        break;
      case 'map':
        this.removeLayer();
        this.addLayer(MapProvider.scanexProvider);
        break;
      case 'kosmo':
        this.removeLayer();
        this.addLayer(MapProvider.kosmoProvider);
        break;
      case 'topo':
        this.removeLayer();
        this.addLayer(MapProvider.topoProvider);
        break;
      case 'vector-topo':
        this.removeLayer();
        this.addLayer(MapProvider.vectorTopoProvider);
        break;
    }
  },

  changeOpacity : function() {
    var opacity = Number($("#sintez_map_opacity_id").val()) / 100;
    var layers = appMap.MapInstance.getLayersByName("Sintez");
    if(layers.length > 0) {
      layers[0].setOpacity(opacity);
    }

  },

  addLayer : function(provider) {
    var layer = new OpenLayers.Layer.TMS("Sintez", "", {
      buffer:0,
      type: 'png',
      getURL: provider,
      alpha: true,
      isBaseLayer: false
    });
    appMap.MapInstance.addLayer(layer);
  },

  removeLayer : function() {
    var layers = appMap.MapInstance.getLayersByName("Sintez");
    if(layers.length > 0) {
      appMap.MapInstance.removeLayer(layers[0]);
      $("#sintez_map_opacity_id").val(100);
    }
  }
}