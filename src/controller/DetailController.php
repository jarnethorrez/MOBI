<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'TagDAO.php';

class DetailController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
    $this->tagDAO = new TagDAO();
  }

  public function index() {
    if(!empty($_GET['e'])) {
        $event = $this->eventDAO->selectById($_GET['e']);
        $this->set('event', $event);
    } else {
      Header('Location: index.php');
    }
  }
}
?>
