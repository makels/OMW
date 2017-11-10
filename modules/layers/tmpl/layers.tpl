<script type="text/javascript" src="/modules/layers/js/layers_handler.js"></script>

<div class="menu module">
  <div class="module-title gradient closed">Синтезоване зображення<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Вибір карти</div>
      <select id="layer_map_type_id" onchange="LayersModuleHandler.changeLayer();">
        <option selected value="none">Нема карти</option>
        <option value="map">Карта</option>
        <option value="kosmo">Космознімок</option>
        <option value="topo">Топокарта</option>
        <option value="vector-topo">Векторна топокарта</option>
      </select>
      <div class="fields_group small">Прозорість</div>
      <input id="sintez_map_opacity_id" onchange="LayersModuleHandler.changeOpacity();" type="range" min="0" max="100" step="1" value="100">
    </div>
  </div>
</div>