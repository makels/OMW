<div class="user_add module">
  <div class="module-title gradient">Создать пользователя</div>
  <div class="module-wrapper">
    {if !$user->has_permission("users")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
    <form id="user_add_form" action="/admin/users/save" method="post" onsubmit="return app.checkAddUser();">
      <div class="fields_group">Пользователь</div>
      <table>
        <tr>
          <td class="var_name">Логин:</td>
          <td><input type="text" id="user_name" name=user[name]" /></td>
        </tr>
        <tr>
          <td class="var_name">Имя:</td>
          <td><input type="text" id="display_name" name=user[display_name]" /></td>
        </tr>
        <tr>
          <td class="var_name">Email:</td>
          <td><input type="text" id="user_email" name=user[email]" /></td>
        </tr>
        <tr>
          <td class="var_name">Пароль:</td>
          <td><input type="password" id="user_pass" name=user[pass]" /></td>
        </tr>
        <tr>
          <td class="var_name">Подтверждение пароля:</td>
          <td><input type="password" id="user_pass_confirm" name=user[pass_confirm]" /></td>
        </tr>
        <tr>
          <td class="var_name">Администратор:</td>
          <td><input type="checkbox" name=user[is_admin]" /></td>
        </tr>
      </table>
      <div class="fields_group">Группы пользователей</div>
      <table>
        {foreach from=$user_groups item=group}
        <tr>
          <td class="var_name">{$group.name}</td>
          <td><input type="checkbox" name="groups[{$group.id}]" /></td>
        </tr>
        {/foreach}
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td colspan="2">
            <button onclick="document.location.href='/admin/users'">{fa_icon name="arrow-circle-left"}Отмена</button>
            <button type="submit">{fa_icon name="save"}Сохранить</button>
          </td>
        </tr>
      </table>
    </form>
    {/if}
  </div>
</div>