<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.12.2015
 * Time: 23:49
 */

Class Module_Search extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");

    $regions_model = DB::loadModel("maps/regions");
    $regions = $regions_model->getAll();
    $smarty->assign("regions", $regions);

    return $smarty->fetch(SITE_PATH . "/modules/search/tmpl/search.tpl");

  }

  function auto_complete() {
    $result = array();
    $filter_regions = array();
    $search_str = Http::post("search_str");
    $search_place = Http::post("search_place");
    $regions = Http::post("regions");
    foreach($regions as $region_id => $checked) {
      if($checked = "on") $filter_regions[] = $region_id;
    }

    switch($search_place) {
      case 0: {
        // Regions
        $regions_model = DB::loadModel("maps/regions");
        $rows = $regions_model->find($search_str, $filter_regions);
        foreach($rows as $row) {
          $result[] = array("id" => $row['CODEOBJ'], "name" => $row['TITLE_U']);
        }
        break;
      }
      case 1: {
        // Area
        if(count($filter_regions) == 0) break;
        $area_model = DB::loadModel("maps/area");
        $rows = $area_model->find($search_str, $filter_regions);
        foreach($rows as $row) {
          $result[] = array("id" => $row['id'], "name" => $row['name']);
        }
        break;
      }
      case 2: {
        // Cities
        if(count($filter_regions) == 0) break;
        $cities_model = DB::loadModel("maps/cities");
        $rows = $cities_model->find($search_str, $filter_regions);
        foreach($rows as $row) {
          $result[] = array("id" => $row['NUM'], "name" => $row['name']);
        }
        break;
      }
      case 3: {
        // Villages
        if(count($filter_regions) == 0) break;
        $villages_model = DB::loadModel("maps/villages");
        $rows = $villages_model->find($search_str, $filter_regions);
        foreach($rows as $row) {
          $result[] = array("id" => $row['id'], "name" => $row['title']);
        }
        break;
      }
    }
    echo json_encode($result);
  }

  function poly_region() {
    $id = Http::post("id");
    $regions_model = DB::loadModel("maps/regions");
    $poly = $regions_model->getPoly($id);
    echo json_encode($poly);
  }

  function poly_city() {
    $id = Http::post("id");
    $city_model = DB::loadModel("maps/cities");
    $poly = $city_model->getPoly($id);
    echo json_encode($poly);
  }

  function poly_area() {
    $id = Http::post('id');
    $area_model = DB::loadModel("maps/area");
    $poly = $area_model->getPoly($id);
    echo json_encode($poly);
  }

  function poly_village() {
    $id = Http::post('id');
    $village_model = DB::loadModel("maps/villages");
    $poly = $village_model->getPoly($id);
    echo json_encode($poly);
  }

}