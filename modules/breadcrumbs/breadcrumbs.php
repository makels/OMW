<?php

class Module_Breadcrumbs extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $breadcrumbs = $this->registry->get("breadcrumbs");
        $smarty->assign("breadcrumbs", $breadcrumbs);
        return $smarty->fetch(SITE_PATH . "/modules/breadcrumbs/tmpl/breadcrumbs.tpl");
    }

}