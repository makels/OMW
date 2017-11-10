<?php /* Smarty version 2.6.25, created on 2017-10-31 22:05:08
         compiled from /home/admin/web/bulag.tk/public_html/admin/modules/login/tmpl/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'fa_icon', '/home/admin/web/bulag.tk/public_html/admin/modules/login/tmpl/login.tpl', 4, false),)), $this); ?>
<form action="/admin/auth" method="POST">
  <div class="login-window shadow">
    <div class="login-window-title gradient">
      <?php echo smarty_function_fa_icon(array('name' => 'key'), $this);?>
<span>Вход</span>
    </div>
    <div class="login-window-body">
      <div class="field-v">
        <div class="fa fa-user">&nbsp;</div>
        <input type="text" name="login" placeholder="Логин" autocomplete="off" />
      </div>
      <div class="field-v">
        <div class="fa fa-lock">&nbsp;</div>
        <input type="password" name="password" placeholder="Пароль" autocomplete="off"  />
      </div>
      <div class="buttons">
        <button class="gradient" type="submit"><?php echo smarty_function_fa_icon(array('name' => "sign-in"), $this);?>
Вход</button>
      </div>
    </div>
  </div>
</form>