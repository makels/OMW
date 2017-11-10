/**
 * Created by Zerg on 24.12.2015.
 */
var MapControlPanel = function() {

  this.Map = null;

  this.controls = {};

  this.controlPanel = null;

  this.init = function() {

    // MENU HIDE
    this.initMenuHideCtrl();

    // FULLSCREEN CTRL
    this.initFullscreenCtrl();

    // MOVE CTRL
    this.initMoveCtrl();

    // ZOOM CTRL
    this.initZoomCtrl();

    // LINER CTRL
    this.initLinerCtrl();

    // CLEAR VECTOR CTRL
    this.initClearVectorCtrl();

    // PRINT CTRL
    this.initPrintCtrl();

    // PRINT BOX CTRL
    this.initPrintBoxCtrl();

    // MAP TYPE
    this.initMapLayersCtrl();

    this.controlPanel = new OpenLayers.Control.Panel({
      displayClass: "Controlpanel"
    });

    this.controlPanel.addControls(this.getControls());

  }

  // MENU HIDE CTRL
  this.initMenuHideCtrl = function() {
    var scope = this;
    this.controls.menuhide = new OpenLayers.Control.Button({
      title: "Меню (показати / приховати)",
      displayClass: "menuhide",
      trigger: function() {
        var menuWrap = $('.main-content .left-side');
        if($(menuWrap).hasClass('closed')) {
          // OPEN MENU
          $(menuWrap).removeClass('closed');
          appMap.updateSize();
        } else {
          // CLOSE MENU
          $(menuWrap).addClass('closed');
          appMap.updateSize();
        }

      }
    });
  }

  // FULLSCREEN CTRL
  this.initFullscreenCtrl = function() {
    var scope = this;
    this.controls.fullscreen = new OpenLayers.Control.Button({
      title: 'На весь екран',
      displayClass: "fullscreen",
      trigger: function() {
        if(this.active === true) {
          this.deactivate();
          scope.Map.MapEventsHandler.onNormalScreen();
        } else {
          this.activate();
          scope.Map.MapEventsHandler.onFullScreen();
        }
      }
    });

  }

  // MOVE CTRL
  this.initMoveCtrl = function() {
    var scope = this;

    this.controls.move = new OpenLayers.Control.Button({
      title:'Перемістити фрагмент',
      displayClass: "olControlNavigation_top",
      trigger: function() {
        scope.activate("move");
        this.activate();
      }
    });

    window.setTimeout(function() {
      scope.controls.move.activate();
    }, 500);

  }

  // ZOOM CTRL
  this.initZoomCtrl = function() {
    var scope = this;
    this.controls.zoom = new OpenLayers.Control.ZoomBox({
      title:'Збільшити фрагмент',
      displayClass: "zoomTo_top",
      eventListeners: {
        "activate": function() {
          scope.activate("zoom");
        }
      }
    });
  }

  // LINER CONTROL
  this.initLinerCtrl = function() {
    var scope = this;
    this.controls.liner = new OpenLayers.Control.Liner({
      title: 'Виміряти відстань',
      displayClass: "liner",
      eventListeners: {
        "activate": function() {
          scope.activate("liner");
        },
        "done" : function(lengthText) {
          app.alert("Відстань: " + lengthText);
        }
      }
    });
  }

  // CLEAR VECTOR CTRL
  this.initClearVectorCtrl = function() {
    var scope = this;
    this.controls.vector = new OpenLayers.Control.Button({
      title: 'Очистити',
      displayClass: "clearPict_top",
      trigger: function() {
        $.each(scope.Map.MapInstance.layers, function(index, layer) {
          if(layer.features)
            layer.destroyFeatures(layer.features, null);

          if(layer.clearMarkers) layer.clearMarkers();
        });
      }
    });
  }

  // PRINT BOX CTRL
  this.initPrintBoxCtrl = function() {
    var scope = this;
    this.controls.print_box = new OpenLayers.Control.PrintBox({
      title: 'Роздрукувати фрагмент',
      displayClass: "print_top",
      eventListeners: {
        "activate": function() {
          scope.activate("print_box");
        }
      }
    });
  }

  // PRINT CTRL
  this.initPrintCtrl = function() {
    var scope = this;
    this.controls.print = new OpenLayers.Control.Button({
      title: 'Роздрукувати',
      displayClass: 'printAll',
      trigger: function() {
        var wnd = window.open('', 'Друк', 'height=500, width=800');
        var content = document.getElementById(appMap.mapElId).innerHTML;
        wnd.document.write('<html><head><title>Друк</title></head><body>' + content + '</body></html>');
        wnd.document.close();
        wnd.print();
      }
    });
  }

  // SELECT LAYERS CTRL
  this.initMapLayersCtrl = function() {
    $.each(appMap.Modules, function(index, module) {
      if(module.title && module.instance && module.instance.showLayer && module.instance.hideLayer) {
        var moduleItem = $("<li><input class='map_layer_visible' type='checkbox' checked>" + module.title + "</li>");
        var ctrl = $('#map_change_ctrl ul');
        ctrl.append(moduleItem);
        $(moduleItem).click(function() {
          var checkBox = $(this).find("input");
          if($(checkBox).is(":checked")) {
            module.instance.showLayer();
          } else {
            module.instance.hideLayer();
          }
        });
      }
    });

    this.controls.maptype = new OpenLayers.Control.Button({
      title: 'Шари карти',
      displayClass: "maptype_top",
      trigger: function() {
        var btnEl = $('.maptype_topItemInactive');
        var ctrl = $('#map_change_ctrl');
        if(ctrl.css('display') == "block") {
          ctrl.hide();
          return;
        }

        var left = btnEl.position().left + 45;
        var top = btnEl.position().top + 45;
        ctrl.show();
        ctrl.css({
          left: left,
          top: top
        });
      }
    });
  }

  // Get All controls array
  this.getControls = function() {
    var controls = [];
    for(var control_name in this.controls) {
      controls.push(this.controls[control_name]);
    }
    return controls;
  }

  // Deactivate all controls
  this.activate = function(caller) {
    for(var name in this.controls) {
      if(caller != name) this.controls[name].deactivate();
    }
  }

  this.init();

}