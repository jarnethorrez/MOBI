<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title><?php echo $pagetitle; ?></title>
    <?php echo $css;?>
  </head>
  <body>

    <div class="container">
      <div class="mobile-nav">
        <a href="index.php">Home</a>
        <a href="#">Over</a>
        <a href="?page=events">acties</a>
        <a href="?page=organiseEvent">organiseer een actie</a>
      </div>
      <?php if(!empty($_SESSION['info'])): ?><div class="alert alert-success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
      <?php if(!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?php echo $_SESSION['error'];?></div><?php endif; ?>

      <?php echo $content; ?>
    </div>

    <footer>
      <div class="wrapper footer-flex">
        <div class="info">
          <p>De week van de mobiliteit is een initiatief van het Netwerk Duurzame Mobiliteit (Komimo vzw)</p>
          <p>Kasteellaan 349a<br />9000 Gent</p>
          <p>09 331 59 10</p>
          <p>info@duurzame-mobiliteit.be</p>
        </div>
        <div class="social">
          <a href="https://www.facebook.com/Weekvandemobiliteit"><img src="assets/img/facebook.png" /></a>
          <a href="https://www.facebook.com/Weekvandemobiliteit"><img src="assets/img/instagram.png" /></a>
          <a href="https://www.facebook.com/Weekvandemobiliteit"><img src="assets/img/twitter.png" /></a>
        </div>
      </div>
    </footer>
    <?php echo $js;?>
    <script>
      WebFontConfig = {
        custom: {
          families: ['Futura'],
          urls: ['assets/fonts/Futura/futura.css']
        }
      };

      (function(d) {
        var wf = d.createElement('script'), s = d.scripts[0];
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
      })(document);
   </script>
  </body>
</html>
