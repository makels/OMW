<!DOCTYPE html>
<html class="no-js" lang="ru">
<head>
    {include file="head.tpl"}
</head>
<body class="page">
{* HEADER *}
{include file="header.tpl"}

{* BREADCRUMBS *}
{if $breadcrumbs}{$breadcrumbs}{/if}

{* INDEX *}
<section class="main-content">
    <div class="row">
        {if $left_side != ""}<div class="left_side">{$left_side}</div>{/if}
        {if $center_side != ""}<div class="center_side">{$center_side}</div>{/if}
        {if $right_side != ""}<div class="right_side">{$right_side}</div>{/if}
    </div>
</section>

{* END OF INDEX*}

{include file="footer.tpl"}

</body>
</html>