<?php
$newsFile = 'admin/news.json';
$newsId   = $_GET['id'] ?? null;
$newsData = [];

if (!$newsId) { header('Location: index'); exit; }

if (file_exists($newsFile)) {
    $decoded = json_decode(file_get_contents($newsFile), true);
    if (is_array($decoded)) $newsData = $decoded;
}

$newsItem = null;
foreach ($newsData as $item) {
    if (isset($item['id']) && (string)$item['id'] === (string)$newsId) {
        $newsItem = $item;
        break;
    }
}
if (!$newsItem) { header('Location: index'); exit; }

// Related news — up to 3 others (latest first), excluding current
$related = [];
foreach (array_reverse($newsData) as $item) {
    if ((string)$item['id'] !== (string)$newsId) {
        $related[] = $item;
        if (count($related) >= 3) break;
    }
}

// Safe date
$dateStr = '';
if (!empty($newsItem['date'])) {
    $ts = strtotime($newsItem['date']);
    if ($ts) $dateStr = date('d M Y', $ts);
}
?>
<!DOCTYPE html>
<html lang="mr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8') ?> — Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/journal.css">
  <style>
    /* ── News Detail Page ── */
    .nd-wrap { max-width: 900px; margin: 28px auto 40px; padding: 0 20px; }

    /* Back button */
    .nd-back {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 13px; font-weight: 600; color: var(--navy);
      text-decoration: none; margin-bottom: 20px;
      padding: 5px 12px; border: 1.5px solid var(--navy);
      border-radius: var(--radius-sm); transition: background var(--transition), color var(--transition);
    }
    .nd-back:hover { background: var(--navy); color: var(--white); }

    /* Article image (inside card) */
    .nd-img-wrap { margin: 0 -32px 24px; overflow: hidden; }
    .nd-img-wrap img {
      width: 100%; max-height: 400px; object-fit: cover; display: block;
      border-top: 1px solid var(--border-light);
      border-bottom: 1px solid var(--border-light);
    }

    /* Article card */
    .nd-article {
      background: var(--white); border-radius: var(--radius);
      box-shadow: var(--shadow-sm); padding: 28px 32px 32px;
      border-top: 4px solid var(--gold);
    }
    .nd-meta { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; flex-wrap: wrap; }
    .nd-badge {
      background: var(--navy); color: var(--white);
      font-size: 11px; font-weight: 700; letter-spacing: 0.6px;
      text-transform: uppercase; padding: 3px 10px; border-radius: 20px;
    }
    .nd-date {
      font-size: 12.5px; color: var(--text-light);
      display: flex; align-items: center; gap: 5px;
    }
    .nd-title {
      font-family: 'Noto Sans Devanagari', var(--font-heading), serif;
      font-size: 22px; font-weight: 700; color: var(--navy);
      line-height: 1.45; margin-bottom: 18px;
    }
    .nd-intro {
      font-family: 'Noto Sans Devanagari', var(--font-body), sans-serif;
      font-size: 15.5px; color: var(--text-muted); line-height: 1.85;
      margin-bottom: 22px; padding-bottom: 20px;
      border-bottom: 1px solid var(--border-light);
    }
    .nd-body {
      font-family: 'Noto Sans Devanagari', var(--font-body), sans-serif;
      font-size: 15px; color: var(--text-primary); line-height: 2;
    }
    .nd-body p { margin-bottom: 14px; }
    .nd-divider { border: none; border-top: 1px solid var(--border-light); margin: 28px 0; }

    /* Related News */
    .nd-related-title {
      font-family: var(--font-heading); font-size: 17px; color: var(--navy);
      margin-bottom: 16px; padding-bottom: 8px;
      border-bottom: 2px solid var(--gold);
    }
    .nd-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .nd-related-card {
      display: flex; flex-direction: column; text-decoration: none;
      color: var(--text-primary); background: var(--white);
      border: 1px solid var(--border-light); border-radius: var(--radius-sm);
      overflow: hidden; transition: box-shadow var(--transition), transform var(--transition);
    }
    .nd-related-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .nd-related-card img { height: 120px; width: 100%; object-fit: cover; display: block; }
    .nd-related-card-body { padding: 10px 11px 12px; }
    .nd-related-card .rc-title {
      font-family: 'Noto Sans Devanagari', var(--font-body), sans-serif;
      font-size: 12.5px; font-weight: 600; color: var(--navy); line-height: 1.45;
      display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .nd-related-card .rc-date { font-size: 11px; color: var(--text-light); margin-top: 6px; }

    @media (max-width: 640px) {
      .nd-article { padding: 18px 14px 22px; }
      .nd-img-wrap { margin: 0 -14px 18px; }
      .nd-img-wrap img { max-height: 220px; }
      .nd-title { font-size: 18px; }
      .nd-related-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <div class="nd-wrap">

    <a class="nd-back" href="index">&#8592; Back to Home</a>

    <article class="nd-article">

      <div class="nd-meta">
        <span class="nd-badge">Press Council of Maharashtra</span>
        <?php if ($dateStr): ?>
        <span class="nd-date">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          <?= $dateStr ?>
        </span>
        <?php endif; ?>
      </div>

      <h1 class="nd-title">
        <?= htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8') ?>
      </h1>

      <?php if (!empty($newsItem['image'])): ?>
      <div class="nd-img-wrap">
        <img src="<?= htmlspecialchars($newsItem['image'], ENT_QUOTES, 'UTF-8') ?>"
             alt="<?= htmlspecialchars($newsItem['title'], ENT_QUOTES, 'UTF-8') ?>">
      </div>
      <?php endif; ?>

      <?php if (!empty($newsItem['intro'])): ?>
      <p class="nd-intro">
        <?= nl2br(htmlspecialchars($newsItem['intro'], ENT_QUOTES, 'UTF-8')) ?>
      </p>
      <?php endif; ?>

      <?php if (!empty($newsItem['details'])): ?>
      <div class="nd-body">
        <?php
          $paras = preg_split('/\r?\n\r?\n/', trim(htmlspecialchars($newsItem['details'], ENT_QUOTES, 'UTF-8')));
          foreach ($paras as $p) {
              $p = trim(str_replace(["\r\n", "\n"], '<br>', $p));
              if ($p !== '') echo "<p>$p</p>\n";
          }
        ?>
      </div>
      <?php endif; ?>

    </article>

    <?php if (!empty($related)): ?>
    <hr class="nd-divider">
    <h2 class="nd-related-title">More News</h2>
    <div class="nd-related-grid">
      <?php foreach ($related as $r):
        $rDate = '';
        if (!empty($r['date'])) { $ts = strtotime($r['date']); if ($ts) $rDate = date('d M Y', $ts); }
      ?>
      <a class="nd-related-card" href="news-detail?id=<?= htmlspecialchars($r['id'], ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($r['image'])): ?>
        <img src="<?= htmlspecialchars($r['image'], ENT_QUOTES, 'UTF-8') ?>"
             alt="<?= htmlspecialchars($r['title'], ENT_QUOTES, 'UTF-8') ?>"
             loading="lazy">
        <?php endif; ?>
        <div class="nd-related-card-body">
          <div class="rc-title"><?= htmlspecialchars($r['title'], ENT_QUOTES, 'UTF-8') ?></div>
          <?php if ($rDate): ?><div class="rc-date"><?= $rDate ?></div><?php endif; ?>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>

  <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>
