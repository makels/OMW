<script src="/admin/modules/orders/js/orders.js"></script>

<div class="product module">
    <div class="module-title gradient">Заказ</div>
    <div class="module-wrapper">
        {if !$user->has_permission("orders")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form method="post" action="/admin/orders"  enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="order[lat]" id="place_lat" value="0"/>
                <input type="hidden" name="order[lng]" id="place_lng" value="0"/>
                <input type="hidden" name="order[date_time]" />
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=order[name]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Клиент:</td>
                        <td>
                            <select name="order[user_id]">
                                <option selected value="0">Не выбран</option>
                                {foreach from=$clients item="client"}
                                    <option value="{$client.id}">{$client.name} ({$client.email})</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Мойщик:</td>
                        <td>
                            <select name="order[washer_id]">
                                <option selected value="0">Не выбран</option>
                                {foreach from=$washers item="washer"}
                                    <option value="{$washer.id}">{$washer.name} ({$washer.email})</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Статус:</td>
                        <td>
                            <select name="order[status]">
                                <option selected value="0">Новый</option>
                                <option value="1">Принят</option>
                                <option value="2">В работе</option>
                                <option value="3">Завершен</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=order[phone]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Модель:</td>
                        <td>
                            <select name="order[model]">
                                <option selected value="0">Седан</option>
                                <option value="1">Джип</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер:</td>
                        <td><input type="text" name=order[number]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Адрес:</td>
                        <td><input id="order_autocomplete" type="text" name=order[address]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Услуга:</td>
                        <td>
                            <select name="order[service]">
                                <option selected value="0">Стандарт</option>
                                <option value="1">Премиум</option>
                                <option value="2">Полный</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">На время:</td>
                        <td><input type="text" id="order_date_id" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Фото:</td>
                        <td><input type="file" value="" name="photo"></td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер флаера:</td>
                        <td><input type="text" name=order[flyer_number]" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" onclick="document.location.href='/admin/orders?filter_status=-1';return false;">{fa_icon name="arrow-circle-left"}Отмена</button>
                            <button type="submit">{fa_icon name="save"}Сохранить</button>
                        </td>
                    </tr>
                </table>
            </form>
        {/if}
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={$GOOGLE_KEY}&libraries=places&callback=orders.initAutocomplete"></script>