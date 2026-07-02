<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - MUDEA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-mid: #2e7d32;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
            --gold: #f5a623;
            --gold-light: #fff8e1;
            --blue: #1565c0;
            --blue-light: #e3f2fd;
            --purple: #6a1b9a;
            --purple-light: #f3e5f5;
            --orange: #e65100;
            --orange-light: #fff3e0;
            --white: #ffffff;
            --cream: #f4f6f8;
            --border: #e0e8e4;
            --text: #1a2e25;
            --text-mid: #455d4f;
            --text-light: #7a9585;
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, .07);
            --shadow-md: 0 6px 24px rgba(0, 0, 0, .11);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text);
            display: flex;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--green-dark);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 200;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .15);
            border-radius: 2px;
        }

        .sidebar-logo {
            background: white;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            flex-shrink: 0;
        }

        .sidebar-logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .sidebar-logo-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .sidebar-logo-text strong {
            display: block;
            font-size: .95rem;
            font-weight: 900;
            color: var(--green-dark);
            line-height: 1.1;
        }

        .sidebar-logo-text span {
            font-size: .68rem;
            color: var(--text-light);
            line-height: 1.3;
        }

        .sidebar-nav {
            padding: 16px 0;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            cursor: pointer;
            color: rgba(255, 255, 255, .72);
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s;
            position: relative;
            border-radius: 0;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, .08);
            color: white;
        }

        .nav-item.active {
            background: var(--green-mid);
            color: white;
            font-weight: 800;
            border-left: 3px solid var(--gold);
        }

        .nav-item .nav-icon {
            width: 20px;
            text-align: center;
            font-size: .9rem;
            flex-shrink: 0;
        }

        .nav-item .nav-badge {
            margin-left: auto;
            background: #e53935;
            color: white;
            font-size: .65rem;
            font-weight: 900;
            padding: 2px 7px;
            border-radius: 999px;
            min-width: 20px;
            text-align: center;
        }

        .nav-separator {
            height: 1px;
            background: rgba(255, 255, 255, .08);
            margin: 10px 20px;
        }

        .sidebar-bottom {
            padding: 12px 0 16px;
            border-top: 1px solid rgba(255, 255, 255, .08);
            flex-shrink: 0;
        }

        .nav-item--logout {
            color: #ef9a9a;
        }

        .nav-item--logout:hover {
            background: rgba(229, 57, 53, .12);
            color: #ef5350;
        }

        /* ─── MAIN AREA ─── */
        .main-area {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-menu-btn {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-mid);
            font-size: 1.1rem;
            transition: background .2s;
        }

        .topbar-menu-btn:hover {
            background: var(--cream);
        }

        .topbar-page-title strong {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text);
            display: block;
            line-height: 1.1;
        }

        .topbar-page-title span {
            font-size: .78rem;
            color: var(--text-light);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-notif {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--cream);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-mid);
            font-size: 1rem;
            transition: background .2s;
        }

        .topbar-notif:hover {
            background: var(--green-light);
        }

        .topbar-notif-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #e53935;
            color: white;
            font-size: .6rem;
            font-weight: 900;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .topbar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--green-light);
            border: 2px solid var(--green-soft);
        }

        .topbar-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        .topbar-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1rem;
        }

        .topbar-user-info strong {
            display: block;
            font-size: .88rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.1;
        }

        .topbar-user-info span {
            font-size: .72rem;
            color: var(--text-light);
        }

        .topbar-chevron {
            color: var(--text-light);
            font-size: .75rem;
        }

        /* ─── PAGE CONTENT ─── */
        .page-content {
            flex: 1;
            padding: 28px 32px;
        }

        /* ─── FOOTER ─── */
        .admin-footer {
            text-align: center;
            padding: 16px 32px;
            border-top: 1px solid var(--border);
            font-size: .75rem;
            color: var(--text-light);
            background: var(--white);
        }

        /* ─── SIDEBAR COLLAPSE (JS) ─── */
        body.sidebar-collapsed .sidebar {
            width: 64px;
        }

        body.sidebar-collapsed .sidebar-logo-text,
        body.sidebar-collapsed .nav-item span:not(.nav-badge),
        body.sidebar-collapsed .nav-separator {
            display: none;
        }

        body.sidebar-collapsed .sidebar-logo {
            justify-content: center;
        }

        body.sidebar-collapsed .main-area {
            margin-left: 64px;
        }

        body.sidebar-collapsed .nav-item {
            justify-content: center;
            padding: 11px;
        }

        body.sidebar-collapsed .nav-item .nav-badge {
            position: absolute;
            top: 6px;
            right: 6px;
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="MUDEA"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
            <div class="sidebar-logo-placeholder" style="display:none;">M</div>
            <div class="sidebar-logo-text">
                <strong>MUDEA</strong>
                <span>Mutuelle de Développement<br>Durable</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-house"></i></span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.actualites.index') }}"
                class="nav-item {{ request()->routeIs('admin.actualites*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-newspaper"></i></span>
                <span>Actualités</span>
            </a>
            <!-- <a href="{{ route('admin.pages') }}"
                class="nav-item {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-file-lines"></i></span>
                <span>Pages</span>
            </a> -->
            <a href="{{ route('admin.vie-coutumes.index') }}"
                class="nav-item {{ request()->routeIs('admin.vie-coutumes*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-masks-theater"></i></span>
                <span>Vie &amp; Coutumes</span>
            </a>
            <a href="{{ route('admin.education.index') }}"
                class="nav-item {{ request()->routeIs('admin.education*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-graduation-cap"></i></span>
                <span>Éducation &amp; Excellence</span>
            </a>
            <a href="{{ route('admin.communaute') }}"
                class="nav-item {{ request()->routeIs('admin.communaute*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-people-group"></i></span>
                <span>Espace Communautaire</span>
            </a>
            <a href="{{ route('admin.bureau') }}"
                class="nav-item {{ request()->routeIs('admin.bureau*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                <span>Bureau</span>
            </a>
            <a href="{{ route('admin.projets') }}"
                class="nav-item {{ request()->routeIs('admin.projets*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-diagram-project"></i></span>
                <span>Projets</span>
            </a>
            <a href="{{ route('admin.messages') }}"
                class="nav-item {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-envelope"></i></span>
                <span>Messages</span>
                <span class="nav-badge">46</span>
            </a>

            <div class="nav-separator"></div>

            <a href="{{ route('admin.utilisateurs') }}"
                class="nav-item {{ request()->routeIs('admin.utilisateurs*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-users"></i></span>
                <span>Utilisateurs</span>
            </a>
            <a href="{{ route('admin.parametres') }}"
                class="nav-item {{ request()->routeIs('admin.parametres*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-gear"></i></span>
                <span>Paramètres</span>
            </a>
            <a href="{{ route('admin.statistiques') }}"
                class="nav-item {{ request()->routeIs('admin.statistiques*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                <span>Statistiques</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ route('logout') }}" class="nav-item nav-item--logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="nav-icon"><i class="fas fa-right-from-bracket"></i></span>
                <span>Déconnexion</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </aside>

    {{-- ── MAIN AREA ── --}}
    <div class="main-area">

        {{-- Topbar --}}
        <header class="topbar">
            <div class="topbar-left">
                <button class="topbar-menu-btn" onclick="document.body.classList.toggle('sidebar-collapsed')">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="topbar-page-title">
                    <strong>@yield('page-title', 'Dashboard')</strong>
                    <span>@yield('page-subtitle', 'Bienvenue dans l\'administratùion MUDEA')</span>
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-notif">
                    <i class="fas fa-bell"></i>
                    <div class="topbar-notif-badge">2</div>
                </div>
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        <img src="{{ asset('images/admin/avatar-default.jpg') }}" alt="Photo de profil admin"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="topbar-avatar-placeholder" style="display:none;"><i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="topbar-user-info">
                        <strong>{{ Auth::user()->nom . ' ' . Auth::user()->prenom }}</strong>
                        <span>{{ Auth::user()->role === 'admin' ? 'Administrateur' : Auth::user()->role }}</span>
                    </div>
                    <i class="fas fa-chevron-down topbar-chevron"></i>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="page-content">
            @yield('content')
        </main>

        <footer class="admin-footer">
            &copy; {{ date('Y') }} MUDEA - Mutuelle de Développement Durable. Tous droits réservés.
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
