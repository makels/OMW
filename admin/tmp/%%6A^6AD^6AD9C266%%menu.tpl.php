<?php /* Smarty version 2.6.25, created on 2017-11-03 06:09:34
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/menu/tmpl/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin//modules/menu/tmpl/menu.tpl', 5, false),)), $this); ?>
<div class="menu module">
  <div class="module-title gradient">Администрирование</div>
  <div class="module-wrapper">
    <ul>
      <li <?php if ($this->_tpl_vars['page'] == 'index'): ?> class="active" <?php endif; ?>><a href="/admin"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Панель управления</a></li>
      <?php if ($this->_tpl_vars['user']->has_permission('clients')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'clients'): ?> class="active" <?php endif; ?>><a href="/admin/clients"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Клиенты</a></li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('washers')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'washers'): ?> class="active" <?php endif; ?>><a href="/admin/washers"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Мойщики</a></li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('orders')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'orders'): ?> class="active" <?php endif; ?>><a href="/admin/orders"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Заявки</a></li>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['user']->has_permission('reviews')): ?>
        <li>
          <?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
<span>Управление отзывами</span>
          <ul>
            <li <?php if ($this->_tpl_vars['page'] == 'clients_reviews'): ?> class="active" <?php endif; ?>><a href="/admin/clients_reviews"><?php echo smarty_function_fa_icon(array('name' => "caret-right"), $this);?>
Отзывы о клиентах</a></li>
            <li <?php if ($this->_tpl_vars['page'] == 'washers_reviews'): ?> class="active" <?php endif; ?>><a href="/admin/washers_reviews"><?php echo smarty_function_fa_icon(array('name' => "caret-right"), $this);?>
Отзывы о мойщиках</a></li>
          </ul>
        </li>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['user']->has_permission('products')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'products'): ?> class="active" <?php endif; ?>><a href="/admin/products"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Товары</a></li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('system')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'system'): ?> class="active" <?php endif; ?>><a href="/admin/system"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Система</a></li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('users')): ?>
        <li>
          <?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
<span>Управление пользователями</span>
          <ul>
            <li <?php if ($this->_tpl_vars['page'] == 'users'): ?> class="active" <?php endif; ?>><a href="/admin/users"><?php echo smarty_function_fa_icon(array('name' => "caret-right"), $this);?>
Пользователи</a></li>
            <li <?php if ($this->_tpl_vars['page'] == 'user_groups'): ?> class="active" <?php endif; ?>><a href="/admin/user_groups"><?php echo smarty_function_fa_icon(array('name' => "caret-right"), $this);?>
Группы пользователей</a></li>
          </ul>
        </li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('news')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'news'): ?> class="active" <?php endif; ?>><a href="/admin/news"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Новости</a></li>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['user']->has_permission('excel')): ?>
        <li <?php if ($this->_tpl_vars['page'] == 'excel'): ?> class="active" <?php endif; ?>><a href="/admin/excel"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Импорт прайслиста XLS</a></li>
      <?php endif; ?>
      <li><a href="/admin/logout"><?php echo smarty_function_fa_icon(array('name' => "hand-o-right"), $this);?>
Выход</a></li>
    </ul>
  </div>
</div>