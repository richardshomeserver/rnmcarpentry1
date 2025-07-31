<?php require_once './includes/minify.php';
require_once './includes/functions.php';
require_once './includes/caching.php';
startCaching();
$yachtingFolders = getProjectFolders('./images/portfolio/Yachting');

$projects = getProjectFolders('./images/portfolio/Yachting');

$anchors = [];

foreach ($projects as $projPath) {
    $folder = basename($projPath);
    $txtFiles = glob(__DIR__ . "/images/portfolio/Yachting/{$folder}/main/*.txt");

    if ($txtFiles && !empty($txtFiles)) {
        // get filename without extension
        $filename = pathinfo($txtFiles[0], PATHINFO_FILENAME);
    } else {
        $filename = $folder;
    }

    // normalize it for use as anchor id
    $anchorId = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $filename));
    $anchors[$folder] = [
        'title'    => $filename,
        'anchorId' => $anchorId
    ];
}

?>
<!doctype html>
<html lang=en>

<head>
  <meta charset=UTF-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <meta name=description content="Richard Matthews, skilled carpenter and bespoke cabinet maker specializing in luxury yachts and personal projects.">
  <title>Richard Matthews | Portfolio</title>
  <link rel=icon href=./images/favicon.ico type=image/x-icon>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css rel=stylesheet>
  <link rel=stylesheet href=./styles/styles.css>
</head>

<body class=bg-light>
  <?php include './includes/navbar.php'; ?>
  <section id=hero aria-label=Introduction class="vh-100 d-flex flex-column align-items-center justify-content-center bg-dark text-white text-center position-relative" style=padding-top:70px>
    <img src=./images/profile_picture.webp alt="Profile Picture" class=rounded-circle>
    <div class=hero-text>
      <h1 class="display-4 fw-bold">Hi, I'm Richard Matthews</h1>
      <p class=lead>Carpenter • Qualified Bespoke Cabinet Maker • Shipwright</p>
    </div>
    <a href=#about class=scroll-indicator style=cursor:pointer>
      <span>Scroll for more</span>
      <div class=arrows>
        <div class=arrow></div>
        <div class=arrow></div>
        <div class=arrow></div>
      </div>
    </a>
  </section>
  <section class="container-fluid py-5 bg-light" id=about aria-label="About Me">
    <div class=container>
      <div class="text-center text-dark mb-4">
        <h2>About Me</h2>
        <div class="section-underline mx-auto"></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8 text-center text-dark">
          <p>
            I’m Richard Matthews, a skilled carpenter with expertise in bespoke cabinetry and shipwright work. I am passionate about craftsmanship and quality in every project I undertake. Whether working on luxury yachts or personal projects, my goal is to bring your vision to life with precision and care.
          </p>
        </div>
      </div>
    </div>
  </section>
  <section id=yachting-work aria-label="My Yachting Work" class="portfolio-grid-wrapper container-fluid py-5 bg-light">
    <div class="section-heading text-center text-dark">
      <h2>My Yachting Work</h2><br>
      <div class=section-underline></div>
    </div>
    <div class="portfolio-grid container">
      <?php renderPortfolioCards($yachtingFolders); ?>
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
