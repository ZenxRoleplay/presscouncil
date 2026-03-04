<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$contactsFile = 'contacts.json';
$contacts = [];

if (file_exists($contactsFile)) {
    $contacts = json_decode(file_get_contents($contactsFile), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['contacts'])) {
        $contacts = $_POST['contacts'];
        file_put_contents($contactsFile, json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: edit-contact-us.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Contact Page | Admin</title>
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
  <h2>Edit Contact Page</h2>
  <?php if (isset($_GET['success'])) echo '<p style="color: green;">Saved successfully!</p>'; ?>

  <form method="POST">
    <div id="contacts-container">
      <?php foreach ($contacts as $i => $contact): ?>
        <div class="block">
          <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Delete</button>
          <label>Heading:<br><input type="text" name="contacts[<?= $i ?>][heading]" value="<?= htmlspecialchars($contact['heading'] ?? '') ?>"></label><br>
          <h3>Address <?= $i + 1 ?>: <input type="text" name="contacts[<?= $i ?>][title]" value="<?= htmlspecialchars($contact['title']) ?>" style="width: 80%; font-size: 1.1em; font-weight: bold;"></h3>
          <label>Address:<br><textarea name="contacts[<?= $i ?>][address]"><?= htmlspecialchars($contact['address']) ?></textarea></label><br>
          <label>Email:<br><input type="email" name="contacts[<?= $i ?>][email]" value="<?= htmlspecialchars($contact['email']) ?>"></label><br>
          <label>Phone:<br><input type="text" name="contacts[<?= $i ?>][phone]" value="<?= htmlspecialchars($contact['phone']) ?>"></label>
        </div>
      <?php endforeach; ?>
    </div>
    <button type="button" onclick="addContactBlock()">Add More</button>
    <button type="submit">Save</button>
  </form>

<script>
function addContactBlock() {
  const container = document.getElementById('contacts-container');
  const index = container.children.length;
  const div = document.createElement('div');
  div.className = 'block';
  div.innerHTML = `
    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Delete</button>
    <label>Heading:<br><input type="text" name="contacts[${index}][heading]"></label><br>
    <h3>Address ${index + 1}: <input type="text" name="contacts[${index}][title]" style="width: 80%; font-size: 1.1em; font-weight: bold;"></h3>
    <label>Address:<br><textarea name="contacts[${index}][address]"></textarea></label><br>
    <label>Email:<br><input type="email" name="contacts[${index}][email]"></label><br>
    <label>Phone:<br><input type="text" name="contacts[${index}][phone]"></label>
  `;
  container.appendChild(div);
}
</script>
</body>
</html>
