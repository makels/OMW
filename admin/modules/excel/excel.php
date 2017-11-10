<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 16.06.2017
 * Time: 14:12
 */
Class Module_Excel extends Module_Base {

    public $log = array();

    public $products_count = 0;

    public $excel_file = "";

    function render() {
        $smarty = $this->registry->get("smarty");
        $smarty->assign('page', 'excel');
        if(Http::post("action") == "check") {
            $this->check();
            if($this->products_count > 0) {
                $smarty->assign("products_count", $this->products_count);
                $smarty->assign("excel_file", $this->excel_file);
            }
        }

        if(Http::post("action") == "import") {
            $this->excel_file = Http::post("excel_file");
            $this->products_count = Http::post("products_count");
            $this->import();
        }

        if(Http::post("action") == "clear_products") {
            $this->clear_products();
            echo json_encode(array("result" => 1));
            exit;
        }

        $smarty->assign("log", implode("\r\n", $this->log));
        return $smarty->fetch(SITE_PATH . "modules/excel/tmpl/excel.tpl");
    }

    function check() {
        if(is_null(Http::file("excel_file"))) {
            $this->log[] = "Выберите файл для загрузки";
            return;
        }
        $this->excel_file = FileManager::upload(Http::file("excel_file"));
        if(!file_exists(UPLOAD_DIR . $this->excel_file)) {
            $this->log[] = "Ошибка загрузки файла для импорта";
            return;
        }

        $this->log[] = "Файл для импорта: " . $this->excel_file;

        require_once(CLASSES_DIR . "PHPExcel/IOFactory.php");
        $xls = PHPExcel_IOFactory::load(UPLOAD_DIR . $this->excel_file);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        for ($i = 3; $i <= $sheet->getHighestRow(); $i++) {
            $product = array();
            $product['row'] = $i;
            $model = $sheet->getCellByColumnAndRow(2, $i)->getValue();
            if($model == "") break;
        }
        $this->products_count = $i - 3;
        $this->log[] = "Найдено товаров: " . $this->products_count;
    }

    function import() {
        require_once(CLASSES_DIR . "PHPExcel/IOFactory.php");
        $xls = PHPExcel_IOFactory::load(UPLOAD_DIR . $this->excel_file);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $model = DB::loadModel("excel/excel");
        for ($i = 3; $i < $this->products_count + 3; $i++) {
            $product = array();
            $product["category"] = $sheet->getCellByColumnAndRow(1, $i)->getValue();
            $product["model"] = $sheet->getCellByColumnAndRow(2, $i)->getValue();
            $product["options"] = array();
            $options = $model->get_options();
            foreach($options as $option) {
                $value = $sheet->getCellByColumnAndRow($option["excel_column"], $i)->getValue();
                switch($option["type"]) {
                    case "string":
                        $product["options"][] = array(
                            "id" => $option["id"],
                            "type" => $option["type"],
                            "value" => $this->getStringOptionValue($value)
                        );
                        break;
                    case "int":
                        $product["options"][] = array(
                            "id" => $option["id"],
                            "type" => $option["type"],
                            "value" => $this->getIntOptionValue($value)
                        );
                        break;
                    case "double":
                        $product["options"][] = array(
                            "id" => $option["id"],
                            "type" => $option["type"],
                            "value" => $this->getDoubleOptionValue($value)
                        );
                        break;
                    case "bool":
                        $product["options"][] = array(
                            "id" => $option["id"],
                            "type" => $option["type"],
                            "value" => $this->getBooleanOptionValue($value)
                        );
                        break;
                }
            }
            $id = $model->add_product($product);
            if($id > 0) $this->log[] = "Строка: " . $i . "  " . $product["model"] . " - OK";
            else $this->log[] = "Строка: " . $i . "  " . $product["model"] . " - Ошибка";
        }
    }

    function getStringOptionValue($value) {
        $value = trim($value);
        return $value;
    }

    function getIntOptionValue($value) {
        $value = trim($value);
        return intval($value);
    }

    function getDoubleOptionValue($value) {
        $value = trim($value);
        $value = str_replace(",", ".", $value);
        return doubleval($value);
    }

    function getBooleanOptionValue($value) {
        $value = trim($value);
        return $value == "+";
    }

    function clear_products() {
        $model = DB::loadModel("excel/excel");
        $model->clear_products();
    }
}