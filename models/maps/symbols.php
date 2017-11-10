<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 09.02.2016
 * Time: 18:09
 */
Class Model_Symbols extends DB {

  private $table = "`p_gis_symbol`";

  public function getAll() {
    return $this->getRows("SELECT * FROM " . $this->table);
  }

  public function getStyleLayer($layer_id) {
    $style = $this->getRow("SELECT `v_desc` FROM `p_gis_variants` WHERE l_id = " . $layer_id);
    return json_decode($style["v_desc"]);
  }
}