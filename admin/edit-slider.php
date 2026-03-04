<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$sliderFile = 'slides.json';
$slides = [];

if (file_exists($sliderFile)) {
    $slides = json_decode(file_get_contents($sliderFile), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['slides'])) {
        $slides = $_POST['slides'];
        file_put_contents($sliderFile, json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: edit-slider.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Slider | Admin</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    input, textarea { width: 100%; padding: 8px; margin: 5px 0; }
    .block { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; background: #f9f9f9; position: relative; }
    button { padding: 10px 15px; margin-top: 10px; cursor: pointer; }
    .remove-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: crimson;
      color: white;
      border: none;
      padding: 5px 10px;
    }
  </style>
</head>
<body>
  <h2>Edit Image + Text Slider</h2>
  <?php if (isset($_GET['success'])) echo '<p style="color: green;">Saved successfully!</p>'; ?>

  <form method="POST">
    <div id="slides-container">
      <?php foreach ($slides as $i => $slide): ?>
        <div class="block">
          <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Delete</button>
          <label>Image Path:<br><input type="text" name="slides[<?= $i ?>][image]" value="<?= htmlspecialchars($slide['image']) ?>"></label><br>
          <label>Text:<br><textarea name="slides[<?= $i ?>][text]"><?= htmlspecialchars($slide['text']) ?></textarea></label>
        </div>
      <?php endforeach; ?>
    </div>
    <button type="button" onclick="addSlideBlock()">Add More</button>
    <button type="submit">Save</button>
  </form>

<script>
function addSlideBlock() {
  const container = document.getElementById('slides-container');
  const index = container.children.length;
  const div = document.createElement('div');
  div.className = 'block';
  div.innerHTML = `
    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Delete</button>
    <label>Image Path:<br><input type="text" name="slides[${index}][image]"></label><br>
    <label>Text:<br><textarea name="slides[${index}][text]"></textarea></label>
  `;
  container.appendChild(div);
}
</script>
</body>
</html>
