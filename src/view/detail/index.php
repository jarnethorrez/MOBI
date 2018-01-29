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
    <picture class="skateboard">
      <source sizes="20vw" srcset="assets/img/skateboard.webp 390w,
                                   assets/img/skateboard-200.webp 200w,
                                   assets/img/skateboard-150.webp 150w" type="image/webp">

                                   <source sizes="20vw" srcset="assets/img/skateboard.png 390w,
                                                                assets/img/skateboard-200.png 200w,
                                                                assets/img/skateboard-150.png 150w" type="image/png">
      <img src="assets/img/skateboard.png" alt="skateboard">
    </picture>
  </div>
</header>

<main class="wrapper detail-grid">
  <picture class="thumbnail">
    <source srcset="assets/thumbnails/<?php echo $event['code']; ?>-400.webp" type="image/webp">
    <img class="thumbnail" src="assets/thumbnails/<?php echo $event['code']; ?>-400.jpg">
  </picture>
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
    $startDate = new DateTime($event['start']);
    $endDate = new DateTime($event['end']);

    $result = 'Datum<br />' . $startDate->format('d/m/Y');

    if ($endDate->format('d') > $startDate->format('d')) {
      $result .= '<br /> t.e.m. ' . $endDate->format('d/m/Y');
    }

    echo $result;
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
