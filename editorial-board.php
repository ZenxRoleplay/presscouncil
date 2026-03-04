<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editorial Board — Information of Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/journal.css" />
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <!-- ================================================================
       EDITORIAL BOARD PAGE
       ISSN Compliance: Requirement #7
       - Minimum 5 members
       - Full official postal address per member
       - Department and institutional designation
       - Institutional email only (no Gmail/Yahoo)
  ================================================================ -->

  <main class="editorial-page-wrapper">

    <!-- Page Header -->
    <div class="editorial-page-header">
      <h1>Editorial Board</h1>
      <div class="ep-journal-name">Information of Press Council of Maharashtra</div>
      <div class="ep-issn">
        ISSN (Online): <em style="color:#b36000;">Applied for / Pending</em>
        &nbsp;|&nbsp;
        Vol. 1 &nbsp;|&nbsp; Est. 2025
      </div>
    </div>

    <!-- ADMIN NOTICE: hidden on public site; visible only on localhost for development -->
    <?php if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1'): ?>
    <div style="background:#fff3cd;border:1px dashed #e8a700;padding:14px 18px;margin-bottom:28px;font-size:13px;color:#7a5200;font-family:Arial,sans-serif;">
      <strong style="display:block;margin-bottom:6px;">&#9888; ADMIN (dev only) — FILL IN BEFORE ISSN SUBMISSION:</strong>
      <ol style="margin:6px 0 0 18px;padding:0;line-height:1.8;">
        <li>Replace all <em>[FILL: ...]</em> fields with real full names, designations, and institutional details.</li>
        <li>Institutional email only (e.g., @mu.ac.in, @unipune.ac.in) — Gmail/Yahoo rejected by ISSN.</li>
        <li>Send institutional profile links to: <a href="mailto:issnindia.niscpr@csir.res.in">issnindia.niscpr@csir.res.in</a></li>
      </ol>
    </div>
    <?php endif; ?>

    <!-- ============================================================
         SECTION 1: EDITOR-IN-CHIEF
    ============================================================ -->
    <div class="editorial-role-section">
      <h2>Editor-in-Chief</h2>

      <div class="editorial-member-header">
        <div>Name &amp; Designation</div>
        <div>Department &amp; Institution</div>
        <div>Postal Address</div>
        <div>Contact</div>
      </div>

      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">Editor-in-Chief</div>
        </div>
        <div>
          <div class="em-dept">[FILL: Department of Mass Communication / Journalism]</div>
          <div class="em-institution">[FILL: Name of University / College / Institute]<br>Maharashtra, India</div>
        </div>
        <div class="em-address">
          [FILL: Department Office Address]<br>
          [FILL: City] – [FILL: PIN]<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:editor@presscouncil.in">editor@presscouncil.in</a><br>
          <small style="font-size:11px;color:#888;">Replace with institutional email</small>
        </div>
      </div>
    </div>

    <!-- ============================================================
         SECTION 2: ASSOCIATE EDITOR
    ============================================================ -->
    <div class="editorial-role-section">
      <h2>Associate Editor</h2>

      <div class="editorial-member-header">
        <div>Name &amp; Designation</div>
        <div>Department &amp; Institution</div>
        <div>Postal Address</div>
        <div>Contact</div>
      </div>

      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">Associate Editor</div>
        </div>
        <div>
          <div class="em-dept">[FILL: Department of Journalism &amp; Mass Communication]</div>
          <div class="em-institution">[FILL: Name of University / College]<br>Maharashtra, India</div>
        </div>
        <div class="em-address">
          [FILL: Department Office Address]<br>
          [FILL: City] – [FILL: PIN]<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:assoceditor@presscouncil.in">assoceditor@presscouncil.in</a><br>
          <small style="font-size:11px;color:#888;">Replace with institutional email</small>
        </div>
      </div>
    </div>

    <!-- ============================================================
         SECTION 3: EDITORIAL BOARD MEMBERS (Minimum 5 required by ISSN)
    ============================================================ -->
    <div class="editorial-role-section">
      <h2>Editorial Board Members</h2>

      <div class="editorial-member-header">
        <div>Name &amp; Designation</div>
        <div>Department &amp; Institution</div>
        <div>Postal Address</div>
        <div>Institutional Email</div>
      </div>

      <!-- Member 1 — University of Mumbai -->
      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">[FILL: Professor / Associate Professor / Head of Department]</div>
        </div>
        <div>
          <div class="em-dept">Department of Communication &amp; Journalism</div>
          <div class="em-institution">University of Mumbai<br>Mumbai, Maharashtra, India</div>
        </div>
        <div class="em-address">
          Department of Communication &amp; Journalism,<br>
          University of Mumbai,<br>
          Fort, Mumbai – 400 032<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:[FILL]@mu.ac.in">[FILL: name]@mu.ac.in</a>
        </div>
      </div>

      <!-- Member 2 — Savitribai Phule Pune University -->
      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">[FILL: Professor / Reader / Assistant Professor]</div>
        </div>
        <div>
          <div class="em-dept">Department of Journalism &amp; Mass Communication</div>
          <div class="em-institution">Savitribai Phule Pune University<br>Pune, Maharashtra, India</div>
        </div>
        <div class="em-address">
          Department of Journalism &amp; Mass Communication,<br>
          Savitribai Phule Pune University,<br>
          Ganeshkhind, Pune – 411 007<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:[FILL]@unipune.ac.in">[FILL: name]@unipune.ac.in</a>
        </div>
      </div>

      <!-- Member 3 — Dr. Babasaheb Ambedkar Marathwada University -->
      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">[FILL: Professor / Lecturer / Researcher]</div>
        </div>
        <div>
          <div class="em-dept">Department of Media Studies</div>
          <div class="em-institution">Dr. Babasaheb Ambedkar Marathwada University<br>Aurangabad, Maharashtra, India</div>
        </div>
        <div class="em-address">
          Department of Media Studies,<br>
          Dr. Babasaheb Ambedkar Marathwada University,<br>
          University Campus, Aurangabad – 431 004<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:[FILL]@bamu.ac.in">[FILL: name]@bamu.ac.in</a>
        </div>
      </div>

      <!-- Member 4 — RTM Nagpur University -->
      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">[FILL: Professor / Head of Dept / Senior Lecturer]</div>
        </div>
        <div>
          <div class="em-dept">Department of Communication Studies</div>
          <div class="em-institution">Rashtrasant Tukadoji Maharaj Nagpur University<br>Nagpur, Maharashtra, India</div>
        </div>
        <div class="em-address">
          Department of Communication Studies,<br>
          RTM Nagpur University,<br>
          Ravindranath Tagore Marg, Nagpur – 440 001<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:[FILL]@nagpuruniversity.org">[FILL: name]@nagpuruniversity.org</a>
        </div>
      </div>

      <!-- Member 5 — Shivaji University Kolhapur -->
      <div class="editorial-member-row">
        <div>
          <div class="em-name">[FILL: Prof. / Dr. Full Name]</div>
          <div class="em-designation">[FILL: Professor / Director / Associate Professor]</div>
        </div>
        <div>
          <div class="em-dept">Department of Journalism &amp; Media Management</div>
          <div class="em-institution">Shivaji University<br>Kolhapur, Maharashtra, India</div>
        </div>
        <div class="em-address">
          Department of Journalism &amp; Media Management,<br>
          Shivaji University,<br>
          Vidyanagar, Kolhapur – 416 004<br>
          Maharashtra, India
        </div>
        <div>
          <a class="em-email" href="mailto:[FILL]@unishivaji.ac.in">[FILL: name]@unishivaji.ac.in</a>
        </div>
      </div>

    </div><!-- /Editorial Board Members -->

    <!-- ============================================================
         NOTE: Add international members here for broader credibility
    ============================================================ -->
    <div style="border:1px dashed #c8b89a;background:#f8f7f4;padding:16px 20px;margin-top:10px;font-size:13px;font-family:Arial,sans-serif;color:#4a4a4a;">
      <strong>Note for ISSN Authority:</strong> The editorial board comprises senior academics from major
      universities and research institutions in Maharashtra. All members hold full-time academic positions and
      contribute to the peer-review and editorial decision-making process of this journal. Board composition is
      reviewed annually.
    </div>

  </main>

  <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>
