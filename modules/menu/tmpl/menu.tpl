<script type="text/javascript" src="/modules/menu/js/menu_handler.js"></script>

<div class="menu-tab gradient" onclick="mainMenuHandler.openMenu();">
  {fa_icon name="reorder"}
  <img src="/theme/images/menu-text.png" />
</div>

<div class="menu module">
  <div class="module-title gradient">{fa_icon name="reorder"}Меню<div onclick="mainMenuHandler.closeMenu();" class="fa-btn">{fa_icon name="close"}</div></div>
  <div class="module-wrapper">
    <ul>
      <li {if $page == "maps_search"} class="active" {/if}><a href="/maps_search">{fa_icon name="hand-o-right"}Адміністративний пошук</a></li>
      <li {if $page == "maps_editor"} class="active" {/if}><a href="/maps_editor">{fa_icon name="hand-o-right"}Редактор</a></li>
      <!--li {if $page == "maps_content"} class="active" {/if}><a href="/maps_content">{fa_icon name="hand-o-right"}Тематичний зміст</a></li>
      <li {if $page == "maps_events"} class="active" {/if}><a href="/maps_events">{fa_icon name="hand-o-right"}Реєстрація подій</a></li-->
    </ul>
  </div>
</div>