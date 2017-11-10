<script type="text/javascript" src="/modules/choice/js/choice_handler.js"></script>

<div class="menu module">
  <div class="module-title gradient closed">Вибір карти<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <select id="choice_map_type_id" onchange="ChoiceModuleHandler.changeMap();">
        <option selected value="map">Карта</option>
        <option value="kosmo">Космознімок</option>
        <option value="topo">Топокарта</option>
        <option value="vector-topo">Векторна топокарта</option>
      </select>
    </div>
  </div>
</div>