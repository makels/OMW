<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 25.01.2016
 * Time: 13:42
 */

Class Model_Pogran extends MSDB {

  public $table = "layers";

  public function getLayers($user) {
  	$result = array();
  	$ids = array();
  	$sql = "EXEC GeoView.getData @LoginName='" . $user->login . "'";
  	$geo_data = $this->getRows($sql);
  	foreach ($geo_data as $data) {
  		if(!in_array($data["LayerId"], $ids)) {
  			$ids[] = $data["LayerId"];
  			$result[] = array(
  				"Id" => $data["LayerId"],
  				"NameOrig" => $data["LayerName"]
  				);
  		}
  	}
  	return $result;
  }

  public function getObjects($layer_id, $user) {
  	$res = array();
  	$sql = "EXEC GeoView.getData @LoginName='" . $user->login . "'";
  	$geo_data = $this->getRows($sql);
  	foreach ($geo_data as $data) {
  		$coord = explode(" ", $data["Point"]);
  		$res[] = array(
  			"x" => $coord[0],
  			"y" => $coord[1],
  			"LayerId" => $data["LayerId"],
  			"ObjectName" => $data["ObjectName"],
  			"Comment" => $data["Comment"]
  			);
  	}
    return $res;
  }


}