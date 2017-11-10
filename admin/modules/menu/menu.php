<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 15:45
 */
Class Module_Menu extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    $user->has_permission("system");
    $smarty->assign("user", $user);
    return $smarty->fetch(SITE_PATH . "/modules/menu/tmpl/menu.tpl");
  }

}