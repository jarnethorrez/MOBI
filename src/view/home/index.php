<header class="home-header">
  <h1 class="hidden">Week van de mobiliteit</h1>
  <div class="left-side">
    <img src="assets/img/logo.png" alt="logo" class="logo">
    <img src="assets/img/car.png" alt="car" class="car" align="right">
  </div>
  <div class="right-side">
    <nav>
      <a href="index.php">Home</a>
      <a href="#">Over</a>
      <a href="?page=events">acties</a>
      <a href="?page=organiseEvent" class="button green-button">organiseer een actie</a>
    </nav>
    <p class="tagline">Help ons<br />om mee(r) te autominderen</p>
    <img src="assets/img/rollerskate.png" alt="rollerskate">
  </div>
</header>
<main>
  <section class="over">
    <div class="inner">
      <img src="assets/img/image-collection.png" alt="collectie van foto's">
      <div class="text">
        <h2>Over de week</h2>
        <p>Elk jaar zet de Week van de Mobiliteit (16 – 22 september)
Vlaanderen #goedopweg om mee(r) te autominderen. Tal van acties tijdens de Week doen ons stil staan bij ons verplaatsingsgedrag en laten proeven van de alternatieven. Want wie de overstap maakt ontdekt zelf de voordelen van het stappen, trappen, trein/tram/bus of autodelen.</p>
      </div>
      <a href="#" class="button white-outline-button wide-button">lees meer</a>
    </div>
  </section>

  <section class="importantDates">
    <h2 class="hidden">important dates</h2>
    <article class="importantDate whiteText autovrije">
      <h3>16 SEPT <span class="divider"></span> Autovrije zondag</h3>
      <p>We starten de week goed met autovrije zondag. Het centrum van verschillende steden wordt afgezet en in plaats van files vullen toffe activiteiten de straten.</p>
      <a href="#" class="button white-outline-button wide-button">Lees meer</a>
    </article>

    <article class="importantDate">
      <h3>20 SEPT <span class="divider"></span> Car Free Day</h3>
      <p>Een kleine  uitdaging op donderdag. Laat de wagen thuis en probeer eens een andere mogelijkheid om op het werk te raken!</p>
      <a href="#" class="button black-outline-button wide-button">Lees meer</a>
    </article>

    <article class="importantDate whiteText strap">
      <h3>21 SEPT <span class="divider"></span> STRAPdag</h3>
      <p>Om de schoolweek af te sluiten worden kinderen
van meer dan 1.200 meewerkende scholen
aangemoedigd om naar school te stappen of trappen</p>
      <a href="#" class="button white-outline-button wide-button">Lees meer</a>
    </article>
  </section>

  <section class="recent">

    <img src="assets/img/train.png" alt="trein">

    <div class="recent-data">
      <h2>Recent toegevoegde acties</h2>
      <?php foreach($events as $event): ?>
        <article class="event-card">
          <div class="event-card-image" style="background-image: url(assets/thumbnails/<?php echo $event['code']?>.jpg);"></div>
          <h3><?php echo $event['title']; ?></h3>
          <div class="dateTime">
            <p class="date"><?php
               $date = new DateTime($event['start']);
               echo $date->format('d/m/Y');
            ?></p>
            <p class="time"><?php
              $startTime = new DateTime($event['start']);
              $startTime = $startTime->format('H:i');

              $endTime = new DateTime($event['end']);
              $endTime = $endTime->format('H:i');

              echo $startTime . ' - ' . $endTime;
            ?></p>
          </div>

          <p class="location"><?php echo $event['city']; ?></p>

          <p class="info"><?php
            $content = strip_tags($event['content']);
            if (strlen($content) > 140) {
              $content = substr($content, 0, 140);
            }
            $content .= '...';
            echo $content;
          ?></p>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="buttons">
      <a href="?page=events" class="button green-button">bekijk alle activiteiten</a>
      <a href="?page=organiseEvent" class="button blue-button">organiseer een activiteiten</a>
    </div>
  </section>
</main>
