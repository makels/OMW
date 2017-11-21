<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 12.11.2017
 * Time: 15:28
 */

Class Controller_Registration Extends Controller_Base {

    public $breadcrumbs = array();

    function index() {
        $smarty = $this->registry->get("smarty");
        $lang = $this->registry->get("lang");
        $lang_prefix = $lang->prefix;

        // Breadcrumbs
        $breadcrumbs = array(
            "home" => array("display" => $lang->translate("Главная"), "url" => "/"),
            "registration" => array(
                "display" => $lang->translate("Регистрация"),
                "url" => $this->registry->get("lang")->prefix . "/registration",
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
            $model = DB::loadModel("users/user");
            $user = $model->add(array(
                "login" => $user['network'] . "_" . $user['uid'],
                "display_name" => $user['last_name'] . " " . $user['first_name'],
                "pass" => "",
                "email" => "",
                "is_admin" => 0
            ));
            Http::redirect("/");
            exit;
        }

        if(Http::post("action") == "registration") $errors = $this->registration();
        $smarty->assign("errors", $errors);
        $this->display("registration");
    }

    function registration() {
        $errors = array();
        $lang = $this->registry->get("lang");
        $smarty = $this->registry->get("smarty");

        $first_name = Http::post("first_name");
        $last_name = Http::post("last_name");
        $email = Http::post("email");
        $password = Http::post("password");

        $smarty->assign("first_name", $first_name);
        $smarty->assign("last_name", $last_name);
        $smarty->assign("email", $email);
        $smarty->assign("password", $password);

        if($first_name == "") $errors[] = $lang->translate("Вы не указали имя");
        if($last_name == "") $errors[] = $lang->translate("Вы не указали фамилию");
        if($email == "") $errors[] = $lang->translate("Вы не указали email");
        if($password == "") $errors[] = $lang->translate("Вы не указали пароль");
        if(!Recaptcha::check()) $errors[] = $lang->translate("Вы не прошли проверку CAPTCHA");

        $smarty->assign("errors", $errors);

        if(count($errors) > 0) return $errors;

        $model = DB::loadModel("users/user");
        $user = $model->add(array(
            "login" => $first_name,
            "display_name" => $last_name . " " . $first_name,
            "pass" => md5($password),
            "email" => $email,
            "is_admin" => 0
        ));
        $smarty->assign("user", $user);
        return $errors;

    }
    
    
}