<?php
$targetDir = "../uploads/news/";
$jsonFile = "news.json";

// Ensure uploads folder exists with secure permissions
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

// Validate required fields
if (
    !isset($_FILES['image']) ||
    empty($_POST['title']) ||
    empty($_POST['intro']) ||
    empty($_POST['details'])
) {
    http_response_code(400);
    echo "All fields are required.";
    exit;
}

$title = trim($_POST['title']);
$intro = trim($_POST['intro']);
$details = trim($_POST['details']);

// Validate uploaded file type
$imageFile = $_FILES['image'];
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$detectedType = mime_content_type($imageFile['tmp_name']);
if (!in_array($detectedType, $allowedTypes)) {
    http_response_code(400);
    echo "Invalid file type.";
    exit;
}

$ext = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
// Optional: Extension-MIME match check
if (($detectedType == "image/jpeg" && !in_array($ext, ['jpg','jpeg'])) ||
    ($detectedType == "image/png" && $ext !== 'png') ||
    ($detectedType == "image/gif" && $ext !== 'gif') ||
    ($detectedType == "image/webp" && $ext !== 'webp')) {
    http_response_code(400);
    echo "File extension does not match MIME type.";
    exit;
}

$filename = uniqid('news_') . '.' . $ext;
$targetPath = $targetDir . $filename;

// Handle file upload
if (!move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
    http_response_code(500);
    echo "Image upload failed.";
    exit;
}

// Load existing news data
$news = [];
if (file_exists($jsonFile)) {
    $decoded = json_decode(file_get_contents($jsonFile), true);
    if (is_array($decoded)) {
        $news = $decoded;
    }
}

// Get current date and time
date_default_timezone_set('Asia/Kolkata');
$uploadDateTime = date("Y-m-d H:i:s");

// Create new news item
$newItem = [
    "id" => uniqid(),
    "image" => $targetPath,
    "title" => $title,
    "intro" => $intro,
    "details" => $details,
    "date" => $uploadDateTime
];

// Save new item
$news[] = $newItem;
if (file_put_contents($jsonFile, json_encode($news, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) === false) {
    http_response_code(500);
    echo "Failed to save news.";
    exit;
}

echo "News uploaded successfully.";
?>
