<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 11.12.2015
 * Time: 11:22
 */

Class Model_User extends DB {

  private $table = "`tz_members`";

  public function get($id) {
    $user = $this->getRow("SELECT * FROM ".$this->table . " WHERE `id` = " . $id);
    $user["is_admin"] = $user["su"];
    return $user;
  }

  public function getByLogin($login) {
    return $this->getRow("SELECT * FROM ".$this->table . " WHERE `name` = '" . $login . "'");
  }

  public function add($data) {
    $id = $this->insert("INSERT INTO " . $this->table . " (`name`,`display_name`,`pass`,`email`,`su`) VALUES ('".$data['login']."','".$data['display_name']."',md5('".$data['pass']."'), '".$data['email']."', ".$data['is_admin'].")");

    return $this->get($id);
  }

  public function update($user_id, $data) {
    $this->execute("UPDATE " . $this->table . " SET `name` = '" . $data['name'] . "',
                          `display_name` = '" . $data['display_name'] . "',
                          `email` = '" . $data['email'] . "',
                           `su` = " . $data['is_admin'] . " WHERE id = " . $user_id);
    if($data['pass'] != '')
      $this->execute("UPDATE " . $this->table . " SET `pass` = md5('" . $data["pass"] . "') WHERE `id` = " . $user_id);
  }

  public function delete($id) {
    $this->execute("DELETE FROM " . $this->table . " WHERE `id` = " . $id);
  }

}