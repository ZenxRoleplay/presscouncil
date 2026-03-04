<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Officials — Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/journal.css" />
  <style>
    .officials-page { max-width: 1000px; margin: 28px auto 40px; padding: 0 20px; }
    .officials-page h1 {
      font-family: var(--font-heading); font-size: 22px; color: var(--navy);
      margin-bottom: 24px; padding-bottom: 10px; border-bottom: 2px solid var(--gold);
    }
    .official-list { list-style: none; padding: 0; margin: 0; }
    .official-item {
      display: flex; align-items: flex-start; gap: 22px;
      padding: 22px; margin-bottom: 18px;
      background: var(--white); border: 1px solid var(--border-light);
      border-left: 4px solid var(--gold); border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      transition: box-shadow var(--transition);
    }
    .official-item:hover { box-shadow: var(--shadow-md); }
    .official-left { display: flex; flex-direction: column; align-items: center; gap: 10px; flex-shrink: 0; }
    .official-left img {
      width: 90px; height: 115px; object-fit: cover;
      border: 2px solid var(--gold); border-radius: var(--radius-sm);
    }
    .bio-button {
      display: block; text-align: center; padding: 4px 10px;
      background: var(--navy); color: var(--white);
      font-size: 11.5px; font-weight: 600;
      text-decoration: none; border-radius: var(--radius-sm);
      transition: background var(--transition); white-space: nowrap;
    }
    .bio-button:hover { background: var(--navy-mid); }
    .bio-button.disabled { background: #aaa; cursor: not-allowed; pointer-events: none; }
    .official-info { flex: 1; min-width: 0; }
    .official-name {
      font-family: var(--font-heading); font-size: 19px;
      font-weight: 700; color: var(--navy); margin-bottom: 2px;
    }
    .official-position {
      font-size: 14px; font-weight: 700; color: var(--gold);
      text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 4px;
    }
    .official-since { font-size: 13px; color: var(--text-light); font-style: italic; margin-bottom: 10px; }
    .official-contact { font-size: 13.5px; color: var(--text-muted); line-height: 1.8; }
    .official-contact a { color: var(--navy-light); text-decoration: none; }
    .official-contact a:hover { text-decoration: underline; }
    .download-letter { margin-top: 12px; display: flex; gap: 10px; flex-wrap: wrap; }
    .dropdown-button { position: relative; display: inline-block; }
    .dropdown-button .main-button {
      display: inline-flex; align-items: center; gap: 4px;
      padding: 6px 13px; background: var(--navy); color: var(--white);
      border-radius: var(--radius-sm); font-size: 13px; font-weight: 600;
      cursor: pointer; white-space: nowrap; user-select: none;
      transition: background var(--transition);
    }
    .dropdown-button .main-button:hover { background: var(--navy-mid); }
    .dropdown-content {
      display: none; position: absolute; background: var(--white);
      min-width: 210px; box-shadow: var(--shadow-md);
      border: 1px solid var(--border-light); border-radius: var(--radius-sm);
      z-index: 1000; top: calc(100% + 4px); left: 0;
    }
    .dropdown-content a {
      color: var(--text-primary); padding: 9px 14px;
      text-decoration: none; display: block; font-size: 13px;
      border-bottom: 1px solid var(--border-light); transition: background var(--transition);
    }
    .dropdown-content a:last-child { border-bottom: none; }
    .dropdown-content a:hover { background: var(--bg-offwhite); color: var(--navy); }
    .dropdown-button:hover .dropdown-content { display: block; }
    @media (max-width: 600px) {
      .official-item { flex-direction: column; }
      .official-left img { width: 80px; height: 100px; }
      .official-name { font-size: 17px; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

<div class="officials-page">
  <h1>Officials</h1>
  <ul class="official-list">
    <?php
    $officials = $conn->query("SELECT * FROM officials ORDER BY FIELD(position, 'Chairman', 'Working President', 'Vice Chairman', 'General Secretary', 'Secretary', 'Treasurer', 'Executive Member'), appointment_date DESC");
    while ($o = $officials->fetch_assoc()):
      $fullName = trim(($o['title'] ?? '') . ' ' . ($o['name'] ?? ''));
      $sinceDate = date('d-m-Y', strtotime($o['appointment_date']));
    ?>
      <li>
        <div class="official-item">
          <div class="official-left">
            <img src="uploads/officials/<?= htmlspecialchars($o['photo']) ?>" alt="<?= htmlspecialchars($fullName) ?>">
            <?php if (!empty($o['biography'])): ?>
              <a class="bio-button" href="uploads/officials/biographies/<?= htmlspecialchars($o['biography']) ?>" target="_blank">View Biography</a>
            <?php else: ?>
              <a class="bio-button disabled">No Biography</a>
            <?php endif; ?>
          </div>
          <div class="official-info">
            <div class="official-name"><?= htmlspecialchars($fullName) ?></div>
            <div class="official-position"><?= htmlspecialchars($o['position']) ?></div>
            <div class="official-since">Since <?= $sinceDate ?></div>
            <div class="official-contact">
              📧 <a href="mailto:<?= htmlspecialchars($o['email']) ?>"><?= htmlspecialchars($o['email']) ?></a><br>
              📞 <a href="tel:<?= htmlspecialchars($o['mobile']) ?>"><?= htmlspecialchars($o['mobile']) ?></a>
            </div>
            <div class="download-letter">

              <!-- Appointment Letter Button with Dropdown -->
              <div class="dropdown-button">
                <span class="main-button">Appointment Letter ▼</span>
                <div class="dropdown-content">
                 <a href="letter-payment" target="_blank">Make Payment for Appointment Letter</a>
                  <?php if (!empty($o['appointment_letter'])): ?>
                <a href="#" onclick="askLetterPassword(<?= $o['id'] ?>)">Download Appointment Letter</a>
              <?php endif; ?>
                </div>
              </div>

              <!-- ID Card Button with Dropdown -->
              <div class="dropdown-button">
                <span class="main-button">ID Card ▼</span>
                <div class="dropdown-content">
                 <a href="idcard-payment" target="_blank">Make Payment for ID Card</a> 
                   <?php if (!empty($o['id_card'])): ?>
               <a href="#" onclick="askIdCardPassword(<?= $o['id'] ?>)">Download ID Card</a>
              <?php endif; ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
</div>

  <?php include 'includes/footer.php'; ?>
</div>
<script>
// ID CARD download — separate function to avoid overwrite bug
function askIdCardPassword(officialId) {
  const password = prompt("Enter your ID Card Password:");
  if (!password) return;
  window.location.href = "verify-idcard-download.php?official_id=" + officialId + "&password=" + encodeURIComponent(password);
}

// APPOINTMENT LETTER download
function askLetterPassword(officialId) {
  const password = prompt("Enter your Appointment Letter Password:");
  if (!password) return;
  window.location.href = "verify-letter-download.php?official_id=" + officialId + "&password=" + encodeURIComponent(password);
}
</script>
</body>
</html>
