<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 25.01.2016
 * Time: 14:13
 */

Class Model_Subjects extends DB {

  public function getSubjects() {
    return $this->getRows("SELECT * FROM `gis_layers` ORDER BY `Title`");
  }

  public function getLayerData($info) {
    return $this->getRows(sprintf("SELECT * FROM `layers` WHERE `layer` = '%s'", $info["key"]));
  }

}