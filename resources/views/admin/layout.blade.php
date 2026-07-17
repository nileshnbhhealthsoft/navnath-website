@php
  $isAuthenticated = session()->get('admin_authenticated', false) === true;
  $adminSiteContent = $isAuthenticated ? \App\Models\SiteContent::current() : [];
  $adminLogoPath = (string) data_get($adminSiteContent, 'media.brand_mark', '');
  $adminFaviconPath = (string) data_get($adminSiteContent, 'media.favicon', '');
@endphp
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Ascent Admin')</title>
  @if ($adminFaviconPath !== '')
    <link rel="icon" href="{{ asset($adminFaviconPath) }}">
  @endif
  <style>
    :root{--sidebar:#21183c;--sidebar-2:#4b3a80;--primary:#5f49a8;--accent:#c376b8;--page:#f5f6fa;--ink:#172033;--muted:#6b7280;--line:#e2e6ef;--white:#fff;--danger:#be123c;--success:#047857}
    *{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--page);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}a{color:inherit;text-decoration:none}button,input,textarea,select{font:inherit}
    .admin-shell{min-height:100vh}.sidebar{position:fixed;inset:0 auto 0 0;width:270px;background:linear-gradient(180deg,var(--sidebar),var(--sidebar-2));color:#fff;display:flex;flex-direction:column;z-index:50;box-shadow:18px 0 50px -36px #130921}.sidebar-brand{min-height:82px;padding:18px 20px;display:flex;align-items:center;gap:12px;border-bottom:1px solid #ffffff1c}.sidebar-logo{width:54px;height:54px;object-fit:contain;border-radius:11px;background:#fff;padding:3px}.sidebar-mark{width:44px;height:44px;border-radius:13px;display:grid;place-items:center;background:linear-gradient(135deg,var(--accent),var(--primary));font-size:19px;font-weight:900}.brand-title{font-size:18px;font-weight:850;line-height:1.05}.brand-subtitle{font-size:11px;color:#ffffffa8;letter-spacing:.12em;text-transform:uppercase;margin-top:5px}.sidebar-nav{padding:20px 14px;display:grid;gap:6px}.nav-section{padding:10px 12px 5px;color:#ffffff70;font-size:10px;font-weight:800;letter-spacing:.16em;text-transform:uppercase}.sidebar-link{display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:11px;color:#f4effa;font-size:14px;font-weight:650;transition:.2s}.sidebar-link svg{width:20px;height:20px;flex:0 0 20px}.sidebar-link:hover{background:#ffffff14;transform:translateX(2px)}.sidebar-link.active{background:#fff;color:var(--sidebar-2);box-shadow:0 12px 30px -22px #000}.sidebar-bottom{margin-top:auto;padding:14px;border-top:1px solid #ffffff1c}.logout-form{margin:0}.logout-button{width:100%;border:0;background:transparent;text-align:left;cursor:pointer}.main-area{margin-left:270px;min-height:100vh}.admin-topbar{height:72px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:35}.topbar-title{font-size:20px;font-weight:800;color:#2f1c50}.topbar-actions{display:flex;align-items:center;gap:10px}.view-site{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border:1px solid var(--line);border-radius:10px;background:#fff;font-size:13px;font-weight:700;color:#3d2469}.view-site:hover{border-color:#9b7cbd;background:#faf8fc}.mobile-toggle{display:none;border:0;background:#f0ecf5;color:#3d2469;width:42px;height:42px;border-radius:10px;cursor:pointer}.content-area{padding:28px}.wrap{max-width:1240px;margin:0 auto}.card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:22px;box-shadow:0 12px 34px -28px #241340;margin-bottom:20px}.section-card{border-left:4px solid var(--primary)}.group{border:1px solid #e4e0eb;border-radius:12px;padding:16px;margin-top:14px;background:#faf9fc}.group legend{font-weight:750;color:#3d2469;padding:0 7px}.list-item{border:1px dashed #c9bdd8;border-radius:12px;padding:15px;margin-top:12px;background:#fff}.field{margin-top:13px}.field label{display:block;font-size:13px;font-weight:700;margin-bottom:6px;color:#3d2469}.field input,.field textarea,.field select{width:100%;border:1px solid #cfd5e2;border-radius:9px;padding:10px 12px;background:#fff}.field textarea{min-height:92px;resize:vertical}.field input:focus,.field textarea:focus,.field select:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px #6339a01a}.btn{display:inline-flex;align-items:center;justify-content:center;border:0;border-radius:10px;padding:11px 17px;font-weight:750;cursor:pointer}.btn-primary{background:linear-gradient(90deg,#3d2469,#6339a0);color:#fff}.btn-secondary{background:#ece8f2;color:#3d2469}.actions{position:sticky;bottom:14px;display:flex;justify-content:flex-end;margin-top:20px;z-index:10}.actions-inner{background:#ffffffeb;border:1px solid #ddd7e7;border-radius:14px;padding:10px;box-shadow:0 15px 35px -20px #241340}.alert{padding:12px 15px;border-radius:10px;margin-bottom:16px}.alert-success{background:#ecfdf5;color:var(--success);border:1px solid #a7f3d0}.alert-error{background:#fff1f2;color:var(--danger);border:1px solid #fecdd3}.grid{display:grid;gap:14px}.grid-2{grid-template-columns:repeat(2,minmax(0,1fr))}.message{border-bottom:1px solid #e4e7ee;padding:18px 0}.message:last-child{border-bottom:0}.muted{color:var(--muted);font-size:13px}.pagination nav{display:flex;gap:8px}.pagination svg{width:18px}.login-wrap{min-height:100vh;display:grid;place-items:center;padding:20px;background:radial-gradient(circle at 15% 20%,#c177ba2c,transparent 30%),linear-gradient(135deg,#f8f6fb,#eee9f4)}.login-card{width:min(430px,100%)}h1,h2,h3{margin-top:0}.hint{font-size:13px;color:var(--muted);line-height:1.55}.page-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:16px}.page-heading h1{margin-bottom:8px}.stats-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:18px}.stat-card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:20px;display:flex;align-items:center;gap:16px;box-shadow:0 14px 34px -30px #241340}.stat-icon{width:50px;height:50px;border-radius:14px;display:grid;place-items:center;background:#f0eaf6;color:#6339a0}.stat-icon svg{width:24px;height:24px}.stat-value{font-size:26px;font-weight:850;color:#2f1c50}.stat-label{font-size:12px;color:var(--muted);margin-top:2px}.quick-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}.quick-card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:22px;transition:.2s}.quick-card:hover{transform:translateY(-3px);border-color:#bca8d1;box-shadow:0 20px 40px -32px #241340}.quick-card svg{width:28px;height:28px;color:#6339a0}.media-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}.media-card{border:1px solid var(--line);border-radius:14px;padding:15px;background:#fff}.media-preview{height:150px;border-radius:11px;background:linear-gradient(135deg,#f4f1f8,#e9edf4);display:grid;place-items:center;overflow:hidden;border:1px dashed #c9bdd8}.media-preview img{width:100%;height:100%;object-fit:contain;padding:8px}.media-empty{font-size:12px;color:#7b7286;text-align:center;padding:12px}.media-label{font-weight:800;color:#3d2469;margin-top:13px}.media-help{font-size:12px;color:var(--muted);min-height:36px;margin-top:4px}.media-file{margin-top:12px;width:100%;font-size:12px}.remove-row{display:flex;align-items:center;gap:7px;margin-top:11px;font-size:12px;color:#7f1d1d}.remove-row input{width:auto}.upload-note{display:flex;align-items:flex-start;gap:10px;background:#f6f0fb;border:1px solid #e0d3ec;border-radius:12px;padding:13px 15px;color:#4b2c79;font-size:13px}.mobile-backdrop{display:none}
    @media(max-width:1050px){.stats-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.media-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
    @media(max-width:820px){.sidebar{transform:translateX(-100%);transition:transform .25s}.sidebar.open{transform:translateX(0)}.main-area{margin-left:0}.mobile-toggle{display:grid;place-items:center}.mobile-backdrop{position:fixed;inset:0;background:#14092399;z-index:45}.mobile-backdrop.show{display:block}.admin-topbar{padding:0 16px}.content-area{padding:18px 12px}.topbar-title{font-size:17px}.view-site span{display:none}}
    @media(max-width:650px){.grid-2,.stats-grid,.quick-grid,.media-grid{grid-template-columns:1fr}.card{padding:16px}.page-heading{display:block}.admin-topbar{height:64px}.media-preview{height:180px}}
  </style>
</head>
<body>
@if ($isAuthenticated)
  <div class="admin-shell">
    <aside id="adminSidebar" class="sidebar" aria-label="Admin sidebar">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        @if ($adminLogoPath !== '')
          <img src="{{ asset($adminLogoPath) }}" alt="Ascent" class="sidebar-logo">
        @else
          <div class="sidebar-mark">A</div>
        @endif
        <div><div class="brand-title">Ascent Admin</div><div class="brand-subtitle">Website Manager</div></div>
      </a>

      <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <svg viewBox="0 0 24 24" fill="none"><path d="M4 13h6V4H4v9zm0 7h6v-5H4v5zm10 0h6v-9h-6v9zm0-16v5h6V4h-6z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
          Dashboard
        </a>
        <div class="nav-section">Website</div>
        <a class="sidebar-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}" href="{{ route('admin.content.edit') }}">
          <svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16M4 12h16M4 19h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          Website Content
        </a>
        <a class="sidebar-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}" href="{{ route('admin.media.edit') }}">
          <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.8"/><circle cx="8" cy="9" r="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M4 17l5-5 4 4 3-3 4 4" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
          Images &amp; Logo
        </a>
        <a class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
          <svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v12H8l-4 3V5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M8 9h8M8 13h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          Contact Messages
        </a>
      </nav>

      <div class="sidebar-bottom">
        <a class="sidebar-link" href="{{ route('home') }}" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="none"><path d="M14 5h5v5M10 14L19 5M19 14v5H5V5h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          View Website
        </a>
        <form class="logout-form" method="POST" action="{{ route('admin.logout') }}">@csrf
          <button class="sidebar-link logout-button" type="submit">
            <svg viewBox="0 0 24 24" fill="none"><path d="M10 5H5v14h5M14 8l4 4-4 4M18 12H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Logout
          </button>
        </form>
      </div>
    </aside>
    <div id="adminBackdrop" class="mobile-backdrop"></div>

    <div class="main-area">
      <header class="admin-topbar">
        <div style="display:flex;align-items:center;gap:12px">
          <button id="sidebarToggle" class="mobile-toggle" type="button" aria-label="Open sidebar">
            <svg width="23" height="23" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <div class="topbar-title">@yield('page_title', 'Admin Panel')</div>
        </div>
        <div class="topbar-actions">
          <a class="view-site" href="{{ route('home') }}" target="_blank" rel="noopener">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M14 5h5v5M10 14L19 5M19 14v5H5V5h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>View Website</span>
          </a>
        </div>
      </header>
      <div class="content-area">@yield('content')</div>
    </div>
  </div>
@else
  @yield('content')
@endif
<script>
(() => {
  const sidebar = document.getElementById('adminSidebar');
  const toggle = document.getElementById('sidebarToggle');
  const backdrop = document.getElementById('adminBackdrop');
  const close = () => { sidebar?.classList.remove('open'); backdrop?.classList.remove('show'); };
  toggle?.addEventListener('click', () => { sidebar?.classList.toggle('open'); backdrop?.classList.toggle('show'); });
  backdrop?.addEventListener('click', close);
  window.addEventListener('resize', () => { if (window.innerWidth > 820) close(); });
})();
</script>
</body>
</html>
