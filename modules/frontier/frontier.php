<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 14:58
 */

Class Module_Frontier extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");
    $fmodel = MSDB::loadModel("maps/pogran");
    $layers = $fmodel->getLayers($user);

    //print_r($layers);die;


    $smarty->assign("layers", $layers);

    return $smarty->fetch(SITE_PATH . "/modules/frontier/tmpl/frontier.tpl");

  }

  function objects() {
    $res = array();
    $layers = Http::post("layers");
    $user = $this->registry->get("user");
    if($layers == null || count($layers) == 0) {
      echo json_encode($res);
      return;
    }

    $front_model = MSDB::loadModel("maps/pogran");
    $symbols_model = DB::loadModel("maps/symbols");
    foreach($layers as $layer) {
      $objects = $front_model->getObjects($layer, $user);
      foreach($objects as $object) {
        $res[] = array(
          "lat" => $object["x"],
          "lng" => $object["y"],
          "style" => $symbols_model->getStyleLayer($object["LayerId"]),
          "title" => $object["ObjectName"] . "\n" . $object["Comment"] . "\n" . sprintf("Lon: %s\nLat: %s", $object["x"], $object["y"])
        );
      }
    }

    echo json_encode($res);
  }

  function symbols() {
    $symbols_model = DB::loadModel("maps/symbols");
    $symbols = $symbols_model->getAll();
    echo json_encode($symbols);
  }

}