<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$mysqli = new mysqli("localhost", "sahil", "Pcm66220666*", "pcm_website");
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = '';
$edit_member = null;

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
            header("Location: modify-members.php?updated=1");
            exit();
        } else {
            $message = "Update failed: " . $stmt->error;
        }
    } else {
        $message = implode("<br>", $errors);
    }
}

if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = $mysqli->query("SELECT * FROM members WHERE id = $edit_id LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $edit_member = $res->fetch_assoc();
    }
}

$members = $mysqli->query("SELECT * FROM members ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modify Members</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f0f0; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 800px; margin: auto; }
        input, select, textarea { width: 100%; padding: 8px; margin: 10px 0; }
        input[type=submit] { background: #007BFF; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background: #0056b3; }
        .message { margin: 10px auto; padding: 10px; background: #d4edda; color: #155724; max-width: 800px; border-radius: 5px; }
        .error { background: #f8d7da; color: #721c24; }
        table { width: 100%; margin-top: 30px; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #007BFF; color: white; }
    </style>
    <script>
        function toggleOtherState(value) {
            const otherStateInput = document.getElementById("otherStateInput");
            otherStateInput.style.display = value === "Other" ? "block" : "none";
        }
    </script>
</head>
<body>

<?php if ($message): ?>
    <div class="message error"><?php echo $message; ?></div>
<?php elseif (isset($_GET['updated'])): ?>
    <div class="message">Member updated successfully.</div>
<?php endif; ?>

<?php if ($edit_member): ?>
<h2>Edit Member #<?php echo $edit_member['id']; ?></h2>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $edit_member['id']; ?>">

    <select name="title" required>
        <option value="">Select Title</option>
        <?php foreach (['Shri', 'Smt.', 'Kumari'] as $t): ?>
            <option value="<?= $t ?>" <?= $edit_member['title'] == $t ? 'selected' : '' ?>><?= $t ?></option>
        <?php endforeach; ?>
    </select>

    <input type="text" name="surname" value="<?= htmlspecialchars($edit_member['surname']) ?>" placeholder="Surname" required>
    <input type="text" name="name" value="<?= htmlspecialchars($edit_member['name']) ?>" placeholder="First Name" required>
    <input type="text" name="middle_name" value="<?= htmlspecialchars($edit_member['middle_name']) ?>" placeholder="Middle Name" required>

    <select name="gender" required>
        <option value="">Select Gender</option>
        <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
            <option value="<?= $g ?>" <?= $edit_member['gender'] == $g ? 'selected' : '' ?>><?= $g ?></option>
        <?php endforeach; ?>
    </select>

    <input type="date" name="dob" value="<?= $edit_member['dob'] ?>" required>
    <input type="text" name="aadhar_number" value="<?= $edit_member['aadhar_number'] ?>" placeholder="Aadhar Number" required>
    <input type="text" name="pan_card_number" value="<?= $edit_member['pan_card_number'] ?>" placeholder="PAN Card Number" required>

    <input type="text" name="house_number" value="<?= $edit_member['house_number'] ?>" placeholder="House Number" required>
    <input type="text" name="village" value="<?= $edit_member['village'] ?>" placeholder="Village" required>
    <input type="text" name="taluka" value="<?= $edit_member['taluka'] ?>" placeholder="Taluka" required>
    <input type="text" name="district" value="<?= $edit_member['district'] ?>" placeholder="District" required>

    <select name="state" onchange="toggleOtherState(this.value)" required>
        <option value="">Select State</option>
        <?php foreach (['Maharashtra', 'NCR New Delhi', 'Other'] as $s): ?>
            <option value="<?= $s ?>" <?= $edit_member['state'] == $s ? 'selected' : '' ?>><?= $s ?></option>
        <?php endforeach; ?>
    </select>

    <input type="text" id="otherStateInput" name="other_state" value="<?= htmlspecialchars($edit_member['other_state']) ?>" placeholder="Specify Other State" style="display: <?= $edit_member['state'] == 'Other' ? 'block' : 'none' ?>;">

    <input type="text" name="pin_code" value="<?= $edit_member['pin_code'] ?>" placeholder="Pin Code" required>
    <input type="text" name="mobile" value="<?= $edit_member['mobile'] ?>" placeholder="Mobile Number" required>
    <input type="email" name="email" value="<?= $edit_member['email'] ?>" placeholder="Email Address" required>

    <input type="text" name="class_of_member" value="<?= $edit_member['class_of_member'] ?>" placeholder="Class of Member" required>
    <input type="date" name="registration_date" value="<?= $edit_member['registration_date'] ?>" required>
    <textarea name="remarks" placeholder="Remarks"><?= htmlspecialchars($edit_member['remarks']) ?></textarea>

    <input type="submit" name="update_member" value="Update Member">
</form>
<?php endif; ?>

<h2>All Members</h2>
<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $members->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] . ' ' . $row['name'] . ' ' . $row['middle_name'] . ' ' . $row['surname'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><a href="?edit=<?= $row['id'] ?>">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
