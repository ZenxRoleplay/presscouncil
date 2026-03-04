<?php
$jsonFile = "slides.json";

$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'] ?? null;
$caption = $data['caption'] ?? '';
$fontSize = $data['fontSize'] ?? 16;

if (!is_numeric($index)) {
    http_response_code(400);
    echo "Invalid input";
    exit;
}

$slides = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

if (!isset($slides[$index])) {
    http_response_code(404);
    echo "Slide not found";
    exit;
}

$slides[$index]['caption'] = $caption;
$slides[$index]['fontSize'] = intval($fontSize);

file_put_contents($jsonFile, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Caption updated";
?>
