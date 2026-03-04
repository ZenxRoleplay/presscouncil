<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Slide Admin Panel</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    img { height: 100px; margin: 5px; border: 1px solid #ccc; }
    .slide-box { display: flex; align-items: center; flex-wrap: wrap; margin-bottom: 10px; }
    .slide-box input[type="text"], .slide-box input[type="number"], .slide-box button {
      margin: 5px 8px;
    }
    #slides { margin-top: 20px; }
    
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
<h2>Upload New Slide</h2>
<form id="uploadForm" enctype="multipart/form-data">
  <input type="file" name="slide" required><br><br>
  <input type="text" name="caption" placeholder="Enter caption (optional)"><br><br>
  <input type="number" name="fontSize" placeholder="Font size (default 16)" value="16"><br><br>
  <button type="submit">Upload</button>
</form>

<h2>Manage Slides</h2>
<div id="slides"></div>

<script>
async function loadSlides() {
  const res = await fetch('slides.json');
  const slides = await res.json();
  const container = document.getElementById('slides');
  container.innerHTML = '';

slides.forEach((slide, index) => {
  const caption = slide.caption || '';
  const fontSize = slide.fontSize || 16;

  const div = document.createElement('div');
  div.className = 'slide-box';
  div.innerHTML = `
    <img src="${slide.image}" />
    <textarea id="caption-${index}" placeholder="Caption" style="width: 600px; height: 75px;">${caption}</textarea>
    <input type="number" value="${fontSize}" id="fontsize-${index}" style="width: 60px;" />
    <button onclick="saveCaption(${index})">💾 Save</button>
    <button onclick="deleteSlide('${slide.image}')">🗑️</button>
    <button ${index === 0 ? 'disabled' : ''} onclick="moveSlide(${index}, -1)">↑</button>
    <button ${index === slides.length - 1 ? 'disabled' : ''} onclick="moveSlide(${index}, 1)">↓</button>
  `;
  container.appendChild(div);
});
}

async function saveCaption(index) {
  const caption = document.getElementById(`caption-${index}`).value;
  const fontSize = parseInt(document.getElementById(`fontsize-${index}`).value) || 16;
  await fetch('edit-caption.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ index, caption, fontSize })
  });
  loadSlides();
}

async function deleteSlide(path) {
  if (!confirm("Are you sure?")) return;
  await fetch('delete.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ path })
  });
  loadSlides();
}

async function moveSlide(index, direction) {
  await fetch('reorder.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ index, direction })
  });
  loadSlides();
}

document.getElementById('uploadForm').addEventListener('submit', async function (e) {
  e.preventDefault();
  const formData = new FormData(this);
  await fetch('upload.php', {
    method: 'POST',
    body: formData
  });
  this.reset();
  loadSlides();
});

loadSlides();
</script>

</body>
</html>
