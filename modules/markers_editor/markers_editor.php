<?php
/**
 * Created by PhpStorm.
 * User: zerg
 * Date: 27.03.16
 * Time: 23:50
 */

Class Module_Markers_Editor extends Module_Base {

  function render() {
    $smarty = $this->registry->get("smarty");
    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $markers_layers = $markers_model->getAllMarkers();
    $markers_types = $markers_model->getAllMarkersTypes();
    $smarty->assign("markers_layers", $markers_layers);
    $smarty->assign("markers_types", $markers_types);
    return $smarty->fetch(SITE_PATH . "/modules/markers_editor/tmpl/markers_editor.tpl");

  }

  function addMarkersLayer() {
    $title = Http::post("title");
    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $id = $markers_model->addMarkersLayer($title);
    echo json_encode($id);
  }

  function removeMarkersLayer() {
    $id = Http::post("id");
    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $id = $markers_model->removeMarkersLayer($id);
    echo json_encode($id);
  }

  function addMarker() {
    $layer_id = Http::post("layer_id");
    $x = Http::post("add_marker_x");
    $y = Http::post("add_marker_y");
    $title = Http::post("marker_title");
    $description = Http::post("add_marker_text");
    $icon = Http::post("marker_type");
    $file = basename($_FILES['marker_file']['name']);
    if($file != "") {
      $upload_file = UPLOAD_DIR . "/" . basename($_FILES['marker_file']['name']);
      if(file_exists($upload_file)) unlink($upload_file);
      move_uploaded_file($_FILES['marker_file']['tmp_name'], $upload_file);
    }

    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $id = $markers_model->addMarker(array(
      "layer_id" => $layer_id,
      "title" => $title,
      "description" => $description,
      "x" => $x,
      "y" => $y,
      "file" => $file = basename($_FILES['marker_file']['name']),
      "icon" => $icon
    ));
    Http::redirect("/");
  }

  function getMarkers() {
    $layer_id = Http::post("layer_id");
    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $markers = $markers_model->getMarkersByLayer($layer_id);
    echo json_encode($markers);
  }

  function removeMarker() {
    $id = Http::post("id");
    $markers_model = DB::loadModel("markers_editor/markers_editor");
    $markers_model->deleteMarker($id);
    echo json_encode(array());
  }


}