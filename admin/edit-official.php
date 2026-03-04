<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: manage-officials.php");
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM officials WHERE id = $id");

if ($result->num_rows == 0) {
    echo "Official not found.";
    exit();
}
$official = $result->fetch_assoc();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $appointment_date = $_POST['appointment_date'];

    $photo = $official['photo'];
    if (isset($_POST['delete_photo']) && $photo) {
        $path = "../uploads/officials/" . $photo;
        if (file_exists($path)) unlink($path);
        $photo = '';
    } elseif (!empty($_FILES['photo']['name'])) {
        $photo = time() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/officials/$photo");
    }

    $appointment_letter = $official['appointment_letter'];
    if (isset($_POST['delete_appointment_letter']) && $appointment_letter) {
        $path = "../uploads/officials/letters/" . $appointment_letter;
        if (file_exists($path)) unlink($path);
        $appointment_letter = '';
    } elseif (!empty($_FILES['appointment_letter']['name'])) {
        $appointment_letter = time() . '_' . basename($_FILES['appointment_letter']['name']);
        move_uploaded_file($_FILES['appointment_letter']['tmp_name'], "../uploads/officials/letters/$appointment_letter");
    }

    $id_card = $official['id_card'];
    if (isset($_POST['delete_id_card']) && $id_card) {
        $path = "../uploads/officials/idcards/" . $id_card;
        if (file_exists($path)) unlink($path);
        $id_card = '';
    } elseif (!empty($_FILES['id_card']['name'])) {
        $id_card = time() . '_' . basename($_FILES['id_card']['name']);
        move_uploaded_file($_FILES['id_card']['tmp_name'], "../uploads/officials/idcards/$id_card");
    }

    $biography = $official['biography'];
    if (isset($_POST['delete_biography']) && $biography) {
        $path = "../uploads/officials/biographies/" . $biography;
        if (file_exists($path)) unlink($path);
        $biography = '';
    } elseif (!empty($_FILES['biography']['name'])) {
        $biography = time() . '_' . basename($_FILES['biography']['name']);
        move_uploaded_file($_FILES['biography']['tmp_name'], "../uploads/officials/biographies/$biography");
    }

    $stmt = $conn->prepare("UPDATE officials SET title=?, name=?, position=?, email=?, mobile=?, appointment_date=?, photo=?, appointment_letter=?, id_card=?, biography=? WHERE id=?");
    $stmt->bind_param("ssssssssssi", $title, $name, $position, $email, $mobile, $appointment_date, $photo, $appointment_letter, $id_card, $biography, $id);
    $stmt->execute();

    header("Location: manage-officials.php?updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Official</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        form { max-width: 650px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; }
        input[type="submit"] { background: #0078D7; color: white; border: none; cursor: pointer; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #0078D7; text-decoration: none; }
        label { font-weight: bold; }
        .section { margin-bottom: 20px; }
        .file-box { display: flex; justify-content: space-between; align-items: center; }
        .file-box a { color: #007BFF; font-size: 14px; }
        .delete-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<a class="back-btn" href="manage-officials.php">&larr; Back to Manage Officials</a>
<h2>Edit Official</h2>

<form method="POST" enctype="multipart/form-data">

    <select name="title" required>
        <option value="">Select Title</option>
        <option value="Shri" <?= $official['title'] == 'Shri' ? 'selected' : '' ?>>Shri</option>
        <option value="Smt." <?= $official['title'] == 'Smt.' ? 'selected' : '' ?>>Smt.</option>
        <option value="Kumari" <?= $official['title'] == 'Kumari' ? 'selected' : '' ?>>Kumari</option>
    </select>

    <input type="text" name="name" value="<?= htmlspecialchars($official['name']) ?>" placeholder="Full Name" required>

    <select name="position" required>
        <option value="">Select Position</option>
        <?php
        $positions = ["CHAIRMAN", "WORKING PRESIDENT", "VICE CHAIRMAN", "GENERAL SECRETARY", "SECRETARY", "TREASURER", "EXECUTIVE MEMBER"];
        foreach ($positions as $pos) {
            $selected = ($official['position'] == $pos) ? 'selected' : '';
            echo "<option value=\"$pos\" $selected>$pos</option>";
        }
        ?>
    </select>

    <input type="email" name="email" value="<?= htmlspecialchars($official['email']) ?>" placeholder="Email">
    <input type="text" name="mobile" value="<?= htmlspecialchars($official['mobile']) ?>" placeholder="Mobile">
    <input type="date" name="appointment_date" value="<?= $official['appointment_date'] ?>">

    <!-- PHOTO -->
    <div class="section">
        <label>Current Photo:</label><br>
        <?php if ($official['photo']): ?>
            <div class="file-box">
                <img src="../uploads/officials/<?= htmlspecialchars($official['photo']) ?>" alt="Photo" width="100">
                <button type="submit" class="delete-btn" name="delete_photo" value="1">Delete Photo</button>
            </div><br>
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*">
    </div>

    <!-- LETTER -->
    <div class="section">
        <label>Appointment Letter:</label><br>
        <?php if ($official['appointment_letter']): ?>
            <div class="file-box">
                <a href="../uploads/officials/letters/<?= htmlspecialchars($official['appointment_letter']) ?>" target="_blank">View Letter</a>
                <button type="submit" class="delete-btn" name="delete_appointment_letter" value="1">Delete Letter</button>
            </div><br>
        <?php endif; ?>
        <input type="file" name="appointment_letter" accept="application/pdf">
    </div>

    <!-- ID CARD -->
    <div class="section">
        <label>ID Card:</label><br>
        <?php if ($official['id_card']): ?>
            <div class="file-box">
                <a href="../uploads/officials/idcards/<?= htmlspecialchars($official['id_card']) ?>" target="_blank">View ID Card</a>
                <button type="submit" class="delete-btn" name="delete_id_card" value="1">Delete ID Card</button>
            </div><br>
        <?php endif; ?>
        <input type="file" name="id_card" accept="application/pdf,image/*">
    </div>

    <!-- BIO -->
    <div class="section">
        <label>Biography:</label><br>
        <?php if ($official['biography']): ?>
            <div class="file-box">
                <a href="../uploads/officials/biographies/<?= htmlspecialchars($official['biography']) ?>" target="_blank">View Biography</a>
                <button type="submit" class="delete-btn" name="delete_biography" value="1">Delete Biography</button>
            </div><br>
        <?php endif; ?>
        <input type="file" name="biography" accept="application/pdf">
    </div>

    <input type="submit" value="Update Official">
</form>

</body>
</html>
