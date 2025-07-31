<?php 

// Helper function to get anchors from a folder path
function getAnchorsFromFolder(string $path): array {
    $folders = array_filter(glob("$path/*"), 'is_dir');
    $anchors = [];
    foreach ($folders as $projPath) {
        $folderName = basename($projPath);
        $txtFiles = glob("$projPath/main/*.txt");
        if (!empty($txtFiles)) {
            $txtPath = $txtFiles[0];
            $title = pathinfo($txtPath, PATHINFO_FILENAME);
        } else {
            $title = $folderName;
        }
        $anchors[$folderName] = $title;
    }
    return $anchors;
}

$portfolioAnchors = getAnchorsFromFolder('./images/portfolio/Yachting');
$personalAnchors  = getAnchorsFromFolder('./images/personal_projects/Personal');
$currentAnchors   = getAnchorsFromFolder('./images/personal_projects/current_projects');

?>

<style>
  .dropdown-menu.scrollable-menu {
    max-height: 60vh;       /* limit dropdown height relative to viewport */
    overflow-y: auto;       /* enable vertical scrolling */
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="#">RNMCarpentry</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <!-- Portfolio Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
             href="https://rnmcarpentry.co.uk"
             id="projectsDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            Portfolio
          </a>
          <ul class="dropdown-menu dropdown-menu-end scrollable-menu" aria-labelledby="projectsDropdown">
            <?php foreach ($portfolioAnchors as $folder => $title):
              $anchor = strtolower(str_replace(' ', '-', $title));
            ?>
            <li>
              <a class="dropdown-item" href="https://rnmcarpentry.co.uk#<?=htmlspecialchars($anchor)?>" data-project="<?=htmlspecialchars($folder)?>">
                <?=htmlspecialchars($title)?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <!-- Personal Projects Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
             href="../personal_projects.php"
             id="personalProjectsDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            Personal Projects
          </a>
          <ul class="dropdown-menu dropdown-menu-end scrollable-menu" aria-labelledby="personalProjectsDropdown">

            <!-- Personal Projects Group -->
            <li><a class="nav-link" href="./personal_projects.php"><h6 class="dropdown-header">Personal Projects</h6></a></li>
            <?php foreach ($personalAnchors as $folder => $title):
              $anchor = strtolower(str_replace(' ', '-', $title));
            ?>
            <li>
              <a class="dropdown-item" href="./personal_projects.php#<?=htmlspecialchars($anchor)?>" data-project="<?=htmlspecialchars($folder)?>">
                <?=htmlspecialchars($title)?>
              </a>
            </li>
            <?php endforeach; ?>

            <li><hr class="dropdown-divider"></li>

            <!-- Current Projects Group -->
            <li><a class="nav-link" href="./personal_projects.php#current-projects"><h6 class="dropdown-header">Current Projects</h6></a></li>
            <?php foreach ($currentAnchors as $folder => $title):
              $anchor = strtolower(str_replace(' ', '-', $title));
            ?>
            <li>
              <a class="dropdown-item" href="./personal_projects.php#<?=htmlspecialchars($anchor)?>" data-project="<?=htmlspecialchars($folder)?>">
                <?=htmlspecialchars($title)?>
              </a>
            </li>
            <?php endforeach; ?>

          </ul>
        </li>

        <!-- Other links -->
        <li class="nav-item"><a class="nav-link" href="./cv.php">CV</a></li>
        <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

  // Hover dropdown behavior for desktop
  function handleHover(e, add) {
    const dropdown = e.currentTarget;
    const toggle = dropdown.querySelector('a[data-bs-toggle="dropdown"]');
    const menu = dropdown.querySelector('.dropdown-menu');
    if (window.innerWidth > 992) {
      if (add) {
        dropdown.classList.add('show');
        toggle.classList.add('show');
        menu.classList.add('show');
        toggle.setAttribute('aria-expanded','true');
      } else {
        dropdown.classList.remove('show');
        toggle.classList.remove('show');
        menu.classList.remove('show');
        toggle.setAttribute('aria-expanded','false');
      }
    }
  }

  document.querySelectorAll('.navbar .dropdown').forEach(function(drop){
    drop.addEventListener('mouseover', e => handleHover(e, true));
    drop.addEventListener('mouseleave', e => handleHover(e, false));
  });

  // Parent link navigation on desktop
  document.querySelectorAll('.dropdown > a').forEach(link => {
    link.addEventListener('click', function(e){
      if (window.innerWidth > 992) {
        window.location = this.href;
      }
    });
  });

  // Close dropdown after clicking a dropdown item
  document.querySelectorAll('.dropdown-menu a.dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
      const dropdown = item.closest('.dropdown');
      if (!dropdown) return;
      const toggle = dropdown.querySelector('a[data-bs-toggle="dropdown"]');
      if (!toggle) return;
      const dropdownInstance = bootstrap.Dropdown.getInstance(toggle);
      if (dropdownInstance) dropdownInstance.hide();
    });
  });

  // Smooth scroll or navigate for personal/current projects links
  document.querySelectorAll('.dropdown-menu a.dropdown-item').forEach(link => {
    link.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (!href) return;

      // Handle personal/current projects links (relative URL)
      if (href.startsWith('./current_projects.php#')) {
        const anchor = href.split('#')[1];
        if (!anchor) return;

        const currentPage = window.location.pathname.split('/').pop();
        if (currentPage === 'current_projects.php') {
          e.preventDefault();
          const target = document.getElementById(anchor);
          if (target) {
            // Close dropdown
            const dropdown = this.closest('.dropdown');
            if (dropdown) {
              const toggle = dropdown.querySelector('a[data-bs-toggle="dropdown"]');
              const dropdownInstance = bootstrap.Dropdown.getInstance(toggle);
              if (dropdownInstance) dropdownInstance.hide();
            }
            // Scroll with offset
            const yOffset = -70;
            const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({top: y, behavior: 'smooth'});
          }
        }
        // else allow default navigation to page with anchor
      }

      // Handle portfolio links (absolute URL)
      if (href.startsWith('https://rnmcarpentry.co.uk#')) {
        const anchor = href.split('#')[1];
        if (!anchor) return;

        const currentHost = window.location.hostname;
        const currentPath = window.location.pathname.replace(/\/$/, ''); // remove trailing slash
        const isHomePage = (currentHost === 'rnmcarpentry.co.uk' || currentHost === 'www.rnmcarpentry.co.uk') 
                           && (currentPath === '' || currentPath === '/');

        if (isHomePage) {
          e.preventDefault();
          const target = document.getElementById(anchor);
          if (target) {
            // Close dropdown
            const dropdown = this.closest('.dropdown');
            if (dropdown) {
              const toggle = dropdown.querySelector('a[data-bs-toggle="dropdown"]');
              const dropdownInstance = bootstrap.Dropdown.getInstance(toggle);
              if (dropdownInstance) dropdownInstance.hide();
            }
            // Scroll with offset
            const yOffset = -70;
            const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({top: y, behavior: 'smooth'});
          }
        }
        // else allow default navigation to homepage with anchor
      }
    });
  });

});
</script>
