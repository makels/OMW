<?php
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// PATH
define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('SITE_PATH', realpath(dirname(__FILE__)) . DIRSEP);
define ('ROOT_PATH', realpath($_SERVER["DOCUMENT_ROOT"]) . DIRSEP);
define ('MODELS_PATH', SITE_PATH . "models" . DIRSEP);
define ('MODULES_PATH', SITE_PATH . "modules" . DIRSEP);
if(is_dir(SITE_PATH."tmp") === false) mkdir(SITE_PATH."tmp");

require "startup.php";

define ('TMPL_PATH', SITE_PATH . "themes" . DIRSEP . THEME_NAME . DIRSEP);
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = TMPL_PATH;
$registry->set ('smarty', $smarty);

$template = new Template($registry);
$registry->set ('template', $template);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $db_link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  mysqli_set_charset($db_link, "UTF8");
  $registry->set('dl', $db_link);
} catch (Exception $ex) {
  echo "Ошибка соединения с сервером - " . $ex;
  $registry->set('dl', null);
}

$lang = new Lang();
$registry->set ('lang', $lang);

$user = new User();
if(isset($_SESSION["user"])) $user->fromArray($_SESSION["user"]);
$registry->set ('user', $user);

$router = new Router($registry);
$registry->set ('router', $router);

$router->setPath (SITE_PATH . 'controllers');
$router->getController($file, $controller, $action, $args);
$registry->set("controller", array(
  "file" => $file,
  "controller" => $controller,
  "action" => $action,
  "args" => $args
));

$system_config = new Config();

$smarty->assign("system_config", json_encode($system_config->getAll()));
$smarty->assign("current_theme", $system_config->get("/settings/view/color"));
$smarty->assign("controller", $registry->get("controller"));

$messages = new Messages();
$registry->set("messages", $messages);

$router->delegate();