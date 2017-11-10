<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.12.2015
 * Time: 22:09
 */

Class Module_Menu extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/menu/tmpl/menu.tpl");
  }

}