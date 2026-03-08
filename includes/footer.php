<?php
include __DIR__ . '/visit-counter.php'; // ← counts the visitor
date_default_timezone_set('Asia/Kolkata');

// Function to get last update time — function_exists guard prevents fatal redeclaration error
if (!function_exists('getLatestUpdate')) {
function getLatestUpdate($dir) {
    $latest = 0;
    // Only track code/content files — exclude runtime-generated files
    $trackExts   = ['php', 'html', 'css', 'js'];
    $excludeFiles = ['counter.txt', 'error_log'];
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
        if (!$file->isFile()) continue;
        $name = $file->getFilename();
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($ext, $trackExts)) continue;          // skip .txt, .json, .log, etc.
        if (in_array($name, $excludeFiles)) continue;        // skip explicit exclusions
        if (strpos($file->getPathname(), 'cache') !== false) continue;
        $mtime = $file->getMTime();
        if ($mtime > $latest) $latest = $mtime;
    }
    return $latest;
}
} // end function_exists guard

$visitorCount = file_exists(dirname(__DIR__) . '/data/counter.txt') ? file_get_contents(dirname(__DIR__) . '/data/counter.txt') : 0;
?>

<!-- ✅ ISSN COMPLIANCE: Publisher & Compliance Footer Strip -->
<link rel="stylesheet" href="assets/css/journal.css">
<div class="compliance-strip">
  <div class="compliance-strip-inner">

    <div class="cs-col">
      <h4>Published By</h4>
      <address>
        <strong style="color:#fff;">Press Council of Maharashtra (PCM)</strong><br>
        प्रेस कॉन्सिल ऑफ महाराष्ट्र<br>
        Room No. 2 &amp; 3, Administrative Officers Hostel Premises,<br>
        Opp. CSMT (VT), 9 Hazarimal Somani Marg,<br>
        Fort, Mumbai – 400 001,<br>
        Maharashtra, India
      </address>
    </div>

    <div class="cs-col">
      <h4>Journal Details</h4>
      <p>
        ISSN (Online):&nbsp;<span style="color:#ffe07a;font-style:italic;">Applied for / Pending</span><br>
        Starting Year:&nbsp;<strong>2026</strong><br>
        Frequency:&nbsp;<strong>Quarterly</strong><br>
        Language:&nbsp;English / Marathi<br>
        Format:&nbsp;<strong>Online</strong>
      </p>
    </div>

    <div class="cs-col">
      <h4>Contact &amp; Ethics</h4>
      <p>
        Editorial Office:<br>
        <a href="mailto:editor@presscouncil.in">editor@presscouncil.in</a><br><br>
        General Enquiries:<br>
        <a href="mailto:info@presscouncil.in">info@presscouncil.in</a><br>
        <a href="tel:+919766220666">+91-97662-20666</a><br><br>
        <a href="journal-policies" style="color:#c8a84b;">Ethics &amp; Policies</a>&nbsp;|&nbsp;<a href="editorial-board" style="color:#c8a84b;">Editorial Board</a>
      </p>
    </div>

  </div>
</div>

<!-- Scroll-to-top button -->
<button class="scroll-top-btn" id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Back to top">&#8679;</button>
<script>
  (function(){
    var btn = document.getElementById('scrollTopBtn');
    window.addEventListener('scroll', function(){
      if(window.scrollY > 300) btn.classList.add('visible');
      else btn.classList.remove('visible');
    }, {passive:true});
  })();
</script>

<footer>
  <div style="background:#0a1724;padding:10px 20px;font-size:13px;color:#7a9ab8;text-align:center;font-family:Arial,sans-serif;">
    &copy; <?= date('Y') ?> Press Council of Maharashtra. All rights reserved. &nbsp;|&nbsp;
    Owned &amp; Published by Press Council of Maharashtra, Maharashtra, India. &nbsp;|&nbsp;
    <a href="journal-policies" style="color:#7a9ab8;">Privacy &amp; Legal</a>
  </div>
</footer>

<!-- Visitor counter & last updated — very bottom of page -->
<div style="background:#0d1f30;color:#7a9ab8;padding:8px 20px;font-size:13px;display:flex;justify-content:space-between;flex-wrap:wrap;border-top:1px solid #1e3a55;">
  <div>👁️ Total Visitors: <strong style="color:#c8a84b;"><?= number_format($visitorCount) ?></strong></div>
  <div>🕒 Last Updated: <strong style="color:#c8a84b;"><?= date("d M Y, h:i A", getLatestUpdate(dirname(__DIR__))) ?> (IST)</strong></div>
</div>
