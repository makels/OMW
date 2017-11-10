<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 10.01.2016
 * Time: 13:18
 */

Class Module_Database extends Module_Base
{

  function render() {
    $smarty = $this->registry->get("smarty");
    $need_version = DB::version() + 1;
    $version_info = array();
    $files = scandir(DB_UPDATE_PATH);
    foreach($files as $file_name) {
      if($file_name == "update_".$need_version.".sql") {
        $version_info = $this->getVersionInfo($file_name);
      }
    }
    $smarty->assign("current_version", DB::version());
    $smarty->assign("version_info", $version_info);
    return $smarty->fetch(SITE_PATH . "modules/system/tmpl/database.tpl");
  }

  function getVersionInfo($file_name) {
    $content = file_get_contents(DB_UPDATE_PATH . "/" . $file_name);
    $start = strpos($content, "/*") + 2;
    $end = strpos($content, "*/");

    $info_xml = substr($content, $start, $end-$start);
    $xml = simplexml_load_string($info_xml);
    return (array)$xml;
  }
}