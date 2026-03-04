<?php
/**
 * PHP Built-in Dev Server Router
 * Usage: php -S localhost:8000 -t "c:\Users\Sahil\Desktop\presscouncil" router.php
 *
 * Allows clean URLs (no .php / .html extension in browser)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve existing real files (images, css, js, uploads, etc.) directly
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// Strip trailing slash (except root)
$path = rtrim($uri, '/') ?: '/index';

// Try .php, then .html
foreach (['.php', '.html'] as $ext) {
    $file = __DIR__ . $path . $ext;
    if (file_exists($file)) {
        // Set REQUEST_URI without extension so PHP scripts that read it are clean
        $_SERVER['SCRIPT_FILENAME'] = $file;
        $_SERVER['SCRIPT_NAME']     = $path . $ext;
        include $file;
        exit;
    }
}

// 404
http_response_code(404);
echo '<h1>404 — Page Not Found</h1>';
