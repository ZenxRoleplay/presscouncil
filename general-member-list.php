<?php
include 'admin/db.php';

// Pagination
$limit = 25;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total members
$total_result = $conn->query("SELECT COUNT(*) AS total FROM members");
$total_members = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_members / $limit);

// Get paginated members
$result = $conn->query("SELECT * FROM members ORDER BY id ASC LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>General Member List | Press Council of Maharashtra</title>
  <link rel="icon" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin: 15px auto;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      font-size: 14px;
      max-width: 200px;
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
      text-align: left;
      height: 35px;
      vertical-align: middle;
    }
    th {
      background-color: #004080;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    h2 {
      text-align: center;
      color: #004080;
    }
    .form-header {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      padding: 5px;
    }
    .form-subtitle{
      font-weight: bold;
      font-size: 12px;
    }
    .print-button {
      text-align: center;
      margin: 20px;
    }
    .print-button button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #004080;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .pagination {
      text-align: center;
      margin: 20px;
    }
    .pagination a {
      display: inline-block;
      padding: 6px 12px;
      background: #004080;
      color: white;
      text-decoration: none;
      margin: 0 3px;
      border-radius: 4px;
    }
    .pagination a.active {
      background: #ff5722;
    }

    /* Print styles */
    @media print {
      body {
        margin: 0;
        background: white;
      }
      th, td{
          font-size: 11px;
      }

      .print-button,
      .pagination,
      header,
      footer,
      .page-buttons,
      .scrolling-text-container {
        display: none !important;
      }

      table {
        width: 100%;
        page-break-inside: auto;
      }

      tr {
        page-break-inside: avoid;
        page-break-after: auto;
      }

      tr.page-break {
        page-break-after: always;
      }
    }
    
    /* LETTER HEAD AT TIME OF PRINTING */
    .print-letterhead {
  display: none;
}

@media print {
  .print-letterhead {
    display: block;
    margin-bottom: 20px;
    }
}
  </style>
</head>
<body>

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

<div class="print-letterhead">
  <img src="letterhead.jpg" alt="Letterhead" style="width: 100%; max-height: 200px; object-fit: contain;">
</div>

<!-- Main Content -->

<div class="print-button">
  <button onclick="showPasswordPrompt()">🖨 Print Form “J”</button>
</div>
 <h2 class="heading">LIST OF REGISTERED MEMBERS </h2>
<!-- Password Prompt Modal -->
<div id="passwordModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
  <div style="background:#fff; padding:20px; max-width:300px; margin:100px auto; border-radius:8px; text-align:center;">
    <h3>Enter Admin Password</h3>
    <input type="password" id="printPassword" placeholder="Enter password" style="padding:8px; width:90%; margin-bottom:10px;" />
    <br>
    <button onclick="checkPrintPassword()">Submit</button>
    <button onclick="closeModal()">Cancel</button>
    <p id="errorMsg" style="color:red; display:none;">Incorrect password!</p>
    </div>
</div>

<div class="table-scroll-wrapper">
<table>
  <thead>
    <tr>
      <td colspan="5" class="form-header">
        Form “J”<br>
        <span class="form-subtitle">(See Rule 33)</span>
      </td>
    </tr>
    <tr>
      <th style="width: 10%">Sr. No.</th>
      <th style="width: 25%">Full Name of the Member</th>
      <th style="width: 55%">Full Address</th>
      <th style="width: 15%">Class of Member</th>
     </tr>
  </thead>
  <tbody>
    <?php 
    $sr = ($page - 1) * $limit + 1;
    $row_count = 0;
    while ($row = $result->fetch_assoc()):
      $name = htmlspecialchars(trim($row['title'] . ' ' . $row['surname'] . ' ' . $row['name'] . ' ' . $row['middle_name']));
      $addressParts = [
        $row['house_number'],
        $row['village'],
        $row['taluka'],
        $row['district'],
        $row['state'],
        $row['pin_code']
      ];
      $fullAddress = htmlspecialchars(implode(', ', array_filter($addressParts)));
      $row_count++;
    ?>
    <tr<?= ($row_count % 25 == 0) ? ' class="page-break"' : '' ?>>
      <td><?= $sr++ ?></td>
      <td><?= $name ?></td>
      <td><?= $fullAddress ?></td>
      <td><?= htmlspecialchars($row['class_of_member']) ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>

<!-- Pagination -->
<div class="pagination">
  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
  <?php endfor; ?>
</div>

<!-- FOOTER -->
<?php include 'includes/footer.php'; ?>
<script>
  function showPasswordPrompt() {
    document.getElementById('passwordModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('passwordModal').style.display = 'none';
    document.getElementById('printPassword').value = '';
    document.getElementById('errorMsg').style.display = 'none';
  }

  function checkPrintPassword() {
    const enteredPassword = document.getElementById('printPassword').value;
    const correctPassword = "7666"; // 🔒 Change this to your secret password

    if (enteredPassword === correctPassword) {
      closeModal();
      window.print();
    } else {
      document.getElementById('errorMsg').style.display = 'block';
    }
    }
</script>

</body>
</html>
