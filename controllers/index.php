<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 11.01.2016
 * Time: 15:43
 */
Class Controller_Index Extends Controller_Base {

  function index() {
    $smarty = $this->registry->get("smarty");
    $this->display();
  }

}