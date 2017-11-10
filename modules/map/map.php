<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 22.12.2015
 * Time: 18:00
 */

Class Module_Map extends Module_Base {

  function render()
  {
    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(__DIR__."/tmpl/map.tpl");
  }

}