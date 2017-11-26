<div class="menu module">
      <div class="module-title">{fa_icon name="reorder"}{"Кабинет"|lang}</div>
      <div class="module-wrapper">
    <ul>
      <li {if $page == "profile"} class="current" {/if}><a href="{"/cabinet/?page=profile"|url}">{fa_icon name="user"}{"Профиль"|lang}</a></li>
      <li {if $page == "company"} class="current" {/if}><a href="{"/cabinet/?page=company"|url}">{fa_icon name="building"}{"Организация"|lang}</a></li>
      <li {if $page == "documents"} class="current" {/if}><a href="{"/cabinet/?page=documents"|url}">{fa_icon name="briefcase"}{"Документы"|lang}</a></li>
      <li {if $page == "dictionaries"} class="current" {/if}><a href="{"/cabinet/?page=dictionaries"|url}">{fa_icon name="book"}{"Справочники"|lang}</a></li>
      <li {if $page == "constructor"} class="current" {/if}><a href="{"/cabinet/?page=constructor"|url}">{fa_icon name="cogs"}{"Конструктор"|lang}</a></li>
      <li {if $page == "calendar"} class="current" {/if}><a href="{"/cabinet/?page=calendar"|url}">{fa_icon name="calendar"}{"Календарь"|lang}</a></li>
      <li {if $page == "bills"} class="current" {/if}><a href="{"/cabinet/?page=bills"|url}">{fa_icon name="credit-card"}{"Счета"|lang}</a></li>
      <li {if $page == "services"} class="current" {/if}><a href="{"/cabinet/?page=services"|url}">{fa_icon name="cog"}{"Услуги"|lang}</a></li>
    </ul>
  </div>
</div>