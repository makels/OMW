<link rel="stylesheet" href="/modules/cabinet/constructor/css/constructor.css" />
<script type="text/javascript" src="/modules/cabinet/constructor/js/constructor.js"></script>
<div class="profile module">
    <div class="module-title">
        <div class="title-text">{fa_icon name="reorder"}{"Конструктор"|lang}</div>
        <div class="toolbox">
            <ul>
                <li>{fa_icon name="file"}{"Файл"|lang}</li>
                <li>{fa_icon name="home"}{"Главная"|lang}</li>
                <li>{fa_icon name="image"}{"Вставка"|lang}</li>
                <li>{fa_icon name="table"}{"Вид"|lang}</li>
            </ul>
        </div>
    </div>
    <div class="module-wrapper" style="padding: 0">
        <div class="workplace" id="constructor"></div>
    </div>
</div>

{literal}
    <script type="text/javascript">
        var tplEditor = new TplEditor();
        $(function() {
            tplEditor.init({
                cnt: "constructor"
            });
        });
    </script>
{/literal}