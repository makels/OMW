<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 14:47
 */
Class Module_Group_add extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $permissions_model = DB::loadModel("users/permissions");
    $permissions = $permissions_model->getPermissions();
    $smarty->assign('permissions', $permissions);
    return $smarty->fetch(SITE_PATH . "modules/users/tmpl/group_add.tpl");
  }

}