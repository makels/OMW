<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.06.2017
 * Time: 6:46
 */
Class Controller_about Extends Controller_Base {

    function index() {
        $smarty = $this->registry->get("smarty");
        $this->display("about");
    }

}