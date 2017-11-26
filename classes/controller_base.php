<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 08.12.2015
 * Time: 11:13
 */

Abstract Class Controller_Base {

  public $breadcrumbs = array();

  protected $registry;

  protected $modules = array();

  function __construct($registry) {
    $this->registry = $registry;
    $this->modules = array(
      "left_side" => array(),
      "center_side" => array(),
      "right_side" => array(),
    );
  }

  abstract function index();

  function display($template = "index") {

    $smarty = $this->registry->get("smarty");
    $this->registerModule("messages/messages", "footer_side");
    $smarty->assign('left_side', $this->renderModules("left_side"));
    $smarty->assign('right_side', $this->renderModules("right_side"));
    $smarty->assign('center_side', $this->renderModules("center_side"));
    $smarty->assign('footer_side', $this->renderModules("footer_side"));
    $smarty->assign('user', $this->registry->get('user'));

    $smarty->display(TMPL_PATH . $template . ".tpl");
  }

  function renderModules($position) {
    $content = "";
    if(count($this->modules[$position]) == 0) return $content;
    foreach($this->modules[$position] as $module) {
      $content .= $module->render();
    }
    return $content;
  }

  function renderModule($name) {
    $t = explode("/", $name);
    $class_name = ucfirst(end($t));
    $module_file = MODULES_PATH.mb_strtolower($name).".php";
    $module_name = "Module_".$class_name;
    if(file_exists($module_file)) {
      require_once $module_file;
      $module = new $module_name($this->registry);
      return $module->render();
    }
    return "";
  }

  function registerModule($name, $position) {
    $path = explode("/", $name);
    $file = end($path) . ".php";
    unset($path[count($path) -1]);
    for($i = 0; $i < count($path); $i++) $path[$i] = ucfirst($path[$i]);
    $class_name = implode("_", $path);
    $module_file = MODULES_PATH . mb_strtolower(implode("/", $path) . "/" . $file);
    $module_name = "Module_".$class_name;
    if(file_exists($module_file)) {
      require_once $module_file;
      $module = new $module_name($this->registry);
      $this->modules[$position][] = $module;
    }
    return null;
  }
}
