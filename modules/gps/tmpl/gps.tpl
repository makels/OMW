<script type="text/javascript" src="/modules/gps/js/gps_handler.js"></script>

{literal}
  <style>

    .module.gps-module .buttons {
      height: 35px;
    }

    .module.gps-module input[name=gps_view] {
      width: 25px;
    }

    .module.gps-module .track_list {
      width: 100%;
      height: 100px;
      border: 1px solid #D7D7D7;
    }

  </style>
{/literal}


<div class="menu module gps-module">
  <div class="module-title gradient closed">GPS моніторинг<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Пристрій</div>
      <select>
        <option>Немає</option>
        <option>Пристрій №1</option>
        <option>Пристрій №2</option>
        <option>Пристрій №3</option>
      </select>
      <div class="fields_group small">Відображення</div>
      <table>
        <tr>
          <td><input type="radio" selected name="gps_view" />Точка</td>
          <td><input type="radio" name="gps_view" />Лінія</td>
        </tr>
      </table>
      <div class="fields_group small">Треки</div>
      <div class="track_list">

      </div>
      <div class="fields_group small">Дії</div>
      <div class="buttons">
        <button>Додати зону</button>
        <button>Зберегти</button>
      </div>
    </div>
  </div>
</div>