<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 14:47
 */
Class Module_Editor extends Module_Base {

  function render() {

    $layers_model = DB::loadModel("editor/layers");
    $smarty = $this->registry->get("smarty");
    $layers = $layers_model->getAllLayers();
    $smarty->assign("layers", $layers);
    return $smarty->fetch(SITE_PATH . "/modules/editor/tmpl/editor.tpl");

  }

  public function getGeometry() {
    $layerId = Http::post("layerId");
    if($layerId == null) return;
    $layers_model = DB::loadModel("editor/layers");
    $layer = $layers_model->getLayer($layerId);
    $geometry = $layers_model->getGeometry($layerId);
    echo json_encode(array(
      "layer" => $layer,
      "geometry" => $geometry
    ));
  }

  public function save() {
    $data = Http::post("data");
    if($data == null) return;
    $editor_model = DB::loadModel("editor/layers");
    $id = $editor_model->save($data);
    echo json_encode(array("id" => $id));
  }

}