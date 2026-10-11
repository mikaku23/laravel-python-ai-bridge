<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'POS Python Bridge')</title>
    <style>
        :root { color-scheme: light; --ink:#172033; --muted:#667085; --line:#e4e7ec; --bg:#f5f7fb; --blue:#2457c5; --green:#18794e; }
        * { box-sizing:border-box; }
        body { margin:0; background:var(--bg); color:var(--ink); font:15px/1.5 system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; }
        header { background:#101828; color:#fff; padding:18px 24px; }
        header .inner, main { max-width:1120px; margin:auto; }
        header .brand { font-weight:750; letter-spacing:.2px; }
        header small { display:block; color:#cbd5e1; margin-top:3px; }
        main { padding:28px 20px 50px; }
        .topbar { display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:22px; flex-wrap:wrap; }
        h1 { margin:0 0 5px; font-size:27px; letter-spacing:-.5px; }
        h2 { margin:0 0 18px; font-size:21px; }
        p { margin:0 0 12px; }
        .muted { color:var(--muted); }
        .card { background:#fff; border:1px solid var(--line); border-radius:14px; padding:20px; box-shadow:0 5px 18px rgba(16,24,40,.035); }
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:6px; border:1px solid transparent; border-radius:9px; padding:9px 13px; text-decoration:none; font-weight:650; font-size:14px; cursor:pointer; }
        .btn-primary { background:var(--blue); color:#fff; }
        .btn-light { background:#fff; color:#344054; border-color:#d0d5dd; }
        .btn-danger { background:#fff; color:#b42318; border-color:#fecdca; }
        .btn-small { padding:6px 9px; font-size:12px; }
        .status { display:inline-flex; padding:5px 9px; border-radius:999px; font-size:12px; font-weight:750; }
        .status-online,.badge-aman { background:#dcfae6; color:#166534; }
        .status-offline,.badge-habis { background:#fee4e2; color:#b42318; }
        .badge-menipis { background:#fef0c7; color:#93370d; }
        .alert { padding:11px 13px; border-radius:9px; margin-bottom:16px; background:#dcfae6; color:#166534; }
        .alert-error { background:#fee4e2; color:#b42318; }
        .table-wrap { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; min-width:780px; }
        th,td { text-align:left; padding:13px 12px; border-bottom:1px solid #eaecf0; vertical-align:top; }
        th { color:#667085; font-size:12px; text-transform:uppercase; letter-spacing:.04em; background:#f9fafb; }
        td small { display:block; color:var(--muted); margin-top:5px; max-width:260px; }
        .actions { display:flex; gap:7px; align-items:center; }
        .actions form { margin:0; }
        .form-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:16px; }
        .field { display:flex; flex-direction:column; gap:6px; }
        .field.full { grid-column:1 / -1; }
        label { font-size:13px; font-weight:700; color:#344054; }
        input { width:100%; border:1px solid #d0d5dd; border-radius:8px; padding:11px 12px; font:inherit; outline-color:#84adff; }
        .field-error { color:#b42318; font-size:12px; }
        .form-actions { display:flex; gap:9px; margin-top:22px; }
        .note { font-size:12px; color:var(--muted); margin-top:18px; }
        @media (max-width:640px) { header {padding:16px;} main {padding:22px 12px;} .card {padding:14px;} h1 {font-size:23px;} .form-grid {grid-template-columns:1fr;} .field.full {grid-column:auto;} }
    </style>
</head>
<body>
<header>
    <div class="inner">
        <div class="brand">POS · Laravel + Python</div>
        <small>Demo lokal untuk CRUD produk dan integrasi API internal</small>
    </div>
</header>
<main>
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-error">Ada data yang perlu diperbaiki. Periksa pesan di setiap kolom.</div>
    @endif
    @yield('content')
</main>
</body>
</html>
