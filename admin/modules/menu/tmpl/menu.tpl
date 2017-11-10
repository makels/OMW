<div class="menu module">
  <div class="module-title gradient">Администрирование</div>
  <div class="module-wrapper">
    <ul>
      <li {if $page == "index"} class="active" {/if}><a href="/admin">{fa_icon name="hand-o-right"}Панель управления</a></li>
      {if $user->has_permission("clients")}
        <li {if $page == "clients"} class="active" {/if}><a href="/admin/clients">{fa_icon name="hand-o-right"}Клиенты</a></li>
      {/if}
      {if $user->has_permission("washers")}
        <li {if $page == "washers"} class="active" {/if}><a href="/admin/washers">{fa_icon name="hand-o-right"}Мойщики</a></li>
      {/if}
      {if $user->has_permission("orders")}
        <li {if $page == "orders"} class="active" {/if}><a href="/admin/orders">{fa_icon name="hand-o-right"}Заявки</a></li>
      {/if}

      {if $user->has_permission("reviews")}
        <li>
          {fa_icon name="hand-o-right"}<span>Управление отзывами</span>
          <ul>
            <li {if $page == "clients_reviews"} class="active" {/if}><a href="/admin/clients_reviews">{fa_icon name="caret-right"}Отзывы о клиентах</a></li>
            <li {if $page == "washers_reviews"} class="active" {/if}><a href="/admin/washers_reviews">{fa_icon name="caret-right"}Отзывы о мойщиках</a></li>
          </ul>
        </li>
      {/if}

      {if $user->has_permission("products")}
        <li {if $page == "products"} class="active" {/if}><a href="/admin/products">{fa_icon name="hand-o-right"}Товары</a></li>
      {/if}
      {if $user->has_permission("system")}
        <li {if $page == "system"} class="active" {/if}><a href="/admin/system">{fa_icon name="hand-o-right"}Система</a></li>
      {/if}
      {if $user->has_permission("users")}
        <li>
          {fa_icon name="hand-o-right"}<span>Управление пользователями</span>
          <ul>
            <li {if $page == "users"} class="active" {/if}><a href="/admin/users">{fa_icon name="caret-right"}Пользователи</a></li>
            <li {if $page == "user_groups"} class="active" {/if}><a href="/admin/user_groups">{fa_icon name="caret-right"}Группы пользователей</a></li>
          </ul>
        </li>
      {/if}
      {if $user->has_permission("news")}
        <li {if $page == "news"} class="active" {/if}><a href="/admin/news">{fa_icon name="hand-o-right"}Новости</a></li>
      {/if}
      {if $user->has_permission("excel")}
        <li {if $page == "excel"} class="active" {/if}><a href="/admin/excel">{fa_icon name="hand-o-right"}Импорт прайслиста XLS</a></li>
      {/if}
      <li><a href="/admin/logout">{fa_icon name="hand-o-right"}Выход</a></li>
    </ul>
  </div>
</div>