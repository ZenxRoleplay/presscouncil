<?php
$newsFile = 'news.json';

// Get POST JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    http_response_code(400);
    echo "Missing news ID.";
    exit;
}

$idToDelete = $data['id'];

// Load existing news
$news = file_exists($newsFile) ? json_decode(file_get_contents($newsFile), true) : [];

// Filter out the news item with matching ID
$updatedNews = array_filter($news, function($item) use ($idToDelete) {
    return $item['id'] !== $idToDelete;
});

// Save updated list
file_put_contents($newsFile, json_encode(array_values($updatedNews), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "Deleted successfully.";
?>
