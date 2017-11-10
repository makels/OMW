/**
 * Created by Zerg on 11.01.2016.
 */
var SearchHandler = {

  moduleLayers : {},

  init: function() {
    this.initModuleLayers();
    var $cmp = $("input.search_place");
    $cmp.change(function() {
      var val = $("input.search_place:checked").val();
      if(val === undefined) $(this).prop('checked', true);
    });
  },

  initModuleLayers: function() {
    this.moduleLayers.vector = new OpenLayers.Layer.Vector("searchVector");
    appMap.MapInstance.addLayer(this.moduleLayers.vector);
  },

  autoComplete : function(el, form_id) {
    var id = $(el).attr("id") + "_auto_complete";
    var val = $(el).val();
    if(val == "" || val.length < 3) {
      $("#" + id).remove();
      return;
    }
    var scope = this;
    var $form = $("#" + form_id);
    var url = $form.attr("action");
    var data = $form.serializeArray();
    $.ajax({
      url: url,
      dataType: 'json',
      data: data,
      type: "post",
      success: function(result) {
        scope.setAutoCompleteResult(el, result);
      }
    });
  },

  setAutoCompleteResult : function(el, result) {
    var scope = this;
    var id = $(el).attr("id") + "_auto_complete";
    $("#" + id).remove();
    if(result.length == 0) {
      return;
    }
    $('body').append("<select size='5' id='" + id + "' class='select_auto_complete'></select>");
    var selEl = $("#" + id);
    $.each(result, function(index, item) {
      $(selEl).append("<option value='" + item.id + "'>" + item.name + "</option>");
    });
    $(selEl).css({
      left: $(el).position().left,
      top: $(el).position().top + 28,
      width: $(el).width() + 13
    });
    $(selEl).change(function() {
      var v = $(this).find("option:selected").val();
      $(el).val($(this).find("option:selected").text());
      $(el).attr("a_val", v);
      $(this).remove();

      scope.autoCompleteCallback(v);
    });
    $(selEl).focusout(
      function() {
        $(this).remove();
      }
    );
  },

  autoCompleteCallback : function(id) {
    var mode = $('input.search_place:checked').val();
    switch(Number(mode)) {
      case 0:
        this.setRegionPoly(id);
        break;
      case 1:
        this.setAreaPoly(id);
        break;
      case 2:
        this.setCityPoly(id);
        break;
      case 3:
        this.setVillagePoly(id);
        break;
    }
  },

  clearLayer: function() {
    this.moduleLayers.vector.destroy();
    this.initModuleLayers();
  },

  hideLayer: function() {
    this.moduleLayers.vector.setVisibility(false);
  },

  showLayer: function() {
    this.moduleLayers.vector.setVisibility(true);
  },

  setRegionPoly : function(id) {
    var scope = this;
    this.clearLayer();
    $.ajax({
      url: 'modules/search/search/poly_region',
      type: 'post',
      dataType: 'json',
      data: { id : id },
      success: function(poly) {
        appMap.displayPoly(scope.moduleLayers.vector,  poly.points, 'EPSG:900913');
        appMap.displayBounds(
          new OpenLayers.Bounds(
            Number(poly.region.left_),
            Number(poly.region.bottom_),
            Number(poly.region.right_),
            Number(poly.region.top_)
          )
        );
      }
    });
  },

  setAreaPoly : function(id) {
    var scope = this;
    this.clearLayer();
    $.ajax({
      url: 'modules/search/search/poly_area',
      type: 'post',
      dataType: 'json',
      data: { id : id },
      success: function(poly) {
        appMap.displayPoly(scope.moduleLayers.vector, poly.points, 'EPSG:900913');
        appMap.displayBounds(new OpenLayers.Bounds(Number(poly.area.left_), Number(poly.area.bottom_), Number(poly.area.right_), Number(poly.area.top_)));
      }
    });
  },

  setCityPoly : function(id) {
    var scope = this;
    this.clearLayer();
    $.ajax({
      url: 'modules/search/search/poly_city',
      type: 'post',
      dataType: 'json',
      data: { id : id },
      success: function(cities) {
        $.each(cities, function(index, poly) {
          appMap.displayPoly(scope.moduleLayers.vector, poly.points, 'EPSG:4326');
            var x = Number(poly.city.X_coor);
            var y = Number(poly.city.Y_coor);
            var center = new OpenLayers.LonLat(x,y);
            center.transform('EPSG:4326', 'EPSG:900913');
            appMap.MapInstance.setCenter(center, 11);
          }
        );
      }
    });
  },

  setVillagePoly : function(id) {
    var scope = this;
    this.clearLayer();
    $.ajax({
      url: 'modules/search/search/poly_village',
      type: 'post',
      dataType: 'json',
      data: { id : id },
      success: function(poly) {
        appMap.displayPoly(scope.moduleLayers.vector, poly.points, 'EPSG:900913');
        appMap.displayBounds(new OpenLayers.Bounds(Number(poly.village.x), Number(poly.village.y), Number(poly.village.right), Number(poly.village.top)));
      }
    });
  }
}

$(function() {
  appMap.registerModule({
    title: "Адміністративний пошук",
    instance: SearchHandler
  });
});
