<div class="nav-overlay" id="nav-overlay" onclick="closeNav()"></div>
<div class="page-buttons">
  <button class="nav-toggle" onclick="toggleNav()" aria-label="Toggle navigation">
    <span></span><span></span><span></span>
  </button>
  <div id="nav-menu">
  <button onclick="closeNav()" style="background:none;border:none;color:rgba(255,255,255,0.5);font-size:22px;padding:10px 22px;text-align:right;width:100%;cursor:pointer;display:none;" id="nav-close-btn">&#10005; Close</button>
  <button onclick="location.href='index'">Home</button>
  <button onclick="location.href='about'">About</button>

  <!-- ✅ ISSN: Journal Navigation -->
  <div class="dropdown">
    <button class="dropbtn">Journal ▼</button>
    <div class="dropdown-content">
      <a href="journal-info">About the Journal</a>
      <a href="editorial-board">Editorial Board</a>
      <a href="volume-1-issue-1">Vol. 1, Issue 1 (Current)</a>
      <a href="journal-policies">Policies &amp; Ethics</a>
      <a href="author-guidelines">Author Guidelines</a>
      <a href="archive">Archive</a>
    </div>
  </div>

  <button onclick="location.href='officials'">Officials</button>
  <button onclick="location.href='contact'">Contact</button>
  <button onclick="location.href='bye-laws'">Bye-Laws</button>

  <div class="dropdown">
    <button class="dropbtn">Audit ▼</button>
    <div class="dropdown-content">
      <a href="audit">Audit Reports</a>
      <a href="itr">ITR</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn">Members ▼</button>
    <div class="dropdown-content">
      <a href="general-member-list">General Member List</a>
    </div>
  </div>
  </div>
</div>
<script>
function toggleNav() {
  var menu = document.getElementById('nav-menu');
  var overlay = document.getElementById('nav-overlay');
  menu.classList.toggle('open');
  overlay.classList.toggle('active');
}
function closeNav() {
  document.getElementById('nav-menu').classList.remove('open');
  document.getElementById('nav-overlay').classList.remove('active');
}
document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeNav(); });
(function(){
  var path = window.location.pathname.split('/').pop().replace(/\.(php|html)$/, '') || 'index';
  document.querySelectorAll('.page-buttons button[onclick]').forEach(function(btn){
    var m = btn.getAttribute('onclick').match(/location\.href='([^']+)'/);
    if(m && m[1] === path) btn.classList.add('nav-active');
  });
})();
</script>

