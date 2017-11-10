<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 19:44
 */
Class Controller_System Extends Controller_Base
{

  function index() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");

    if($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("system/system", "center_side");
    }

    $smarty->assign('page', 'system');

    $this->display();
  }

}