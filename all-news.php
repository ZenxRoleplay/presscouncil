<!DOCTYPE html>
<html lang="mr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All News — Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/journal.css">
  <style>
    .all-news-wrap { max-width: 1080px; margin: 28px auto 40px; padding: 0 20px; }
    .all-news-header {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 20px; flex-wrap: wrap; gap: 10px;
    }
    .all-news-header h1 {
      font-family: var(--font-heading); font-size: 22px; color: var(--navy);
    }
    .news-search {
      padding: 7px 13px; border: 1.5px solid var(--border); border-radius: var(--radius-sm);
      font-size: 13.5px; color: var(--text-primary); outline: none; width: 240px;
      font-family: var(--font-body);
      transition: border-color var(--transition);
    }
    .news-search:focus { border-color: var(--navy); }

    /* Grid */
    .all-news-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }
    .an-card {
      display: flex; flex-direction: column; text-decoration: none;
      color: var(--text-primary); background: var(--white);
      border: 1px solid var(--border-light); border-radius: var(--radius);
      overflow: hidden; transition: box-shadow var(--transition), transform var(--transition);
    }
    .an-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
    .an-img-wrap { position: relative; overflow: hidden; }
    .an-card img { height: 180px; width: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .an-card:hover img { transform: scale(1.04); }
    .an-badge {
      position: absolute; top: 8px; left: 8px;
      background: var(--gold); color: var(--navy-dark);
      font-size: 10px; font-weight: 700; letter-spacing: 0.5px;
      padding: 2px 8px; border-radius: 20px; text-transform: uppercase;
    }
    .an-body { padding: 13px 14px 15px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
    .an-title {
      font-family: 'Noto Sans Devanagari', var(--font-body), sans-serif;
      font-size: 14px; font-weight: 700; color: var(--navy); line-height: 1.45;
      display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .an-intro {
      font-family: 'Noto Sans Devanagari', var(--font-body), sans-serif;
      font-size: 12.5px; color: var(--text-muted); line-height: 1.55;
      display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
      flex: 1;
    }
    .an-date { font-size: 11px; color: var(--text-light); display: flex; align-items: center; gap: 4px; margin-top: auto; padding-top: 6px; border-top: 1px solid var(--border-light); }
    .an-empty { text-align: center; color: var(--text-light); font-size: 15px; padding: 40px 0; grid-column: 1/-1; }
    .an-count { font-size: 12.5px; color: var(--text-light); }

    @media (max-width: 480px) {
      .news-search { width: 100%; }
      .all-news-grid { grid-template-columns: 1fr; }
      .an-card img { height: 140px; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <div class="all-news-wrap">
    <div class="all-news-header">
      <h1>All News</h1>
      <input class="news-search" id="newsSearch" type="search" placeholder="Search news…" autocomplete="off">
    </div>
    <div class="an-count" id="newsCount"></div>
    <div class="all-news-grid" id="newsGrid">
      <div class="an-empty">Loading…</div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

</div>
<script>
(function(){
  const now = Date.now();
  const sevenDays = 7 * 24 * 60 * 60 * 1000;
  let allNews = [];

  function renderGrid(items) {
    const grid = document.getElementById('newsGrid');
    document.getElementById('newsCount').textContent = items.length + ' article' + (items.length !== 1 ? 's' : '');
    if (!items.length) {
      grid.innerHTML = '<div class="an-empty">No matching news found.</div>';
      return;
    }
    grid.innerHTML = items.map(news => {
      let dateHTML = '', isNew = false;
      if (news.date) {
        const d = new Date(news.date);
        if (!isNaN(d)) {
          dateHTML = d.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
          isNew = (now - d.getTime()) < sevenDays;
        }
      }
      const badge = isNew ? '<span class="an-badge">New</span>' : '';
      const intro = (news.intro || '').replace(/\r?\n/g, ' ').trim();
      const calIcon = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>`;
      return `
        <a class="an-card" href="news-detail?id=${news.id}">
          <div class="an-img-wrap">
            <img src="${news.image}" alt="${news.title}" loading="lazy">
            ${badge}
          </div>
          <div class="an-body">
            <div class="an-title">${news.title}</div>
            <div class="an-intro">${intro}</div>
            ${dateHTML ? `<div class="an-date">${calIcon} ${dateHTML}</div>` : ''}
          </div>
        </a>`;
    }).join('');
  }

  fetch('admin/news.json')
    .then(r => r.json())
    .then(data => {
      allNews = [...data].reverse(); // latest first
      renderGrid(allNews);
    })
    .catch(() => {
      document.getElementById('newsGrid').innerHTML = '<div class="an-empty">Could not load news.</div>';
    });

  document.getElementById('newsSearch').addEventListener('input', function(){
    const q = this.value.trim().toLowerCase();
    if (!q) { renderGrid(allNews); return; }
    renderGrid(allNews.filter(n =>
      (n.title || '').toLowerCase().includes(q) ||
      (n.intro  || '').toLowerCase().includes(q)
    ));
  });
})();
</script>
</body>
</html>
