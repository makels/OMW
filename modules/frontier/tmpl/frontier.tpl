<script type="text/javascript" src="/modules/frontier/js/frontier_handler.js"></script>

<div class="menu module">
  <div class="module-title gradient closed">ІС Геліос<div  style="display: none;" class="fa-btn close">{fa_icon name="arrow-up"}</div><div class="fa-btn open">{fa_icon name="arrow-down"}</div></div>
  <div class="module-wrapper wrap-closed" style="height: 0px;">
    <div class="module-content">
      <div class="fields_group small">Об`єкти</div>
      <div class="mod-frontier-layers">
        {foreach from=$layers item="layer"}
          <input type="checkbox" value="{$layer.Id}" id="mod_frontier_layer[{$layer.Id}]" class="mod_frontier_layers" /><label for="mod_frontier_layer[{$layer.Id}]">{$layer.NameOrig}</label><br>
        {/foreach}
      </div>
    </div>
  </div>
</div>