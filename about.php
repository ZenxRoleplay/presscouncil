<?php
// Load additional about content from JSON if available
$aboutJsonPath = 'data/about_content.json';
$aboutContent = ['paragraphs' => []];
if (file_exists($aboutJsonPath)) {
    $decoded = json_decode(file_get_contents($aboutJsonPath), true);
    if (is_array($decoded) && isset($decoded['paragraphs'])) {
        $aboutContent = $decoded;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About — Information of Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/journal.css" />
  <style>
    /* About Journal Block */
    .about-journal-block {
      max-width: 960px;
      margin: 30px auto 0;
      padding: 28px 32px;
      background: #f8f7f4;
      border: 1px solid #ddd8cc;
      border-left: 5px solid #1a3a5c;
      border-radius: 4px;
    }
    .about-journal-block h2 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 20px;
      color: #1a3a5c;
      margin: 0 0 14px;
      padding-bottom: 8px;
      border-bottom: 1px solid #ddd8cc;
    }
    .about-journal-text p {
      font-size: 14.5px;
      line-height: 1.75;
      color: #333;
      margin: 0 0 12px;
      font-family: Georgia, 'Times New Roman', serif;
    }
    .about-journal-text p:last-child { margin-bottom: 0; }

    /* Additional admin-managed content */
    .about-admin-content {
      max-width: 960px;
      margin: 24px auto 0;
      padding: 0 32px;
      font-family: Georgia, 'Times New Roman', serif;
      font-size: 14.5px;
      line-height: 1.75;
      color: #1a1a1a;
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <!-- ABOUT THE JOURNAL -->
  <section class="about-journal-block">
    <h2>About the Journal</h2>
    <div class="about-journal-text">
      <p>
        <strong>Information of Press Council of Maharashtra</strong> is the official information journal of the
        <strong>Press Council of Maharashtra (PCM)</strong>, an Autonomous Council Recognised by
        NITI Aayog, ISO 9001:2015 Certified. This publication serves as the primary information
        organ of the Press Council of Maharashtra, disseminating official announcements, decisions,
        council activities, and developments pertaining to the press and media landscape in Maharashtra.
      </p>
      <p>
        The journal publishes information on press freedom, journalist welfare, media ethics, council
        member updates, official notifications, regulatory decisions, and scholarly contributions
        relating to the work of the Press Council of Maharashtra and the broader press ecosystem in
        the state. It serves as an authoritative record of the Council's activities and a reference
        resource for journalists, media organizations, and policymakers across Maharashtra and India.
      </p>
      <p>
        Published <strong>quarterly</strong> in January, April, July, and October, the journal is
        available free of charge online. Submissions are accepted in <strong>English and Marathi</strong>.
      </p>
    </div>
  </section>

  <!-- Admin-managed paragraphs (editable from admin panel) -->
  <?php if (!empty($aboutContent['paragraphs'])): ?>
  <div class="about-admin-content">
    <?php foreach ($aboutContent['paragraphs'] as $para): ?>
      <p><?php echo htmlspecialchars($para, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <div class="section-divider"></div>

  <!-- JOURNAL PARTICULARS -->
  <section class="journal-info-block">
    <h2>Journal Particulars</h2>
    <div class="jib-grid">
      <div class="jib-row">
        <div class="jib-label">Publication Title</div>
        <div class="jib-value">Information of Press Council of Maharashtra</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">ISSN (Online)</div>
        <div class="jib-value" style="color:#b36000;font-style:italic;">Applied for / Pending Assignment</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">ISSN (Print)</div>
        <div class="jib-value">Not Applicable (Online Only)</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Starting Year</div>
        <div class="jib-value">2025</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Publication Frequency</div>
        <div class="jib-value">Quarterly (January, April, July, October)</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Format</div>
        <div class="jib-value">Online</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Subject / Discipline</div>
        <div class="jib-value">Press Council Activities, Press Freedom, Journalist Welfare, Media Ethics, Official Notifications</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Language</div>
        <div class="jib-value">English, Marathi</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Review Process</div>
        <div class="jib-value">Double-Blind Peer Review</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Publisher</div>
        <div class="jib-value">Press Council of Maharashtra (PCM), Maharashtra, India</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Owner</div>
        <div class="jib-value">Press Council of Maharashtra — An Autonomous Council Recognised by NITI Aayog</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Country</div>
        <div class="jib-value">India</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Email Id</div>
        <div class="jib-value"><a href="mailto:editor@presscouncil.in">editor@presscouncil.in</a></div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Mobile No.</div>
        <div class="jib-value">+91-90495-76666</div>
      </div>
      <div class="jib-row">
        <div class="jib-label">Website</div>
        <div class="jib-value"><a href="https://presscouncil.in" target="_blank">presscouncil.in</a></div>
      </div>
    </div>
  </section>

  <div class="section-divider"></div>

  <!-- PUBLISHER & OWNERSHIP -->
  <section class="publisher-details-section">
    <h2>Publisher &amp; Ownership Information</h2>
    <div class="pub-detail-grid">

      <div class="pub-detail-card">
        <h3>Publisher</h3>
        <address>
          <strong>Press Council of Maharashtra (PCM)</strong><br>
          प्रेस कॉन्सिल ऑफ महाराष्ट्र<br>
          An Autonomous Council Recognised by NITI Aayog<br>
          ISO 9001:2015 Certified
        </address>
      </div>

      <div class="pub-detail-card">
        <h3>Registered Postal Address</h3>
        <address>
          <strong>Press Council of Maharashtra (PCM)</strong><br>
          Room No. 2 &amp; 3, Administrative Officers Hostel Premises,<br>
          Opposite Chhatrapati Shivaji Maharaj Terminus (VT),<br>
          9, Hazarimal Somani Marg, Bori Bunder, Azad Maidan,<br>
          Fort, Mumbai – 400 001<br>
          Maharashtra, India<br><br>
          <strong>Tel:</strong> +91-90495-76666<br>
          <strong>Email:</strong> <a href="mailto:editor@presscouncil.in">editor@presscouncil.in</a>
        </address>
      </div>

      <div class="pub-detail-card">
        <h3>Ownership &amp; Legal Status</h3>
        <p>
          <strong>Owner:</strong> Press Council of Maharashtra<br>
          <strong>Legal Status:</strong> Autonomous Non-Profit Council<br>
          <strong>NITI Aayog Recognition:</strong> Yes<br>
          <strong>ISO Certification:</strong> 9001:2015<br>
          <strong>Publishing Body:</strong> Press Council of Maharashtra<br>
          <strong>Editorial Management:</strong> Editorial Board, PCM
        </p>
      </div>

    </div>
  </section>

  <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>
