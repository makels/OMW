<?php
Class Module_Login extends Module_Base {
  function render() {
    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "modules/login/tmpl/login.tpl");
  }
}