@extends('layouts.app')

@section('title', 'Accueil - MUDEA')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
                               VARIABLES & RESET
        ============================================================ */
        :root {
            --green:        #1e6b2e;
            --green-mid:    #2e7d32;
            --green-light:  #43a047;
            --green-pale:   #e8f5e9;
            --gold:         #f5a623;
            --gold-dark:    #d4880a;
            --white:        #ffffff;
            --off-white:    #f7f9f7;
            --dark:         #111a12;
            --text:         #2c3e2d;
            --muted:        #607063;
            --border:       #dde8de;
            --footer-bg:    #0f2313;
            --shadow-sm:    0 2px 8px rgba(0,0,0,.08);
            --shadow-md:    0 6px 24px rgba(0,0,0,.12);
            --shadow-lg:    0 16px 48px rgba(0,0,0,.16);
            --radius:       12px;
            --radius-sm:    8px;
            --transition:   .25s cubic-bezier(.4,0,.2,1);
            --font-body:    'Nunito', sans-serif;
            --font-display: 'Playfair Display', serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            color: var(--text);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        img { max-width: 100%; display: block; }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ============================================================
           HEADER
        ============================================================ */
        .mudea-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--white);
            box-shadow: 0 2px 16px rgba(0,0,0,.09);
            font-family: var(--font-body);
        }

        .header-inner {
            display: flex;
            align-items: center;
            min-height: 82px;
            height: auto;
            gap: 24px;
            width: min(100%, 1320px);
            margin: 0 auto;
            padding: 12px 24px;
            flex-wrap: wrap;
        }

        /* Logo */
        .header-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .logo-img {
            height: 56px;
            width: auto;
            object-fit: contain;
        }

        .logo-text { display: flex; flex-direction: column; line-height: 1.15; }

        .logo-name {
            font-size: 1.3rem;
            font-weight: 900;
            color: var(--green);
            letter-spacing: 2.5px;
        }

        .logo-subtitle {
            font-size: 0.5rem;
            font-weight: 700;
            color: var(--green-mid);
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        /* Nav */
        .header-nav { flex: 1; min-width: 0; }

        .nav-list {
            display: flex;
            align-items: center;
            gap: 0;
            flex-wrap: wrap;
        }

        .nav-item { position: relative; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 9px 12px;
            font-size: .8rem;
            font-weight: 700;
            color: var(--text);
            border-radius: 6px;
            white-space: nowrap;
            transition: color var(--transition), background var(--transition);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .nav-link:hover,
        .nav-item.active > .nav-link {
            color: var(--green);
            background: var(--green-pale);
        }

        .nav-item.active > .nav-link {
            color: var(--green);
            border-bottom: 2px solid var(--green);
            border-radius: 0;
        }

        .nav-arrow {
            font-size: .6rem;
            color: var(--green);
            transition: transform var(--transition);
        }

        .nav-item.has-dropdown:hover .nav-arrow { transform: rotate(180deg); }

        /* Dropdown */
        .dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            min-width: 200px;
            background: var(--white);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-md);
            border-top: 3px solid var(--green);
            padding: 8px 0;
            z-index: 999;
        }

        .nav-item.has-dropdown:hover .dropdown { display: block; animation: dropFade .18s ease; }

        @keyframes dropFade {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .dropdown a {
            display: block;
            padding: 9px 18px;
            font-size: .82rem;
            font-weight: 600;
            color: var(--text);
            transition: background var(--transition), padding-left var(--transition);
        }

        .dropdown a:hover {
            background: var(--green-pale);
            color: var(--green);
            padding-left: 24px;
        }

        /* Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .btn-search {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            padding: 8px;
            border-radius: 50%;
            transition: background var(--transition);
            display: flex;
            align-items: center;
        }

        .btn-search:hover { background: var(--green-pale); color: var(--green); }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            cursor: pointer;
            border: none;
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
        }

        .btn-hero:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

        .btn-adherer  { background: var(--green); color: var(--white); }
        .btn-adherer:hover  { background: var(--green-mid); }
        .btn-contribuer { background: var(--gold); color: var(--white); }
        .btn-contribuer:hover { background: var(--gold-dark); }

        /* Burger */
        .burger-btn {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }
        .burger-btn span {
            display: block;
            width: 24px; height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all var(--transition);
        }

        /* Search bar */
        .search-bar {
            display: none;
            background: var(--green);
            padding: 12px 24px;
        }
        .search-bar.open { display: block; animation: dropFade .2s ease; }
        .search-bar-inner {
            display: flex;
            align-items: center;
            max-width: 700px;
            margin: 0 auto;
            gap: 10px;
        }
        .search-input {
            flex: 1;
            padding: 10px 18px;
            border: none;
            border-radius: 50px;
            font-size: .9rem;
            font-family: var(--font-body);
            outline: none;
        }
        .search-btn {
            background: var(--gold);
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 800;
            cursor: pointer;
            font-size: .82rem;
        }
        .search-close {
            background: none; border: none; color: white;
            font-size: 1.5rem; cursor: pointer; line-height: 1;
        }

        /* ============================================================
           HERO
        ============================================================ */
        .hero {
            position: relative;
            min-height: 620px;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, #0a2e14 0%, #1e5c28 60%, #2e7d32 100%);
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset("images/hero-ande.png") }}');
            background-size: cover;
            background-position: center;
            opacity: .42;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 80px 24px;
            max-width: 640px;
            margin-left: clamp(24px, 5vw, 72px);
        }

        .hero-badge {
            display: inline-block;
            background: var(--gold);
            color: var(--white);
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 6px;
        }

        .hero-title .accent { color: var(--gold); }

        .hero-desc {
            color: rgba(255,255,255,.85);
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 500px;
        }

        .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }

        .btn-outline-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            border: 2px solid var(--white);
            color: var(--white);
            background: transparent;
            transition: background var(--transition), color var(--transition);
        }
        .btn-outline-white:hover { background: var(--white); color: var(--green); }

        .btn-gold-solid {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 8px;
            font-size: .9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: var(--gold);
            color: var(--white);
            border: 2px solid var(--gold);
            transition: background var(--transition);
        }
        .btn-gold-solid:hover { background: var(--gold-dark); border-color: var(--gold-dark); }

        /* ============================================================
           STATS BAR
        ============================================================ */
        .stats-bar {
            background: var(--white);
            box-shadow: var(--shadow-md);
            border-radius: var(--radius);
            margin: 0 auto;
            max-width: 1320px;
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            overflow: hidden;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            padding: 28px 24px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid transparent;
            transition: background var(--transition);
        }
        .stat-item:last-child { border-right: none; }
        .stat-item:hover { background: var(--green-pale); }

        .stat-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 10px;
        }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 26px; height: 26px; fill: white; }
        .stat-icon--green  { background: var(--green); }
        .stat-icon--gold   { background: var(--gold); }
        .stat-icon--blue   { background: #1565c0; }
        .stat-icon--purple { background: #6a1b9a; }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            color: var(--dark);
            line-height: 1;
        }

        .stat-label {
            font-size: .7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
        }

        .stat-desc {
            font-size: .83rem;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .stat-link {
            font-size: .82rem;
            font-weight: 700;
            color: var(--green);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap var(--transition);
        }
        .stat-item:nth-child(2) .stat-link { color: var(--gold); }
        .stat-link:hover { gap: 10px; }

        /* ============================================================
           SECTIONS GÉNÉRALES
        ============================================================ */
        .section { padding: 72px 24px; }
        .section--gray { background: var(--off-white); }

        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 36px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 40px; height: 3px;
            background: var(--gold);
            margin-top: 6px;
            border-radius: 2px;
        }

        .section-all {
            font-size: .82rem;
            font-weight: 700;
            color: var(--green);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
            transition: gap var(--transition);
        }
        .section-all:hover { gap: 10px; }

        /* ============================================================
           PROJETS
        ============================================================ */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            max-width: 1240px;
            margin: 0 auto;
        }

        .project-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .project-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .project-img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--green-pale), var(--green-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .project-body { padding: 22px; }

        .project-name {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .project-desc {
            font-size: .83rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .project-progress-bar {
            background: var(--border);
            border-radius: 50px;
            height: 6px;
            margin-bottom: 6px;
            overflow: hidden;
        }

        .project-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--green-light));
            border-radius: 50px;
            transition: width 1s ease;
        }

        .project-progress-label {
            font-size: .75rem;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .project-link {
            font-size: .82rem;
            font-weight: 700;
            color: var(--green);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap var(--transition);
        }
        .project-link:hover { gap: 10px; }

        /* ============================================================
           ACTUALITÉS
        ============================================================ */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
            max-width: 1320px;
            margin: 0 auto;
        }

        .news-card {
            display: flex;
            gap: 20px;
            background: var(--white);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .news-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }

        .news-date-box {
            flex-shrink: 0;
            width: 60px;
            text-align: center;
            background: var(--green);
            color: white;
            border-radius: var(--radius-sm);
            padding: 10px 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .news-day { font-size: 1.5rem; font-weight: 900; line-height: 1; }
        .news-month { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; opacity: .85; }

        .news-img {
            flex-shrink: 0;
            width: 90px; height: 90px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            background: var(--green-pale);
            display: flex; align-items: center; justify-content: center; font-size: 1.8rem;
        }

        .news-body { flex: 1; min-width: 0; }

        .news-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .news-excerpt {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .news-link {
            font-size: .78rem;
            font-weight: 700;
            color: var(--green);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap var(--transition);
        }
        .news-link:hover { gap: 8px; }

        /* ============================================================
           BLOCS ÉDUC + COMMUNAUTÉ
        ============================================================ */
        .duo-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            max-width: 1240px;
            margin: 0 auto;
        }

        .duo-card {
            display: flex;
            align-items: center;
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .duo-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }

        .duo-card-image {
            flex-shrink: 0;
            width: 38%;
            height: 180px;
            overflow: hidden;
        }

        .duo-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .duo-card-content {
            flex: 1;
            padding: 24px;
        }

        .duo-card-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .duo-card--educ      .duo-card-title { color: var(--gold-dark); }
        .duo-card--community .duo-card-title { color: var(--green); }

        .duo-card-desc {
            font-size: .88rem;
            line-height: 1.6;
            margin-bottom: 18px;
            color: var(--muted);
        }

        .btn-duo-gold,
        .btn-duo-green {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--white);
            transition: background var(--transition), transform var(--transition);
        }

        .btn-duo-gold  { background: var(--gold); }
        .btn-duo-gold:hover  { background: var(--gold-dark); transform: translateY(-2px); }

        .btn-duo-green { background: var(--green); }
        .btn-duo-green:hover { background: var(--green-mid); transform: translateY(-2px); }

        /* ============================================================
           CTA BANNER
        ============================================================ */
        .cta-banner {
            background: linear-gradient(135deg, var(--green-mid) 0%, var(--green) 100%);
            padding: 50px 24px;
            display: flex;
            align-items: center;
            gap: 32px;
            flex-wrap: wrap;
        }

        .cta-banner-left {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
            min-width: 260px;
        }

        .cta-icon {
            width: 64px; height: 64px;
            background: rgba(255,255,255,.15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .cta-icon svg { width: 32px; height: 32px; fill: white; }

        .cta-title {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            margin-bottom: 4px;
        }
        .cta-desc { font-size: .88rem; color: rgba(255,255,255,.8); line-height: 1.5; }

        .cta-btns {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 50px;
            font-size: .88rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: var(--gold);
            color: white;
            border: 2px solid var(--gold);
            transition: background var(--transition), transform var(--transition);
        }
        .btn-cta-primary:hover { background: var(--gold-dark); border-color: var(--gold-dark); transform: translateY(-2px); }

        .btn-cta-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 50px;
            font-size: .88rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,.6);
            transition: border-color var(--transition), background var(--transition);
        }
        .btn-cta-outline:hover { border-color: white; background: rgba(255,255,255,.08); }

        /* ============================================================
           FOOTER
        ============================================================ */
        .mudea-footer {
            background: var(--footer-bg);
            color: #c8d8ca;
            font-family: var(--font-body);
        }

        .footer-main {
            display: grid;
            grid-template-columns: 1.6fr 1fr 1fr 1.5fr 0.8fr;
            gap: 32px;
            max-width: 1240px;
            margin: 0 auto;
            padding: 56px 24px 48px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .footer-logo-img {
            height: 50px;
            width: auto;
            object-fit: contain;
            display: block;
            filter: none;
            opacity: 1;
        }

        .footer-logo-name {
            font-size: 1.15rem;
            font-weight: 900;
            color: white;
            letter-spacing: 2px;
        }

        .footer-logo-sub {
            font-size: .48rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--green-light);
            letter-spacing: .5px;
        }

        .footer-col-title {
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: white;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--green-mid);
            display: inline-block;
        }

        .footer-links { display: flex; flex-direction: column; gap: 8px; }

        .footer-links a {
            font-size: .83rem;
            color: #c8d8ca;
            transition: color var(--transition), padding-left var(--transition);
        }
        .footer-links a:hover { color: var(--gold); padding-left: 5px; }

        .footer-links--cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
        }

        .footer-contact { display: flex; flex-direction: column; gap: 10px; }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: .83rem;
        }

        .footer-contact-item svg {
            width: 14px; height: 14px;
            fill: var(--green-light);
            margin-top: 2px;
            flex-shrink: 0;
        }

        .footer-social { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 4px; }

        .social-btn {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            transition: transform var(--transition), opacity var(--transition);
            text-decoration: none;
        }
        .social-btn:hover { transform: translateY(-3px); opacity: .85; }
        .social-btn svg { width: 18px; height: 18px; fill: white; }

        .social-btn--fb { background: #1877f2; }
        .social-btn--wa { background: #25d366; }
        .social-btn--yt { background: #ff0000; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.07);
            text-align: center;
            padding: 16px 24px;
            font-size: .75rem;
            color: rgba(255,255,255,.35);
        }

        /* ============================================================
           RESPONSIVE
           Repères : 1024px (tablette paysage) · 900px (tablette/menu burger)
                     640px (mobile) · 480px (petit mobile)
        ============================================================ */
        @media (max-width: 1024px) {
            .projects-grid { grid-template-columns: 1fr 1fr; }
            .footer-main   { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 1180px) {
            .header-nav  { display: none; }
            .header-nav.open { display: flex; }
            .burger-btn  { display: flex; }

            .header-nav.open {
                position: fixed;
                top: 82px; left: 0; right: 0;
                background: white;
                flex-direction: column;
                padding: 16px 24px 28px;
                box-shadow: var(--shadow-md);
                z-index: 998;
                max-height: calc(100vh - 82px);
                overflow-y: auto;
            }

            .nav-list { flex-direction: column; width: 100%; gap: 4px; }
            .nav-link  { width: 100%; font-size: .9rem; padding: 10px 12px; }
            .dropdown  { position: static; box-shadow: none; border-top: none; border-left: 3px solid var(--green); margin-left: 16px; }
            .nav-item.has-dropdown.open .dropdown { display: block; }
            .btn-adherer, .btn-contribuer { display: none; }

            .hero { min-height: 560px; }

            .stats-bar   { grid-template-columns: 1fr 1fr; }
            .stat-item   { border-right: none; border-bottom: 1px solid var(--border); }
            .stat-item:nth-child(2n) { border-right: none; }
            .stat-item:nth-last-child(-n+2) { border-bottom: none; }

            .duo-grid    { grid-template-columns: 1fr; max-width: 640px; }
            .news-grid   { grid-template-columns: 1fr; }
            .home-stats-wrap { margin-top: -28px; }
        }

        @media (max-width: 640px) {
            .section { padding: 56px 20px; }

            .header-inner { padding: 10px 16px; gap: 12px; }
            .header-logo { gap: 8px; }
            .logo-img { height: 48px; }
            .logo-name { font-size: 1.08rem; }
            .logo-subtitle { display: none; }
            .header-actions { gap: 8px; margin-left: auto; }

            .hero-content { margin-left: 0; padding: 64px 20px; }
            .hero-btns .btn-outline-white,
            .hero-btns .btn-gold-solid { flex: 1 1 auto; justify-content: center; }

            .stats-bar { border-radius: var(--radius-sm); }
            .stat-item { padding: 22px 18px; }

            .section-header { margin-bottom: 24px; }

            .projects-grid { grid-template-columns: 1fr; gap: 20px; }
            .news-grid     { gap: 20px; }
            .duo-grid      { gap: 20px; max-width: 100%; }

            /* Les cartes éduc/communauté passent en colonne : image au-dessus, texte en dessous */
            .duo-card { flex-direction: column; align-items: stretch; }
            .duo-card-image   { width: 100%; height: 200px; }
            .duo-card-content { width: 100%; padding: 22px; }

            /* La carte actu garde date + photo sur une ligne, le texte passe en dessous */
            .news-card { flex-wrap: wrap; padding: 18px; gap: 14px 16px; }
            .news-body { flex: 1 1 100%; }

            .cta-banner { padding: 36px 20px; text-align: center; }
            .cta-banner-left { flex-direction: column; min-width: 0; }
            .cta-btns { width: 100%; justify-content: center; }
        }

        @media (max-width: 480px) {
            .hero-title { font-size: 1.9rem; }
            .hero-desc  { font-size: .95rem; }

            .stats-bar { grid-template-columns: 1fr; }
            .stat-item { border-right: none !important; border-bottom: 1px solid var(--border) !important; }
            .stat-item:last-child { border-bottom: none !important; }

            .news-img      { width: 64px; height: 64px; }
            .news-date-box { width: 52px; padding: 8px 4px; }
            .news-day      { font-size: 1.25rem; }

            .footer-links--cols { grid-template-columns: 1fr; }

            .cta-btns { flex-direction: column; width: 100%; }
            .btn-cta-primary, .btn-cta-outline { width: 100%; }
        }
    </style>
@endpush

@section('content')

{{-- ================================================================
                   PROJETS PRIORITAIRES
================================================================ --}}

<section class="section section--gray">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Projets Prioritaires</h2>
            <a href="{{ url('/projets') }}" class="section-all">Voir tous les projets &rarr;</a>
        </div>
        <div class="projects-grid">

            <div class="project-card">
                <div class="project-img">
                    <img src="{{ asset('images/projets/ecole.jpg') }}" alt="EPP Andé" style="width:100%;height:190px;object-fit:cover;" onerror="this.parentElement.innerHTML='🏫'">
                </div>
                <div class="project-body">
                    <h3 class="project-name">Réhabilitation de l'EPP Andé</h3>
                    <p class="project-desc">Améliorer les conditions d'apprentissage de nos enfants.</p>
                    <div class="project-progress-bar">
                        <div class="project-progress-fill" style="width:70%"></div>
                    </div>
                    <div class="project-progress-label">70%</div>
                    <a href="{{ url('/projets/ecole') }}" class="project-link">Voir le projet &rarr;</a>
                </div>
            </div>

            <div class="project-card">
                <div class="project-img">
                    <img src="{{ asset('images/projets/chateau.jpg') }}" alt="Eau potable" style="width:100%;height:190px;object-fit:cover;" onerror="this.parentElement.innerHTML='💧'">
                </div>
                <div class="project-body">
                    <h3 class="project-name">Accès à l'eau potable</h3>
                    <p class="project-desc">Fournir de l'eau potable à tous les quartiers du village.</p>
                    <div class="project-progress-bar">
                        <div class="project-progress-fill" style="width:45%"></div>
                    </div>
                    <div class="project-progress-label">45%</div>
                    <a href="{{ url('/projets/chateau') }}" class="project-link">Voir le projet &rarr;</a>
                </div>
            </div>

            <div class="project-card">
                <div class="project-img">
                    <img src="{{ asset('images/projets/route.jpg') }}" alt="Voies" style="width:100%;height:190px;object-fit:cover;" onerror="this.parentElement.innerHTML='🛤️'">
                </div>
                <div class="project-body">
                    <h3 class="project-name">Aménagement des voies</h3>
                    <p class="project-desc">Faciliter la mobilité et désenclaver nos communautés.</p>
                    <div class="project-progress-bar">
                        <div class="project-progress-fill" style="width:60%"></div>
                    </div>
                    <div class="project-progress-label">60%</div>
                    <a href="{{ url('/projets/route') }}" class="project-link">Voir le projet &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================================================================
                         ACTUALITÉS
================================================================ --}}

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Actualités</h2>
            <a href="{{ url('/actualites') }}" class="section-all">Voir toutes les actualités &rarr;</a>
        </div>
        <div class="news-grid">

            <div class="news-card">
                <div class="news-date-box">
                    <span class="news-day">12</span>
                    <span class="news-month">Mai</span>
                </div>
                <div class="news-img">
                    <img src="{{ asset('images/actualites/reunion.png') }}" alt="" style="width:70px;height:70px;object-fit:cover;border-radius:8px;" onerror="this.parentElement.innerHTML='📋'">
                </div>
                <div class="news-body">
                    <h4 class="news-title">Réunion du Bureau Exécutif</h4>
                    <p class="news-excerpt">Le Bureau Exécutif a tenu sa réunion mensuelle.</p>
                    <a href="{{ url('/actualites/reunion') }}" class="news-link">Lire la suite &rarr;</a>
                </div>
            </div>

            <div class="news-card">
                <div class="news-date-box" style="background:var(--gold);">
                    <span class="news-day">05</span>
                    <span class="news-month">Mai</span>
                </div>
                <div class="news-img">
                    <img src="{{ asset('images/actualites/solidarite.png') }}" alt="" style="width:70px;height:70px;object-fit:cover;border-radius:8px;" onerror="this.parentElement.innerHTML='🌿'">
                </div>
                <div class="news-body">
                    <h4 class="news-title">Journée de solidarité</h4>
                    <p class="news-excerpt">Une journée citoyenne pour un village propre et accueillant.</p>
                    <a href="{{ url('/actualites/journee-solidarite') }}" class="news-link">Lire la suite &rarr;</a>
                </div>
            </div>

            <div class="news-card">
                <div class="news-date-box" style="background:#1565c0;">
                    <span class="news-day">28</span>
                    <span class="news-month">Avr</span>
                </div>
                <div class="news-img">
                    <img src="{{ asset('images/actualites/examen.png') }}" alt="" style="width:70px;height:70px;object-fit:cover;border-radius:8px;" onerror="this.parentElement.innerHTML='🎓'">
                </div>
                <div class="news-body">
                    <h4 class="news-title">Résultats des examens</h4>
                    <p class="news-excerpt">Félicitations à tous nos élèves pour leurs brillants résultats.</p>
                    <a href="{{ url('/actualites/resultats-examens') }}" class="news-link">Lire la suite &rarr;</a>
                </div>
            </div>

             <div class="news-card">
                <div class="news-date-box" style="background:#1565c0;">
                    <span class="news-day">30</span>
                    <span class="news-month">juin</span>
                </div>
                <div class="news-img">
                    <img src="{{ asset('images/actualites/examen.png') }}" alt="" style="width:70px;height:70px;object-fit:cover;border-radius:8px;" onerror="this.parentElement.innerHTML='🎓'">
                </div>
                <div class="news-body">
                    <h4 class="news-title">Action de fin d'année</h4>
                    <p class="news-excerpt">Félicitations à tous nos élèves pour leurs brillants résultats.</p>
                    <a href="{{ url('/actualites/action-fin-annee') }}" class="news-link">Lire la suite &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================================================================
                   ÉDUCATION + COMMUNAUTÉ
================================================================ --}}

