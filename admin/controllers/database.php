<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 10.01.2016
 * Time: 13:17
 */

Class Controller_Database Extends Controller_Base
{

  function index()
  {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    if(!$user->is_admin()) Http::redirect("/admin");
    if ($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("system/database", "center_side");
    }

    $smarty->assign('page', 'database');

    $this->display();
  }

  function version_update() {
    $file = Http::post("update_file");
    if($file != null) DB::version_update($file);
    Http::redirect("/admin/database");
  }
}