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

  <!-- Journal Particulars Strip (ISSN requirement: preliminary details on main page) -->
  <div class="journal-strip">
    <div class="journal-strip-inner">
      <div class="js-col">
        <span class="js-label">Publication</span>
        <span class="js-val">Information of Press Council of Maharashtra</span>
      </div>
      <div class="js-divider"></div>
      <div class="js-col">
        <span class="js-label">Starting Year</span>
        <span class="js-val">2025</span>
      </div>
      <div class="js-divider"></div>
      <div class="js-col">
        <span class="js-label">Frequency</span>
        <span class="js-val">Quarterly</span>
      </div>
      <div class="js-divider"></div>
      <div class="js-col">
        <span class="js-label">Format</span>
        <span class="js-val">Online</span>
      </div>
      <div class="js-divider"></div>
      <div class="js-col">
        <span class="js-label">Language</span>
        <span class="js-val">English / Marathi</span>
      </div>
      <div class="js-divider"></div>
      <div class="js-col">
        <span class="js-label">Subject</span>
        <span class="js-val">Press Freedom · Media Ethics · Journalist Welfare</span>
      </div>
    </div>
  </div>

  <!-- Slider and News -->
  <div class="slider-wrapper">
    <div class="news-box left-news">
      <h3>News Updates</h3>
      <ul id="left-news"></ul>
      <a class="view-all" href="all-news">View All News</a>
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
      const leftBox = document.getElementById('left-news');
      const rightBox = document.getElementById('right-news');
      leftBox.innerHTML = '';
      rightBox.innerHTML = '';

      const now = Date.now();
      const sevenDays = 7 * 24 * 60 * 60 * 1000;

      // Latest first
      [...data].reverse().forEach((news, i) => {
        const li = document.createElement('li');

        // Date handling — some entries may lack date field
        let formattedDate = '';
        let isNew = false;
        if (news.date) {
          const d = new Date(news.date);
          if (!isNaN(d)) {
            formattedDate = d.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
            isNew = (now - d.getTime()) < sevenDays;
          }
        }

        const badgeHTML = isNew
          ? `<span class="news-badge">New</span>`
          : '';

        const dateHTML = formattedDate
          ? `<div class="news-date">
               <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
               ${formattedDate}
             </div>`
          : '';

        // Trim intro — first 160 chars max
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

        (i % 2 === 0 ? leftBox : rightBox).appendChild(li);
      });
    })
    .catch(() => {}); // silently ignore fetch errors
</script>


</body>
</html>
