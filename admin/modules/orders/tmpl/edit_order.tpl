<script src="/admin/modules/orders/js/orders.js"></script>

<div class="product module">
    <div class="module-title gradient">Заказ</div>
    <div class="module-wrapper">
        {if !$user->has_permission("orders")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form method="post" action="/admin/orders"  enctype="multipart/form-data">
                <input type="hidden" name="action" id="form_action" value="save">
                <input type="hidden" name="order[id]" value="{$order.id}">
                <input type="hidden" name="order[lat]" id="place_lat" value="{$order.lat}"/>
                <input type="hidden" name="order[lng]" id="place_lng" value="{$order.lng}"/>
                <input type="hidden" name="order[date_time]" value="{$order.date_time}" />
                {if $order.photo != ""}
                    <b>Изображение:</b>
                    <input style="display:none;width: 200px;margin-left: 10px;margin-bottom: 10px;" name="exist_photo" value="{$order.photo}">
                    <div class="thumb-image">
                        <img src="/admin/uploads/{$order.photo}" />
                        <button style="float: none;margin-left: 10px;" onclick="$('#form_action').val('delete_image');"type="submit">{fa_icon name="delete"}Удалить</button>
                    </div>
                {/if}
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=order[name]" value="{$order.name}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Клиент:</td>
                        <td>
                            <select name="order[user_id]">
                                <option {if $order.user_id == 0}selected{/if} value="0">Не выбран</option>
                                {foreach from=$clients item="client"}
                                    <option {if $order.user_id == $client.id}selected{/if} value="{$client.id}">{$client.name} ({$client.email})</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Мойщик:</td>
                        <td>
                            <select name="order[washer_id]">
                                <option {if $order.washer_id == 0}selected{/if} value="0">Не выбран</option>
                                {foreach from=$washers item="washer"}
                                    <option {if $order.washer_id == $washer.id}selected{/if} value="{$washer.id}">{$washer.name} ({$washer.email})</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Статус:</td>
                        <td>
                            <select name="order[status]">
                                <option {if $order.status == 0}selected{/if} value="0">Новый</option>
                                <option {if $order.status == 1}selected{/if} value="1">Принят</option>
                                <option {if $order.status == 2}selected{/if} value="2">В работе</option>
                                <option {if $order.status == 3}selected{/if} value="3">Завершен</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=order[phone]" value="{$order.phone}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Модель:</td>
                        <td>
                            <select name="order[model]">
                                <option {if $order.model == 0}selected{/if} value="0">Седан</option>
                                <option {if $order.model == 1}selected{/if} value="1">Джип</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер:</td>
                        <td><input type="text" name=order[number]" value="{$order.number}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Адрес:</td>
                        <td><input id="order_autocomplete" type="text" name=order[address]" value="{$order.address}" /><button style="float: none;margin-left: 10px;" onclick="modalMap.open({$order.id}, {$order.lat}, {$order.lng});return false;">Показать на карте</button></td>
                    </tr>
                    <tr>
                        <td class="var_name">Услуга:</td>
                        <td>
                            <select name="order[service]">
                                <option {if $order.service == 0}selected{/if} value="0">Стандарт</option>
                                <option {if $order.service == 1}selected{/if} value="1">Премиум</option>
                                <option {if $order.service == 2}selected{/if} value="2">Полный</option>
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
                        <td><input type="text" name=order[flyer_number]" value="{$order.flyer_number}" /></td>
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