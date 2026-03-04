<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// DB connection
$mysqli = new mysqli("localhost", "sahil", "Pcm66220666*", "pcm_website");
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Handle delete action
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $mysqli->query("DELETE FROM members WHERE id = $del_id");
    header("Location: delete-members.php?deleted=1");
    exit();
}

// Fetch members
$result = $mysqli->query("SELECT * FROM members ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Members | Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f7f9fc; }
        table { border-collapse: collapse; width: 100%; max-width: 900px; margin-bottom: 40px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #0078D7; color: white; }
        a.delete-link { color: #c0392b; text-decoration: none; }
        a.delete-link:hover { text-decoration: underline; }
        .message { max-width: 900px; margin: auto; padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px; }
    </style>
    <script>
        function confirmDelete(name, id) {
            if(confirm("Are you sure you want to delete member: " + name + " (ID: " + id + ")?")) {
                window.location.href = "delete-members.php?delete=" + id;
            }
        }
    </script>
</head>
<body>

<h2 style="text-align:center;">Delete Members</h2>

<?php if (isset($_GET['deleted'])): ?>
    <div class="message">Member deleted successfully.</div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Surname</th><th>Gender</th><th>DOB</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['surname']); ?></td>
            <td><?php echo htmlspecialchars($row['gender']); ?></td>
            <td><?php echo htmlspecialchars($row['dob']); ?></td>
            <td><a href="javascript:void(0)" class="delete-link" onclick="confirmDelete('<?php echo addslashes($row['name']); ?>', <?php echo $row['id']; ?>)">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
