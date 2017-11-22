<?php

Class Controller_Logout Extends Controller_Base {

    function index() {
        unset($_SESSION["user"]);
        Http::redirect("/");
    }

}