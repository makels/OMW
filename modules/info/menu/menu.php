<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 24.02.2016
 * Time: 13:52
 */
Class Module_Menu extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/info/menu/menu.tpl");
  }
}