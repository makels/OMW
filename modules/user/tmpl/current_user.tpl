<div class="current-user">
    {if $is_logged}
        <a href="{"/cabinet"|url}">
            <div class="avatar">
                {if $user->avatar != ""}
                    <div class="header_avatar" style="background-image: url('/storage/{$user->id}/images/{$user->avatar}');">&nbsp;</div>
                {else}
                    <div class="header_avatar" style="background-image: url('/themes/{$smarty.const.THEME_NAME}/images/no-avatar.png')">&nbsp;</div>
                {/if}
            </div>
        </a>
        <a href="{"/cabinet/?page=profile"|url}">{$user->display_name}</a>&nbsp;&nbsp;
        <a href="{"/logout"|url}">{fa_icon name="sign-out"}&nbsp;{"Выход"|lang}</a>
    {else}
        {fa_icon name="sign-in"}
        <a href="{"/login"|url}">{"Войти"|lang}</a>&nbsp;&nbsp;
        {fa_icon name="user"}
        <a href="{"/registration"|url}">{"Регистрация"|lang}</a>
    {/if}
</div>