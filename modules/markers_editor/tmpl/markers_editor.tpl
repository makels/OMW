<script type="text/javascript" src="/modules/markers_editor/js/markers_editor.js"></script>

<div class="menu module">
  <div class="module-title closed gradient">Мої маркери<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Оберіть власні маркери</div>
      <select id="markers_editor_select">
        <option value="-1" selected>Немає</option>
        {foreach from=$markers_layers item=markers_layer}
          <option value="{$markers_layer.id}">{$markers_layer.title}</option>
        {/foreach}
      </select>

      <div class="fields_group small">Дії</div>
      <div class="button_map_editor_group">
        <ul>
          <li><img title="Додати новий шар маркерів" src="/theme/images/icons/z_plus.png" onclick="markersEditor.addMarkersLayer();"></li>
          <li><img title="Видалити шар маркерів" src="/theme/images/icons/z_minus.png" onclick="markersEditor.removeMarkersLayer();"></li>
          <li><img title="Додати маркер" src="/theme/images/icons/pushed-pin-md.png" onclick="markersEditor.addMarker();"></li>
        </ul>
      </div>

      <!-- Marker form -->
      <div class="upload_map_form" id="add_marker_form_id">
        <form enctype="multipart/form-data" id="marker_add_form" action="/modules/markers_editor/markers_editor/addMarker" method="post" onsubmit="return markersEditor.checkUploadForm();">
          <input type="hidden" name="layer_id" id="marker_layer_id" />
          <input type="hidden" name="add_marker_x" id="add_marker_x" />
          <input type="hidden" name="add_marker_y" id="add_marker_y" />
          <table>
            <tr><td colspan="2"><div id="upload_map_form_message"></div></td></tr>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Заголовок:</label></td>
              <td style="text-align: left;"><input type="text" class="maps_editor_input_text" name="marker_title" id="marker_title_id" /></td>
            </tr>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Тип маркеру:</label></td>
              <td style="text-align: left;">
                <select name="marker_type">
                  {foreach from=$markers_types item=markers_type}
                    <option {if $markers_type.s_name == "UNDEF"} selected {/if} value="{$markers_type.s_name}">{$markers_type.name}</option>
                  {/foreach}
                </select>
              </td>
            </tr>

            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Текст:</label></td>
              <td style="text-align: left;"><textarea name="add_marker_text"></textarea></td>
            </tr>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Прикріпити файл:</label></td>
              <td style="text-align: left;"><input type="file" class="maps_editor_input_file" name="marker_file" id="bound_file_id" /></td>
            </tr>
          </table>
        </form>
      </div>

      <!-- Open marker form -->
      <div class="upload_map_form" id="marker_form_id">
        <div id="marker_form">
          <table>
            <tr><td colspan="2"><div id="upload_map_form_message"></div></td></tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Заголовок:</label></td>
              <td><span id="marker_title_zid" ></span></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Тип маркеру:</label></td>
              <td>
                <select disabled="disabled" name="marker_type" id="marker_type_id">
                  {foreach from=$markers_types item=markers_type}
                    <option value="{$markers_type.s_name}">{$markers_type.name}</option>
                  {/foreach}
                </select>
              </td>
            </tr>

            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Текст:</label></td>
              <td><textarea readonly id="marker_text_id" name="marker_text"></textarea></td>
            </tr>
            <tr>
              <td colspan="2"><div id="marker_file"></div></td>
            </tr>
          </table>
        </div>
      </div>


    </div>
  </div>
</div>