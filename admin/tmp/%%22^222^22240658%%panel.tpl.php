<?php /* Smarty version 2.6.25, created on 2017-11-03 06:09:34
         compiled from /home/admin/web/bulag.tk/public_html/admin//modules/panel/tmpl/panel.tpl */ ?>
<div class="panel module">
  <div class="module-title gradient">Панель управления</div>
  <div class="module-wrapper" style="height: 100px">

    <?php if ($this->_tpl_vars['user']->has_permission('system')): ?>
      <a href="/admin/system">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/settings.png" />
          <span>Система</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('products')): ?>
      <a href="/admin/products">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/products.png" />
          <span>Товары</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('users')): ?>
      <a href="/admin/users">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/user.png" />
          <span>Пользователи</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('users')): ?>
      <a href="/admin/user_groups">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/groups.png" />
          <span>Группы пользователей</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('news')): ?>
      <a href="/admin/news">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/news.png" />
          <span>Новости</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('excel')): ?>
      <a href="/admin/excel">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/excel.png" />
          <span>Импорт прайслиста</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('clients')): ?>
      <a href="/admin/clients">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/clients.png" />
          <span>Клиенты</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('washers')): ?>
      <a href="/admin/washers">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/washers.png" />
          <span>Мойщики</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('reviews')): ?>
      <a href="/admin/clients_reviews">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/clients_reviews.png" />
          <span>Отзывы о клиентах</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('reviews')): ?>
      <a href="/admin/washers_reviews">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/washers_reviews.png" />
          <span>Отзывы о мойщиках</span>
        </div>
      </a>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['user']->has_permission('orders')): ?>
      <a href="/admin/orders">
        <div class="icon-wrapper">
          <img src="/admin/theme/images/icons/products.png" />
          <span>Заказы</span>
        </div>
      </a>
    <?php endif; ?>

  </div>
</div>