<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 15:12
 */
Class Module_Group_edit extends Module_Base {

  function render() {
    $group_id = Http::get("id");
    $smarty = $this->registry->get("smarty");
    $groups_model = DB::loadModel("users/groups");
    $permissions_model = DB::loadModel("users/permissions");
    $permissions = $permissions_model->getPermissions();
    $permissions_group = $permissions_model->getPermissionsGroup($group_id);

    $ids = array();
    foreach($permissions_group as $pg) $ids[] = $pg['permission_id'];
    $pres = array();
    foreach($permissions as $permission) {
      if(in_array($permission["id"], $ids)) {
        $permission["enabled"] = 1;
      } else {
        $permission["enabled"] = 0;
      }
      $pres[] = $permission;
    }

    $group = $groups_model->get($group_id);
    $smarty->assign('group_id', $group_id);
    $smarty->assign('group', $group);
    $smarty->assign('permissions', $pres);
    return $smarty->fetch(SITE_PATH . "modules/users/tmpl/group_edit.tpl");
  }

}