<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login");
    exit();
}

include 'includes/db.php';
$result = $conn->query("SELECT * FROM members ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Members | Admin Panel</title>
    <h1>PRESS COUNCIL OF MAHARASHTRA</h1>
    <style>
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
            text-align: center;
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
<h2>All Registered Members</h2>

<div class="controls">
    <input type="text" id="searchInput" placeholder="Search...">

    <select id="genderFilter">
        <option value="">Filter by Gender</option>
        <?php
        $genders = $conn->query("SELECT DISTINCT gender FROM members ORDER BY gender");
        while ($gender = $genders->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($gender['gender']) . '">' . htmlspecialchars($gender['gender']) . '</option>';
        }
        ?>
    </select>
    <select id="stateFilter">
        <option value="">Filter by State</option>
        <?php
        $states = $conn->query("SELECT DISTINCT state FROM members ORDER BY state");
        while ($state = $states->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($state['state']) . '">' . htmlspecialchars($state['state']) . '</option>';
        }
        ?>
    </select>
    
    <select id="districtFilter">
        <option value="">Filter by District</option>
        <?php
        $districts = $conn->query("SELECT DISTINCT district FROM members ORDER BY district");
        while ($district = $districts->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($district['district']) . '">' . htmlspecialchars($district['district']) . '</option>';
        }
        ?>
    </select>
    
    <button id="printBtn" onclick="window.print()">🖨 Print</button>
</div>

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
        while($row = $result->fetch_assoc()): ?>
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
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="back-link">
    <a href="dashboard">← Back to Dashboard</a>
</div>

<script>
function applyFilters() {
    const searchText = document.getElementById("searchInput").value.toLowerCase();
    const selectedState = document.getElementById("stateFilter").value.toLowerCase();
    const selectedDistrict = document.getElementById("districtFilter").value.toLowerCase();
    const selectedGender = document.getElementById("genderFilter").value.toLowerCase();

    const rows = document.querySelectorAll("#membersTable tbody tr");

    rows.forEach(row => {
        const rowText = row.innerText.toLowerCase();
        const address = row.cells[7].textContent.toLowerCase(); // Full Address column
        const gender = row.cells[3].textContent.toLowerCase();  // Gender column

        const matchesSearch = rowText.includes(searchText);
        const matchesState = !selectedState || address.includes(selectedState);
        const matchesDistrict = !selectedDistrict || address.includes(selectedDistrict);
        const matchesGender = !selectedGender || gender === selectedGender;

        row.style.display = (matchesSearch && matchesState && matchesDistrict && matchesGender) ? "" : "none";
    });
}

// Bind the unified filter function to all filter inputs
document.getElementById("searchInput").addEventListener("input", applyFilters);
document.getElementById("stateFilter").addEventListener("change", applyFilters);
document.getElementById("districtFilter").addEventListener("change", applyFilters);
document.getElementById("genderFilter").addEventListener("change", applyFilters);
</script>


</body>
</html>
