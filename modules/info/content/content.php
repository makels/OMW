<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 24.02.2016
 * Time: 13:56
 */
Class Module_Content extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/info/content/content.tpl");
  }
}