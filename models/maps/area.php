<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 12.01.2016
 * Time: 1:51
 */

Class Model_Area extends DB {

  private $table = "`dist_main`";

  public function find($sub, $filter = array()) {
    $filter_str = implode(",", $filter);
    if(count($filter) > 0)
      $sql = "SELECT ID as `id`, dist_main.codeobj as codeobj_, concat(dist_main.TITLE_U, ', ', regions.TITLE_U, ' обл.') as `name`, regions.TITLE_U as title_region
              FROM dist_main inner JOIN regions ON dist_main.CODEOBJ=regions.CODEOBJ
              WHERE dist_main.TITLE_U like '" . $sub . "%'
                AND dist_main.codeobj IN (" . $filter_str . ")
                  ORDER BY (dist_main.TITLE_U) LIMIT 0, 30";
    else
      $sql = "SELECT ID as `id`, dist_main.codeobj as codeobj_, concat(dist_main.TITLE_U, ', ', regions.TITLE_U, ' обл.') as `name`, regions.TITLE_U as title_region
              FROM dist_main inner JOIN regions ON dist_main.CODEOBJ=regions.CODEOBJ
              WHERE dist_main.TITLE_U like '" . $sub . "%' ORDER BY (dist_main.TITLE_U) LIMIT 0, 30";

    return $this->getRows($sql);
  }

  public function getPoly($id) {
    $sql = "SELECT a.*, b.line FROM dist_table a, dist_multi b WHERE a.ID = b.ID AND a.CODEOBJ = " . $id;
    $area = $this->getRow($sql);
    $lat_lng = array();
    $points = explode(" ", $area["line"]);
    for($i = 0; $i < (count($points) / 2); $i++) {
      $lat_lng[] = array(
        "lat" => $points[$i * 2],
        "lng" => $points[$i*2 + 1] + 30211.277859906666
      );
    }
    return array("area" => $area, "points" => $lat_lng);
  }

}