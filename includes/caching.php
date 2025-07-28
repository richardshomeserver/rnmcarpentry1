<?php
// === CONFIGURATION ===
$cacheDir = __DIR__ . '/cache/';
$cacheTTL = 3600; // 1 hour

// Ensure the cache directory exists
if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// === HELPERS ===

/**
 * Generate a secure, hashed cache key based on the request URL
 */
function generateCacheKey(): string {
    $url = $_SERVER['REQUEST_URI'];
    // Optionally: normalize or strip query strings if you don't need them
    return hash('sha256', $url);
}

/**
 * Get the absolute and validated path to a cache file
 */
function getCacheFilePath(string $key): ?string {
    global $cacheDir;

    $cacheFile = $cacheDir . $key . '.cache';
    $realCacheFile = realpath($cacheFile);

    // If file doesn't exist yet, realpath returns false
    if ($realCacheFile === false && str_contains($cacheFile, '..') === false) {
        return $cacheFile; // Safe to create
    }

    // Validate the resolved path is still inside the cache directory
    $realCacheDir = realpath($cacheDir);
    if ($realCacheFile && strpos($realCacheFile, $realCacheDir) === 0) {
        return $realCacheFile;
    }

    return null; // Invalid / malicious path
}

/**
 * Safely read the cached file content
 */
function getCachedPage(string $key, int $ttl): ?string {
    $filePath = getCacheFilePath($key);
    if (!$filePath || !file_exists($filePath)) return null;

    if (filemtime($filePath) + $ttl > time() && is_readable($filePath)) {
        return file_get_contents($filePath);
    }
    return null;
}

/**
 * Save the generated content to a cache file
 */
function saveCache(string $key, string $content): void {
    $filePath = getCacheFilePath($key);
    if ($filePath) {
        file_put_contents($filePath, $content, LOCK_EX);
    }
}

/**
 * Start caching (checks for cached content and serves it if available)
 */
function startCaching(): void {
    global $cacheTTL;
    $key = generateCacheKey();
    $cachedContent = getCachedPage($key, $cacheTTL);

    if ($cachedContent !== null) {
        header('X-Cache: HIT');
        echo $cachedContent;
        exit;
    }

    ob_start();
}

/**
 * End caching (stores output in cache and prints it)
 */
function endCaching(): void {
    $key = generateCacheKey();
    $content = ob_get_clean();

    // Optional: sanitize or validate here if dynamic user input is involved
    saveCache($key, $content);
    echo $content;
}
