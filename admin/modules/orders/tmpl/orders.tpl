{literal}
    <style>
        .orders_list .cell_center{
            text-align: center;
        }
    </style>
{/literal}
<script>
    var OrdersList = JSON.parse('{$orders_json}');
</script>
<div class="products module">
    <div class="module-title gradient">Заказы</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/orders/" method="post">
            <input type="hidden" name="action" id="form_action" value="">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');">{fa_icon name="user-plus"}Создать заказ</button>
                <button type="submit" onclick="$('#form_action').val('delete');">{fa_icon name="user-times"}Удалить заказ</button>
                <button type="button" onclick="modalMap.openOrders(OrdersList);return false;">{fa_icon name="map"}Показать на карте</button>
            </div>
            <div class="filter-wrapper">
                <label>Статус:&nbsp;</label>
                <select name="filter_status" onchange="document.location.href = '/admin/orders/?filter_status=' + $(this).val();">
                    <option {if $filter_status == -1}selected{/if} value="-1">Все</option>
                    <option {if $filter_status == 0}selected{/if} value="0">Новый</option>
                    <option {if $filter_status == 1}selected{/if} value="1">Принятый</option>
                    <option {if $filter_status == 2}selected{/if} value="2">В работе</option>
                    <option {if $filter_status == 3}selected{/if} value="3">Завершен</option>
                </select>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
                <th>Телефон</th>
                <th>Услуга</th>
                <th>Модель</th>
                <th>Номер</th>
                <th>Адрес</th>
                <th>Время</th>
                <th>Создана</th>
                </thead>
                <tbody>
                {foreach from=$orders item=order}
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_order_checkbox" type="checkbox" name="order[{$order.id}]" /></td>
                        <td><a href="/admin/orders/edit?id={$order.id}">{$order.name}</a></td>
                        <td><a href="/admin/orders/edit?id={$order.id}">{if $order.client}{$order.client.email}{/if}</a></td>
                        <td class="cell_center">
                            {if $order.status == 0}
                                <span style="color:red;">Новый</span>
                            {elseif $order.status == 1}
                                <span style="color:dodgerblue;">Принят</span>
                            {elseif $order.status == 2}
                                <span style="color:#1e5799;">В работе</span>
                            {elseif $order.status == 3}
                                <span style="color:green;">Завершен</span>
                            {/if}
                        </td>
                        <td class="cell_center">{$order.phone}</td>
                        <td class="cell_center">{if $order.service == 0}Стандарт{elseif $order.service == 1}Премиум{elseif $order.service == 2}Полный{/if}</td>
                        <td class="cell_center">{if $order.model == 0}Седан{else}Джип{/if}</td>
                        <td class="cell_center">{$order.number}</td>
                        <td class="cell_center">{$order.address}</td>
                        <td class="cell_center">{$order.date_time|date_format:"%d.%m.%y %H:%M"}</td>
                        <td class="cell_center">{$order.create_order|date_format:"%d.%m.%y %H:%M"}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={$GOOGLE_KEY}&libraries=places"></script>