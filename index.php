<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Information of Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/journal.css">
</head>
<body>
<div class="page-wrapper">
  <?php include 'includes/header.php'; ?>

  <?php include 'includes/navbar.php'; ?>

  <!-- Slider and News -->
  <div class="slider-wrapper">
    <div class="news-box left-news">
      <h3>Online Journal</h3>
      <div style="padding:4px 0;font-size:13px;line-height:2;">
        <div style="border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:10px;">
          <div style="font-weight:700;color:var(--navy);font-size:14px;margin-bottom:2px;">Information of Press Council of Maharashtra</div>
          <div style="color:#888;font-size:12px;font-style:italic;">ISSN (Online): Applied for / Pending</div>
        </div>
        <div><span style="color:#888;">Starting Year:</span> <strong>2026</strong></div>
        <div><span style="color:#888;">Frequency:</span> <strong>Quarterly</strong></div>
        <div><span style="color:#888;">Format:</span> <strong>Online (e-Journal)</strong></div>
        <div><span style="color:#888;">Language:</span> <strong>English / Hindi / Marathi</strong></div>
        <div style="margin-top:8px;border-top:1px solid #eee;padding-top:10px;">
          <span style="color:#888;">Current Issue:</span><br>
          <a href="volume-1-issue-1" style="color:var(--navy);font-weight:600;">Vol. 1, Issue 1 (2026)</a>
        </div>
        <div style="margin-top:12px;display:flex;flex-direction:column;gap:6px;">
          <a href="journal-info" style="background:var(--navy);color:#fff;text-align:center;padding:7px 10px;border-radius:5px;font-size:12px;font-weight:600;text-decoration:none;">About the Journal</a>
          <a href="editorial-board" style="background:var(--bg-offwhite);color:var(--navy);text-align:center;padding:7px 10px;border-radius:5px;font-size:12px;font-weight:600;text-decoration:none;border:1px solid var(--border-light);">Editorial Board</a>
          <a href="journal-policies" style="background:var(--bg-offwhite);color:var(--navy);text-align:center;padding:7px 10px;border-radius:5px;font-size:12px;font-weight:600;text-decoration:none;border:1px solid var(--border-light);">Policies &amp; Ethics</a>
        </div>
      </div>
    </div>

    <div class="slider-container">
      <div class="slider-track" id="slider-track"></div>
      <button class="slider-btn prev" id="slider-prev" aria-label="Previous slide">❮</button>
      <button class="slider-btn next" id="slider-next" aria-label="Next slide">❯</button>
      <div class="slider-dots" id="slider-dots"></div>
    </div>

    <div class="news-box right-news">
      <h3>Latest News</h3>
      <ul id="right-news"></ul>
      <a class="view-all" href="all-news">View All News</a>
    </div>
  </div>
</div>

<!-- FOOTER -->
     <?php include 'includes/footer.php'; ?>

<script src="assets/js/slider.js"></script>
<script>
  fetch('admin/news.json')
    .then(res => res.json())
    .then(data => {
      const rightBox = document.getElementById('right-news');
      rightBox.innerHTML = '';

      const now = Date.now();
      const sevenDays = 7 * 24 * 60 * 60 * 1000;

      // Latest first — all news goes to right box
      [...data].reverse().forEach((news) => {
        const li = document.createElement('li');

        let formattedDate = '';
        let isNew = false;
        if (news.date) {
          const d = new Date(news.date);
          if (!isNaN(d)) {
            formattedDate = d.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
            isNew = (now - d.getTime()) < sevenDays;
          }
        }

        const badgeHTML = isNew ? `<span class="news-badge">New</span>` : '';
        const dateHTML = formattedDate
          ? `<div class="news-date">
               <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
               ${formattedDate}
             </div>`
          : '';

        const rawIntro = (news.intro || '').replace(/\r?\n/g, ' ').trim();

        li.innerHTML = `
          <a class="news-card" href="news-detail?id=${news.id}">
            <div class="news-card-img-wrap">
              <img src="${news.image}" alt="${news.title}" loading="lazy" />
              ${badgeHTML}
            </div>
            <div class="news-card-body">
              <div class="title">${news.title}</div>
              <div class="intro">${rawIntro}</div>
              ${dateHTML}
            </div>
          </a>`;

        rightBox.appendChild(li);
      });
    })
    .catch(() => {});
</script>


</body>
</html>
