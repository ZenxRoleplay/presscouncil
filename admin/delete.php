<?php
$jsonFile = "slides.json";

// Get JSON body
$data = json_decode(file_get_contents('php://input'), true);
$path = $data['path'] ?? '';

if (!$path || !is_string($path)) {
    http_response_code(400);
    die("Invalid path");
}

// Sanitize & restrict to uploads directory
$realBase = realpath('../uploads/slider');
$realPath = realpath($path);

if ($realPath === false || strpos($realPath, $realBase) !== 0) {
    http_response_code(403);
    die("Access denied");
}

// Delete file from disk
if (file_exists($path)) {
    unlink($path);
}

// Load and filter JSON
$slides = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

// Remove object where image matches
$slides = array_values(array_filter($slides, function ($slide) use ($path) {
    return $slide['image'] !== $path;
}));

// Save updated JSON
file_put_contents($jsonFile, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "Deleted.";
?>
