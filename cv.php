<?php require_once './includes/minify.php';
require_once './includes/caching.php';
startCaching(); ?>
<!doctype html>
<html lang=en>

<head>
  <meta charset=UTF-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <title>My CV</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css rel=stylesheet>
  <link defer rel=stylesheet href=./styles/styles.css>
</head>

<body class="bg-light">
  <?php include './includes/navbar.php'; ?>
  <div class=cv-page-container>
    <div class=cv-page>
      <img src=./images/cv/CV1.webp alt="CV Page 1">
    </div>
    <div class=cv-page>
      <img src=./images/cv/CV2.webp alt="CV Page 2">
    </div>
  </div>
  <?php include './includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

</body>

</html>
<?php endCaching();
