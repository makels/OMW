<div class="product module">
    <div class="module-title gradient">Клиент</div>
    <div class="module-wrapper">
        {if !$user->has_permission("clients")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <div class="client-info-wrapper">
                <span>Количество моек в этом месяце: <b>{$client.current_wash_count}</b></span><br>
                <span>Всего моек: <b>{$client.wash_count}</b></span><br>
                {if $client.current_wash_count >= 4}
                    <span class="free-wash">Доступна бесплатная мойка в этом месяце.</span>
                {/if}
            </div>
            <form method="post" action="/admin/clients"  enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="client[id]" value="{$client.id}"/>
                <table>
                    <tr>
                        <td class="var_name">Имя:</td>
                        <td><input type="text" name=client[name]" value="{$client.name}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Email:</td>
                        <td><input type="text" name=client[email]" value="{$client.email}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Пароль:</td>
                        <td><input type="password" name=client[pass]" value="" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Телефон:</td>
                        <td><input type="text" name=client[phone]" value="{$client.phone}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Баланс:</td>
                        <td><input type="text" name=client[rest]" value="{$client.rest}" /></td>
                    </tr>
                    <tr>
                        <td class="var_name">Баллы:</td>
                        <td><input type="text" name=client[ball]" value="{$client.ball}" /></td>
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
