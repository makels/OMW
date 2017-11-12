<div class="current-user">
    {if $is_logged}
    {else}
        {fa_icon name="sign-in"}
        <a href="/login">{"Войти"|lang}</a>&nbsp;&nbsp;
        {fa_icon name="user"}
        <a href="/registration">{"Зарегистрироваться"|lang}</a>
    {/if}
</div>