<header class="repeatable-header">
  <h1 class="hidden">Week van de mobiliteit</h1>
  <div class="left-side">
    <picture class="logo">
      <source sizes="20vw" srcset="assets/img/logo.webp 390w,
                                   assets/img/logo-300.webp 300w,
                                   assets/img/logo-200.webp 200w,
                                   assets/img/logo-150.webp 150w" type="image/webp">

                                   <source sizes="20vw" srcset="assets/img/logo.png 390w,
                                                                assets/img/logo-300.png 300w,
                                                                assets/img/logo-200.png 200w,
                                                                assets/img/logo-150.png 150w" type="image/png">
      <img src="assets/img/logo.png" alt="logo">
    </picture>
  </div>
  <div class="right-side">
    <nav>
      <a href="index.php">Home</a>
      <a href="#">Over</a>
      <a href="?page=events">acties</a>
      <a href="?page=organiseEvent" class="button green-button">organiseer een actie</a>
    </nav>
    <h2 class="title event-title"><?php echo $event['title']; ?></h2>
    <img src="assets/img/skateboard.png" alt="rollerskate">
  </div>
</header>

<main class="wrapper detail-grid">
  <div class="thumbnail" style="background-image: url(assets/thumbnails/<?php echo $event['code']; ?>.jpg)"></div>
  <div class="important-info">
    <p><?php

    $str = 'Locatie<br />';

    if ($event['address'] != 'Diverse locaties') {
      $str .= $event['location'] . '<br />' . $event['address'] . '<br />' . $event['postal'] . ' ' . $event['city'];
    } else {
      $str .= $event['address'];
    }

    echo $str;

    ?></p>
    <p class="detail-date"><?php
    $date = new DateTime($event['start']);
    echo 'Datum<br />' . $date->format('d/m/Y');
    ?></p>
    <p class="detail-time"><?php
      $startTime = new DateTime($event['start']);
      $startTime = $startTime->format('H:i');

      $endTime = new DateTime($event['end']);
      $endTime = $endTime->format('H:i');

      echo 'Start - einde<br />' . $startTime . 'u - ' . $endTime . 'u';
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
