<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';

class HomeController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
  }

  public function index() {
    $events = $this->eventDAO->selectThreeLatest();
    $this->set('events', $events);

    $this->set('pagetitle', 'Week van de mobiliteit - Home');
  }

}

?>
