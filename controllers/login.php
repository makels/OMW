<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 12.11.2017
 * Time: 15:28
 */

Class Controller_Login Extends Controller_Base {

    public $breadcrumbs = array();

    function index() {
        $smarty = $this->registry->get("smarty");
        $lang = $this->registry->get("lang");
        $lang_prefix = $lang->prefix;

        // Breadcrumbs
        $breadcrumbs = array(
            "home" => array("display" => $lang->translate("Главная"), "url" => $lang->url("/")),
            "registration" => array(
                "display" => $lang->translate("Вход"),
                "current" => 1)
        );
        $this->registry->set("breadcrumbs", $breadcrumbs);
        // End breadcrumbs

        $smarty->assign("breadcrumbs", $this->renderModule("breadcrumbs/breadcrumbs"));
        $smarty->assign("lang_prefix", $lang_prefix);
        $smarty->assign("current_user", $this->renderModule("user/current_user"));
        $smarty->assign("select_lang", $this->renderModule("lang/select_lang"));
        $smarty->assign("page", "registration");

        $errors = array();

        if(isset($_POST['token'])) {
            $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
            $user = json_decode($s, true);
            // Login
            Http::redirect("/");
            exit;
        }

        if(Http::post("action") == "login") $errors = $this->login();
        $smarty->assign("errors", $errors);
        $this->display("login");
    }

    function login() {
        $errors = array();
        $lang = $this->registry->get("lang");
        $smarty = $this->registry->get("smarty");


        
        return $errors;

    }


}