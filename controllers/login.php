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
        $messages = $this->registry->get("messages");
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
            $user_data = json_decode($s, true);
            $user = new User();
            $user->login = $user_data["network"] . "_" . $user_data["uid"];
            $user->social = $user_data["network"];
            $user->auth();
            if($user->is_logged()) {
                $_SESSION["user"] = $user->toArray();
                Http::redirect("/cabinet");
                exit;
            } else {
                Http::redirect($lang->url("/registration"));
                exit;
            }

        }

        if(isset($_POST["action"]) && $_POST["action"] == "login") {
            $user = new User();
            $user->login = Http::post("email");
            $user->password = Http::post("password");
            $user->auth();
            if(!is_null($user->is_logged())) {
                $_SESSION["user"] = $user->toArray();
                Http::redirect("/cabinet");
                exit;
            } else {
                $messages->add($lang->translate("Неверный логин или пароль"));
            }
        }

        $smarty->assign("errors", $errors);
        $this->display("login");
    }
}