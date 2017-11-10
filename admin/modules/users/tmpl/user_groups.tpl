<div class="users module">
  <div class="module-title gradient">Группы пользователей</div>
  <div class="module-wrapper">
    {if !$user->has_permission("users")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
    <form id="groups_delete_form" action="/admin/user_groups/delete" method="post">
      <table cellpadding="0" cellspacing="0">
        <thead>
        <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
        <th>Группа</th>
        <th>Описание</th>
        </thead>
        <tbody>
          {foreach from=$groups item=group}
            <tr>
              <td><input class="delete_group_checkbox" type="checkbox" name="group[{$group.id}]" /></td>
              <td><a href="/admin/user_groups/edit?id={$group.id}">{$group.name}</a></td>
              <td>{$group.description}</td>
            </tr>
          {/foreach}
        </tbody>
      </table>

      <div class="buttons-wrapper">
        <a class="btn" href="/admin/user_groups/add">{fa_icon name="user-plus"}Создать группу</a>
        <a class="btn" href="#" onclick="{literal}if($('.delete_group_checkbox:checked').length > 0) { app.deleteGroups(); } return false;{/literal}">{fa_icon name="user-times"}Удалить группу</a>
      </div>
    </form>
    {/if}
  </div>
</div>