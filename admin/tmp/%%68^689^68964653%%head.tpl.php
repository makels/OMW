<?php /* Smarty version 2.6.25, created on 2017-10-31 22:05:08
         compiled from head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'head.tpl', 40, false),)), $this); ?>
<title>Brilliant Ulag</title>
<meta charset = "utf-8" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/font-opensans.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/main.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/zwindow.css" />
<link rel="stylesheet" type="text/css" href="/admin/theme/css/daterangepicker.css" />


<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="/theme/css/ie.css" />
<![endif]-->

<!-- Themes -->
<?php if ($this->_tpl_vars['current_theme'] == 'green'): ?>
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/green-theme.css" />
<?php endif; ?>

<?php if ($this->_tpl_vars['current_theme'] == 'blue'): ?>
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/blue-theme.css" />
<?php endif; ?>

<?php if ($this->_tpl_vars['current_theme'] == 'bw'): ?>
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/bw-theme.css" />
<?php endif; ?>

<?php if ($this->_tpl_vars['current_theme'] == 'red'): ?>
  <link rel="stylesheet" type="text/css" href="/admin/theme/css/red-theme.css" />
<?php endif; ?>


<script type="text/javascript" src="/admin/theme/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/admin/theme/js/moment.min.js"></script>
<script type="text/javascript" src="/admin/theme/js/daterangepicker.js"></script>
<script type="text/javascript" src="/admin/theme/js/zwindow.js"></script>
<script type="text/javascript" src="/admin/theme/js/app.js"></script>

<?php echo '
<script type="text/javascript">
  window.system_config_json = \''; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['system_config'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
<?php echo '\';
</script>
'; ?>