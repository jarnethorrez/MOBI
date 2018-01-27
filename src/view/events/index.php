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
    <h2 class="title">Activiteiten</h2>
    <picture class="bike">
      <source sizes="50vw" srcset="assets/img/bike.webp 283w,
                                   assets/img/bike-200.webp 200w,
                                   assets/img/bike-150.webp 150w" type="image/webp">

                                   <source sizes="20vw" srcset="assets/img/bike.png 283w,
                                                                assets/img/bike-200.png 200w,
                                                                assets/img/bike-150.png 150w" type="image/png">
      <img src="assets/img/bike.png" alt="bike">
    </picture>
  </div>
</header>
<main>
  <section class="filter">
    <div class="wrapper upper-section">
      <p class="label">Kies een of meerdere dagen</p>
      <p class="label">Plaats</p>
      <div class="days">
        <p class="day" data-day="16">16<br />SEPT</p>
        <p class="day" data-day="17">17<br />SEPT</p>
        <p class="day" data-day="18">18<br />SEPT</p>
        <p class="day" data-day="19">19<br />SEPT</p>
        <p class="day" data-day="20">20<br />SEPT</p>
        <p class="day" data-day="21">21<br />SEPT</p>
        <p class="day" data-day="22">22<br />SEPT</p>
      </div>
      <form class="" action="index.html" method="post">
        <input type="text" name="plaats" placeholder="Stad of postcode" class="input">
      </form>
    </div>

    <div class="tags">
      <div class="wrapper">
        <p class="label">Tags</p>
        <?php foreach($tags as $tag): ?>
          <p class="tag"><?php echo $tag['tag']; ?></p>
        <?php endforeach; ?>
      </div>
      </div>
  </section>

  <section class="events wrapper">

    <?php foreach($events as $event): ?>
      <article class="event-card">
        <img src="assets/thumbnails/<?php echo $event['code']?>.jpg" class="event-card-image">
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
          $content = $event['content'];
          if (strlen($content) > 140) {
            $content = substr($content, 0, 140);
          }
          $content .= '...';
          echo $content;
        ?></p>
        <a href="?page=detail&e=<?php echo $event['id']; ?>" class="button green-button wide-button">Lees Meer</a>
      </article>
    <?php endforeach; ?>
  </section>
</main>
