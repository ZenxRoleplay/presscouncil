<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$mysqli = new mysqli("localhost", "sahil", "Pcm66220666*", "pcm_website");
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = '';
$edit_member = null;

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_member'])) {
    $id = intval($_POST['id']);

    $title = $_POST['title'];
    $surname = trim($_POST['surname']);
    $name = trim($_POST['name']);
    $middle_name = trim($_POST['middle_name']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $aadhar_number = trim($_POST['aadhar_number']);
    $pan_card_number = strtoupper(trim($_POST['pan_card_number']));
    $house_number = trim($_POST['house_number']);
    $village = trim($_POST['village']);
    $taluka = trim($_POST['taluka']);
    $district = trim($_POST['district']);
    $state = $_POST['state'];
    $other_state = trim($_POST['other_state']);
    $pin_code = trim($_POST['pin_code']);
    $mobile = trim($_POST['mobile']);
    $email = trim($_POST['email']);
    $class_of_member = trim($_POST['class_of_member']);
    $registration_date = $_POST['registration_date'];
    $remarks = trim($_POST['remarks']);

    $errors = [];

    if (!in_array($title, ['Shri', 'Smt.', 'Kumari'])) $errors[] = "Invalid title.";
    if ($surname === '' || $name === '' || $middle_name === '') $errors[] = "Name fields required.";
    if (!in_array($gender, ['Male', 'Female', 'Other'])) $errors[] = "Invalid gender.";
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) $errors[] = "Invalid DOB.";
    if (!preg_match('/^\d{12}$/', $aadhar_number)) $errors[] = "Aadhar must be 12 digits.";
    if (!preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $pan_card_number)) $errors[] = "Invalid PAN format.";
    if (!preg_match('/^\d{6}$/', $pin_code)) $errors[] = "PIN must be 6 digits.";
    if (!preg_match('/^\d{10}$/', $mobile)) $errors[] = "Mobile must be 10 digits.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
    if ($state === 'Other' && $other_state === '') $errors[] = "Specify other state.";
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $registration_date)) $errors[] = "Invalid registration date.";

    if (empty($errors)) {
        $stmt = $mysqli->prepare("UPDATE members SET title=?, surname=?, name=?, middle_name=?, gender=?, dob=?, aadhar_number=?, pan_card_number=?, house_number=?, village=?, taluka=?, district=?, state=?, other_state=?, pin_code=?, mobile=?, email=?, class_of_member=?, registration_date=?, remarks=? WHERE id=?");
        $stmt->bind_param("ssssssssssssssssssssi", $title, $surname, $name, $middle_name, $gender, $dob, $aadhar_number, $pan_card_number, $house_number, $village, $taluka, $district, $state, $other_state, $pin_code, $mobile, $email, $class_of_member, $registration_date, $remarks, $id);
        if ($stmt->execute()) {
            $message = "Member updated successfully.";
        } else {
            $message = "Update failed: " . $stmt->error;
        }
    } else {
        $message = implode("<br>", $errors);
    }
}

// Handle edit
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = $mysqli->query("SELECT * FROM members WHERE id = $edit_id LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $edit_member = $res->fetch_assoc();
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $delete_stmt = $mysqli->prepare("DELETE FROM members WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        $message = "Member deleted successfully.";
    } else {
        $message = "Error deleting member: " . $mysqli->error;
    }
}

