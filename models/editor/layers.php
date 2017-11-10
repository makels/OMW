<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 23.02.2016
 * Time: 15:49
 */
Class Model_Layers extends DB
{

  private $table = "`gis_layers`";

  public function getAllLayers() {
    return $this->getRows("SELECT * FROM " . $this->table);
  }

  public function getLayer($layerId) {
    return $this->getRow("SELECT * FROM " . $this->table . " WHERE id=" . $layerId);
  }

  public function getGeometry($layerId) {
    $layer = $this->getLayer($layerId);
    $geometry = $this->getRows(sprintf(
      "SELECT a.geometry, b.path FROM %s a, %s b WHERE a.id = b.id",
      $layer["tgeom"],
      $layer["tattr"]));
    return $geometry;
  }

  public function save($data) {
    $layer = $this->getLayer($data["LayerId"]);
    if($layer == null) return 0;
    $geometry_table = $layer["tgeom"];

  }
}