/**
 * Created by Zerg on 11.01.2016.
 */
var mainMenuHandler = {

  openMenu : function() {
    var menuEl = $(".menu.module");
    var menuTab = $(".menu-tab");
    $(menuEl).show();
    $(menuTab).hide();
    appMap.updateSize();
  },

  closeMenu : function() {
    var menuEl = $(".menu.module");
    var menuTab = $(".menu-tab");
    $(menuTab).show();
    $(menuEl).hide();
    appMap.updateSize();
  }
}