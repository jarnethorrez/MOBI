<?php
require_once __DIR__ . '/DAO.php';
class TagDAO extends DAO {
  public function getTags() {
    $sql = "SELECT `tag` FROM `ma3_auto_tags`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }
}
?>
