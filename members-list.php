<?php
include 'admin/db.php';

$result = $conn->query("SELECT * FROM members ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>General Member List — Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/journal.css">
  <style>
    .members-page { max-width: 1100px; margin: 28px auto 40px; padding: 0 20px; }
    .members-page h1 {
      font-family: var(--font-heading); font-size: 22px; color: var(--navy);
      margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--gold);
    }
    .members-table-wrap { overflow-x: auto; border-radius: var(--radius); box-shadow: var(--shadow-sm); }
    table {
      border-collapse: collapse; background: var(--white);
      width: 100%; min-width: 520px;
    }
    .form-header-row td {
      background: var(--navy); color: var(--white);
      text-align: center; font-family: var(--font-heading);
      font-size: 17px; padding: 14px 10px 10px; letter-spacing: 0.3px;
    }
    .form-subtitle { font-size: 13px; opacity: 0.75; margin-top: 4px; display: block; }
    th {
      background: var(--navy-mid); color: var(--white);
      padding: 10px 12px; font-size: 13px; text-align: left;
      font-family: var(--font-body); letter-spacing: 0.3px;
    }
    td {
      padding: 10px 12px; border-bottom: 1px solid var(--border-light);
      font-size: 13.5px; color: var(--text-primary); vertical-align: top;
    }
    tr:last-child td { border-bottom: none; }
    tr:nth-child(even) td { background: #f6f8fb; }
    @media (max-width: 540px) { td, th { font-size: 12px; padding: 8px; } }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <div class="members-page">
  <h1>Registered Members</h1>
  <div class="members-table-wrap">
  <table>
    <thead>
      <tr class="form-header-row">
        <td colspan="4">
          Form "J"
          <span class="form-subtitle">(See Rule 33)</span>
        </td>
      </tr>
      <tr>
        <th>Sr. No.</th>
        <th>Name</th>
        <th>Full Address</th>
        <th>Class of Member</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sr = 1;
      while ($row = $result->fetch_assoc()): 
        $name = htmlspecialchars(trim($row['title'] . ' ' . $row['full_name']));
        $addressParts = [
          $row['house_number'],
          $row['village'],
          $row['taluka'],
          $row['district'],
          $row['state'],
          $row['pin_code']
        ];
        $fullAddress = htmlspecialchars(implode(', ', array_filter($addressParts)));
      ?>
      <tr>
        <td><?= $sr++ ?></td>
        <td><?= $name ?></td>
        <td><?= $fullAddress ?></td>
        <td><?= htmlspecialchars($row['class_of_member']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  </div></div>

  <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>

