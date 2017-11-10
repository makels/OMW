{literal}
<style>
    .products_list .cell_center{
        text-align: center;
    }
</style>
{/literal}
<div class="products module">
    <div class="module-title gradient">Товары</div>
    <div class="module-wrapper">
        <table class="products_list" cellpadding="0" cellspacing="0">
            <thead>
            <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
            <th>Product</th>
            <th>Indoor</th>
            <th>Outdoor</th>
            <th>Installation</th>
            <th>Rent</th>
            <th>Cabinet Size</th>
            </thead>
            <tbody>
            {foreach from=$products item=product}
                <tr>
                    <td style="width: 40px;text-align: center;"><input class="delete_product_checkbox" type="checkbox" name="product[{$product.product_id}]" /></td>
                    <td><a href="/admin/products/edit?id={$product.product_id}">{$product.model} ({$product.options[4].double_value})</a></td>
                    <td class="cell_center">{$product.options[0].bool_value}</td>
                    <td class="cell_center">{$product.options[1].bool_value}</td>
                    <td class="cell_center">{$product.options[2].bool_value}</td>
                    <td class="cell_center">{$product.options[3].bool_value}</td>
                    <td class="cell_center">{$product.options[5].string_value}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
</div>