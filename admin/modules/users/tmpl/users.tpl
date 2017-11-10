<div class="users module">
  <div class="module-title gradient">Пользователи</div>
  <div class="module-wrapper">
    {if !$user->has_permission("users")}
      У Вас недостаточно прав для работы с данным режимом
    {else}
      <form id="users_delete_form" action="/admin/users/delete" method="post">
      <table cellpadding="0" cellspacing="0">
        <thead>
          <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
          <th>Логин</th>
          <th>Имя</th>
          <th>E-mail</th>
          <th>Администратор</th>
        </thead>
        <tbody>
        {foreach from=$users item=user}
          <tr>
            <td><input class="delete_user_checkbox" type="checkbox" name="user[{$user.id}]" /></td>
            <td><a href="/admin/users/edit?id={$user.id}">{$user.name}</a></td>
            <td>{$user.display_name}</td>
            <td>{$user.email}</td>
            <td>{if $user.su==1}Да{else}Нет{/if}</td>
          </tr>
        {/foreach}
        </tbody>
      </table>

      <div class="buttons-wrapper">
        <a class="btn" href="/admin/users/add">{fa_icon name="user-plus"}Создать пользователя</a>
        <a class="btn" href="#" onclick="{literal}if($('.delete_user_checkbox:checked').length > 0) { app.deleteUsers(); } return false;{/literal}">{fa_icon name="user-times"}Удалить пользователя</a>
      </div>
    {/if}
  </div>
</div>