<?php

require_once '../../dao/EventDAO.php';

if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
  $eventDAO = new EventDAO();
  $conditions = Array();
  $events = $eventDAO->search($conditions);

  echo json_encode($events);
  exit();
}

?>
