<?php

Class Recaptcha {

    public static function check() {
        $captcha = Http::post("g-recaptcha-response");
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $url = $google_url."?secret=" . RECAPTCHA_SECRET . "&response=" . $captcha;
        $res = Http::postRequest($url, array("response" => $captcha));
        $res = json_decode($res, true);
        return $res['success'];
    }

}