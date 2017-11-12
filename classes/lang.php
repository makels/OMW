<?php

class Lang {
    
    public $default_prefix = "ru";
    
    public $prefix;

    public $name;
    
    private $_model;

    public $langs = array(
        "uk" => "Українська",
        "ru" => "Русский",
        "en" => "English",
        "fr" => "Français",
        "de" => "Deutsch"
    );

    function __construct() {
        $this->prefix = isset($_SESSION["lang"]) ? $_SESSION["lang"] : $this->default_prefix; 
        $this->setLang($this->prefix);
        $this->_model = DB::loadModel("lang/lang");
    }
    
    public function setLang($prefix) {
        $this->prefix = $prefix;
        $_SESSION["lang"] = $this->prefix;        
    }

    public function url($url, $prefix = "") {
        if($prefix == "") $prefix = $this->default_prefix;
        return "/" . $prefix . $url;
    }
    
    public function translate($str) {
        $tr = $this->_model->translate($str, $this->prefix);
        if(is_null($tr)) {
            $tr = $this->yandex_translate($str, $this->prefix);
            $tr = json_decode($tr);
            if(isset($tr->code) && $tr->code == 200) {
                $this->_model->add($str, $tr->text[0], $this->prefix);
                return $tr->text[0];
            } else {
                return $str;
            }
        }
        return $tr["translate"];
    }

    public function yandex_translate($str, $to) {
        $uri = sprintf(YA_TRANSLATE_URL, $this->default_prefix, $to);
        $data = array("text" => $str);
        $res = Http::postRequest($uri, $data);
        return $res;
    }
}