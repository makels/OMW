/**
 * Created by Zerg on 25.02.2016.
 */
var MapsEditor = function() {

  this.moduleLayers = {};

  this.init = function() {
    var scope = this;
    $("#maps_editor_select").change(function() {
      var map_id = $(this).val();
      $("#map_id").val(map_id);
      scope.changeMap(map_id);
    });

    $("#layer_map_opacity_id").change(function() {
      var opacity = $(this).val();
      scope.setOpacityCustomMaps(opacity/100);
    });
  }

  this.initModuleLayers = function() {
    this.moduleLayers.image = [];
  }

  this.addMap = function() {
    var scope = this;
    var zWindow = new ZWindow({
      title: "Назва карти",
      text: "Введіть назву карти: <br><input type='text' id='custom_map_name' />",
      buttons: [
      {
        text: "Ок",
        click: function() {
          var name = $("#custom_map_name").val();
          scope.onAddMap(name);
          zWindow.hide();
        }
      },
      {
        text: "Відміна",
        click: function() {
          zWindow.hide();
        }
      }
    ]
    });

    zWindow.show();
  }

  this.onAddMap = function(name) {
    $.ajax({
      url: "/modules/maps_editor/maps_editor/addMap",
      type: "post",
      dataType: "json",
      data: {
        map_title: name
      },
      success: function(id) {
        if(id != 0) {
//          $("#maps_editor_select").append("<option value='" + id + "'>" + name + "</option>");
//          $("#maps_editor_select").val(id);
          document.location.reload();
        }
      }
    });
  }

  this.removeMap = function() {
    var scope = this;
    var id = $("#maps_editor_select").val();
    var name = $("#maps_editor_select option:selected").html();

    var zWindow = new ZWindow({
      title: "Видалити карту",
      text: "Видалити карту '" + name + "' ?",
      buttons: [
        {
          text: "Ок",
          click: function() {
            scope.beginRemoveMap(id, function() {
              document.location.reload();
            });
            zWindow.hide();
            $("#maps_editor_select option:selected").remove();
            $("#maps_editor_select").val(0);
          }
        },
        {
          text: "Відміна",
          click: function() {
            zWindow.hide();
          }
        }
      ]
    });
    zWindow.show();

  }

  this.beginRemoveMap = function(id, success) {
    $.ajax({
      url: "/modules/maps_editor/maps_editor/removeMap",
      type: "post",
      dataType: "json",
      data: {
        id: id
      },
      success: function(id) {
        success();
      }
    });
  }

  this.uploadBound = function() {
    // This need show upload window
    var scope = this;
    var uploadContent = $("#upload_map_form_id").html();
    var zWindow = new ZWindow({
      title: "Фрагмент карти",
      text: uploadContent,
      buttons: [
      {
        text: "Ок",
        click: function() {
          // This need submit form content
          $("#bound_file_form").submit();
        }
      },
      {
        text: "Відміна",
        click: function() {
          zWindow.hide();
        }
      }
    ]
    });

    zWindow.show();
    //$("#upload_map_form_id").show();
  }

  this.checkUploadForm = function() {
    var map_name = $("#custom_map_name").val();
    var left_bound = $("#left_bound_id").val();
    var down_bound = $("#down_bound_id").val();
    var right_bound = $("#right_bound_id").val();
    var top_bound = $("#top_bound_id").val();
    var bound_file = $("#bound_file_id").val();

    if(map_name == "") { $("#upload_map_form_message").html("Введіть назву карти"); return false; }
    if(left_bound == "") { $("#upload_map_form_message").html("Введіть координату лівого краю фрагмента карти"); return false; }
    if(down_bound == "") { $("#upload_map_form_message").html("Введіть координату нижнього краю фрагмента карти"); return false; }
    if(right_bound == "") { $("#upload_map_form_message").html("Введіть координату правого краю фрагмента карти"); return false; }
    if(top_bound == "") { $("#upload_map_form_message").html("Введіть координату верхнього краю фрагмента карти"); return false; }
    if(bound_file == "") { $("#upload_map_form_message").html("Оберіть файл фрагмента карти"); return false; }

    return true;
  }

  this.changeMap = function(map_id) {
    this.clearCustomMaps();
    if(Number(map_id) == -1) return;
    var scope = this;
    appMap.showMask();
    $.ajax({
      url: "/modules/maps_editor/maps_editor/mapLayers",
      type: "post",
      dataType: "json",
      data: {
        map_id: map_id
      },
      success: function(info) {
        appMap.hideMask();
        scope.drawMapLayers(info);
      },
      error: function() {
        appMap.hideMask();
      }
    });
  }

  this.drawMapLayers = function(info) {
    var bounds = new OpenLayers.Bounds();
    bounds.extend(new OpenLayers.LonLat(Number(info.x), Number(info.y)));
    bounds.extend(new OpenLayers.LonLat(Number(info.right), Number(info.top)));
    bounds.transform('EPSG:4326', appMap.MapInstance.getProjectionObject());
    this.moduleLayers.image = new OpenLayers.Layer.Image('CustomMap', '/uploads/' + info.img, bounds, new OpenLayers.Size(Number(info.width), Number(info.height)), {
      'isBaseLayer': false,
      'alwaysInRange': true
    });
    appMap.MapInstance.addLayer(this.moduleLayers.image);
    this.moduleLayers.image.setZIndex(150);
    appMap.MapInstance.zoomToExtent(bounds)
  }

  this.clearCustomMaps = function() {
    if(this.moduleLayers.image == undefined) return;
    this.moduleLayers.image.destroy();
  }

  this.hideLayer = function() {
    this.moduleLayers.image.setVisibility(false);
  }

  this.showLayer = function() {
    this.moduleLayers.image.setVisibility(true);
  }

  this.setOpacityCustomMaps = function(opacity) {
    var mapLayers = appMap.MapInstance.getLayersByName("CustomMap");
    $.each(mapLayers, function(index, layer) {
      layer.setOpacity(opacity);
    });
  }

}

var mapsEditor = new MapsEditor();

$(function() {
  appMap.registerModule({
    title: "Мої карти",
    instance: mapsEditor
  });
});