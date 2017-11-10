<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 11:14
 */

Class Model_Groups extends DB {

  private $table = "`tz_groups`";

  private $groups_users_table = "`tz_groups_users`";

  public function get($id) {
    return $this->getRow("SELECT * FROM " . $this->table . " WHERE `id` = " . $id);
  }

  public function addGroup($group) {
    return $this->insert("INSERT INTO " . $this->table . " (`name`, `description`) VALUES ('" . $group["name"] . "','" . $group["description"] . "')");
  }

  public function getGroups() {
    return $this->getRows("SELECT * FROM " . $this->table . " ORDER BY `name`");
  }

  public function setGroups($user_id, $groups_ids) {
    $this->execute("DELETE FROM " . $this->groups_users_table . " WHERE `user_id` = " . $user_id);
    foreach($groups_ids as $gid) {
      $this->insert("INSERT INTO " . $this->groups_users_table . " (`user_id`, `group_id`) VALUES (" . $user_id . ", " . $gid . ")");
    }
  }

  public function getUserGroups($id_user) {
    return $this->getRows("SELECT * FROM " . $this->groups_users_table . " gu
                            LEFT JOIN " . $this->table ." g ON gu.`group_id` = g.`id`
                            WHERE gu.`user_id` = ".$id_user);
  }

  public function updateGroup($group_id, $group) {
    $this->execute("UPDATE " . $this->table . " SET `name` = '" . $group['name'] . "', `description` = '" . $group['description'] . "' WHERE `id` = " . $group_id);
  }

  public function delete($id) {
    $this->execute("DELETE FROM " . $this->table . " WHERE `id` = " . $id);
  }

}