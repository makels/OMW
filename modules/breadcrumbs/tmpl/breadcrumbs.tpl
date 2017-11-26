{if $breadcrumbs}
    <section class="main-content">
    <div class="breadcrumbs-wrapper">
        <ul>
        {foreach from = $breadcrumbs item = "item"}
            {if $item.current}
                <li>{$item.display}</li>
            {else}
                <li><a href="{$item.url}">{$item.display}</a>&nbsp;&nbsp;{fa_icon name="caret-right"}&nbsp;</li>
            {/if}
        {/foreach}
        </ul>
    </div>
    </section>
{/if}