<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 14:28
 */


Class Module_Choice extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/choice/tmpl/choice.tpl");

  }

}