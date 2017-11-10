<div class="products module">
    <div class="module-title gradient">Отзывы о мойщиках</div>
    <div class="module-wrapper">
        <form id="orders_form" action="/admin/washers_reviews" method="post">
            <input type="hidden" name="action" id="form_action" value="delete">
            <div class="buttons-wrapper">
                <button type="submit" onclick="$('#form_action').val('publish');">{fa_icon name="user-plus"}Опубликовать отзывы</button>
                <button type="submit" onclick="$('#form_action').val('unpublish');">{fa_icon name="user-plus"}Снять с публикации</button>
                <button type="submit" onclick="$('#form_action').val('delete');">{fa_icon name="user-times"}Удалить отзывы</button>
            </div>
            <table class="products_list" cellpadding="0" cellspacing="0">
                <thead>
                <th style="padding-left: 10px;"><span class="fa fa-check-square-o">&nbsp;</span></th>
                <th>Дата</th>
                <th>Клиент</th>
                <th>Мойщик</th>
                <th>Оценка</th>
                <th>Отзыв</th>
                <th>Опубликован</th>
                </thead>
                <tbody>
                {foreach from=$reviews item=review}
                    <tr>
                        <td style="width: 40px;text-align: center;"><input class="delete_client_checkbox" type="checkbox" name="reviews[{$review.id}]" /></td>
                        <td class="cell_center">{$review.date|date_format:"%d.%m.%Y"}</td>
                        <td class="cell_center">{$review.client}</td>
                        <td class="cell_center">{$review.washer}</td>
                        <td class="cell_center">{$review.rating}</td>
                        <td class="cell_center">{$review.review}</td>
                        <td class="cell_center">{if $review.active == 1}Да{else}Нет{/if}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </form>
    </div>
</div>