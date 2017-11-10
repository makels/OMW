<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.01.2016
 * Time: 15:06
 */

Class Module_Events extends Module_Base {

  function render() {

    $smarty = $this->registry->get("smarty");
    return $smarty->fetch(SITE_PATH . "/modules/events/tmpl/events.tpl");

  }


  function addEvent() {
    $date = Http::post("event_date");
    $x = Http::post("add_event_x");
    $y = Http::post("add_event_y");
    $title = Http::post("event_title");
    $description = Http::post("add_event_text");
    $file = basename($_FILES['event_file']['name']);
    if($file != "") {
      $upload_file = UPLOAD_DIR . "/" . basename($_FILES['event_file']['name']);
      if(file_exists($upload_file)) unlink($upload_file);
      move_uploaded_file($_FILES['event_file']['tmp_name'], $upload_file);
    }

    $events_model = DB::loadModel("events/events");
    $id = $events_model->addEvent(array(
      "event_date" => $date,
      "title" => $title,
      "description" => $description,
      "x" => $x,
      "y" => $y,
      "file" => $file = basename($_FILES['event_file']['name']),
    ));
    Http::redirect("/");
  }

  function getEvents() {
    $start = Http::post("start");
    $end = Http::post("end");
    $events_model = DB::loadModel("events/events");
    $events = $events_model->getEvents($start, $end);
    echo json_encode($events);
  }

  function removeEvent() {
    $id = Http::post("id");
    $events_model = DB::loadModel("events/events");
    $events_model->removeEvent($id);
    echo json_encode(array());
  }

}