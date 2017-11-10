<?php

Class Model_Regions extends DB {

  private $table = "`regions`";

  public function getAll() {
    return $this->getRows("SELECT * FROM " . $this->table . "ORDER BY TITLE_U");
  }

  public function find($sub) {
    $sql = "SELECT `CODEOBJ`, CONCAT(`TITLE_U`, ' (', `CODEOBJ`, ')') AS TITLE_U FROM " . $this->table . "WHERE TITLE_U LIKE '" . $sub . "%' ORDER BY (TITLE_U)";
    return $this->getRows($sql);
  }

  public function getPoly($region_id) {
    $sql = "SELECT * FROM `regions_main` WHERE `CODEOBJ` = " . $region_id;
    $region = $this->getRow($sql);
    $poly_sql = "SELECT * FROM `multi_regions` WHERE `CODEOBJ` = " . $region['ID'];
    $rows = $this->getRows($poly_sql);
    $lat_lng = array();
    foreach($rows as $row) {
      $points = explode(" ", $row["line"]);
      for($i = 0; $i < (count($points) / 2); $i++) {
        $lat_lng[] = array(
          "lat" => $points[$i * 2],
          "lng" => $points[$i*2 + 1] + 30211.277859906666
        );
      }
    }
    return array("region" => $region, "points" => $lat_lng);
  }

}