<?php

class Model_Lang extends DB {

    public function translate($str, $lang) {
        $q = sprintf("SELECT `translate` FROM `lang` WHERE `orig` = '%s' AND lang = '%s'", $str, $lang);
        $tr = $this->getRow($q);
        return $tr;
    }

    public function add($origin, $translate, $to) {
        $this->execute(sprintf("INSERT INTO `lang` (`orig`,`translate`,`lang`, `lang_group`) VALUES ('%s', '%s', '%s', '%s')",
            $origin, $translate, $to, "yandex"));
    }

}