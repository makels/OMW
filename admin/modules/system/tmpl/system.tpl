<div class="system module">
  <div class="module-title gradient">Система</div>
  <div class="module-wrapper">
    {if !$user->has_permission("system")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
      <form action="/admin/modules/system/system/save" method="post">
        <div class="fields_group">Оформление</div>
        <table>
          <tr>
            <td class="var_name">Цвет:</td>
            <td class="admin-theme-color green"><input {if $view_color == "green"}checked{/if} type="radio" name="view[color]" value="green" />Зеленый</td>
            <td class="admin-theme-color blue"><input {if $view_color == "blue"}checked{/if} type="radio" name="view[color]" value="blue" />Синий</td>
            <td class="admin-theme-color black_white"><input {if $view_color == "bw"}checked{/if} type="radio" name="view[color]" value="bw" />Серый</td>
            <td class="admin-theme-color red"><input {if $view_color == "red"}checked{/if} type="radio" name="view[color]" value="red" />Красный</td>
            <td></td>
          </tr>
        </table>

        <div class="fields_group">Настройки базы данных</div>
        <table>
          <tr>
            <td class="var_name">Сервер базы данных:</td>
            <td><input type="text" name="database[host]" value="{$database_host}" /></td>
          </tr>
          <tr>
            <td class="var_name">Порт:</td>
            <td><input type="text" name="database[port]" value="{$database_port}" /></td>
          </tr>
          <tr>
            <td class="var_name">Название базы данных:</td>
            <td><input type="text" name="database[name]" value="{$database_name}" /></td>
          </tr>
          <tr>
            <td class="var_name">Пользователь базы данных:</td>
            <td><input type="text" name="database[user]" value="{$database_user}" /></td>
          </tr>
          <tr>
            <td class="var_name">Пароль:</td>
            <td><input type="password" name="database[pass]" value="{$database_pass}" /></td>
          </tr>
          <tr>
            <td>Состояние:</td>
            <td>{if $database_error}<span class="err">Ошибка соединения</span>{else}<span class="success">Соединение установлено</span>{/if}</td>
          </tr>
          <tr>
            <td colspan="2">
              <button type="submit">{fa_icon name="save"}Сохранить</button>
            </td>
          </tr>
        </table>


      </form>
    {/if}
  </div>
</div>