// Fetch all members
$members = $mysqli->query("SELECT * FROM members ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Members</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f0f0; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 800px; margin: 20px auto; }
        input, select, textarea { width: 100%; padding: 8px; margin: 10px 0; }
        input[type=submit] { background: #007BFF; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background: #0056b3; }
        .message { margin: 10px auto; padding: 10px; background: #d4edda; color: #155724; max-width: 800px; border-radius: 5px; }
        .error { background: #f8d7da; color: #721c24; }
        table { width: 100%; margin-top: 30px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #007BFF; color: white; }
        a.btn { padding: 5px 10px; text-decoration: none; background: #007BFF; color: white; border-radius: 4px;}
        a.btn:hover { background: #0056b3; }
        .delete-btn { background: #dc3545; }
        .delete-btn:hover { background: #c82333; }
        
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        h1{
            text-align: center;
            font-size: 40px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .controls {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }
        input[type="text"], select {
            padding: 8px;
            font-size: 14px;
        }
        button#printBtn {
            padding: 8px 14px;
            background-color: #0078D7;
            color: white;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 10px;
            cursor: pointer;
        }
        th {
            background: #0078D7;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .back-link {
            margin-top: 20px;
            text-align: left;
        }
                   .action-buttons{
                white-space: nowrap;
            }
            .action-buttons a.btn{
                display: inline-block;
                margin-right: 6px;
                margin-left: 4px;
            }
        @media print {
            @page {
                size: A3 landscape;
                margin: 10mm;
            }
            .controls, .back-link {
                display: none;
            }
    }
    </style>
</head>
<body>


<div class="back-link">
    <a href="dashboard.php">← Back to Dashboard</a>
</div>


<?php if ($message): ?>
    <div class="message"><?= $message ?></div>
<?php endif; ?>

<?php if ($edit_member): ?>
    <form method="POST">
        <h2>Edit Member</h2>
        <label>Member ID (PCM Allotted ID)</label>
        <input type="text" value="<?= htmlspecialchars($edit_member['member_id']) ?>" readonly>

        <input type="hidden" name="id" value="<?= $edit_member['id'] ?>">

        <label>Title</label>
        <select name="title">
            <?php foreach (['Shri', 'Smt.', 'Kumari'] as $t): ?>
                <option value="<?= $t ?>" <?= $edit_member['title'] == $t ? 'selected' : '' ?>><?= $t ?></option>
            <?php endforeach; ?>
        </select>

        <label>Surname</label>
        <input type="text" name="surname" value="<?= htmlspecialchars($edit_member['surname']) ?>" required>

        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($edit_member['name']) ?>" required>

        <label>Middle Name</label>
        <input type="text" name="middle_name" value="<?= htmlspecialchars($edit_member['middle_name']) ?>" required>

        <label>Gender</label>
        <select name="gender">
            <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
                <option value="<?= $g ?>" <?= $edit_member['gender'] == $g ? 'selected' : '' ?>><?= $g ?></option>
            <?php endforeach; ?>
        </select>

        <label>Date of Birth</label>
        <input type="date" name="dob" value="<?= $edit_member['dob'] ?>">

        <label>Aadhar Number</label>
        <input type="text" name="aadhar_number" value="<?= htmlspecialchars($edit_member['aadhar_number']) ?>">

        <label>PAN Card Number</label>
        <input type="text" name="pan_card_number" value="<?= htmlspecialchars($edit_member['pan_card_number']) ?>">

        <label>House Number</label>
        <input type="text" name="house_number" value="<?= htmlspecialchars($edit_member['house_number']) ?>">

        <label>Village</label>
        <input type="text" name="village" value="<?= htmlspecialchars($edit_member['village']) ?>">

        <label>Taluka</label>
        <input type="text" name="taluka" value="<?= htmlspecialchars($edit_member['taluka']) ?>">

        <label>District</label>
        <input type="text" name="district" value="<?= htmlspecialchars($edit_member['district']) ?>">

        <label>State</label>
        <select name="state" onchange="toggleOtherState(this.value)">
            <?php foreach (['Maharashtra', 'Other'] as $s): ?>
                <option value="<?= $s ?>" <?= $edit_member['state'] == $s ? 'selected' : '' ?>><?= $s ?></option>
            <?php endforeach; ?>
        </select>

        <label id="otherStateInput" style="<?= $edit_member['state'] === 'Other' ? '' : 'display:none;' ?>">Other State</label>
        <input type="text" name="other_state" value="<?= htmlspecialchars($edit_member['other_state']) ?>" style="<?= $edit_member['state'] === 'Other' ? '' : 'display:none;' ?>">

        <label>PIN Code</label>
        <input type="text" name="pin_code" value="<?= htmlspecialchars($edit_member['pin_code']) ?>">

        <label>Mobile</label>
        <input type="text" name="mobile" value="<?= htmlspecialchars($edit_member['mobile']) ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($edit_member['email']) ?>">

        <label>Class of Member</label>
        <select name="class of member">
            <?php foreach (['General', 'Life', 'Honorary'] as $t): ?>
                <option value="<?= $t ?>" <?= $edit_member['class_of_member'] == $t ? 'selected' : '' ?>><?= $t ?></option>
            <?php endforeach; ?>
        </select>
        
        <label>Registration Date</label>
        <input type="date" name="registration_date" value="<?= $edit_member['registration_date'] ?>">

        <label>Remarks</label>
        <textarea name="remarks"><?= htmlspecialchars($edit_member['remarks']) ?></textarea>

        <input type="submit" name="update_member" value="Update Member">
    </form>
<?php endif; ?>

<h2>All Members</h2>
<table id="membersTable">
    <thead>
        <tr>
            <th>Sr No.</th>
            <th>Member ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Aadhar</th>
            <th>PAN</th>
            <th>Full Address</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Member Class</th>
            <th>Reg. Date</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sr_no = 1;
        while($row = $members->fetch_assoc()): ?>
        <tr>
            <td><?= $sr_no++ ?></td>
            <td><?= htmlspecialchars($row['member_id'] ?? '') ?></td>
            <td><?= htmlspecialchars(trim($row['title'] . ' ' . $row['full_name'])) ?></td>
            <td><?= htmlspecialchars($row['gender'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['dob'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['aadhar_number'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['pan_card_number'] ?? '') ?></td>
            <td>
                <?= htmlspecialchars(
                    trim(
                        ($row['house_number'] ?? '') . ', ' .
                        ($row['village'] ?? '') . ', ' .
                        ($row['taluka'] ?? '') . ', ' .
                        ($row['district'] ?? '') . ', ' .
                        ($row['state'] ?? '') . ' - ' .
                        ($row['pin_code'] ?? '')
                    )
                ) ?>
            </td>
            <td><?= htmlspecialchars($row['mobile'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['class_of_member'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['registration_date'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['remarks'] ?? '') ?></td>
            <td class="action-buttons">
                    <a href="?edit=<?= $row['id'] ?>" class="btn">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
// 🔍 Search filter
document.getElementById("searchInput").addEventListener("keyup", function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll("#membersTable tbody tr");

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});

// 🗂 State filter
document.getElementById("stateFilter").addEventListener("change", function () {
    filterBy("state", this.value.toLowerCase());
});

// 🗂 District filter
document.getElementById("districtFilter").addEventListener("change", function () {
    filterBy("district", this.value.toLowerCase());
});

function filterBy(type, value) {
    const columnIndex = 7; // Address column
    const rows = document.querySelectorAll("#membersTable tbody tr");

    rows.forEach(row => {
        const cell = row.cells[columnIndex].textContent.toLowerCase();
        const visible = !value || cell.includes(value);
        row.style.display = visible ? "" : "none";
    });
}
</script>

</body>
</html>
