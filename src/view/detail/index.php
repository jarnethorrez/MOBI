<header class="repeatable-header">
  <h1 class="hidden">Week van de mobiliteit</h1>
  <div class="left-side">
      <img src="assets/img/logo.png" alt="logo" class="logo">
  </div>
  <div class="right-side">
    <nav>
      <a href="index.php">Home</a>
      <a href="#">Over</a>
      <a href="?page=events">acties</a>
      <a href="?page=organiseEvent" class="button green-button">organiseer een actie</a>
    </nav>
    <h2 class="title"><?php echo $event['title']; ?></h2>
    <img src="assets/img/bike.png" alt="rollerskate">
  </div>
</header>

<main class="wrapper detail-grid">
  <div class="thumbnail" style="background-image: url(assets/thumbnails/<?php echo $event['code']; ?>.jpg)"></div>
  <div class="important-info">
    <p><?php

    if ($event['address'] != 'Diverse locaties') {
      $str = $event['location'] . '<br />' . $event['address'] . '<br />' . $event['postal'] . ' ' . $event['city'];
    } else {
      $str = $event['address'];
    }

    echo $str;

    ?></p>
    <p><?php
    $date = new DateTime($event['start']);
    echo $date->format('d/m/Y');
    ?></p>
    <p><?php
      $startTime = new DateTime($event['start']);
      $startTime = $startTime->format('H:i');

      $endTime = new DateTime($event['end']);
      $endTime = $endTime->format('H:i');

      echo $startTime . ' - ' . $endTime;
    ?></p>
  </div>
  <?php  echo $event['content']; ?>

  <?php if (!empty($event['practical'])): ?>
    <div class="praktisch">
      <h3>Praktisch</h3>
      <?php echo $event['practical']; ?>
    </div>
  <?php endif; ?>

  <div class="buttons">
    <a href="?page=events" class="button green-button wide-button">Terug naar activiteiten overzicht</a>
    <a href="<?php echo $event['link']; ?>" class="button blue-button wide-button" target="_blank">Bezoek website</a>
  </div>
</main>
