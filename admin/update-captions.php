<?php
session_start();
if (!isset($_SESSION['admin'])) {
    http_response_code(403);
    exit('Unauthorized');
}

$data = json_decode(file_get_contents('php://input'), true);
$index = $data['index'];
$caption = $data['caption'];

$file = 'slides.json';

if (!file_exists($file)) {
    echo json_encode(["error" => "File not found"]);
    exit;
}

$slides = json_decode(file_get_contents($file), true);

if (!isset($slides[$index])) {
    echo json_encode(["error" => "Invalid index"]);
    exit;
}

$slides[$index]['caption'] = $caption;
file_put_contents($file, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo json_encode(["success" => true]);
