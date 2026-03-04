<?php
include 'includes/db.php';

if (!isset($_GET['official_id'], $_GET['password'])) {
  exit('Invalid access.');
}

$officialId = intval($_GET['official_id']);
$password = $_GET['password'];

// Fetch official from database
$stmt = $conn->prepare("SELECT appointment_letter, letter_password FROM officials WHERE id = ?");
$stmt->bind_param("i", $officialId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $official = $result->fetch_assoc();

  // Check if password matches
  if ($password === $official['letter_password']) {
    $file = 'uploads/officials/letters/' . $official['appointment_letter'];
    
    if (file_exists($file)) {
      // Force download
      header('Content-Description: File Transfer');
      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . basename($file) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      readfile($file);
      exit;
    } else {
      exit("Appointment letter file not found.");
    }
  } else {
    exit("Incorrect password.");
  }
} else {
  exit("Official not found.");
}
?>
