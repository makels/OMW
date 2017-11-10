<div class="news module">
    <div class="module-title gradient">Новости</div>
    <div class="module-wrapper">
        {if !$user->has_permission("news")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
        <form action="/admin/news" method="post">
            <input type="hidden" name="action" id="form_action" value="">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('create');">{fa_icon name="file-o"}Создать</button>
                <button type="submit" onclick="$('#form_action').val('publish');">{fa_icon name="arrow-right"}Опубликовать</button>
                <button type="submit" onclick="$('#form_action').val('unpublish');">{fa_icon name="arrow-left"}Снять с публикации</button>
                <button type="submit" onclick="$('#form_action').val('delete');">{fa_icon name="close"}Удалить</button>
            </div>
            <table>
                <thead>
                    <td></td>
                    <td>Название статьи</td>
                    <td>Дата</td>
                    <td>Статус</td>
                </thead>
                <tbody>
                    {foreach from=$news item=news_item}
                        <tr>
                            <td><input type="checkbox" name="item[{$news_item.id}]"></td>
                            <td><a href="/admin/news?id={$news_item.id}">{$news_item.title}</a></td>
                            <td>{$news_item.date_time|date_format:"%d.%m.%Y"}</td>
                            <td>{if $news_item.status == 1}Опубликована{else}Не опубликована{/if}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </form>
        {/if}
    </div>
</div>