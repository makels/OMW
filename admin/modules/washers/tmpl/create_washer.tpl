<script src="/admin/modules/washers/js/washers.js"></script>
<div class="product module">
    <div class="module-title gradient">Клиент</div>
    <div class="module-wrapper">
        {if !$user->has_permission("washers")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form method="post" action="/admin/washers"  enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="washer[lat]" id="place_lat" value="0"/>
                <input type="hidden" name="washer[lng]" id="place_lng" value="0"/>
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=washer[name]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Email:</td>
                        <td><input type="text" name=washer[email]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Пароль:</td>
                        <td><input type="password" name=washer[pass]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=washer[phone]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Адрес:</td>
                        <td><input id="washer_autocomplete" type="text" name=washer[address]" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="var_name"><input type="checkbox" name=washer[transport]" value="" />&nbsp;Транспорт</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" onclick="document.location.href='/admin/clients';return false;">{fa_icon name="arrow-circle-left"}Отмена</button>
                            <button type="submit">{fa_icon name="save"}Сохранить</button>
                        </td>
                    </tr>
                </table>
            </form>
        {/if}
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={$GOOGLE_KEY}&libraries=places&callback=washers.initAutocomplete"></script>
