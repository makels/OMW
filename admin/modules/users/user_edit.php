<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 10:42
 */

Class Module_User_edit extends Module_Base {

  function render() {
    $user_id = Http::get("id");
    $smarty = $this->registry->get("smarty");
    $user_model = DB::loadModel("users/user");
    $groups_model = DB::loadModel("users/groups");
    $user_data = $user_model->get($user_id);
    $all_groups = $groups_model->getGroups();
    $user_groups = $groups_model->getUserGroups($user_id);

    $ids = array();
    foreach($user_groups as $ug) $ids[] = $ug["id"];

    $user_all_groups = array();

    foreach($all_groups as $group) {
      if(in_array($group["id"], $ids)) {
        $group["enabled"] = 1;
      } else {
        $group["enabled"] = 0;
      }
      $user_all_groups[] = $group;
    }

    $smarty->assign('user_id', $user_id);
    $smarty->assign('user_data', $user_data);
    $smarty->assign('user_groups', $user_all_groups);

    return $smarty->fetch(SITE_PATH . "modules/users/tmpl/user_edit.tpl");
  }

}