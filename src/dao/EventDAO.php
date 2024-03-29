<?php
require_once __DIR__ . '/DAO.php';
class EventDAO extends DAO {

  public function filter($tags, $days, $location) {
    $sql = "SELECT *, ma3_auto_events.id as `event_id` FROM `ma3_auto_events` LEFT OUTER JOIN `ma3_auto_events_organisers` ON ma3_auto_events.id = ma3_auto_events_organisers.event_id LEFT OUTER JOIN `ma3_auto_organisers` ON ma3_auto_organisers.id = ma3_auto_events_organisers.organiser_id LEFT OUTER JOIN `ma3_auto_events_tags` ON ma3_auto_events.id = ma3_auto_events_tags.event_id LEFT OUTER JOIN `ma3_auto_tags` ON ma3_auto_tags.id = ma3_auto_events_tags.tag_id";

      if (!empty($tags) || !empty($days) || !empty($location)) {

        $sql .= ' WHERE ';

        if(!empty($tags)) {
          $i = 0;

          $sql .= '(';
          foreach($tags as $tag) {
            $sql .= "`tag` = '" . $tag . "' ";
            if ($i < count($tags) - 1) {
              $sql .= 'or ';
            }
            $i++;
          }
          $sql .= ')';
        }

        if (!empty($days)) {
          if(!empty($tags)) {
            $sql .= 'AND ';
          }

          $i = 0;

          $sql .= '(';
          foreach($days as $day) {
            $sql .= "(`start` > '2018-09-" . $day . " 00:00:00' AND `end` < '2018-09-" . $days[count($days)-1] . " 23:59:59')";
            $sql .= "OR (`end` > '2018-09-" . $days[count($days)-1] . " 00:00:00' AND `start` < '2018-09-" . $day . " 00:00:00')";
            if ($i < count($days) - 1) {
              $sql .= 'or ';
            }
            $i++;
          }
          $sql .= ')';

        }

        if (!empty($location)) {

          if(!empty($days) || !empty($tags)) {
            $sql .= 'AND ';
          }

          $sql .= "(`city` LIKE '" .$location ."%' or `postal` LIKE '" . $location . "%' or `city` = 'Diverse Steden')";

        }

      }

      $sql .=  "GROUP BY ma3_auto_events.id ORDER BY ma3_auto_events.id";

      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function search($conditions = array()) {
    $sql = "SELECT DISTINCT
      ma3_auto_events.*
      FROM `ma3_auto_events`
      LEFT OUTER JOIN `ma3_auto_events_organisers` ON ma3_auto_events.id = ma3_auto_events_organisers.event_id
      LEFT OUTER JOIN `ma3_auto_organisers` ON ma3_auto_organisers.id = ma3_auto_events_organisers.organiser_id
      LEFT OUTER JOIN `ma3_auto_events_tags` ON ma3_auto_events.id = ma3_auto_events_tags.event_id
      LEFT OUTER JOIN `ma3_auto_tags` ON ma3_auto_tags.id = ma3_auto_events_tags.tag_id
      WHERE 1
    ";
    $conditionSqls = array();
    $conditionParams = array();
    //handle the conditions
    $conditionsSqls = array();
    $i = 0;
    foreach($conditions as &$condition) {
      if(empty($condition['comparator'])) {
        $condition['comparator'] = '=';
      }
      $comparator = DAO::getSanitizedComparator($condition['comparator']);
      $columnName = DAO::getSanitizedColumnName($condition['field']);
      //special columns?
      if($columnName == 'organiser_id') {
        $columnName = 'ma3_auto_organisers.id';
      } else if($columnName == 'organiser') {
        $columnName = 'ma3_auto_organisers.name';
      } else if($columnName == 'tag_id') {
        $columnName = 'ma3_auto_tags.id';
      } else if($columnName == 'tag') {
        $columnName = 'ma3_auto_tags.tag';
      }
      //handle functions
      if(!empty($condition['function'])) {
        $function = DAO::getSanitizedFunction($condition['function']);
        $columnName = "{$function}({$columnName})";
      }
      $conditionSqls[] = "{$columnName} {$comparator} :{$i}";
      if($comparator == 'like') {
        $conditionParams[$i] = '%' . $condition['value'] . '%';
      } else {
        $conditionParams[$i] = $condition['value'];
      }
      $i++;
    }
    if(!empty($conditionSqls)) {
      $sql .= 'AND ' . implode(' AND ', $conditionSqls);
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($conditionParams);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($result)) {
      return $result;
    }
    $eventIds = $this->_getEventIdsFromResult($result);
    $tagsByEventId = $this->_getTagsForEventIds($eventIds);
    $organisersByEventId = $this->_getOrganisersForEventIds($eventIds);
    //handle the tags & organisers in the foreach loop - we want to see all tags for a given event
    foreach($result as &$row) {
      $row['tags'] = array();
      if(!empty($tagsByEventId[$row['id']])) {
        $row['tags'] = $tagsByEventId[$row['id']];
      }
      $row['organisers'] = array();
      if(!empty($organisersByEventId[$row['id']])) {
        $row['organisers'] = $organisersByEventId[$row['id']];
      }
    }
    return $result;
  }

  public function selectById($id) {
    $sql = "SELECT * FROM `ma3_auto_events` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function selectThreeLatest() {
    $sql = "SELECT * FROM `ma3_auto_events` ORDER BY `id` DESC LIMIT 3";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
  }

  private function _getEventIdsFromResult(&$result) {
    $eventIds = array();
    foreach($result as &$row) {
      $eventIds[] = $row['id'];
    }
    return $eventIds;
  }

  private function _getOrganisersForEventIds($eventIds) {
    $organisersByEventId = array();
    $eventIdsImploded = implode(', ', $eventIds);
    $sql = "SELECT
      ma3_auto_organisers.*,
      ma3_auto_events_organisers.event_id
      FROM `ma3_auto_organisers`
      RIGHT OUTER JOIN `ma3_auto_events_organisers` ON ma3_auto_events_organisers.organiser_id = ma3_auto_organisers.id
      WHERE ma3_auto_events_organisers.event_id IN ({$eventIdsImploded})
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      if(empty($organisersByEventId[$row['event_id']])) {
        $organisersByEventId[$row['event_id']] = array();
      }
      $organisersByEventId[$row['event_id']][] = $row;
    }
    return $organisersByEventId;
  }

  private function _getTagsForEventIds($eventIds) {
    $tagsByEventId = array();
    $eventIdsImploded = implode(', ', $eventIds);
    $sql = "SELECT
      ma3_auto_tags.*,
      ma3_auto_events_tags.event_id
      FROM `ma3_auto_tags`
      RIGHT OUTER JOIN `ma3_auto_events_tags` ON ma3_auto_events_tags.tag_id = ma3_auto_tags.id
      WHERE ma3_auto_events_tags.event_id IN ({$eventIdsImploded})
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      if(empty($tagsByEventId[$row['event_id']])) {
        $tagsByEventId[$row['event_id']] = array();
      }
      $tagsByEventId[$row['event_id']][] = $row;
    }
    return $tagsByEventId;
  }

}
