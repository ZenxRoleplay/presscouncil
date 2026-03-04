<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'db.php';

// Sanitize input from POST
$title = htmlspecialchars(trim($_POST['title']));
$surname = htmlspecialchars(trim($_POST['surname']));
$name = htmlspecialchars(trim($_POST['name']));
$middle_name = htmlspecialchars(trim($_POST['middle_name']));
$gender = htmlspecialchars(trim($_POST['gender']));
$dob = htmlspecialchars(trim($_POST['dob']));
$aadhar_number = htmlspecialchars(trim($_POST['aadhar_number']));
$pan_card_number = htmlspecialchars(trim($_POST['pan_card_number']));
$house_number = htmlspecialchars(trim($_POST['house_number']));
$village = htmlspecialchars(trim($_POST['village']));
$taluka = htmlspecialchars(trim($_POST['taluka']));
$district = htmlspecialchars(trim($_POST['district']));
$state = htmlspecialchars(trim($_POST['state']));
$other_state = isset($_POST['other_state']) ? htmlspecialchars(trim($_POST['other_state'])) : '';
$pin_code = htmlspecialchars(trim($_POST['pin_code']));
$mobile = htmlspecialchars(trim($_POST['mobile']));
$email = htmlspecialchars(trim($_POST['email']));
$class_of_member = htmlspecialchars(trim($_POST['class_of_member']));
$registration_date = htmlspecialchars(trim($_POST['registration_date']));
$remarks = htmlspecialchars(trim($_POST['remarks']));

// If state is "Other", override with other_state input
if ($state === "Other" && !empty($other_state)) {
    $state = $other_state;
}

// Combine full name (surname + middle + name)
$full_name = trim($surname . ' ' . $middle_name . ' ' . $name);

// Basic required fields validation
if (empty($full_name) || empty($mobile) || empty($class_of_member)) {
    echo "Please fill all required fields (Full Name, Mobile, and Class of Member).";
    exit;
}

// Prepare SQL INSERT query
$sql = "INSERT INTO members (
    title, surname, name, middle_name, full_name, gender, dob,
    aadhar_number, pan_card_number, house_number, village, taluka, district, state, pin_code, 
    mobile, email, class_of_member, registration_date, remarks
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Prepare failed: " . $conn->error;
    exit;
}

// Bind parameters and execute insert
$stmt->bind_param(
    "ssssssssssssssssssss",
    $title, $surname, $name, $middle_name, $full_name, $gender, $dob,
    $aadhar_number, $pan_card_number, $house_number, $village, $taluka, $district, $state, $pin_code,
    $mobile, $email, $class_of_member, $registration_date, $remarks
);

if ($stmt->execute()) {
    // Get the newly inserted member's auto-increment id
    $inserted_id = $stmt->insert_id;

    // Extract year from registration date
    $year = date('Y', strtotime($registration_date));

    // Get last used member_id globally (irrespective of year)
    $sql_last = "SELECT member_id FROM members WHERE member_id LIKE 'PCM%' ORDER BY member_id DESC LIMIT 1";
    $result_last = $conn->query($sql_last);

    if ($result_last && $result_last->num_rows > 0) {
        $row_last = $result_last->fetch_assoc();
        $last_member_id = $row_last['member_id'];

        // Extract last 4 digits and increment
        $last_serial = intval(substr($last_member_id, -4));
        $new_serial = $last_serial + 1;
    } else {
        // No previous PCM member, start from 1
        $new_serial = 1;
    }

    // Create new member_id with current year and global serial
    $serial_number = str_pad($new_serial, 4, '0', STR_PAD_LEFT);
    $member_id = "PCM{$year}{$serial_number}";

    // Update the member with the generated member_id
    $update_sql = "UPDATE members SET member_id = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $member_id, $inserted_id);
    $update_stmt->execute();
    $update_stmt->close();

    // Redirect with success message
    header("Location: dashboard.php?message=Member added successfully");
    exit;

} else {
    // Handle insert error
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
