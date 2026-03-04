<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

$file = '../data/about_content.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated = [
        'paragraphs' => array_filter(array_map('trim', explode("\n", $_POST['paragraphs']))),
    ];
    file_put_contents($file, json_encode($updated, JSON_PRETTY_PRINT));
    $success = true;
}

$content = json_decode(file_get_contents($file), true);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit About Content</title>
  <style>
    body { font-family: Arial; max-width: 800px; margin: auto; padding: 20px; }
    input, textarea { width: 100%; padding: 8px; margin-bottom: 15px; }
    button { padding: 10px 20px; }
    label { font-weight: bold; }
            .back-button {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #0078D7;
            font-weight: bold;
            background-color: #e3e9f0;
            padding: 8px 16px;
            border-radius: 6px;
        }
        .back-button:hover {
            background-color: #d0deed;
        }
  </style>
</head>
<body>
    <a href="dashboard.php" class="back-button">← Back to Dashboard</a>
  <h2>Edit About Page Content</h2>
  <?php if (!empty($success)) echo "<p style='color: green;'>Updated successfully!</p>"; ?>
  <form method="POST">
    
    <label>Paragraphs (each on a new line):</label>
    <textarea name="paragraphs" rows="6"><?= implode("\n", $content['paragraphs']) ?></textarea>

    <button type="submit">Save</button>
  </form>
</body>
</html>
