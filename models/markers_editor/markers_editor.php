<?php
/**
 * Created by PhpStorm.
 * User: zerg
 * Date: 28.03.16
 * Time: 0:24
 */

Class Model_Markers_Editor extends DB {

  private $table_markers_layer = "`gis_markers_layers`";

  private $table_markers = "`gis_markers`";

  public function getAllMarkers() {
    return $this->getRows(sprintf("SELECT * FROM %s", $this->table_markers_layer));
  }

  public function getAllMarkersTypes() {
    return $this->getRows("SELECT * FROM p_gis_symbol");
  }

  public function addMarkersLayer($title) {
    return $this->insert(sprintf("INSERT INTO %s (`title`) VALUES ('%s')", $this->table_markers_layer, $title));
  }

  public function removeMarkersLayer($id) {
    $this->execute(sprintf("DELETE FROM %s WHERE `id` = %d", $this->table_markers_layer, $id));
    $this->execute(sprintf("DELETE FROM %s WHERE `layer_id` = %d", $this->table_markers, $id));
  }

  public function addMarker($data) {
    return $this->insert(sprintf("INSERT INTO %s (`layer_id`, `title`, `description`, `x`, `y`, `file`, `icon`) VALUES (%d, '%s', '%s', %.7f, %.7f, '%s', '%s')",
        $this->table_markers,
        $data["layer_id"],
        $data["title"],
        $data["description"],
        $data["x"],
        $data["y"],
        $data["file"],
        $data["icon"])
    );
  }

  public function getMarkersByLayer($layer_id) {
    return $this->getRows(sprintf("SELECT * FROM %s WHERE `layer_id` = %d", $this->table_markers, $layer_id));
  }

  public function deleteMarker($id) {
    $this->execute("DELETE FROM `gis_markers` WHERE `id` = " . $id);
  }

}