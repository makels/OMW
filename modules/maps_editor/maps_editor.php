<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 25.02.2016
 * Time: 14:40
 */

Class Module_Maps_Editor extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");
    $maps_model = DB::loadModel("maps_editor/maps_editor");
    $maps = $maps_model->getAllMaps();
    $smarty->assign("maps", $maps);
    return $smarty->fetch(SITE_PATH . "/modules/maps_editor/tmpl/maps_editor.tpl");

  }

  function removeMap() {
    $id = Http::post("id");
    if($id == null || $id == 0) return;
    $maps_model = DB::loadModel("maps_editor/maps_editor");
    $maps_model->deleteMap($id);
    echo json_encode($id);
  }

  function uploadMap() {

    $map_name = Http::post("map_name");
    $left_bound = Http::post("left_bound");
    $down_bound = Http::post("down_bound");
    $right_bound = Http::post("right_bound");
    $top_bound = Http::post("top_bound");
    $map_id = Http::post("map_id");
    $upload_file = UPLOAD_DIR . "/" . basename($_FILES['bound_file']['name']);
    if(file_exists($upload_file)) unlink($upload_file);

    if (move_uploaded_file($_FILES['bound_file']['tmp_name'], $upload_file)) {

      $size = getimagesize($upload_file);

      $maps_model = DB::loadModel("maps_editor/maps_editor");
      $map_id = $maps_model->addMap($map_name);
      $maps_model->addUploadedMap(array(
        "map_id" => $map_id,
        "left_bound" => $left_bound,
        "right_bound" => $right_bound,
        "down_bound" => $down_bound,
        "top_bound" => $top_bound,
        "upload_file" => basename($_FILES['bound_file']['name']),
        "width" => $size[0],
        "height" => $size[1]
      ));
      Http::redirect("/");
    } else {
      Http::redirect("/");
    }
  }

  function mapLayers() {
    $map_id = Http::post("map_id");
    $maps_model = DB::loadModel("maps_editor/maps_editor");
    $layers = $maps_model->getMapLayers($map_id);
    echo json_encode($layers);
  }

}