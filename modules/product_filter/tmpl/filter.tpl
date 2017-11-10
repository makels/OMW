{literal}
<script>
    document.filter = {
        side: "{/literal}{if isset($smarty.get.side)}{$smarty.get.side}{else}all{/if}{literal}",
        type: "{/literal}{if isset($smarty.get.type)}{$smarty.get.type}{else}all{/if}{literal}",
        size: "{/literal}{if isset($smarty.get.size)}{$smarty.get.size}{else}all{/if}{literal}"
    }
</script>
{/literal}
<script src="/modules/product_filter/js/filter.js" type="text/javascript"></script>