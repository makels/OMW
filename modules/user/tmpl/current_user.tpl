<div class="current-user">
    {if $is_logged}
    {else}
        {fa_icon name="sign-in"}
        <a href="{"/login"|url}">{"Войти"|lang}</a>&nbsp;&nbsp;
        {fa_icon name="user"}
        <a href="{"/registration"|url}">{"Регистрация"|lang}</a>
    {/if}
</div>