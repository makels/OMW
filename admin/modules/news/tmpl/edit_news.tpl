<link rel="stylesheet" href="/admin/theme/css/jquery-ui-1.10.4.custom.min.css">
<script src="/admin/theme/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="/admin/theme/js/datepicker-ru.js"></script>
<script src="/admin/modules/news/tmpl/ckeditor/ckeditor.js"></script>
<script src="/admin/modules/news/tmpl/js/news.js"></script>
<div class="news module">
    <div class="module-title gradient">Изменить новость</div>
    <div class="module-wrapper">
        {if !$user->has_permission("news")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form action="/admin/news" method="post"enctype="multipart/form-data" >
                <input type="hidden" name="action" value="save" id="form_action">
                <input type="hidden" name="id" value="{$news.id}">
                <b>Заголовок:</b><input style="width: 40%;margin-left: 10px;margin-bottom: 10px;" type="text" value="{$news.title}" name="title"><br>
                <b>Дата публикации:</b> <input type="text" name="date_time" id="news_date_id" value="{$news.date_time|date_format:"%d.%m.%Y"}">
                <b>Опубликована:</b> <input style="margin-bottom: 10px;" type="checkbox" {if $news.status == 1}checked{/if} name="publish"><br>

                {if $news.up_slider == ""}
                    <b>Верхний слайдер:</b> <input style="margin-bottom: 10px;" type="file" name="up_slider"><br>
                {else}
                    <b>Верхний слайдер:</b>
                    <input style="display:none;width: 200px;margin-left: 10px;margin-bottom: 10px;" name="exist_up_slider" value="{$news.up_slider}">
                    <div class="thumb-image">
                        <img src="/upload/{$news.up_slider}" />
                        <button style="float: none;margin-left: 10px;" onclick="$('#form_action').val('delete_up_slider');"type="submit">{fa_icon name="delete"}Удалить</button><br>
                    </div>
                {/if}

                {if $news.main_image == ""}
                    <b>Изображение:</b><input style="width: 40%;margin-left: 10px;margin-bottom: 10px;" type="file" value="" name="image"><br>
                {else}
                    <b>Изображение:</b>
                    <input style="display:none;width: 200px;margin-left: 10px;margin-bottom: 10px;" name="exist_image" value="{$news.main_image}">
                    <div class="thumb-image">
                        <img src="/upload/{$news.main_image}" />
                        <button style="float: none;margin-left: 10px;" onclick="$('#form_action').val('delete_image');"type="submit">{fa_icon name="delete"}Удалить</button>
                    </div>

                {/if}

                {foreach from=$down_slider key=i item=image}
                    {if $image != ""}
                        <b>Нижний слайдер (Изображение № {$i + 1}):</b>
                        <input style="display:none;width: 200px;margin-left: 10px;margin-bottom: 10px;" name="exist_down_slider[]" value="{$image}">
                        <div class="thumb-image">
                            <img src="/upload/{$image}" />
                            <button style="float: none;margin-left: 10px;" onclick="$('#form_action').val('delete_down_slider_{$i}');"type="submit">{fa_icon name="delete"}Удалить</button><br>
                        </div>
                    {/if}
                {/foreach}

                <b>Добавить нижний слайдер:</b> <input style="margin-bottom: 10px;" type="file" name="down_slider"><br>


                <textarea name="body" id="editor" rows="10" cols="80">{$news.body}</textarea>

                <div class="buttons-wrapper">
                    <button type="button" onclick="window.location.href='/admin/news';">{fa_icon name="arrow-circle-left"}Отмена</button>
                    <button type="submit">{fa_icon name="save"}Сохранить</button>
                </div>
            </form>
        {/if}
    </div>
</div>