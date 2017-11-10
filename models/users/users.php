<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.12.2015
 * Time: 23:57
 */

Class Model_Users extends DB {

  private $table = "`tz_members`";

  public function getUsers() {
    return $this->getRows("SELECT * FROM " . $this->table . " ORDER BY `display_name`");
  }

}