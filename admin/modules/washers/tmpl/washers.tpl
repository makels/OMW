<script>
    var WashersList = JSON.parse('{$washers_json}');
</script>

<div class="products module">
    <div class="module-title gradient">Мойщики</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/washers" method="post">
            <input type="hidden" name="action" id="form_action" value="save">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');">{fa_icon name="user-plus"}Добавить мойщика</button>
                <button type="submit" onclick="$('#form_action').val('delete');">{fa_icon name="user-times"}Удалить мойщика</button>
                <button type="button" onclick="modalMap.openWashers(WashersList);return false;">{fa_icon name="map"}Показать на карте</button>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Транспорт</th>
                </thead>
                <tbody>
                {foreach from=$washers item=washer}
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_client_checkbox" type="checkbox" name="washers[{$washer.id}]" /></td>
                        <td><a href="/admin/washers/edit?id={$washer.id}">{$washer.name}</a></td>
                        <td class="cell_center">{$washer.email}</td>
                        <td class="cell_center">{$washer.phone}</td>
                        <td class="cell_center">{$washer.address}</td>
                        <td class="cell_center">{if $washer.transport == 1}Есть{else}Нет{/if}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={$GOOGLE_KEY}&libraries=places"></script>