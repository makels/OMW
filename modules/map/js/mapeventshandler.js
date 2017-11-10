/**
 * Created by Zerg on 24.12.2015.
 */
var MapEventsHandler = function(map) {

  this.Map = map;

  this.init = function() {
    this.initResizeMap();
    this.resizeMap();
    document.fullscreenchange = function() {
      debugger;
    };
  }

  this.initResizeMap = function() {
    var scope = this;
    $(window).resize(function() {
      scope.resizeMap();
    });
  }

  this.resizeMap = function() {
    var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
    var mapEl = $("#" + this.Map.mapElId);
    var wHeight = $(window).height();
    var topMap = $(mapEl).position().top;
    var height = wHeight - topMap;
    $("#map-loading").css({
      left: ($(mapEl).width() / 2) - 100,
      top: (height / 2) - 30
    });
    $(mapEl).height(height);

    if(fullscreenElement == null) {
      $(mapEl).removeClass("map_full_screen");
      this.Map.MapControlPanel.controls.fullscreen.deactivate();
    }
  }

  this.onFullScreen = function() {
    var elem = document.getElementById(this.Map.mapElId);
    var mapEl = $("#" + this.Map.mapElId);
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
      $(mapEl).addClass("map_full_screen");
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
      $(mapEl).addClass("map_full_screen");
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen();
      $(mapEl).addClass("map_full_screen");
    }
  }

  this.onNormalScreen = function() {
    var mapEl = $("#" + this.Map.mapElId);
    if(document.exitFullscreen) {
      document.exitFullscreen();
      $(mapEl).removeClass("map_full_screen");
    } else if(document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
      $(mapEl).removeClass("map_full_screen");
    } else if(document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
      $(mapEl).removeClass("map_full_screen");
    }
  }

}