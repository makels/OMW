<div class="top-current-lang flag flag-{$lang_prefix}">{$lang_name}</div>
<div class="top-languages-list">
    <ul>
        {foreach from=$languages key="key" item="item"}
            <li><a href="/{$key}"><div class="flag flag-{$key}">&nbsp;{$item}</div></a></li>
        {/foreach}
    </ul>
</div>