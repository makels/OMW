<?php
/**
 * Created by PhpStorm.
 * User: zerg
 * Date: 28.03.16
 * Time: 13:33
 */
Class Model_Events extends DB {

  private $table_events = "`gis_events`";

  public function addEvent($data) {
    $time = strtotime($data["event_date"]);
    $date = date('Y-m-d',$time);
    return $this->insert(sprintf("INSERT INTO %s (`event_date`, `title`, `description`, `x`, `y`, `file`) VALUES ('%s', '%s', '%s', %.7f, %.7f, '%s')",
        $this->table_events,
        $date,
        $data["title"],
        $data["description"],
        $data["x"],
        $data["y"],
        $data["file"])
    );
  }

  public function deleteEvent($id) {
    $this->execute("DELETE FROM `gis_events` WHERE `id` = " . $id);
  }

  public function getEvents($start, $end) {
    $time = strtotime($start);
    $start = date('Y-m-d',$time);
    $time = strtotime($end);
    $end = date('Y-m-d',$time);

    return $this->getRows(sprintf("SELECT * FROM %s WHERE `event_date` > '%s' AND `event_date` < '%s'", $this->table_events, $start, $end));
  }

  public function removeEvent($id) {
    $this->execute(sprintf("DELETE FROM %s WHERE `id` = %d", $this->table_events, $id));

  }

}