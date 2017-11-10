<div class="user_add module">
  <div class="module-title gradient">Создать группу</div>
  <div class="module-wrapper">
    {if !$user->has_permission("users")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
    <form id="group_add_form" action="/admin/user_groups/save" method="post" onsubmit="return app.checkAddGroup();">
      <div class="fields_group">Группа</div>
      <table>
        <tr>
          <td class="var_name">Название:</td>
          <td><input type="text" id="group_name" name=group[name]" /></td>
        </tr>
        <tr>
          <td class="var_name">Описание:</td>
          <td><textarea id="group_description" name=group[description]"></textarea></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
      </table>

      <div class="fields_group">Права группы</div>
      <table>
        {foreach from=$permissions item=permission}
        <tr>
          <td class="var_name">{$permission.name}</td>
          <td><input type="checkbox" name=permission[{$permission.id}]" /></td>
        </tr>
        {/foreach}
        <tr>
          <td colspan="2">
            <button onclick="document.location.href='/admin/user_groups'">{fa_icon name="arrow-circle-left"}Отмена</button>
            <button type="submit">{fa_icon name="save"}Сохранить</button>
          </td>
        </tr>
      </table>

    </form>
    {/if}
  </div>
</div>
