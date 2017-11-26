<script type="text/javascript" src="/modules/messages/js/messages.js"></script>
<div class="messages-wrapper">
    {if count($messages_items) > 0}
        <ul>
            {foreach from=$messages_items item=message}
                <li>{$message}</li>
            {/foreach}
        </ul>
        {literal}
            <script type="text/javascript">
                $(function() { Messages.show(); });
            </script
        {/literal}
    {/if}
</div>