<script type="text/javascript" src="/modules/search/js/search_handler.js"></script>

<div class="menu module">
  <div class="module-title closed gradient">Адміністративний пошук<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <form method="post" action="/modules/search/search/auto_complete" id="map_search_form" onsubmit="return false;">
      <div class="fields_group small">Пошук</div>
      <table>
        <tr>
          <td colspan="2">
            <input type="text" name="search_str" id="map_search_input" class="auto_complete" onkeyup="SearchHandler.autoComplete(this, 'map_search_form');" autocomplete="off" placeholder="Введіть фрагмент назви" />
          </td>
        </tr>
        <tr>
          <td colspan="2"><label for="search_regions"><input type="checkbox" class="search_place" checked name="search_place" value="0" id="search_regions" />Області</label></td>
        </tr>
        <tr>
          <td colspan="2"><label for="search_rajon"><input type="checkbox" class="search_place" name="search_place" value="1" id="search_rajon" />Райони</label></td>
        </tr>
        <tr>
          <td colspan="2"><label for="search_city"><input type="checkbox" class="search_place" name="search_place" value="2" id="search_city" />Міста</label></td>
        </tr>
        <tr>
          <td colspan="2"><label for="search_village"><input type="checkbox" class="search_place" name="search_place" value="3" id="search_village" />Сільради</label></td>
        </tr>
      </table>

      <div class="fields_group small">Області</div>
      <a href="#" class="fields_group small" onclick="$('.filter-regions').prop('checked', true);return false;">Виділити всі</a>
      &nbsp;/&nbsp;
      <a href="#" class="fields_group small" onclick="$('.filter-regions').prop('checked', false);return false;">Зняти всі</a>
      <div class="search_filter_wrapper">
        <table class="search_filter">
          {foreach from=$regions item=region}
            <tr>
              <td>
                <label for="region_{$region.CODEOBJ}"><input type="checkbox" checked class="filter-regions" name="regions[{$region.CODEOBJ}]" id="region_{$region.CODEOBJ}" />{$region.TITLE_U}</label>
              </td>
            </tr>
          {/foreach}

        </table>
      </div>
    </form>
    </div>
  </div>
</div>