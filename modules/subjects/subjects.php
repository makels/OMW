<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 15:01
 */
Class Module_Subjects extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");

    $subjects_model = DB::loadModel("maps/subjects");
    $subjects = $subjects_model->getSubjects();

    $smarty->assign("subjects", $subjects);

    return $smarty->fetch(SITE_PATH . "/modules/subjects/tmpl/subjects.tpl");

  }

  function layers() {
    $layers = array();
    $list = Http::post("list");
    if($list == null) {
      echo json_encode($layers);
      exit;
    }

    $subjects_model = DB::loadModel("maps/subjects");
    foreach($list as $data) {
      $layers[] = array(
        "layer" => $data["key"],
        "data" => $subjects_model->getLayerData($data)
      );
    }
    echo json_encode($layers);
  }

}