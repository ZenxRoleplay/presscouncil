<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Member | Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 40px;
        }
        form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input, select, textarea {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0078D7;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #005ea6;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #0078D7;
            font-weight: bold;
            background-color: #e3e9f0;
            padding: 8px 16px;
            border-radius: 6px;
        }
        .back-button:hover {
            background-color: #d0deed;
        }
    </style>
</head>
<body>

<a href="dashboard.php" class="back-button">← Back to Dashboard</a>

<h2 style="text-align:center;">Add New Member</h2>

<form id="add-member-form" method="post" action="process-add-member.php">
    
    <select name="title" required>
        <option value="">Select Title</option>
        <option>Shri</option>
        <option>Smt.</option>
        <option>Kumari</option>
    </select>

    <input type="text" name="surname" placeholder="Surname" required>
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="middle_name" placeholder="Middle Name" required>

    <select name="gender" required>
        <option value="">Select Gender</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
    </select>

    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required>

    <input type="text" name="aadhar_number" id="aadhar_number" placeholder="Aadhar Number" required>

    <input type="text" name="pan_card_number" id="pan_card_number" placeholder="PAN Card Number" required>

    <input type="text" name="house_number" placeholder="House Number" required>
    <input type="text" name="village" placeholder="Village / Town" required>
    <input type="text" name="taluka" placeholder="Taluka / Block" required>
    <input type="text" name="district" placeholder="District" required>
    
    <select name="state" id="state" required onchange="handleStateChange(this)">
        <option value="">Select State</option>
        <option value="Maharashtra">Maharashtra</option>
        <option value="NCR New Delhi">NCR New Delhi</option>
        <option value="Other">Other</option>
    </select>
    <input type="text" name="other_state" id="other-state" placeholder="Enter State Name" style="display:none;">

    <input type="text" name="pin_code" id="pin_code" placeholder="Pin Code" required>
    <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" id="email" placeholder="Email" required>

    <select name="class_of_member" required>
        <option value="">Select Member Class</option>
        <option>General</option>
        <option>Life</option>
        <option>Honorary</option>
    </select>

    <label for="registration_date">Date of Registration:</label>
    <input type="date" name="registration_date" id="registration_date" required>

    <textarea name="remarks" placeholder="Remarks"></textarea>

    <input type="submit" value="Add Member">
</form>

<script>
    // Show/hide 'Other State' input field
    function handleStateChange(select) {
        const otherStateInput = document.getElementById('other-state');
        if (select.value === 'Other') {
            otherStateInput.style.display = 'block';
            otherStateInput.required = true;
        } else {
            otherStateInput.style.display = 'none';
            otherStateInput.value = '';
            otherStateInput.required = false;
        }
    }

    // Validate form fields before submit
    document.getElementById('add-member-form').addEventListener('submit', function(event) {
        const mobile = document.getElementById('mobile').value.trim();
        const pin = document.getElementById('pin_code').value.trim();
        const email = document.getElementById('email').value.trim();
        const aadhar = document.getElementById('aadhar_number').value.trim();
        const pan = document.getElementById('pan_card_number').value.trim();
        const dob = document.getElementById('dob').value;
        const regDate = document.getElementById('registration_date').value;

        const mobilePattern = /^[0-9]{10}$/;
        const pinPattern = /^[0-9]{6}$/;
        const emailPattern = /^[^@]+@[^@]+\.[^@]+$/;
        const aadharPattern = /^[0-9]{12}$/;
        const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        if (!mobilePattern.test(mobile)) {
            alert("Mobile number must be exactly 10 digits.");
            event.preventDefault();
            return false;
        }

        if (!pinPattern.test(pin)) {
            alert("Pin code must be exactly 6 digits.");
            event.preventDefault();
            return false;
        }

        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            event.preventDefault();
            return false;
        }

        if (!aadharPattern.test(aadhar)) {
            alert("Aadhar number must be exactly 12 digits.");
            event.preventDefault();
            return false;
        }

        if (!panPattern.test(pan)) {
            alert("PAN card number must be in format: ABCDE1234F.");
            event.preventDefault();
            return false;
        }

        // Validate age >= 18
        if (dob) {
            const dobDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - dobDate.getFullYear();
            const m = today.getMonth() - dobDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            if (age < 18) {
                alert("Member must be at least 18 years old.");
                event.preventDefault();
                return false;
            }
        }

        if (regDate && dob && new Date(regDate) < new Date(dob)) {
            alert("Registration date cannot be before date of birth.");
            event.preventDefault();
            return false;
        }
    });
</script>

</body>
</html>
