<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $getData = $conn->query("SELECT photo, appointment_letter, id_card, biography FROM officials WHERE id = $id");
    if ($getData && $getData->num_rows > 0) {
        $data = $getData->fetch_assoc();

        // Delete photo
        if (!empty($data['photo']) && file_exists("../uploads/officials/" . $data['photo'])) {
            unlink("../uploads/officials/" . $data['photo']);
        }

        // Delete appointment letter
        if (!empty($data['appointment_letter']) && file_exists("../uploads/officials/letters/" . $data['appointment_letter'])) {
            unlink("../uploads/officials/letters/" . $data['appointment_letter']);
        }

        // Delete ID card
        if (!empty($data['id_card']) && file_exists("../uploads/officials/idcards/" . $data['id_card'])) {
            unlink("../uploads/officials/idcards/" . $data['id_card']);
        }

        // Delete biography PDF
        if (!empty($data['biography']) && file_exists("../uploads/officials/biographies/" . $data['biography'])) {
            unlink("../uploads/officials/biographies/" . $data['biography']);
        }
    }

    $conn->query("DELETE FROM officials WHERE id=$id");
    header("Location: manage-officials.php?deleted=1");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $appointment_date = $_POST['appointment_date'];

    // Uploads
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = time() . '_' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/officials/$photo");
    }

    $appointment_letter = '';
    if (isset($_FILES['appointment_letter']) && $_FILES['appointment_letter']['error'] == 0) {
        $appointment_letter = time() . '_' . basename($_FILES['appointment_letter']['name']);
        move_uploaded_file($_FILES['appointment_letter']['tmp_name'], "../uploads/officials/letters/$appointment_letter");
    }

    $id_card = '';
    if (isset($_FILES['id_card']) && $_FILES['id_card']['error'] == 0) {
        $id_card = time() . '_' . basename($_FILES['id_card']['name']);
        move_uploaded_file($_FILES['id_card']['tmp_name'], "../uploads/officials/idcards/$id_card");
    }

    $biography = '';
    if (isset($_FILES['biography']) && $_FILES['biography']['error'] == 0) {
        $biography = time() . '_' . basename($_FILES['biography']['name']);
        move_uploaded_file($_FILES['biography']['tmp_name'], "../uploads/officials/biographies/$biography");
    }

    $stmt = $conn->prepare("INSERT INTO officials (title, name, position, email, mobile, appointment_date, photo, appointment_letter, id_card, biography) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $title, $fullname, $position, $email, $mobile, $appointment_date, $photo, $appointment_letter, $id_card, $biography);
    $stmt->execute();

    header("Location: manage-officials.php?added=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Officials</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f0f0f0; }
        h2 { color: #333; }
        form, table { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; }
        input[type="submit"] { background: #0078D7; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        img { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; }
        .action-btns { display: flex; flex-wrap: wrap; gap: 8px }
        .action-btns a { text-decoration: none; font-size: 14px; padding: 6px 12px; border-radius: 4px; color: white; }
        .edit-btn { background: #ff9800;}
        .delete-btn { background: #f44336;}
        .back-btn { background: #555; color: white; text-decoration: none; padding: 10px 15px; display: inline-block; border-radius: 4px; margin-bottom: 20px; }
        .message { color: green; font-weight: bold; }
    </style>
</head>
<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<?php if (isset($_GET['added'])) echo "<p class='message'>Official added successfully.</p>"; ?>
<?php if (isset($_GET['deleted'])) echo "<p class='message'>Official deleted successfully.</p>"; ?>

<h2>Add New Official</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Title:</label>
    <select name="title" required>
        <option value="">Select Title</option>
        <option value="Shri">Shri</option>
        <option value="Smt.">Smt.</option>
        <option value="Kumari">Kumari</option>
    </select>

    <label>Full Name:</label>
    <input type="text" name="fullname" required>

    <label>Position:</label>
<select name="position" required>
    <option value="">-- Select Position --</option>
    <option value="Chairman">Chairman</option>
    <option value="Working President">Working President</option>
    <option value="Vice Chairman">Vice Chairman</option>
    <option value="General Secretary">General Secretary</option>
    <option value="Secretary">Secretary</option>    
    <option value="Treasurer">Treasurer</option>
    <option value="Executive Member">Executive Member</option>
</select>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Mobile:</label>
    <input type="text" name="mobile" required>

    <label>Appointment Date:</label>
    <input type="date" name="appointment_date" required>

    <label>Photo:</label>
    <input type="file" name="photo" accept="image/*" required>

    <label>Appointment Letter (PDF):</label>
    <input type="file" name="appointment_letter" accept=".pdf">

    <label>ID Card (PDF):</label>
    <input type="file" name="id_card" accept=".pdf">

    <label>Biography (PDF):</label>
    <input type="file" name="biography" accept=".pdf">

    <input type="submit" value="Add Official">
</form>

<h2>All Officials</h2>
<table id="officialsTable">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Position</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Appointment</th>
            <th>Letter</th>
            <th>ID Card</th>
            <th>Biography</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $officials = $conn->query("SELECT * FROM officials ORDER BY appointment_date DESC");
        while ($row = $officials->fetch_assoc()):
        ?>
        <tr>
            <td><img src="../uploads/officials/<?= htmlspecialchars($row['photo']) ?>"></td>
            <td><?= htmlspecialchars($row['title'] . ' ' . $row['name']) ?></td>
            <td><?= htmlspecialchars($row['position']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['mobile']) ?></td>
            <td><?= htmlspecialchars($row['appointment_date']) ?></td>
            <td>
                <?php if (!empty($row['appointment_letter'])): ?>
                    <a href="../uploads/officials/letters/<?= htmlspecialchars($row['appointment_letter']) ?>" target="_blank">View</a>
                <?php else: ?> — <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($row['id_card'])): ?>
                    <a href="../uploads/officials/idcards/<?= htmlspecialchars($row['id_card']) ?>" target="_blank">View</a>
                <?php else: ?> — <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($row['biography'])): ?>
                    <a href="../uploads/officials/biographies/<?= htmlspecialchars($row['biography']) ?>" target="_blank">View</a>
                <?php else: ?> — <?php endif; ?>
            </td>
            <td class="action-btns">
                <a href="edit-official.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="delete-btn">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#officialsTable').DataTable();
  });
</script>
</body>
</html>
