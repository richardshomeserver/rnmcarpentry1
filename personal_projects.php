<?php require_once './includes/minify.php';
require_once './includes/functions.php';
require_once './includes/caching.php';
startCaching();
$yachtingFolders = getProjectFolders('./images/personal_projects/Personal');
$personalFolders = getProjectFolders('./images/personal_projects/current_projects'); ?>
<!doctype html>
<html lang=en>

<head>
  <meta charset=UTF-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <meta name=description content="Richard Matthews, skilled carpenter and bespoke cabinet maker specializing in luxury yachts and personal projects.">
  <title>Richard Matthews | Personal Projects</title>
  <link rel=icon href=./images/favicon.ico type=image/x-icon>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css rel=stylesheet>
  <link rel=stylesheet href=./styles/styles.css>
</head>

<body class=bg-light>
  <?php include './includes/navbar.php'; ?>
  <section id=personal-work aria-label="My Personal Work" class="portfolio-grid-wrapper container-fluid py-5 bg-light">
    <div class="section-heading text-center text-dark">
      <h2>My Personal Work</h2><br>
      <div class=section-underline></div>
    </div>
    <div class="portfolio-grid container">
      <?php renderPortfolioCards($yachtingFolders); ?>
    </div>
  </section>
  <section id=current-projects aria-label="My Current Projects" class="portfolio-grid-wrapper container-fluid py-5 bg-light">
    <div class="section-heading text-center text-dark">
      <h2>My Current Projects</h2><br>
      <div class=section-underline></div>
    </div>
    <div class="portfolio-grid container">
      <?php renderPortfolioCards($personalFolders); ?>
    </div>
  </section>
  <?php include './includes/footer.php'; ?>
  <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js></script>
  <script src=https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js></script>
  <script src=https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js></script>
  <script src=https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js async></script>
  <script defer src=./scripts/scripts.js></script>
</body>

</html>
<?php endCaching();
