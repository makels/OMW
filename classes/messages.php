<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 7:51
 */

Class Messages {

    public $items = array();

    function __construct() {
        $this->items = isset($_SESSION["messages"]) ? $_SESSION["messages"] : array();
    }

    public function add($msg) {
        $this->items[] = $msg;
        $_SESSION["messages"] = $this->items;
    }

    public function get() {
        $messages =  $this->items;
        $this->clear();
        return $messages;
    }

    public function clear() {
        $this->items = array();
        $_SESSION["messages"] = $this->items;
    }

}