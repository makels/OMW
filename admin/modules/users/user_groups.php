<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 14:13
 */

Class Module_User_Groups extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $groups_model = DB::loadModel("users/groups");
    $groups = $groups_model->getGroups();
    $smarty->assign("groups", $groups);

    return $smarty->fetch(SITE_PATH . "modules/users/tmpl/user_groups.tpl");
  }

}