<section class="section section--gray">
    <div class="container">
        <div class="duo-grid">

            <!-- EDUCATION -->
            <div class="duo-card duo-card--educ">

                <div class="duo-card-image">
                    <img src="{{ asset('images/actualites/eleve.JPG') }}" alt="Education">
                </div>

                <div class="duo-card-content">
                    <div class="duo-card-title">Éducation & Excellence</div>

                    <p class="duo-card-desc">
                        Soutenir la réussite scolaire et universitaire de nos enfants,
                        encourager l'excellence et préparer l'avenir.
                    </p>

                    <a href="{{ url('/education-excellence') }}"
                       class="btn-duo-gold">
                        Découvrir l'espace éducation
                    </a>
                </div>
            </div>

            <!-- COMMUNAUTE -->
            <div class="duo-card duo-card--community">

                <div class="duo-card-image">
                    <img src="{{ asset('images/actualites/union.png') }}" alt="Communauté">
                </div>

                <div class="duo-card-content">
                    <div class="duo-card-title">Espace Communautaire</div>

                    <p class="duo-card-desc">
                        Échanger, partager, renforcer les liens et construire ensemble
                        le développement de notre village.
                    </p>

                    <a href="{{ url('/chefferie-patrimoine') }}"
                       class="btn-duo-green">
                        Rejoindre les échanges
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================================================================
                        CTA BANNER
================================================================ --}}

<div class="cta-banner">
    <div class="container" style="display:flex;align-items:center;gap:32px;flex-wrap:wrap;width:100%;">
        <div class="cta-banner-left">
            <div class="cta-icon">
                <svg viewBox="0 0 24 24"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
            </div>
            <div>
                <div class="cta-title">Chaque contribution compte !</div>
                <p class="cta-desc">Votre soutien permet de réaliser nos projets et d'améliorer durablement les conditions de vie à Andé.</p>
            </div>
        </div>
        <div class="cta-btns">
            <a href="{{ url('/contact') }}" class="btn-cta-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
                Contribuer maintenant
            </a>
            <a href="{{ url('/contact') }}" class="btn-cta-outline">
                En savoir plus
            </a>
        </div>
    </div>
</div>

@endsection
