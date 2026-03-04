<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact — Press Council of Maharashtra</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/journal.css" />
  <style>
    .contact-page { max-width: 900px; margin: 28px auto 40px; padding: 0 20px; }
    .contact-page h1 {
      font-family: var(--font-heading); font-size: 22px; color: var(--navy);
      margin-bottom: 20px; padding-bottom: 10px;
      border-bottom: 2px solid var(--gold);
    }
    #contact-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }
    .contact-card {
      background: var(--white);
      padding: 20px 22px;
      border: 1px solid var(--border-light);
      border-top: 3px solid var(--gold);
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
    }
    .contact-heading h3 {
      font-family: var(--font-heading);
      font-size: 15px; color: var(--navy);
      margin: 0 0 12px; padding-bottom: 8px;
      border-bottom: 1px solid var(--border-light);
    }
    .address-block {
      font-family: var(--font-body);
      font-size: 14px; line-height: 1.75;
      color: var(--text-primary);
    }
    .contact-info {
      margin-top: 12px;
      font-size: 13.5px;
      line-height: 1.8;
      color: var(--text-muted);
    }
    .contact-info a { color: var(--navy-light); text-decoration: none; }
    .contact-info a:hover { text-decoration: underline; }
    @media (max-width: 540px) {
      #contact-container { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <?php include 'includes/header.php'; ?>
  <?php include 'includes/navbar.php'; ?>

  <div class="contact-page">
    <h1>Contact Us</h1>
    <div id="contact-container"></div>
  </div>

  <?php include 'includes/footer.php'; ?>

<script>
  fetch('admin/contacts.json')
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById('contact-container');
      container.innerHTML = '';
      data.forEach(entry => {
        const wrapper = document.createElement('div');
        wrapper.className = 'contact-card';

        wrapper.innerHTML = `
          <div class="contact-heading">
            <h3>${entry.heading ?? ''}</h3>
          </div>
          <div class="address-block">
            <strong>${entry.title}</strong><br/>
            ${entry.address.replace(/\n/g, '<br/>')}
          </div>
          <div class="contact-info">
            <strong>Email:</strong> <a href="mailto:${entry.email}">${entry.email}</a><br/>
            <strong>Phone:</strong> <a href="tel:${entry.phone}">${entry.phone}</a>
          </div>
        `;
        container.appendChild(wrapper);
      });
    });
</script>


  <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>
