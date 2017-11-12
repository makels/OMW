<?php
Class Module_Select_Lang extends Module_Base {

    function render() {
        $lang = $this->registry->get("lang");
        $smarty = $this->registry->get("smarty");
        $smarty->assign("lang_prefix", $lang->prefix);
        $smarty->assign("lang_name", $lang->langs[$lang->prefix]);
        $smarty->assign("languages", $lang->langs);
        return $smarty->fetch(SITE_PATH . "/modules/lang/tmpl/select_lang.tpl");
    }

}