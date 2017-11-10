{* PROJ4JS *}
<script type="text/javascript" src="/modules/map/libs/proj4js/proj4js.js"></script>
<script type="text/javascript" src="/modules/map/libs/proj4js/defs/EquidistantConic_Ukraine.js"></script>
<script type="text/javascript" src="/modules/map/libs/proj4js/defs/EPSG900913.js"></script>
<script type="text/javascript" src="/modules/map/libs/proj4js/defs/EPSG27200.js"></script>
<script type="text/javascript" src="/modules/map/libs/proj4js/defs/My_proj.js"></script>

{* OPENLAYERS *}
<script type="text/javascript" src="/modules/map/libs/openlayers/OpenLayers.js"></script>

{* MAP MODULE *}
<link rel="stylesheet" href="/modules/map/css/mapcontrolpanel.css" />

<script type="text/javascript" src="/modules/map/js/mapcontrolpanel.js"></script>
<script type="text/javascript" src="/modules/map/js/mapprovider.js"></script>
<script type="text/javascript" src="/modules/map/js/mapeventshandler.js"></script>
<script type="text/javascript" src="/modules/map/js/map.js"></script>

<div class="module map-module">
  {*<div class="module-title gradient"></div>*}
  <div class="module-wrapper">
    <div id="map-loading">{fa_icon name="clock-o"}Зачекайте</div>
    <div style="width:100%;" id="op-map"></div>

    <div id="map_change_ctrl" style="display: none;">
      <ul>
      </ul>
    </div>
  </div>
</div>