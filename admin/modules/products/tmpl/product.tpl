<div class="product module">
    <div class="module-title gradient">Товар</div>
    <div class="module-wrapper">
        {if !$user->has_permission("users")}
        У Вас недостаточно прав для работы с данным режимом
        {else}
        <form method="post">
        <input type="hidden" name="product[id]" value="{$product.product_id}" />
        <table>
            <tr>
                <td class="var_name">Модель:</td>
                <td><input type="text" id="product_model" name=product[model]" value="{$product.model}" /></td>
            </tr>
            {foreach from=$product.options item=option}
            <tr>
                <td class="var_name">{$option.name}:</td>
                <td>
                {if $option.type == "bool"}
                    <input type="checkbox" name="option[{$option.option_id}]" {if $option.bool_value == 1} checked {/if} />
                {elseif $option.type == "double"}
                    <input type="number" name="option[{$option.option_id}]" value="{$option.double_value}" />
                {elseif $option.type == "int"}
                    <input type="number" name="option[{$option.option_id}]" value="{$option.int_value}" />
                {elseif $option.type == "string"}
                    <input type="text" name="option[{$option.option_id}]" value="{$option.string_value}" />
                {/if}
                </td>
            </tr>
            {/foreach}
            <tr>
                <td colspan="2">
                    <button onclick="document.location.href='/admin/products'">{fa_icon name="arrow-circle-left"}Отмена</button>
                    <button type="submit">{fa_icon name="save"}Сохранить</button>
                </td>
            </tr>
        </table>
        </form>
        {/if}
    </div>
</div>