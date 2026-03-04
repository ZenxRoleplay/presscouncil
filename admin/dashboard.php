<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Press Council of Maharashtra</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }

        .dashboard {
            max-width: 960px;
            margin: 50px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .link-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .link-box {
            text-align: center;
            padding: 25px 15px;
            background-color: #f9fbfc;
            border: 1px solid #dde2e6;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .link-box:hover {
            border-color: #007bff;
            background-color: #e8f1ff;
        }

        .link-box a {
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            font-size: 16px;
        }

        .logout-button {
            display: block;
            width: 180px;
            margin: 0 auto;
            text-align: center;
            background-color: #d9534f;
            color: white;
            padding: 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c9302c;
        }

        @media (max-width: 600px) {
            .dashboard {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>
    <p>Use the options below to manage the Press Council of Maharashtra website.</p>

    <div class="link-grid">
        <div class="link-box">
            <a href="add-member.php">Add Member</a>
        </div>
        <div class="link-box">
            <a href="view-members.php">View Members</a>
        </div>
         <div class="link-box">
            <a href="image-slider.php">Manage Image Slider</a>
        </div>
         <div class="link-box">
            <a href="news-admin.php">Manage News</a>
        </div>
        <div class="link-box">
            <a href="edit-about.php">Edit About</a>
        </div>
         <div class="link-box">
            <a href="edit-contact-us.php">Edit Contact Us</a>
        </div>
        <div class="link-box">
            <a href="manage-officials.php">Manage Officials</a>
        </div>
    </div>

    <a href="logout.php" class="logout-button">Logout</a>
</div>

</body>
</html>
