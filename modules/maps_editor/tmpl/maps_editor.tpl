<script type="text/javascript" src="/modules/maps_editor/js/maps_editor.js"></script>

<div class="menu module">
  <div class="module-title closed gradient">Мої карти<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Оберіть власну карту</div>
      <select id="maps_editor_select">
        <option value="-1" selected>Немає</option>
        {foreach from=$maps item=map}
          <option value="{$map.id}">{$map.title}</option>
        {/foreach}
      </select>
      <div class="fields_group small">Прозорість</div>
      <input id="layer_map_opacity_id" onchange="LayersModuleHandler.changeOpacity();" type="range" min="0" max="100" step="1" value="100">
      <div class="fields_group small">Дії</div>
      <div class="button_map_editor_group">
        <ul>
          <li><img title="Додати фрагмент карти" src="/theme/images/icons/z_plus.png" onclick="mapsEditor.uploadBound();"></li>
          <li><img title="Видалити фрагмент карти" src="/theme/images/icons/z_minus.png" onclick="mapsEditor.removeMap();"></li>
          <!--li><img title="Завантажити фрагмент карти" src="/theme/images/icons/z_map_upload.png" onclick="mapsEditor.uploadBound();"></li>
          <li><img title="Видалити фрагмент карти" src="/theme/images/icons/z_map_remove.png" onclick="mapsEditor.removeBound();"></li-->
        </ul>
      </div>


      <!-- Upload map form -->
      <div class="upload_map_form" id="upload_map_form_id">
        <form enctype="multipart/form-data" id="bound_file_form" action="/modules/maps_editor/maps_editor/uploadMap" method="post" onsubmit="return mapsEditor.checkUploadForm();">
          <table>
            <tr><td colspan="2"><div id="upload_map_form_message"></div></td></tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Назва карти:</label></td>
              <td><input type="text" class="maps_editor_input_text" name="map_name" id="custom_map_name" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Нижній лівий кут (широта):</label></td>
              <td><input type="text" class="maps_editor_input_text" name="left_bound" id="left_bound_id" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Нижній лівий кут (довгота):</label></td>
              <td><input type="text" class="maps_editor_input_text" name="down_bound" id="down_bound_id" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Правий верхній кут (широта):</label></td>
              <td><input type="text" class="maps_editor_input_text" name="right_bound" id="right_bound_id" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Правий верхній кут (довгота):</label></td>
              <td><input type="text" class="maps_editor_input_text" name="top_bound" id="top_bound_id" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Фрагмент карти:</label></td>
              <td><input type="file" class="maps_editor_input_file" name="bound_file" id="bound_file_id" /></td>
            </tr>
          </table>
        </form>
      </div>  
    </div>
  </div>
</div>