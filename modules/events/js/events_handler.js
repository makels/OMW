/**
 * Created by Zerg on 18.01.2016.
 */

var EventsEditor = function() {

  this.moduleLayers = {};

  this.init = function() {
    var scope = this;
    this.initModuleLayers();
    this.initMaskedInput();
  }

  this.initModuleLayers = function() {
    this.moduleLayers.events = new OpenLayers.Layer.Vector("eventsEditor");
    appMap.MapInstance.addLayer(this.moduleLayers.events);
  }

  this.hideLayer = function() {
    this.moduleLayers.events.setVisibility(false);
  }

  this.showLayer = function() {
    this.moduleLayers.events.setVisibility(true);
  }

  this.initMaskedInput = function() {
    $("#events_period_start").datetimepicker($.extend($.datepicker.regional['uk'], {
      stepMinute: 5,
      showSecond:false,
      showMillisec:false,
      showMicrosec:false,
      showTimezone:false
    }));
    $("#events_period_end").datetimepicker($.extend($.datepicker.regional['uk'], {
      stepMinute: 5,
      showSecond:false,
      showMillisec:false,
      showMicrosec:false,
      showTimezone:false
    }));
  }

  this.addEvent = function() {
    var scope = this;
    var feature = new OpenLayers.Control.DrawFeature(this.moduleLayers.events,
      OpenLayers.Handler.Point);

    feature.callbacks.done = function(point) {
      feature.deactivate();
      scope.onAddEvent(point);
    }
    appMap.MapInstance.addControl(feature);
    feature.activate();
  }

  this.onAddEvent = function(point) {
    var scope = this;
    var uploadContent = $("#add_event_form_id").html();
    var zWindow = new ZWindow({
      title: "Додати подію",
      text: uploadContent,
      buttons: [
        {
          text: "Ок",
          click: function() {
            // This need submit form content
            $("#add_event_x").val(point.x);
            $("#add_event_y").val(point.y);

            $("#event_add_form").submit();
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
    $("#event_date_id").mask("00.00.0000");
  }

  this.checkUploadForm = function() {
    var title = $("#event_title_id").val();
    if(title == "") { $("#add_event_form_message").html("Введіть заголовок події"); return false; }

    return true;
  }

  this.showEvents = function() {
    var scope = this;
    this.clearEvents();
    var start = $("#events_period_start").val();
    var end = $("#events_period_end").val();

    if(start == "" || end == "") {
      app.alert("Оберіть період подій");
      return;
    }

    $.ajax({
      url: "/modules/events/events/getEvents",
      type: "post",
      dataType: "json",
      data: {
        start: start,
        end: end
      },
      success: function(events) {
        scope.drawEvents(events);
      }
    });
  }

  this.drawEvents = function(events) {
    var scope = this;

    $.each(events, function(index, point) {

      var marker = {
        lat: point.x,
        lng: point.y,
        style: {"userData": point, "fillColor":"#ee9900","fillOpacity":0.2,"hoverFillColor":"white","hoverFillOpacity":0.8,"strokeColor":"#ee9900","strokeOpacity":1,"strokeWidth":1,"strokeLinecap":"round","strokeDashstyle":"solid","hoverStrokeColor":"red","hoverStrokeOpacity":1,"hoverStrokeWidth":0.2,"pointRadius":20,"hoverPointRadius":1,"hoverPointUnit":"%","pointerEvents":"visiblePainted","cursor":"inherit","graphicOpacity":1,"externalGraphic":"/theme/images/icons/location_pin.png","backgroundHeight":32,"backgroundWidth":32},
      }

      marker.style.cursor = "pointer";
      marker.style.title = point.title;
      var fpoint = new OpenLayers.Geometry.Point(Number(marker.lat), Number(marker.lng));
      var feature = new OpenLayers.Feature.Vector(fpoint, null, marker.style);
      scope.moduleLayers.events.addFeatures([feature]);
    });

    var selectFeature = new OpenLayers.Control.SelectFeature(
      scope.moduleLayers.events,
      {
        onSelect: function(marker) {
          scope.openEvent(marker.style.userData);
        },
        autoActivate: true
      }
    );
    appMap.MapInstance.addControl(selectFeature);
  }

  this.openEvent = function(data) {
    var scope = this;
    var sd = new Date(data.event_date);
    var td = sd.getDate() + "." + sd.getMonth() + "." + sd.getFullYear();
    var content = $("#event_form_id").html();
    var zWindow = new ZWindow({
      title: "Властивості події",
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
            scope.deleteEvent(data.id);
            zWindow.hide();
          }
        }
      ]
    });

    $("#event_title_zid").text(data.title);
    $("#event_text_id").text(data.description);
    $("#event_date").text(td);
    if(data.file != '')
      $("#event_file").html('Файл: <a href="/uploads/' + data.file + '" target="_blank">' + data.file + '</a>');
    zWindow.show();

  }

  this.clearEvents = function() {
    this.moduleLayers.events.destroyFeatures();
  }

  this.deleteEvent = function(id) {
    $.ajax({
      url: "/modules/events/events/removeEvent",
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

}

var eventsEditor = new EventsEditor();

$(function() {
  appMap.registerModule({
    title: "Реєстрація подій",
    instance: eventsEditor
  });
});
