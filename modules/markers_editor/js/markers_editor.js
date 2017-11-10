/**
 * Created by zerg on 27.03.16.
 */
var MarkersEditor = function() {

  this.moduleLayers = {};

  this.init = function() {
    var scope = this;
    $("#markers_editor_select").change(function() {
      var layer_id = $(this).val();
      scope.changeLayer(layer_id);
    });
    this.initModuleLayers();
  }

  this.initModuleLayers = function() {
    this.moduleLayers.markers = new OpenLayers.Layer.Vector("markersEditor");
    appMap.MapInstance.addLayer(this.moduleLayers.markers);
  }

  this.hideLayer = function() {
    this.moduleLayers.markers.setVisibility(false);
  }

  this.showLayer = function() {
    this.moduleLayers.markers.setVisibility(true);
  }

  this.addMarkersLayer = function() {
    var scope = this;
    var zWindow = new ZWindow({
      title: "Назва шару",
      text: "Введіть назву шару: <br><input type='text' id='markers_layer_name' />",
      buttons: [
        {
          text: "Ок",
          click: function() {
            var name = $("#markers_layer_name").val();
            scope.onAddMarkersLayer(name);
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

  this.onAddMarkersLayer = function(name) {
    $.ajax({
      url: "/modules/markers_editor/markers_editor/addMarkersLayer",
      type: "post",
      dataType: "json",
      data: {
        title: name
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

  this.removeMarkersLayer = function() {
    var scope = this;
    var id = $("#markers_editor_select").val();
    var name = $("#markers_editor_select option:selected").html();

    var zWindow = new ZWindow({
      title: "Видалити шар",
      text: "Видалити шар '" + name + "' ?",
      buttons: [
        {
          text: "Ок",
          click: function() {
            scope.beginRemoveMarkersLayer(id, function() {
              document.location.reload();
            });
            zWindow.hide();
            $("#markers_editor_select option:selected").remove();
            $("#markers_editor_select").val(0);
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

  this.beginRemoveMarkersLayer = function(id, success) {
    $.ajax({
      url: "/modules/markers_editor/markers_editor/removeMarkersLayer",
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

  this.addMarker = function() {
    var scope = this;
    var layerId = Number($("#markers_editor_select").val());
    if(layerId == -1) app.alert("Оберіть, або додайте новий шар маркерів");
    var feature = new OpenLayers.Control.DrawFeature(this.moduleLayers.markers,
      OpenLayers.Handler.Point);

    feature.callbacks.done = function(point) {
      feature.deactivate();
      scope.onAddMarker(point);
    }
    appMap.MapInstance.addControl(feature);
    feature.activate();
  }

  this.changeLayer = function(layer_id) {
    var scope = this;
    this.clearMarkers();
    if(Number(layer_id) == -1) return;
    $.ajax({
      url: "/modules/markers_editor/markers_editor/getMarkers",
      type: "post",
      dataType: "json",
      data: {
        layer_id: layer_id
      },
      success: function(markers) {
        scope.drawMarkers(markers);
      }
    });
  }

  this.onAddMarker = function(point) {
    var scope = this;
    var uploadContent = $("#add_marker_form_id").html();
    var zWindow = new ZWindow({
      title: "Додати маркер",
      text: uploadContent,
      buttons: [
        {
          text: "Ок",
          click: function() {
            // This need submit form content
            var layer_id = $("#markers_editor_select").val();
            $("#marker_layer_id").val(layer_id);
            $("#add_marker_x").val(point.x);
            $("#add_marker_y").val(point.y);

            $("#marker_add_form").submit();
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

  this.checkUploadForm = function() {
    var title = $("#marker_title_id").val();
    if(title == "") { $("#upload_map_form_message").html("Введіть заголовок маркеру"); return false; }

    return true;
  }

  this.drawMarkers = function(markers) {
    var scope = this;

    $.each(markers, function(index, point) {

      var marker = {
        lat: point.x,
        lng: point.y,
        style: {"userData": point, "fillColor":"#ee9900","fillOpacity":0.2,"hoverFillColor":"white","hoverFillOpacity":0.8,"strokeColor":"#ee9900","strokeOpacity":1,"strokeWidth":1,"strokeLinecap":"round","strokeDashstyle":"solid","hoverStrokeColor":"red","hoverStrokeOpacity":1,"hoverStrokeWidth":0.2,"pointRadius":20,"hoverPointRadius":1,"hoverPointUnit":"%","pointerEvents":"visiblePainted","cursor":"inherit","graphicOpacity":1,"externalGraphic":"/theme/images/icons/location_pin.png","backgroundHeight":32,"backgroundWidth":32}
      }

      marker.style.cursor = "pointer";
      marker.style.title = point.title;
      var fpoint = new OpenLayers.Geometry.Point(Number(marker.lat), Number(marker.lng));
      var feature = new OpenLayers.Feature.Vector(fpoint, null, marker.style);
      scope.moduleLayers.markers.addFeatures([feature]);
    });

    var selectFeature = new OpenLayers.Control.SelectFeature(
      scope.moduleLayers.markers,
      {
        onSelect: function(marker) {
          scope.openMarker(marker.style.userData);
        },
        autoActivate: true
      }
    );
    appMap.MapInstance.addControl(selectFeature);
  }

  this.clearMarkers = function() {
    this.moduleLayers.markers.destroyFeatures();
  }

  this.deleteMarker = function(id) {
    $.ajax({
      url: "/modules/markers_editor/markers_editor/removeMarker",
      type: "post",
      dataType: "json",
      data: {
        id: id
      },
      success: function(id) {
        document.location.reload();
      }
    });
  }

  this.openMarker = function(data) {
    var scope = this;

    var content = $("#marker_form_id").html();
    var zWindow = new ZWindow({
      title: "Властивості маркеру",
      text: content,
      buttons: [
        {
          text: "Ок",
          click: function() {
            zWindow.hide();
          }
        },
        {
          text: "Видалити",
          click: function() {
            scope.deleteMarker(data.id);
            zWindow.hide();
          }
        }
      ]
    });

    $("#marker_title_zid").text(data.title);
    $("#marker_type_id").val(data.icon);
    $("#marker_text_id").text(data.description);
    if(data.file != '')
      $("#marker_file").html('Файл: <a href="/uploads/' + data.file + '" target="_blank">' + data.file + '</a>');


    zWindow.show();
  }


}

var markersEditor = new MarkersEditor();

$(function() {
  appMap.registerModule({
    title: "Мої маркери",
    instance: markersEditor
  });
});