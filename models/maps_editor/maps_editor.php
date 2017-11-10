<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 28.02.2016
 * Time: 10:45
 */
Class Model_Maps_Editor extends DB {

  private $table = "`gis_maps`";

  private $table_layer = "`gis_maps_layers`";

  public function addMap($title) {
    return $this->insert(sprintf("INSERT INTO %s (`title`) VALUES ('%s')", $this->table, $title));
  }

  public function getAllMaps() {
    $maps =  $this->getRows(sprintf("SELECT * FROM %s ORDER BY `title`", $this->table));
    return $maps;
  }

  public function deleteMap($id) {
    $this->execute(sprintf("DELETE FROM %s WHERE `id` = %d", $this->table, $id));
    $this->execute(sprintf("DELETE FROM %s WHERE `map_id` = %d", $this->table_layer, $id));
  }

  public function addUploadedMap($map_info) {
    return $this->insert(sprintf("INSERT INTO %s (`map_id`, `img`, `x`, `y`, `right`, `top`, `width`, `height`) VALUES ('%d', '%s', %.6f, %.6f, %.6f, %.6f, %d, %d)",
      $this->table_layer,
      $map_info["map_id"],
      $map_info["upload_file"],
      $map_info["left_bound"],
      $map_info["down_bound"],
      $map_info["right_bound"],
      $map_info["top_bound"],
      $map_info["width"],
      $map_info["height"])
    );
  }

  public function getMapLayers($map_id) {
    return $this->getRow(sprintf("SELECT * FROM %s where `map_id` = %d", $this->table_layer, $map_id));
  }
}