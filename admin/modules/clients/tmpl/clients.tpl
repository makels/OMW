<div class="products module">
    <div class="module-title gradient">Клиенты</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/clients" method="post">
            <input type="hidden" name="action" id="form_action" value="save">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');">{fa_icon name="user-plus"}Добавить клиента</button>
                <button type="submit" onclick="$('#form_action').val('delete');">{fa_icon name="user-times"}Удалить клиента</button>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Баланс</th>
                <th>Баллы</th>
                </thead>
                <tbody>
                {foreach from=$clients item=client}
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_client_checkbox" type="checkbox" name="clients[{$client.id}]" /></td>
                        <td><a href="/admin/clients/edit?id={$client.id}">{$client.name}</a></td>
                        <td class="cell_center">{$client.email}</td>
                        <td class="cell_center">{$client.phone}</td>
                        <td class="cell_center">{$client.rest}</td>
                        <td class="cell_center">{$client.ball}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </form>
    </div>
</div>