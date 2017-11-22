<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 09.12.2015
 * Time: 12:28
 */

Class User {

  public $id;

  public $social = "";

  public $data;

  public $login;

  public $password;

  public $display_name;

  public $avatar;

  public $permissions;

  public $group_name;

  public $logged = false;

  public $is_admin = false;

  public function auth() {
    $this->authDB();
    if($this->logged === true) $this->setCurrent();
  }

  public function authDB() {
    $user_model = DB::loadModel("users/user");
    if($this->login != "" && $this->password != "") {
      $user_row = $user_model->getByLogin($this->login);
      if(is_null($user_row)) return;
      if(md5($this->password) == $user_row["pass"]) {
        $this->is_admin = $user_row["su"] == 1;
        $this->display_name = $user_row["display_name"];
        $this->id = $user_row["id"];
        $this->avatar = $user_row["avatar"];
        $this->data = $user_row;
        $this->permissions = $this->getPermissions($this->id);
        $this->logged = true;
      }
    }
    if($this->login != "" && $this->social != "") {
      $user_row = $user_model->getByLogin($this->login);
      if(is_null($user_row)) return;
      $this->is_admin = $user_row["su"] == 1;
      $this->display_name = $user_row["display_name"];
      $this->avatar = $user_row["avatar"];
      $this->id = $user_row["id"];
      $this->data = $user_row;
      $this->permissions = $this->getPermissions($this->id);
      $this->logged = true;
    }
  }

  private function isAdmin($config) {
    if(isset($config[0]["memberof"])) {
      foreach($config[0]["memberof"] as $member) {
        if(mb_strpos($member, "Администраторы домена") != false) {
          return 1;
        }
      }
    } else {
      return 0;
    }
  }

  public function is_admin() {
    return $this->is_admin === true || $this->is_admin == 1 ? true : null;
  }

  public function is_logged() {
    return $this->logged === true || $this->logged == 1 ? true : null;
  }

  public function getPermissions() {
    $user_model = DB::loadModel("users/user");
    $permissions = $user_model->get_permissions($this->id);
    return $permissions;
  }

  public function has_permission($alias) {
    $permissions = $this->getPermissions();
    foreach($permissions as $permission) {
      if($permission["alias"] == $alias) return true;
    }
    return false;
  }

  public function toArray() {
    return array(
      "id" => $this->id,
      "data" => $this->data,
      "permissions" => $this->permissions,
      "is_admin" => $this->is_admin,
      "logged" => $this->logged,
      "login" => $this->login,
      "password" => $this->password,
      "display_name" => $this->display_name,
      "avatar" => $this->avatar,
      "group_name" => $this->group_name
    );
  }

  public function fromArray($data) {
    $this->id = isset($data["id"]) ? $data["id"] : 0;
    $this->data = isset($data["data"]) ? $data["data"] : array();
    $this->permissions = isset($data["permissions"]) ? $data["permissions"] : array();
    $this->logged = isset($data["logged"]) ? $data["logged"] : false;
    $this->is_admin = isset($data["is_admin"]) ? $data["is_admin"] : false;
    $this->login = isset($data["login"]) ? $data["login"] : "";
    $this->password = isset($data["password"]) ? $data["password"] : "";
    $this->display_name = isset($data["display_name"]) ? $data["display_name"] : "";
    $this->avatar = isset($data["avatar"]) ? $data["avatar"] : "";
    $this->group_name = isset($data["group_name"]) ? $data["group_name"] : "";
  }

  public function setCurrent() {
    global $registry;
    $registry->set('user', $this);
    $_SESSION['user'] = $this->toArray();
  }
}