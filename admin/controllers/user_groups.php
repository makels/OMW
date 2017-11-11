<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 14:11
 */

Class Controller_User_groups extends Controller_Base
{

  public function index()
  {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    if(!$user->is_admin()) Http::redirect("/admin");
    if ($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/user_groups", "center_side");
    }

    $smarty->assign('page', 'user_groups');

    $this->display();
  }

  public function add() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");

    if($user->is_admin == 1) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/group_add", "center_side");
    }

    $smarty->assign('page', 'user_groups');

    $this->display();
  }

  public function edit() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    if(!$user->is_admin()) Http::redirect("/admin");
    if($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/group_edit", "center_side");
    }

    $smarty->assign('page', 'user_groups');

    $this->display();
  }

  public function save() {

    $group = Http::post("group");
    $permissions = Http::post("permission");
    $group_model = DB::loadModel("users/groups");
    $permission_model = DB::loadModel("users/permissions");
    $id_group = $group_model->addGroup($group);
    $pids = array();
    foreach($permissions as $id => $val) $pids[] = $id;
    $permission_model->setPermissions($id_group, $pids);

    Http::redirect("/admin/user_groups");

  }

  public function delete() {
    $groups = Http::post("group");
    $group_model = DB::loadModel("users/groups");
    foreach($groups as $id => $group) {
      $group_model->delete($id);
    }

    Http::redirect("/admin/user_groups");
  }

  public function update() {

    $group = Http::post("group");
    $group_id = Http::post("group_id");
    $permissions = Http::post("permission");

    $permission_model = DB::loadModel("users/permissions");
    $group_model = DB::loadModel("users/groups");
    $group_model->updateGroup($group_id, $group);
    $pids = array();
    foreach($permissions as $id => $val) $pids[] = $id;
    $permission_model->setPermissions($group_id, $pids);

    Http::redirect("/admin/user_groups");

  }



}