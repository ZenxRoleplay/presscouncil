<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$newsId = $_GET['id'] ?? '';
$newsFile = 'news.json';
$newsData = [];

if (file_exists($newsFile)) {
    $json = file_get_contents($newsFile);
    $newsData = json_decode($json, true);
}

// Find the news item by ID
$editNews = null;
foreach ($newsData as $item) {
    if ($item['id'] === $newsId) {
        $editNews = $item;
        break;
    }
}

if (!$editNews) {
    die("News not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $intro = $_POST['intro'] ?? '';
    $details = $_POST['details'] ?? '';
    $image = $editNews['image']; // Default: existing image

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $imgPath = 'uploads/' . time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);
        $image = $imgPath;
    }

    foreach ($newsData as &$item) {
        if ($item['id'] === $newsId) {
            $item['title'] = $title;
            $item['intro'] = $intro;
            $item['details'] = $details;
            $item['image'] = $image;
            break;
        }
    }

    file_put_contents($newsFile, json_encode($newsData, JSON_PRETTY_PRINT));
    header("Location: news-admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit News</title>
  <style>
    input, textarea, button { display: block; width: 100%; margin: 10px 0; padding: 8px; }
    img { max-width: 200px; display: block; margin-bottom: 10px; }
  </style>
</head>
<body>
<h1>Edit News</h1>
<form method="POST" enctype="multipart/form-data">
  <label>Title</label>
  <input type="text" name="title" value="<?= htmlspecialchars($editNews['title']) ?>" required>

  <label>Intro</label>
  <textarea name="intro" required><?= htmlspecialchars($editNews['intro']) ?></textarea>

  <label>Full Details</label>
  <textarea name="details" rows="6" required><?= htmlspecialchars($editNews['details']) ?></textarea>

  <label>Current Image</label>
  <img src="<?= $editNews['image'] ?>" alt="Current Image">

  <label>Upload New Image (optional)</label>
  <input type="file" name="image">

  <button type="submit">Save Changes</button>
</form>
</body>
</html>
