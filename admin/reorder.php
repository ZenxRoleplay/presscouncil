<?php
$jsonFile = "slides.json";

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$index = isset($data['index']) ? (int)$data['index'] : -1;
$direction = isset($data['direction']) ? (int)$data['direction'] : 0;

// Load slides
$slides = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

if (!is_array($slides) || !isset($slides[$index])) {
    http_response_code(400);
    die("Invalid index or data.");
}

$newIndex = $index + $direction;
if ($newIndex < 0 || $newIndex >= count($slides)) {
    http_response_code(400);
    die("Out of bounds");
}

// Swap
$temp = $slides[$index];
$slides[$index] = $slides[$newIndex];
$slides[$newIndex] = $temp;

// Save back
file_put_contents($jsonFile, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Reordered.";
?>
