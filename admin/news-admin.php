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
  <title>News Admin Panel</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h2 { margin-top: 40px; }
    input, textarea, button { display: block; width: 100%; margin: 10px 0; padding: 8px; }
    img { max-height: 100px; margin-right: 10px; }
    .news-item { display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
    .news-info { flex: 1; }
    .actions button { margin-left: 10px; }
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
<h1>Manage News</h1>

<h2>Add News</h2>
<form id="newsForm" enctype="multipart/form-data">
  <input type="file" name="image" required>
  <input type="text" name="title" placeholder="News Title" required>
  <textarea name="intro" placeholder="Short Intro (1-2 lines)" rows="2" required></textarea>
  <textarea name="details" placeholder="Full News Content (HTML or text)" rows="6" required></textarea>
  <button type="submit">Add News</button>
</form>

<h2>Existing News</h2>
<div id="newsList"></div>

<script>
async function loadNews() {
  const res = await fetch('news.json');
  const news = await res.json();
  const container = document.getElementById('newsList');
  container.innerHTML = '';

  news.forEach(item => {
    const div = document.createElement('div');
    div.className = 'news-item';
    div.innerHTML = `
      <div class="news-info">
        <img src="${item.image}" alt="news" />
        <strong>${item.title}</strong>
        <p>${item.intro}</p>
      </div>
      <div class="actions">
        <button onclick="editNews('${item.id}')">Edit</button>
        <button onclick="deleteNews('${item.id}')">Delete</button>
      </div>
    `;
    container.appendChild(div);
  });
}

async function deleteNews(id) {
  if (!confirm('Delete this news?')) return;
  await fetch('delete-news.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ id })
  });
  loadNews();
}

function editNews(id) {
  window.location.href = `edit-news.php?id=${id}`;
}


// Handle form submit
const form = document.getElementById('newsForm');
form.addEventListener('submit', async e => {
  e.preventDefault();
  const formData = new FormData(form);
  const res = await fetch('upload-news.php', { method: 'POST', body: formData });
  const msg = await res.text();
  alert(msg);
  form.reset();
  loadNews();
});

loadNews();
</script>
</body>
</html>
