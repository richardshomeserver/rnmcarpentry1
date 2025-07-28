<?php require_once './includes/minify.php';
require_once './includes/functions.php';
require_once './includes/caching.php';
startCaching();
$baseDirs = ['./images/current_projects', './images/portfolio'];
$cacheKey = 'gallery_folders_' . hash('sha256', implode(',', $baseDirs));
$folders = getCachedData($cacheKey);
if ($folders === null) {
  $folders = [];
  foreach ($baseDirs as $baseDir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseDir), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $fileInfo) {
      $basename = $fileInfo->getBasename();
      if ($fileInfo->isDir() && $basename !== '.' && $basename !== '..' && $basename !== 'main') {
        $folders[] = $fileInfo->getPathname();
      }
    }
  }
  setCachedData($cacheKey, $folders);
} ?>

<!doctype html>
<html lang=en>

<head>
  <meta charset=UTF-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <title>Gallery | Richard Matthews</title>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css rel=stylesheet>
  <link href=https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css rel=stylesheet>
  <link href="./styles/styles.css?v=<?= time() ?>" rel=stylesheet>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js async></script>
</head>

<body class="gallery-page bg-white">
  <?php include './includes/navbar.php'; ?>
  <div class=container>
    <?php foreach ($folders as $folder): $folderName = basename($folder);
      $folderLabel = ucwords(str_replace('_', ' ', $folderName));
      $safeID = str_replace([' ', '_'], '-', strtolower($folderName));
      $folderImages = getImageFiles($folder);
      if (empty($folderImages)) continue;
      usort($folderImages, fn($a, $b) => filemtime($a) <=> filemtime($b)); ?>
      <h2 class="text-dark mb-1"><?= htmlspecialchars($folderLabel) ?></h2>
      <div class="section-underline mx-auto"></div>
      <div class=gallery id="gallery-<?= htmlspecialchars($safeID) ?>">
        <?php foreach ($folderImages as $i => $path): $relativePath = str_replace('./', '', $path);
          $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $path);
          $webpExists = file_exists($webpPath);
          $relativeWebp = str_replace('./', '', $webpPath);
          $size = @getimagesize($path);
          $width = $size[0] ?? 300;
          $height = $size[1] ?? 200;
          $aspectRatio = $height > 0 ? round(($height / $width) * 100, 2) : 66; ?>
          <div class=collage-item data-aos=fade-up style="--aspect-ratio: <?= $aspectRatio ?>%">
            <a href="<?= htmlspecialchars($relativePath) ?>" class=glightbox data-gallery="gallery-<?= htmlspecialchars($safeID) ?>">
              <picture>
                <?php if ($webpExists): ?>
                  <?php if ($i < 6): ?>
                    <source srcset="<?= htmlspecialchars($relativeWebp) ?>" type=image/webp>
                  <?php else: ?>
                    <source data-srcset="<?= htmlspecialchars($relativeWebp) ?>" type=image/webp>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if ($i < 6): ?>
                  <img src="<?= htmlspecialchars($relativePath) ?>" alt="Gallery image <?= $i + 1 ?> from <?= $folderLabel ?>" loading=eager decoding=async fetchpriority=high width="<?= $width ?>" height="<?= $height ?>">
                <?php else: ?>
                  <img data-src="<?= htmlspecialchars($relativePath) ?>" alt="Gallery image <?= $i + 1 ?> from <?= $folderLabel ?>" class=lazyload loading=lazy decoding=async fetchpriority=low width="<?= $width ?>" height="<?= $height ?>">
                <?php endif; ?>
              </picture>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php include './includes/footer.php'; ?>
  <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js></script>
  <script src=https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js></script>
  <script src=https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js></script>
  <script src=https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js async></script>
  <script src=./scripts/scripts.js></script>
</body>

</html>
<?php endCaching();
