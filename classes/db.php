<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 11.12.2015
 * Time: 11:20
 */

Class DB {

  public function last_id() {
    global $registry;
    $link = $registry->get("dl");
    return mysqli_insert_id($link);
  }

  public function getRow($sql) {
    global $registry;
    $link = $registry->get("dl");
    $res = mysqli_query($link, $sql);
    if($res && $row = $res->fetch_assoc()) return $row;
    else return null;
  }

  public function getRows($sql) {
    global $registry;
    $link = $registry->get("dl");
    $res = mysqli_query($link, $sql);
    $rows = array();
    if($res) {
      while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
      }
    }
    return $rows;
  }

  public function insert($sql) {
    global $registry;
    $link = $registry->get("dl");
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($stmt);
    return $this->last_id();
  }

  public function execute($sql) {
    global $registry;
    $link = $registry->get("dl");
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($stmt);
  }

  public static function loadModel($model = "") {
    if($model == "") return null;
    $t = explode("/", $model);
    $class_name = ucfirst(end($t));
    $model_file = MODELS_PATH.mb_strtolower($model).".php";
    $model_name = "Model_".$class_name;
    if(file_exists($model_file)) {
      require_once $model_file;
      return new $model_name;
    }
    return null;
  }

  public static function version() {
    global $registry;
    $link = $registry->get("dl");
    try {
      $res = mysqli_query($link, "SELECT * FROM `version` ORDER BY `version` DESC");
      if ($res && $row = $res->fetch_assoc()) {
        return $row["version"];
      } else return 0;
    } catch(Exception $e) {
      return 0;
    }
  }

  public static function version_update($file_name) {
    global $registry;
    $link = $registry->get("dl");
    $sql = file_get_contents(DB_UPDATE_PATH."/".$file_name);
    $res = mysqli_multi_query($link, $sql);

    mysqli_stmt_execute($res);
  }

  public static function getSQLDate($date) {
    $res = date_parse_from_format("d.m.Y", $date);
    return sprintf("%s-%s-%s", $res["year"], $res["month"], $res["day"]);
  }

  public static function esc($str) {
    return str_replace("'", "\'", $str);
  }

}