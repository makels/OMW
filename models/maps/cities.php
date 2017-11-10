<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.01.2016
 * Time: 1:21
 */

Class Model_Cities extends DB {

  private $table = "`citi_ext`";

  public function find($sub, $filter = array()) {
    $filter_str = implode(",", $filter);
    if(count($filter) > 0)
      $sql = "SELECT DISTINCT `CODEKOATUU` as `NUM`, concat(`Title`, ' (', `CODEKOATUU`, ')') as `name` FROM " . $this->table . " WHERE Title LIKE '" . $sub . "%' AND substring(CODEGENE,1,2) in (" . $filter_str . ") ORDER BY `Title` LIMIT 0, 30";
    else
      $sql = "SELECT DISTINCT `CODEKOATUU` as `NUM`, concat(`Title`, ' (', `CODEKOATUU`, ')') as `name` FROM " . $this->table . " WHERE Title LIKE '" . $sub . "%' ORDER BY `Title` LIMIT 0, 30";
    return $this->getRows($sql);
  }

  public function getPoly($id) {
    $nums = array();
    $sql = "SELECT `NUM` FROM " . $this->table . " WHERE `CODEKOATUU` = '" . $id . "'";
    $ids = $this->getRows($sql);
    foreach($ids as $num) {
      $nums[] = $num['NUM'];
    }

    $ids_str = implode(",", $nums);

    $sql = "SELECT * FROM " . $this->table . " WHERE `NUM` IN (" . $ids_str . ")";
    $cities = $this->getRows($sql);
    $result = array();
    foreach($cities as $city) {
      $lat_lng = array();
      $points = explode(" ", $city["poligon"]);
      for ($i = 0; $i < (count($points) / 2); $i++) {
        $lat_lng[] = array(
          "lng" => $points[$i * 2],
          "lat" => $points[$i * 2 + 1]
        );
      }
      $result[] = array("city" => $city, "points" => $lat_lng);
    }
    return $result;
  }

}