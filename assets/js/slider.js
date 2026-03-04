(() => {
  let currentIndex = 0;
  let slides = [];
  let autoTimer = null;
  const INTERVAL = 5000;

  const track    = document.getElementById('slider-track');
  const dotsWrap = document.getElementById('slider-dots');
  const prevBtn  = document.getElementById('slider-prev');
  const nextBtn  = document.getElementById('slider-next');

  // ── Fetch slides ──────────────────────────────────────────────────────────
  document.addEventListener('DOMContentLoaded', () => {
    fetch('admin/slides.json')
      .then(r => { if (!r.ok) throw new Error('slides.json not found'); return r.json(); })
      .then(data => {
        if (!Array.isArray(data) || data.length === 0) return;
        slides = data;
        renderSlides();
        buildDots();
        goTo(0);
        startAuto();
      })
      .catch(() => { /* silently hide slider if no slides */ });
  });

  // ── Render slide elements ─────────────────────────────────────────────────
  function renderSlides() {
    track.innerHTML = '';
    slides.forEach(s => {
      const div = document.createElement('div');
      div.className = 'slide';

      const img = document.createElement('img');
      img.src     = s.image;
      img.alt     = 'Slide';
      img.loading = 'lazy';

      const cap = document.createElement('div');
      cap.className = 'caption';
      cap.style.fontSize = (s.fontSize ? s.fontSize : 15) + 'px';

      const text = s.caption || '';
      if (text.length > 0) {
        const textEl = document.createElement('div');
        textEl.className = 'caption-text';
        textEl.textContent = text;
        cap.appendChild(textEl);

        // Only show toggle if text is long enough to be clamped
        if (text.length > 120) {
          const toggle = document.createElement('button');
          toggle.className = 'caption-toggle';
          toggle.textContent = '▼ Read More';
          toggle.addEventListener('click', e => {
            e.stopPropagation();
            const expanded = textEl.classList.toggle('expanded');
            toggle.textContent = expanded ? '▲ Show Less' : '▼ Read More';
          });
          cap.appendChild(toggle);
        }
      }

      div.append(img, cap);
      track.appendChild(div);
    });
  }

  // ── Dot indicators ────────────────────────────────────────────────────────
  function buildDots() {
    if (!dotsWrap) return;
    dotsWrap.innerHTML = '';
    slides.forEach((_, i) => {
      const d = document.createElement('button');
      d.className = 'slider-dot';
      d.setAttribute('aria-label', 'Go to slide ' + (i + 1));
      d.addEventListener('click', () => { goTo(i); resetAuto(); });
      dotsWrap.appendChild(d);
    });
  }

  function updateDots() {
    if (!dotsWrap) return;
    dotsWrap.querySelectorAll('.slider-dot').forEach((d, i) => {
      d.classList.toggle('active', i === currentIndex);
    });
  }

  // ── Navigation ────────────────────────────────────────────────────────────
  function goTo(index) {
    if (slides.length === 0) return;
    currentIndex = (index + slides.length) % slides.length;
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
    updateDots();
  }

  function nextSlide() { goTo(currentIndex + 1); }
  function prevSlide() { goTo(currentIndex - 1); }

  window.nextSlide = nextSlide;
  window.prevSlide = prevSlide;

  prevBtn && prevBtn.addEventListener('click', () => { prevSlide(); resetAuto(); });
  nextBtn && nextBtn.addEventListener('click', () => { nextSlide(); resetAuto(); });

  // ── Auto-play ─────────────────────────────────────────────────────────────
  function startAuto() { autoTimer = setInterval(nextSlide, INTERVAL); }
  function stopAuto()  { clearInterval(autoTimer); }
  function resetAuto() { stopAuto(); startAuto(); }

  // Pause when tab is hidden
  document.addEventListener('visibilitychange', () => {
    document.hidden ? stopAuto() : startAuto();
  });

  // Pause on hover
  const container = track && track.closest('.slider-container');
  if (container) {
    container.addEventListener('mouseenter', stopAuto);
    container.addEventListener('mouseleave', startAuto);
  }

  // ── Touch / Swipe ─────────────────────────────────────────────────────────
  let touchStartX = 0;
  let touchDeltaX = 0;

  if (track) {
    track.addEventListener('touchstart', e => {
      touchStartX = e.touches[0].clientX;
      touchDeltaX = 0;
      stopAuto();
    }, { passive: true });

    track.addEventListener('touchmove', e => {
      touchDeltaX = e.touches[0].clientX - touchStartX;
    }, { passive: true });

    track.addEventListener('touchend', () => {
      if (Math.abs(touchDeltaX) > 40) {
        touchDeltaX < 0 ? nextSlide() : prevSlide();
      }
      resetAuto();
    });
  }

  // ── Keyboard ──────────────────────────────────────────────────────────────
  document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') { nextSlide(); resetAuto(); }
    if (e.key === 'ArrowLeft')  { prevSlide(); resetAuto(); }
  });
})();
