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

    $smarty->assign("database_external_host", $config->get("/settings/database_external/host"));
    $smarty->assign("database_external_port", $config->get("/settings/database_external/port"));
    $smarty->assign("database_external_name", $config->get("/settings/database_external/name"));
    $smarty->assign("database_external_user", $config->get("/settings/database_external/user"));
    $smarty->assign("database_external_pass", $config->get("/settings/database_external/pass"));

    $smarty->assign("auth_mode", $config->get("/settings/auth/mode"));

    $smarty->assign("ad_server_address", $config->get("/settings/ad_server/address"));
    $smarty->assign("ad_server_account_sufix", $config->get("/settings/ad_server/account_sufix"));
    $smarty->assign("ad_server_base_dn", $config->get("/settings/ad_server/base_dn"));

    $smarty->assign("tiles_path", $config->get("/settings/tiles_path"));

    $smarty->assign("view_color", $config->get("/settings/view/color"));

    if($this->registry->get("dl") == null) {
      $smarty->assign("database_error", 1);
    }

    if($this->registry->get("ext_dl") == null) {
      $smarty->assign("database_external_error", 1);
    }

    return $smarty->fetch(SITE_PATH . "modules/system/tmpl/system.tpl");
  }

  function save() {
    $database = Http::post("database");
    $database_external = Http::post("database_external");
    $auth = Http::post("auth");
    $ad_server = Http::post("ad_server");
    $tiles_path = Http::post("tiles_path");
    $view = Http::post("view");

    if(!is_null($database) &&
      !is_null($database_external) &&
      !is_null($auth) &&
      !is_null($ad_server) &&
      !is_null($tiles_path) &&
      !is_null($view)) {

      $config = new Config();
      $config->set("/settings/database/host", $database["host"]);
      $config->set("/settings/database/port", $database["port"]);
      $config->set("/settings/database/name", $database["name"]);
      $config->set("/settings/database/user", $database["user"]);
      $config->set("/settings/database/pass", $database["pass"]);

      $config->set("/settings/database_external/host", $database_external["host"]);
      $config->set("/settings/database_external/port", $database_external["port"]);
      $config->set("/settings/database_external/name", $database_external["name"]);
      $config->set("/settings/database_external/user", $database_external["user"]);
      $config->set("/settings/database_external/pass", $database_external["pass"]);

      $config->set("/settings/auth/mode", $auth["mode"]);

      $config->set("/settings/ad_server/address", $ad_server["address"]);
      $config->set("/settings/ad_server/account_sufix", $ad_server["account_sufix"]);
      $config->set("/settings/ad_server/base_dn", $ad_server["base_dn"]);

      $config->set("/settings/tiles_path", $tiles_path);

      $config->set("/settings/view/color", $view["color"]);

    }

    Http::redirect("/admin/system");
  }

}