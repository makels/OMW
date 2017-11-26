<div class="profile module">
    <div class="module-title">{fa_icon name="reorder"}{"Профиль"|lang}</div>
    <div class="module-wrapper">
        <form method="post" enctype="multipart/form-data" id="avatar_form">
            <input type="hidden" name="action" value="avatar" />
            <input id="avatar" type="file" name="avatar" onchange="$('#avatar_form').submit();" style="display: none;" />
            <a href="#" onclick="$('#avatar').trigger('click');">
                {if $user->avatar != ""}
                    <div class="profile_avatar" style="background-image: url('/storage/{$user->id}/images/{$user->avatar}');">&nbsp;</div>
                {else}
                    <div class="profile_avatar" style="background-image: url('/themes/{$smarty.const.THEME_NAME}/images/no-avatar.png')">&nbsp;</div>
                {/if}
            </a>
        </form>
        <form method="post" id="profile_form">
            <input type="hidden" name="action" value="save" />
            <div class="fields-group">
                <div class="field">
                    <label>{"Фамилия"|lang}:</label><br>
                    <input autocomplete="off" type="text" name="first_name" value="{$user->first_name}">
                </div>
                <div class="field">
                    <label>{"Имя"|lang}:</label><br>
                    <input autocomplete="off" type="text" name="last_name" value="{$user->last_name}">
                </div>
                <div class="field">
                    <label>Email:</label><br>
                    <input autocomplete="off" type="email"  name="email" value="{$user->email}">
                </div>
                <div class="field">
                    <label>{"Пароль"|lang}:</label><br>
                    <input autocomplete="off" type="password"  name="password" value="">
                </div>
                <div class="field">
                    <div class="g-recaptcha" data-sitekey="{$smarty.const.RECAPTCHA_KEY}" id="recaptcha"></div>
                </div>
                <div class="field">
                    <button type="submit" class="btn" id="btn-register">{"Сохранить"|lang}</button>
                </div>
            </div>
        </form>
    </div>
</div>