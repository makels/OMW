<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.01.2016
 * Time: 14:21
 */

Class Model_Villages extends DB {

  private $table = "`silrada`";

  public function find($sub, $filter = array()) {
    $filter_str = implode(",", $filter);
    $sql = "SELECT * FROM " . $this->table . " WHERE `title` LIKE '" .  $sub. "%' LIMIT 0, 20";

    return $this->getRows($sql);
  }

  public function getPoly($id) {
    $sql = "SELECT * FROM " . $this->table . " WHERE `id` = " . $id;
    $village = $this->getRow($sql);
    $lat_lng = array();
    $points = explode(" ", $village["geometry"]);
    for($i = 0; $i < (count($points) / 2); $i++) {
      $lat_lng[] = array(
        "lat" => $points[$i * 2],
        "lng" => $points[$i*2 + 1]
      );
    }
    return array("village" => $village, "points" => $lat_lng);
  }

}