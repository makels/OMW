<link rel="stylesheet" href="/admin/theme/css/jquery-ui-1.10.4.custom.min.css">
<script src="/admin/theme/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="/admin/theme/js/datepicker-ru.js"></script>
<script src="/admin/modules/news/tmpl/ckeditor/ckeditor.js"></script>
<script src="/admin/modules/news/tmpl/js/news.js"></script>
<div class="news module">
    <div class="module-title gradient">Создать новость</div>
    <div class="module-wrapper">
        {if !$user->has_permission("news")}
            У Вас недостаточно прав для работы с данным режимом
        {else}
            <form action="/admin/news" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="action" value="save">
                Заголовок:<input style="width: 40%;margin-left: 10px;margin-bottom: 10px;" type="text" value="Новая статья" name="title"><br>
                Дата публикации: <input type="text" name="date_time" id="news_date_id" value="{$smarty.now|date_format:"%d.%m.%Y"}">
                Опубликована: <input style="margin-bottom: 10px;" type="checkbox" checked name="publish"><br>
                Верхний слайдер: <input style="margin-bottom: 10px;" type="file" name="up_slider"><br>
                Изображение:<input style="width: 40%;margin-left: 10px;margin-bottom: 10px;" type="file" value="" name="image"><br>
                Нижний слайдер (Изображение № 1): <input style="margin-bottom: 10px;" type="file" name="down_slider[]"><br>
                Нижний слайдер (Изображение № 2): <input style="margin-bottom: 10px;" type="file" name="down_slider[]"><br>
                Нижний слайдер (Изображение № 3): <input style="margin-bottom: 10px;" type="file" name="down_slider[]"><br>
                Нижний слайдер (Изображение № 4): <input style="margin-bottom: 10px;" type="file" name="down_slider[]"><br>
                Нижний слайдер (Изображение № 5): <input style="margin-bottom: 10px;" type="file" name="down_slider[]"><br>
                <textarea name="body" id="editor" rows="10" cols="80"></textarea>

                <div class="buttons-wrapper">
                    <button type="button" onclick="window.location.href='/admin/news';">{fa_icon name="arrow-circle-left"}Отмена</button>
                    <button type="submit">{fa_icon name="save"}Сохранить</button>
                </div>
            </form>
        {/if}
    </div>
</div>