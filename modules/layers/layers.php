<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 14:55
 */

Class Module_Layers extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/layers/tmpl/layers.tpl");

  }

}