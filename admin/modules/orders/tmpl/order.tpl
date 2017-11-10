<div class="product module">
    <div class="module-title gradient">Заказ</div>
    <div class="module-wrapper">
        {if !$user->has_permission("orders")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form method="post">
                <input type="hidden" name="order[id]" value="{$order.order_id}" />
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=order[name]" value="{$order.name}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=order[phone]" value="{$order.phone}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Модель:</td>
                        <td><input type="text" name=order[model]" value="{$order.model}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Номер:</td>
                        <td><input type="text" name=order[number]" value="{$order.number}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Адрес:</td>
                        <td><input type="text" name=order[address]" value="{$order.address}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Местоположение:</td>
                        <td><input type="text" name=order[place]" value="{$order.place}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Сервис:</td>
                        <td><input type="text" name=order[service]" value="{$order.service}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">На время:</td>
                        <td><input type="text" name=order[date_time]" value="{$order.date_time}" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button onclick="document.location.href='/admin/orders'">{fa_icon name="arrow-circle-left"}Отмена</button>
                            <button type="submit">{fa_icon name="save"}Сохранить</button>
                        </td>
                    </tr>
                </table>
            </form>
        {/if}
    </div>
</div>