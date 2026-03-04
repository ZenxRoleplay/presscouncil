<?php
$uploadDir = "../uploads/slider/";
$jsonFile = "slides.json";

if (!isset($_FILES['slide']) || !isset($_POST['caption']) || !isset($_POST['fontSize'])) {
    die("Missing required fields");
}

$caption = $_POST['caption'];
$fontSize = intval($_POST['fontSize']);

$filename = time() . "_" . basename($_FILES['slide']['name']);
$targetPath = $uploadDir . $filename;

if (move_uploaded_file($_FILES['slide']['tmp_name'], $targetPath)) {
    $slides = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
    array_unshift($slides, [
        "image" => $targetPath,
        "caption" => $caption,
        "fontSize" => $fontSize
    ]);
    file_put_contents($jsonFile, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    echo "Uploaded successfully.";
} else {
    echo "Upload failed.";
}
?>
