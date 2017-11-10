<link rel="stylesheet" href="/admin/modules/excel/tmpl/css/excel.css">
<div class="system module">
    <div class="module-title gradient">Импорт прайслиста из файла Excel</div>
    <div class="module-wrapper">
        {if !$user->has_permission("excel")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
        <form id="excel_form" method="post" enctype="multipart/form-data" onsubmit="return app.checkExcelForm();">
            {if $products_count > 0}
                <input type="hidden" name="action" value="import">
                <input type="hidden" name="products_count" value="{$products_count}">
                <input type="hidden" name="excel_file" value="{$excel_file}">
            {else}
                <input type="hidden" name="action" value="check">
            {/if}
            <div class="fields_group">Выбор файла для импорта</div>
            <table>
                <tr>
                    <td class="var_name">Файл:</td>
                    <td><input type="file" id="excel_file" name="excel_file" /></td>
                </tr>
                <tr>
                    <td class="var_name">Протокол проверки:</td>
                    <td>
                        <textarea id="excel_log_id" name="excel_log">{if isset($log)}{$log}{/if}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button onclick="document.location.href='/admin/'">{fa_icon name="arrow-circle-left"}Отмена</button>
                        <button type="submit">{fa_icon name="check"}Проверка файла</button>
                        <button {if !isset($products_count)}disabled{/if} type="submit">{fa_icon name="download"}Импорт</button>
                        <button type="button" onclick="app.clearProducts();">{fa_icon name="remove"}Очистить базу товаров</button>
                    </td>
                </tr>
            </table>
        </form>
        {/if}
    </div>
</div>