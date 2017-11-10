<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 23:41
 */
Class Controller_Users extends Controller_Base
{

  public function index() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");

    if($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/users", "center_side");
    }

    $smarty->assign('page', 'users');

    $this->display();
  }

  public function add() {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");

    if($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/user_add", "center_side");
    }

    $smarty->assign('page', 'users');

    $this->display();
  }

  public function save() {

    $user = Http::post("user");
    $user["is_admin"] = $user["is_admin"] == "on" ? 1: 0;
    $groups = Http::post("groups");
    $groups_ids = array();
    foreach($groups as $id => $group) $groups_ids[] = $id;

    $user_model = DB::loadModel("users/user");
    $user_groups_model = DB::loadModel("users/groups");
    $user_data = $user_model->add($user);
    $user_groups_model->setGroups($user_data["id"], $groups_ids);

    Http::redirect("/admin/users");
  }

  public function delete() {
    $users = Http::post("user");
    $user_model = DB::loadModel("users/user");
    foreach($users as $id => $val) {
      $user_model->delete($id);
    }

    Http::redirect("/admin/users");
  }

  public function update() {
    $user = Http::post("user");
    $user_id = Http::post("user_id");
    $user["is_admin"] = $user["is_admin"] == "on" ? 1: 0;
    $groups = Http::post("groups");
    $groups_ids = array();
    foreach($groups as $id => $group) $groups_ids[] = $id;

    $user_model = DB::loadModel("users/user");
    $user_groups_model = DB::loadModel("users/groups");
    $user_model->update($user_id, $user);
    $user_groups_model->setGroups($user_id, $groups_ids);

    Http::redirect("/admin/users");
  }

  public function edit() {
    $user = $this->registry->get("user");

    if($user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("users/user_edit", "center_side");
    }

    $smarty = $this->registry->get("smarty");
    $smarty->assign('page', 'users');

    $this->display();
  }

}