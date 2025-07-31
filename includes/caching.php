<?php
// CONFIG
$cacheDir = __DIR__ . '/cache/';
$cacheTTL = 0; // Cache never expires

if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

function generateCacheKey(): string {
    return hash('sha256', $_SERVER['REQUEST_URI']);
}

function getCacheFilePath(string $key): ?string {
    global $cacheDir;
    $file = $cacheDir . $key . '.cache';
    $real = realpath($file);
    $realDir = realpath($cacheDir);
    if (($real === false && !str_contains($file, '..')) || ($real && str_starts_with($real, $realDir))) {
        return $file;
    }
    return null;
}

function getCachedPage(string $key, int $ttl): ?string {
    $path = getCacheFilePath($key);
    if (!$path || !file_exists($path)) return null;
    if (filemtime($path) + $ttl < time() || !is_readable($path)) return null;
    return file_get_contents($path);
}

function saveCache(string $key, string $content): void {
    $path = getCacheFilePath($key);
    if ($path) {
        file_put_contents($path, $content, LOCK_EX);
    }
}

function startCaching(): void {
    global $cacheTTL;
    $key = generateCacheKey();
    $cached = getCachedPage($key, $cacheTTL);
    if ($cached !== null) {
        header('X-Cache: HIT');
        header('Vary: Accept-Encoding');
        echo $cached;
        exit;
    }
    // Use ob_gzhandler as callback so PHP handles compression automatically
    ob_start('ob_gzhandler');
}

function endCaching(): void {
    $key = generateCacheKey();
    // Flush buffer (compressed if client supports it)
    $content = ob_get_clean();
    if ($content === false) {
        // failure reading buffer
        return;
    }
    saveCache($key, $content);
    echo $content;
}
