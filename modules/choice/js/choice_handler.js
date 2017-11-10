/**
 * Created by Zerg on 18.01.2016.
 */
var ChoiceModuleHandler = {

  changeMap : function() {
    var type = $("#choice_map_type_id").val();
    switch (type) {
      case 'map':
        appMap.MapInstance.baseLayer.getURL = MapProvider.scanexProvider;
        break;

      case 'kosmo':
        appMap.MapInstance.baseLayer.getURL = MapProvider.kosmoProvider;
        break;

      case 'topo':
        appMap.MapInstance.baseLayer.getURL = MapProvider.topoProvider;
        break;

      case 'vector-topo':
        appMap.MapInstance.baseLayer.getURL = MapProvider.vectorTopoProvider;
        break;

      default:
        appMap.MapInstance.baseLayer.getURL = MapProvider.scanexProvider;
        break;
    }
    appMap.MapInstance.baseLayer.redraw();
  }


}