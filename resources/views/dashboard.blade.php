<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — LabSystem</title>
    <meta name="description" content="Dashboard Sistem Informasi Manajemen Aset dan BHP Laboratorium.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Outfit', 'Inter', sans-serif; box-sizing: border-box; }
        body {
            margin: 0;
            background: #0a0a1a;
            color: #e2e8f0;
            min-height: 100vh;
        }
        /* -------- SIDEBAR -------- */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 260px; height: 100vh;
            background: rgba(255,255,255,0.04);
            border-right: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            z-index: 100;
            padding: 1.75rem 1.25rem;
        }
        .sidebar-logo {
            display: flex; align-items: center; gap: 0.85rem;
            margin-bottom: 2.5rem;
        }
        .logo-box {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px rgba(99,102,241,0.45);
            flex-shrink: 0;
        }
        .sidebar-title { font-size: 1.1rem; font-weight: 800; color: #fff; line-height: 1.2; }
        .sidebar-subtitle { font-size: 0.72rem; font-weight: 500; color: rgba(165,180,252,0.7); }
        .sidebar-nav { display: flex; flex-direction: column; gap: 0.25rem; flex: 1; }
        .nav-section-label {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(148,163,184,0.5);
            margin: 1.25rem 0 0.5rem 0.5rem;
        }
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 0.9rem;
            border-radius: 0.65rem;
            font-size: 0.9rem; font-weight: 500;
            color: rgba(203,213,225,0.75);
            text-decoration: none;
            transition: all 0.18s ease;
            cursor: pointer;
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(99,102,241,0.18);
            color: #c4b5fd;
        }
        .nav-item svg { opacity: 0.8; flex-shrink: 0; }
        .nav-item.active svg { opacity: 1; }
        .role-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,0.07);
            padding-top: 1.25rem;
            display: flex; flex-direction: column; gap: 0.75rem;
        }
        .user-info {
            display: flex; align-items: center; gap: 0.75rem;
        }
        .user-avatar {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .user-name { font-size: 0.87rem; font-weight: 600; color: #e2e8f0; }
        .user-email { font-size: 0.72rem; color: rgba(148,163,184,0.7); }
        .btn-logout {
            width: 100%;
            padding: 0.6rem;
            border-radius: 0.65rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #fca5a5;
            font-size: 0.85rem; font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }
        .btn-logout:hover { background: rgba(239,68,68,0.2); border-color: rgba(239,68,68,0.5); }
        /* -------- MAIN CONTENT -------- */
        .main {
            margin-left: 260px;
            padding: 2.5rem;
            min-height: 100vh;
            background: linear-gradient(160deg, #0f0c29 0%, #111130 60%, #0a0a1a 100%);
        }
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 2.5rem;
        }
        .page-title { font-size: 1.7rem; font-weight: 800; color: #fff; }
        .page-subtitle { font-size: 0.9rem; color: rgba(148,163,184,0.8); margin-top: 0.2rem; }
        /* -------- STAT CARDS -------- */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem; }
        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 1.1rem;
            padding: 1.5rem;
            position: relative; overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.3); }
        .stat-card::before {
            content: ''; position: absolute;
            top: -30px; right: -30px; width: 100px; height: 100px;
            border-radius: 50%;
            opacity: 0.15;
        }
        .stat-card.indigo::before { background: #6366f1; }
        .stat-card.violet::before { background: #8b5cf6; }
        .stat-card.cyan::before { background: #06b6d4; }
        .stat-card.emerald::before { background: #10b981; }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }
        .stat-icon.indigo { background: rgba(99,102,241,0.2); }
        .stat-icon.violet { background: rgba(139,92,246,0.2); }
        .stat-icon.cyan { background: rgba(6,182,212,0.2); }
        .stat-icon.emerald { background: rgba(16,185,129,0.2); }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: #fff; line-height: 1; margin-bottom: 0.35rem; }
        .stat-label { font-size: 0.8rem; font-weight: 500; color: rgba(148,163,184,0.75); text-transform: uppercase; letter-spacing: 0.05em; }
        /* -------- FEATURE CARDS -------- */
        .section-title { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 1.1rem; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.1rem; }
        .feature-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 1rem;
            padding: 1.4rem;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none; color: inherit;
            display: flex; flex-direction: column; gap: 0.75rem;
        }
        .feature-card:hover { background: rgba(99,102,241,0.12); border-color: rgba(99,102,241,0.4); transform: translateY(-2px); }
        .feature-icon {
            width: 46px; height: 46px; border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(99,102,241,0.4);
        }
        .feature-title { font-size: 0.97rem; font-weight: 700; color: #e2e8f0; }
        .feature-desc { font-size: 0.82rem; color: rgba(148,163,184,0.75); line-height: 1.5; }
        .feature-tag {
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 0.2rem 0.6rem;
            border-radius: 999px; width: fit-content;
        }
        .tag-new { background: rgba(99,102,241,0.2); color: #a5b4fc; }
        .tag-coming { background: rgba(148,163,184,0.1); color: rgba(148,163,184,0.7); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
        }
    </style>
</head>
<body>
    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div>
                <div class="sidebar-title">LabSystem</div>
                <div class="sidebar-subtitle">Manajemen Aset Lab</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <p class="nav-section-label">Utama</p>
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            @if(auth()->user()->isAdmin())
                <p class="nav-section-label">Administrator</p>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Manajemen User
                </a>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Manajemen Ruangan
                </a>
            @endif

            @if(auth()->user()->isKalab())
                <p class="nav-section-label">Kepala Laboratorium</p>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Draf Pengadaan
                </a>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat Pengadaan
                </a>
            @endif

            @if(auth()->user()->isKaprodi())
                <p class="nav-section-label">Ketua Prodi</p>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Review Pengadaan
                </a>
            @endif

            @if(auth()->user()->isAdminStaf())
                <p class="nav-section-label">Staf Administrasi</p>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Input Penerimaan Barang
                </a>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Label & QR Code Aset
                </a>
            @endif

            @if(auth()->user()->isLabStaf())
                <p class="nav-section-label">Staf Laboratorium</p>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    Stok BHP
                </a>
                <a href="#" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Log Maintenance
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-email">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar dari Sistem
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main">
        {{-- Topbar --}}
        <div class="topbar">
            <div>
                <div class="page-title">Dashboard</div>
                <div class="page-subtitle">Selamat datang kembali, <strong style="color:#a5b4fc">{{ auth()->user()->name }}</strong> 👋</div>
            </div>
            <div>
                @php
                    $roleName = auth()->user()->role->name ?? '-';
                    $roleColors = [
                        'Admin' => 'background:rgba(239,68,68,0.15); color:#fca5a5; border:1px solid rgba(239,68,68,0.3)',
                        'Kalab' => 'background:rgba(99,102,241,0.15); color:#a5b4fc; border:1px solid rgba(99,102,241,0.3)',
                        'Kaprodi' => 'background:rgba(139,92,246,0.15); color:#c4b5fd; border:1px solid rgba(139,92,246,0.3)',
                        'Admin_Staf' => 'background:rgba(6,182,212,0.15); color:#67e8f9; border:1px solid rgba(6,182,212,0.3)',
                        'Lab_Staf' => 'background:rgba(16,185,129,0.15); color:#6ee7b7; border:1px solid rgba(16,185,129,0.3)',
                    ];
                    $roleStyle = $roleColors[$roleName] ?? 'background:rgba(148,163,184,0.1); color:#cbd5e1;';
                    $roleLabels = [
                        'Admin' => 'Administrator',
                        'Kalab' => 'Kepala Laboratorium',
                        'Kaprodi' => 'Ketua Program Studi',
                        'Admin_Staf' => 'Staf Administrasi',
                        'Lab_Staf' => 'Staf Laboratorium',
                    ];
                    $roleLabel = $roleLabels[$roleName] ?? $roleName;
                @endphp
                <span class="role-badge" style="{{ $roleStyle }}; border-radius:999px; padding:0.4rem 1rem; font-size:0.78rem; font-weight:700; letter-spacing:0.05em;">
                    {{ $roleLabel }}
                </span>
            </div>
        </div>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card indigo">
                <div class="stat-icon indigo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/></svg>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Total Aset</div>
            </div>
            <div class="stat-card violet">
                <div class="stat-icon violet">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#8b5cf6" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Jenis BHP</div>
            </div>
            <div class="stat-card cyan">
                <div class="stat-icon cyan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#06b6d4" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Draf Pengadaan</div>
            </div>
            <div class="stat-card emerald">
                <div class="stat-icon emerald">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#10b981" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Log Maintenance</div>
            </div>
        </div>

        {{-- Akses Cepat berdasarkan Role --}}
        <div class="section-title">Akses Cepat — {{ $roleLabel }}</div>
        <div class="features-grid">
            @if(auth()->user()->isAdmin())
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                    <div>
                        <div class="feature-title">Kelola Pengguna</div>
                        <div class="feature-desc">Tambah, edit, dan hapus akun pengguna sistem beserta rolenya.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
                    <div>
                        <div class="feature-title">Kelola Ruangan</div>
                        <div class="feature-desc">Daftarkan dan atur data ruangan laboratorium sebagai lokasi aset.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
            @endif

            @if(auth()->user()->isKalab())
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg></div>
                    <div>
                        <div class="feature-title">Buat Draf Pengadaan</div>
                        <div class="feature-desc">Ajukan draf pengadaan aset dan BHP tahunan laboratorium ke Kaprodi.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <div>
                        <div class="feature-title">Riwayat Pengadaan</div>
                        <div class="feature-desc">Lacak status draf pengadaan lama, termasuk yang sudah terkunci.</div>
                    </div>
                    <span class="feature-tag tag-coming">Segera Hadir</span>
                </a>
            @endif

            @if(auth()->user()->isKaprodi())
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg></div>
                    <div>
                        <div class="feature-title">Review Draf Pengadaan</div>
                        <div class="feature-desc">Setujui atau tolak item pengadaan per item dalam draf yang diajukan Kalab.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                    <div>
                        <div class="feature-title">Finalisasi & Kunci Draf</div>
                        <div class="feature-desc">Kunci draf yang sudah selesai direview agar tidak dapat diubah kembali.</div>
                    </div>
                    <span class="feature-tag tag-coming">Segera Hadir</span>
                </a>
            @endif

            @if(auth()->user()->isAdminStaf())
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg></div>
                    <div>
                        <div class="feature-title">Input Penerimaan Barang</div>
                        <div class="feature-desc">Catat penerimaan aset secara parsial atau lengkap beserta tanggal terima.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg></div>
                    <div>
                        <div class="feature-title">Input Label & QR Code</div>
                        <div class="feature-desc">Berikan penomoran kode aset dan unggah foto QR/Barcode tiap barang.</div>
                    </div>
                    <span class="feature-tag tag-coming">Segera Hadir</span>
                </a>
            @endif

            @if(auth()->user()->isLabStaf())
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg></div>
                    <div>
                        <div class="feature-title">Kelola Stok BHP</div>
                        <div class="feature-desc">Catat restock dan pemakaian Barang Habis Pakai (BHP) laboratorium harian.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
                <a href="#" class="feature-card">
                    <div class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                    <div>
                        <div class="feature-title">Log Maintenance Aset</div>
                        <div class="feature-desc">Catat pemeliharaan aset, update kondisi, dan potong stok BHP otomatis.</div>
                    </div>
                    <span class="feature-tag tag-new">Tersedia</span>
                </a>
            @endif
        </div>
    </main>
</body>
</html>
