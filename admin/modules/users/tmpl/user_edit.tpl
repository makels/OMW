<div class="user_edit module">
  <div class="module-title gradient">Редактирование пользователя</div>
  <div class="module-wrapper">
    {if !$user->has_permission("users")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
    <form id="user_edit_form" action="/admin/users/update" method="post" onsubmit="return app.checkEditUser();">
      <div class="fields_group">Пользователь</div>
      <table>
        <tr>
          <td class="var_name">Логин:</td>
          <td><input type="text" id="user_name" name=user[name]" value="{$user_data.name}" /></td>
        </tr>
        <tr>
          <td class="var_name">Имя:</td>
          <td><input type="text" id="display_name" name=user[display_name]" value="{$user_data.display_name}" /></td>
        </tr>
        <tr>
          <td class="var_name">Email:</td>
          <td><input type="text" id="user_email" name=user[email]" value="{$user_data.email}"/></td>
        </tr>
        <tr>
          <td class="var_name">Пароль:</td>
          <td><input type="password" id="user_pass" name=user[pass]" value=""/></td>
        </tr>
        <tr>
          <td class="var_name">Подтверждение пароля:</td>
          <td><input type="password" id="user_pass_confirm" name=user[pass_confirm]" value="" /></td>
        </tr>
        <tr>
          <td class="var_name">Администратор:</td>
          <td><input type="checkbox" name=user[is_admin]" {if $user_data.is_admin == 1} checked {/if} /></td>
        </tr>
      </table>
      <div class="fields_group">Группы пользователей</div>
      <table>
        {foreach from=$user_groups item=group}
          <tr>
            <td class="var_name">{$group.name}</td>
            <td><input type="checkbox" {if $group.enabled == 1} checked {/if} name="groups[{$group.id}]" /></td>
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
      <input type="hidden" name="user_id" value="{$user_id}" />

    </form>
    {/if}
  </div>
</div>