<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 20:09
 */

Class Module_System extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    $smarty->assign("user", $user);

    $config = new Config();
    $smarty->assign("database_host", $config->get("/settings/database/host"));
    $smarty->assign("database_port", $config->get("/settings/database/port"));
    $smarty->assign("database_name", $config->get("/settings/database/name"));
    $smarty->assign("database_user", $config->get("/settings/database/user"));
    $smarty->assign("database_pass", $config->get("/settings/database/pass"));

    $smarty->assign("view_color", $config->get("/settings/view/color"));

    if($this->registry->get("dl") == null) {
      $smarty->assign("database_error", 1);
    }

    return $smarty->fetch(SITE_PATH . "modules/system/tmpl/system.tpl");
  }

  function save() {
    $database = Http::post("database");
    $view = Http::post("view");

    if(!is_null($database) && !is_null($view)) {
      $config = new Config();
      $config->set("/settings/database/host", $database["host"]);
      $config->set("/settings/database/port", $database["port"]);
      $config->set("/settings/database/name", $database["name"]);
      $config->set("/settings/database/user", $database["user"]);
      $config->set("/settings/database/pass", $database["pass"]);
      $config->set("/settings/view/color", $view["color"]);
    }

    Http::redirect("/admin/system");
  }

}