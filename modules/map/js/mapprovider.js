/**
 * Created by Zerg on 23.12.2015.
 */
var MapProvider = {

  MAX_EXTEND: new OpenLayers.Bounds(-20037508, -20037508, 20037508, 20037508.34),

  BOUNDS_UKRAINE: new OpenLayers.Bounds(2312305.420865983, 5482047.999176792, 4526050.8985648127, 7583730.558321303),

  scanexProvider: function(bounds) {
    return MapProvider.provide(bounds, "gis_ua_web", "png", this);
  },

  kosmoProvider: function(bounds) {
    return MapProvider.provide(bounds, "gis_kosmo_ua", "jpg", this);
  },

  topoProvider: function(bounds) {
    return MapProvider.provide(bounds, "kobl_topo", "png", this);
  },

  vectorTopoProvider: function(bounds) {
    return MapProvider.provide(bounds, "gis_topoznak_50", "png", this);
  },

  provide: function(bounds, prefix, type, scope) {
    var res = appMap.MapInstance.getResolution();
    var x = Math.round((bounds.left - scope.maxExtent.left) / (res * scope.tileSize.w));
    var y = Math.round ((scope.maxExtent.top - bounds.top) / (res * scope.tileSize.h));
    var z = scope.map.getZoom();
    if (scope.map.baseLayer.name == 'Virtual Earth Roads' || scope.map.baseLayer.name == 'Virtual Earth Aerial' || scope.map.baseLayer.name == 'Virtual Earth Hybrid') {
      z = z + 1;
    }

    if (appMap.mapBounds.intersectsBounds(bounds) && z >= appMap.mapMinZoom && z <= appMap.mapMaxZoom) {
      return app.system_config.tiles_path + "/" + prefix + "/" + z + "/" + x + "/" + y + "." + type;
    } else {
      return app.system_config.tiles_path + "/none.png";
    }
  }

}