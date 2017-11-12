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
    $smarty->assign("current_user", $this->renderModule("user/current_user"));
    $smarty->assign("select_lang", $this->renderModule("lang/select_lang"));
    $smarty->assign("page", "index");
    $this->display("index");
  }

}