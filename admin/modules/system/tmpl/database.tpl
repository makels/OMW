<div class="system module">
  <div class="module-title gradient">Оновлення бази даних</div>
  <div class="module-wrapper">
    <div class="fields_group">Версія бази: {$current_version}</div>
    <div class="fields_group">Доступні оновлення</div>
    {if $version_info.version }
      <form method="POST" action="/admin/database/version_update">
      <table>
        <tr>
          <td class="var_name">Оновлення:</td>
          <td>Версія: <b>{$version_info.version}</b><br>Деталі: <b>{$version_info.description}</b></td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit">{fa_icon name="check"}Встановити</button>
          </td>
        </tr>
      </table>
        <input type="hidden" name="update_file" value="{$version_info.file}" />
      </form>
    {else}
      Немає доступних оновлень
    {/if}
  </div>
</div>