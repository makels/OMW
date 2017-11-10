<script type="text/javascript" src="/modules/events/js/events_handler.js"></script>
<script type="text/javascript" src="/modules/events/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/modules/events/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="/modules/events/js/timepicker-addon.js"></script>
<script type="text/javascript" src="/modules/events/js/datepicker-uk.js"></script>
<link rel="stylesheet" type="text/css" href="/modules/events/css/jquery-ui-1.10.4.custom.min.css" />

<style type="text/css">
  {literal}
    #ui-timepicker-div dl { text-align: left; }
    .ui_tpicker_hour_label, .ui_tpicker_minute_label { line-height: 25px !important; }
    #ui-timepicker-div dl dt { height: 25px; }
    #ui-timepicker-div dl dd { margin: -25px 0 10px 65px; }
    #ui-datepicker-div { z-index: 9999 !important; font-size: 12px !important;}
    .ui_tpicker_unit_hide { display: none; }
    .ui-datepicker-current { opacity: 1 !important; }
    .ui_tpicker_time_input { width: 50px !important; }
  {/literal}
</style>

<div class="menu module">
  <div class="module-title gradient closed">Реєстрація подій<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Вибір періоду</div>
      <div class="events_period_wrapper">
        <label for="events_period_start">Початок періоду</label>
        <input id="events_period_start"/>
        <label for="events_period_start">Кінець періоду</label>
        <input id="events_period_end" />
      </div>

      <div class="fields_group small">Дії</div>
      <div class="button_map_editor_group">
        <button onclick="eventsEditor.showEvents();">Показати</button>
        <button onclick="eventsEditor.addEvent();">Додати подію</button>
      </div>

      <!-- Event form -->
      <div class="upload_map_form" id="add_event_form_id">
        <form enctype="multipart/form-data" id="event_add_form" action="/modules/events/events/addEvent" method="post" onsubmit="return eventsEditor.checkUploadForm();">
          <input type="hidden" name="add_event_x" id="add_event_x" />
          <input type="hidden" name="add_event_y" id="add_event_y" />
          <table>
            <tr><td colspan="2"><div id="add_event_form_message"></div></td></tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="event_title">Заголовок:</label></td>
              <td><input type="text" class="maps_editor_input_text" name="event_title" id="event_title_id" /></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Дата:</label></td>
              <td><input type="text" class="maps_editor_input_text" name="event_date" id="event_date_id"  placeholder="дд.мм.рррр"/></td>
            </tr>

            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Текст:</label></td>
              <td><textarea name="add_event_text"></textarea></td>
            </tr>
            <tr>
              <td><label class="upload_bounds_maps_class" for="left_bound_id">Прикріпити файл:</label></td>
              <td><input type="file" class="maps_editor_input_file" name="event_file" id="bound_file_id" /></td>
            </tr>
          </table>
        </form>
      </div>

      <!-- Open event form -->
      <div class="upload_map_form" id="event_form_id">
        <div id="event_form">
          <table>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Заголовок:</label></td>
              <td style="text-align: left;"><span id="event_title_zid" ></span></td>
            </tr>
            <tr>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Дата:</label></td>
              <td style="text-align: left;"><div id="event_date">&nbsp;</div></td>
            </tr>
            <tr>
              <td style="text-align: left;"><label class="upload_bounds_maps_class" for="left_bound_id">Текст:</label></td>
              <td style="text-align: left;"><textarea readonly id="event_text_id" name="marker_text"></textarea></td>
            </tr>
            <tr>
              <td style="text-align: left;" colspan="2"><div id="event_file"></div></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>