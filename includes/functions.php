<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Caching Setup
$cacheDir = __DIR__ . '/cache';
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

function getCachedData(string $key, int $ttl = 3600): mixed {
    global $cacheDir;
    $file = "$cacheDir/$key.cache";
    if (file_exists($file) && (filemtime($file) + $ttl > time())) {
        $fileContents = file_get_contents($file);
        if ($fileContents === false) {
            // Handle error: Unable to read the file
            error_log("Failed to read file: $file");
            return null;
        }
        $decodedData = json_decode($fileContents, true);
        if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decode error
            error_log("JSON decode error: " . json_last_error_msg());
            return null;
        }
        return $decodedData;
    }
    return null;
}

function setCachedData(string $key, mixed $data): void {
    global $cacheDir;
    $encodedData = json_encode($data);
    if ($encodedData === false) {
        // Handle error: Unable to encode data
        error_log("JSON encode error: " . json_last_error_msg());
        return;
    }
    file_put_contents("$cacheDir/$key.cache", $encodedData);
}

// Portfolio logic
function getProjectFolders(string $path): array {
    $cacheKey = 'folders_' . hash('sha256', $path);
    $cached = getCachedData($cacheKey);
    if ($cached !== null) return $cached;

    $folders = array_filter(glob("$path/*"), 'is_dir');
    natsort($folders);

    setCachedData($cacheKey, $folders);
    return $folders;
}

function getImageFiles(string $dir): array {
    return glob("$dir/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
}

function getDescriptionAndTitle(string $mainFolder, string $fallbackTitle): array {
    $txtFiles = glob("$mainFolder/*.txt");
    if (!empty($txtFiles)) {
        $txtPath = $txtFiles[0];
        $title = ucwords(str_replace(['-', '_'], ' ', pathinfo($txtPath, PATHINFO_FILENAME)));
        $description = trim(file_get_contents($txtPath));
    } else {
        $title = $fallbackTitle;
        $description = '';
    }

    return [$title, $description];
}

function getCardClass(int $imageCount): string {
    $class = 'portfolio-card';
    if ($imageCount >= 4) $class .= ' wide tall';
    elseif ($imageCount === 3) $class .= ' wide';
    elseif ($imageCount === 2) $class .= ' tall';
    return $class;
}

function renderImageLink(string $imgPath, string $galleryId): void {
    $imgUrl = str_replace('./', '', $imgPath);
    $alt = basename($imgPath);
    echo "<a href=\"$imgUrl\" class=\"glightbox\" data-gallery=\"$galleryId\">";
    echo "<img data-src=\"$imgUrl\" alt=\"$alt\" class=\"lazyload\">";
}

function renderHiddenLightboxLink(string $imgPath, string $galleryId): void {
    $imgUrl = str_replace('./', '', $imgPath);
    echo "<a href=\"$imgUrl\" class=\"glightbox d-none\" data-gallery=\"$galleryId\"></a>";
}

function renderPortfolioCards(array $folders): void {
    if (empty($folders)) {
        echo "<p>No projects found.</p>";
        return;
    }

    foreach ($folders as $folderPath) {
        $mainFolder = "$folderPath/main";
        if (!is_dir($mainFolder)) continue;

        $mainImages = getImageFiles($mainFolder);
        natsort($mainImages);
        if (empty($mainImages)) continue;

        $allImages = array_unique(array_merge(
            getImageFiles($folderPath),
            $mainImages
        ));
        natsort($allImages);

        $imgCount = count($mainImages);
        [$cardTitle, $description] = getDescriptionAndTitle($mainFolder, basename($folderPath));
        $cardClass = getCardClass($imgCount);
        $galleryId = hash('sha256', $folderPath);

        echo "<div class=\"$cardClass\" data-aos=\"fade-up\">";
        if ($imgCount === 1) {
            renderImageLink($mainImages[0], $galleryId);
        } else {
            echo "<div class=\"image-grid image-grid-" . min(4, $imgCount) . "\">";
            foreach (array_slice($mainImages, 0, 4) as $img) {
                renderImageLink($img, $galleryId);
            }
            echo "</div>";
        }

        $shown = array_map('realpath', $mainImages);
        foreach ($allImages as $img) {
            if (!in_array(realpath($img), $shown)) {
                renderHiddenLightboxLink($img, $galleryId);
            }
        }

        echo "<div class=\"content\">";
        echo "<h5>" . htmlspecialchars($cardTitle) . "</h5>";
        echo "<p>" . nl2br(htmlspecialchars($description)) . "</p>";
        echo "</div></div>";
    }
}
?>
