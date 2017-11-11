<?php
// PATH
define ('MODELS_PATH', SITE_PATH . "models" . DIRSEP);
define ('MODULES_PATH', SITE_PATH . "modules" . DIRSEP);
define ('TMPL_PATH', SITE_PATH . "views" . DIRSEP);
define ('UPLOAD_DIR', SITE_PATH . "uploads/");
define ('UPLOAD_IMAGE_DIR', ROOT_PATH . "uploads/");
define ('CLASSES_DIR', SITE_PATH . "classes/");
define ('SMARTY_DIR', SITE_PATH . "classes/smarty/");
require_once SMARTY_DIR . "Smarty.class.php";
require_once CLASSES_DIR . "config.php";

// DB
$config = new Config();
define ('DB_HOST', $config->get("/settings/database/host"));
define ('DB_PORT', $config->get("/settings/database/port"));
define ('DB_NAME', $config->get("/settings/database/name"));
define ('DB_USER', $config->get("/settings/database/user"));
define ('DB_PASS', $config->get("/settings/database/pass"));

// OTHER
define ('GOOGLE_KEY', 'AIzaSyDwmDR0f3MXKPcU2WMPhFujNyiDXSDLs-c');

spl_autoload_register(function($class_name) {
  $filename = strtolower($class_name) . '.php';
  $file = CLASSES_DIR . $filename;

  if (file_exists($file) === false) {
    return false;
  }
  require_once($file);
});
