<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'TagDAO.php';

class EventsController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
    $this->tagDAO = new TagDAO();
  }

  public function index() {
    $conditions = Array();


    if (!empty($_POST['action']) && $_POST['action'] == 'search') {

      var_dump($_POST);

    }

    $events = $this->eventDAO->search($conditions);

    $tags = $this->tagDAO->getTags();
    $this->set('tags', $tags);
    $this->set('events', $events);

  }

}
