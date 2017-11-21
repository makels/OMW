{if $breadcrumbs}
    <div class="breadcrumbs-wrapper">
        <ul>
        {foreach from = $breadcrumbs item = "item"}
            {if $item.current}
                <li>{$item.display}</li>
            {else}
                <li><a href="{$item.url}">{$item.display}</a>&nbsp;{fa_icon name="caret-right"}</li>
            {/if}
        {/foreach}
        </ul>
    </div>
{/if}