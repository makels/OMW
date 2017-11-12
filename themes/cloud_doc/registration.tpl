<!DOCTYPE html>
<html class="no-js" lang="ru">
    <head>
        {include file="head.tpl"}
        <script src='https://www.google.com/recaptcha/api.js?hl={$lang_prefix}' async defer></script>
    </head>
    <body class="page">
        {* HEADER *}
        {include file="header.tpl"}

        {* INDEX *}
        <section class="main-content">
            <div class="register-form">
                <h1>{"Регистрация"|lang}</h1>
                {if count($errors) > 0}
                <div class="errors-wrapper">
                    {foreach from = $errors item = "error"}
                        <p>{$error}</p>
                    {/foreach}
                </div>
                {/if}
                <form method="post">
                    <input type="hidden" name="action" value="registration" />
                    <div class="fields-group">
                        <div class="field">
                            <label>{"Фамилия"|lang}:</label><br>
                            <input autocomplete="off" type="text" name="first_name" value="{$first_name}">
                        </div>
                        <div class="field">
                            <label>{"Имя"|lang}:</label><br>
                            <input autocomplete="off" type="text" name="last_name" value="{$last_name}">
                        </div>
                        <div class="field">
                            <label>Email:</label><br>
                            <input autocomplete="off" type="email"  name="email" value="{$email}">
                        </div>
                        <div class="field">
                            <label>{"Пароль"|lang}:</label><br>
                            <input autocomplete="off" type="password"  name="password" value="">
                        </div>
                        <div class="g-recaptcha" data-sitekey="{$smarty.const.RECAPTCHA_KEY}" id="recaptcha"></div>
                        <div class="field">
                            <button type="submit" class="btn" id="btn-register">{"Регистрация"|lang}</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        {* END OF INDEX*}

        {include file="footer.tpl"}

    </body>
</html>