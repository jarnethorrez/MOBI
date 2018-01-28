<?php

require_once '../../dao/EventDAO.php';

if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {

  $conditions = array();

  if (!empty($_POST['action']) && $_POST['action'] == 'search') {

    $days = explode(',', $_POST['days']);
    $tags = explode(',', $_POST['tags']);

  }

  $eventDAO = new EventDAO();
  $events = $eventDAO->filter($tags, $days, $_POST['location']);
  echo json_encode($events);
  exit();
}

?>
