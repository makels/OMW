<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 13.12.2015
 * Time: 15:50
 */

Class Model_Permissions extends DB {

  private $table = "`tz_permissions`";

  private $groups_permissions = "`tz_groups_permissions`";

  public function getPermissions() {
    return $this->getRows("SELECT * FROM " . $this->table . " ORDER BY `name`");
  }

  public function setPermissions($group_id, $permissions_ids) {
     $this->execute("DELETE FROM " . $this->groups_permissions . " WHERE `group_id` = " . $group_id);
    foreach($permissions_ids as $pid) {
      $this->insert("INSERT INTO " . $this->groups_permissions . " (`group_id`, `permission_id`) VALUES (" . $group_id . ", " . $pid .")");
    }
  }

  public function getPermissionsGroup($group_id) {
    return $this->getRows("SELECT * FROM " . $this->table . " g
                            LEFT JOIN " . $this->groups_permissions . " gp ON gp.`permission_id` = g.`id`
                            WHERE gp.`group_id` = " . $group_id);
  }

}