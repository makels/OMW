<script type="text/javascript" src="/modules/editor/js/editor_handler.js"></script>

<div class="menu module editor">
  <div class="module-title gradient closed">Редактор<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div id="editor_module_content" class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Вибір шару</div>
      <select id="editor_layers">
        <option value="map">Карта</option>
        {foreach from=$layers item="layer"}
          <option value="{$layer.id}">{$layer.title}</option>
        {/foreach}
      </select>

      <div id="editor_add_map" class="fields_group small">Додати фрагмент карти</div>
      <div id="editor_add_line" style="display: none;" class="fields_group small">Додати лінію</div>
      <div id="editor_add_marker" style="display: none;" class="fields_group small">Додати маркер</div>
      <div id="editor_add_poly" style="display: none;" class="fields_group small">Додати фігуру</div>
      <div id="editor_color_palette" class="color_group" style="display: none;">
        <ul>
          <li><div title="Додати" class="color_box wrapper" color="#9b0c00"><div class="color_box red">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper" color="#00008B"><div class="color_box blue">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper" color="#1b911f"><div class="color_box green">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper" color="#9B410E"><div class="color_box yellow">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper" color="#000000"><div class="color_box black">&nbsp;</div></div></li>
        </ul>
      </div>

      <div id="editor_marker_palette" class="color_group" style="display: none;">
        <ul>
          <li><div title="Додати" class="color_box wrapper"><div class="color_box red">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper"><div class="color_box blue">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper"><div class="color_box green">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper"><div class="color_box yellow">&nbsp;</div></div></li>
          <li><div title="Додати" class="color_box wrapper"><div class="color_box black">&nbsp;</div></div></li>
        </ul>
      </div>

      <div id="editor_actions_map_buttons" class="button_container">
        <button>{fa_icon name="map-o"}Файл</button>
        <button onclick="app.beginInfo();">{fa_icon name="info-circle"}Інструкція</button>
      </div>

      <div id="editor_actions_line_buttons" style="display: none;" class="button_container">
        <button>Зберегти</button>
        <button>Видалити</button>
      </div>

      <div id="editor_actions_marker_buttons" style="display: none;" class="button_container">
        <button>Зберегти</button>
        <button>Видалити</button>
      </div>

      <div id="editor_actions_poly_buttons" style="display: none;" class="button_container">
        <button>Зберегти</button>
        <button>Видалити</button>
      </div>


    </div>
  </div>
</div>