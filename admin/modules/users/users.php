<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 23:54
 */

Class Module_Users extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $users_model = DB::loadModel("users/users");
    $users = $users_model->getUsers();
    $smarty->assign("users", $users);

    return $smarty->fetch(SITE_PATH . "modules/users/tmpl/users.tpl");
  }

}