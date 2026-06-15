<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $metaTitle ?? 'MUDEA')</title>
    <meta name="description" content="{{ $metaDescription ?? 'Portail institutionnel de la MUDEA' }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@600;700&display=swap');

        :root {
            --green: #1f8a3b;
            --green-dark: #135f28;
            --yellow: #f0c53a;
            --blue: #1d57d6;
            --ink: #173046;
            --muted: #5e6d7c;
            --bg: #f6f8f2;
            --card: #ffffff;
            --line: rgba(23, 48, 70, 0.1);
            --shadow: 0 18px 45px rgba(23, 48, 70, 0.08);
            --radius: 24px;
            --radius-sm: 16px;
            --container: 1180px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(31, 138, 59, 0.12), transparent 30%),
                radial-gradient(circle at top right, rgba(29, 87, 214, 0.1), transparent 26%),
                linear-gradient(180deg, #fbfcf8 0%, var(--bg) 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            display: block;
            width: 100%;
        }

        .site-shell {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .site-shell::before,
        .site-shell::after {
            content: "";
            position: fixed;
            border-radius: 999px;
            filter: blur(40px);
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        .site-shell::before {
            width: 18rem;
            height: 18rem;
            top: -6rem;
            right: -5rem;
            background: rgba(240, 197, 58, 0.35);
        }

        .site-shell::after {
            width: 16rem;
            height: 16rem;
            bottom: -4rem;
            left: -5rem;
            background: rgba(31, 138, 59, 0.24);
        }

        .container {
            width: min(calc(100% - 2rem), var(--container));
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid rgba(23, 48, 70, 0.08);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.8rem 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            min-width: 0;
        }

        .brand-mark {
            width: 3.8rem;
            height: 3.8rem;
            border-radius: 1rem;
            overflow: hidden;
            flex: 0 0 auto;
            background: #fff;
            box-shadow: 0 12px 24px rgba(23, 48, 70, 0.12);
            border: 1px solid rgba(23, 48, 70, 0.08);
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-text {
            min-width: 0;
        }

        .brand-text strong {
            display: block;
            font-size: 1rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .brand-text span {
            display: block;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.3;
        }

        .site-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.8rem 1rem;
            font-size: 0.9rem;
        }

        .site-nav a {
            position: relative;
            padding: 0.3rem 0;
            font-weight: 700;
            color: var(--ink);
        }

        .site-nav a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            transform: scaleX(0);
            transform-origin: left;
            background: linear-gradient(90deg, var(--green), var(--blue));
            transition: transform 0.2s ease;
        }

        .site-nav a:hover::after,
        .site-nav a.active::after {
            transform: scaleX(1);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.9rem;
            padding: 0 1.15rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 800;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--green), var(--blue));
            box-shadow: 0 12px 24px rgba(29, 87, 214, 0.18);
        }

        .btn-secondary {
            color: var(--ink);
            background: rgba(255, 255, 255, 0.82);
            border-color: rgba(23, 48, 70, 0.12);
        }

        .btn-accent {
            color: #173046;
            background: linear-gradient(135deg, #ffe389, var(--yellow));
            border-color: rgba(23, 48, 70, 0.08);
        }

        .hero,
        .section {
            position: relative;
            z-index: 1;
        }

        .hero {
            padding: 2rem 0 1rem;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 1.5rem;
            align-items: stretch;
        }

        .hero-copy,
        .hero-card,
        .panel,
        .info-card,
        .side-card,
        .stat-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(23, 48, 70, 0.08);
            box-shadow: var(--shadow);
        }

        .hero-copy {
            border-radius: 32px;
            padding: 2rem;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            color: var(--green-dark);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.76rem;
            font-weight: 800;
        }

        .eyebrow::before {
            content: "";
            width: 2.4rem;
            height: 1px;
            background: linear-gradient(90deg, var(--green), var(--yellow));
        }

        .hero-copy h1,
        .page-title,
        .section-title {
            margin: 0.75rem 0 0.85rem;
            font-family: 'Cormorant Garamond', serif;
            line-height: 0.95;
            letter-spacing: -0.03em;
        }

        .hero-copy h1 {
            font-size: clamp(2.5rem, 5vw, 4.3rem);
        }

        .page-title,
        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .hero-copy p,
        .page-copy,
        .muted,
        .info-card p,
        .side-card li,
        .stat-card span {
            color: var(--muted);
            line-height: 1.75;
        }

        .hero-slogan {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            color: #173046;
            background: rgba(240, 197, 58, 0.22);
            font-size: 0.9rem;
            font-weight: 800;
        }

        .hero-actions {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 1.4rem;
        }

        .hero-points {
            display: grid;
            gap: 0.75rem;
            margin-top: 1.4rem;
            padding: 0;
            list-style: none;
        }

        .hero-points li {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .hero-points li::before {
            content: "";
            width: 0.7rem;
            height: 0.7rem;
            margin-top: 0.5rem;
            border-radius: 999px;
            flex: 0 0 auto;
            background: linear-gradient(135deg, var(--green), var(--blue));
        }

        .hero-card {
            border-radius: 32px;
            overflow: hidden;
            display: grid;
            grid-template-rows: minmax(18rem, 1fr) auto;
        }

        .hero-card img {
            height: 100%;
            object-fit: cover;
        }

        .hero-card-content {
            padding: 1rem 1.1rem 1.2rem;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(247, 249, 245, 1));
        }

        .hero-card-content strong {
            display: block;
            margin-bottom: 0.35rem;
        }

        .stats {
            padding: 0.65rem 0 1rem;
        }

        .stat-grid,
        .card-grid {
            display: grid;
            gap: 1rem;
        }

        .stat-grid {
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        .stat-card {
            border-radius: 20px;
            padding: 1rem 1.1rem;
            text-align: center;
        }

        .stat-card strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--ink);
            font-size: 1.45rem;
        }

        .section {
            padding: 1rem 0 1.5rem;
        }

        .panel,
        .side-card,
        .info-card {
            border-radius: var(--radius);
        }

        .panel {
            padding: 1.3rem;
        }

        .page-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 1rem;
            align-items: start;
        }

        .side-card {
            padding: 1.3rem;
        }

        .side-card h3,
        .panel h2,
        .panel h3,
        .info-card h3 {
            margin-top: 0;
            margin-bottom: 0.7rem;
            font-family: 'Cormorant Garamond', serif;
            line-height: 1;
        }

        .side-card ul,
        .footer ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .side-card ul {
            display: grid;
            gap: 0.7rem;
        }

        .side-card li {
            padding-left: 1rem;
            position: relative;
        }

        .side-card li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.8rem;
            width: 0.45rem;
            height: 0.45rem;
            border-radius: 999px;
            background: var(--green);
        }

        .card-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .info-card {
            padding: 1.15rem;
        }

        .info-card h3 {
            font-size: 1.45rem;
        }

        .footer {
            margin-top: 0.75rem;
            padding: 1.5rem 0 1rem;
            background: linear-gradient(180deg, #10311d 0%, #0d2435 100%);
            color: #e7f1ff;
            position: relative;
            z-index: 1;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr;
            gap: 1.25rem;
            align-items: start;
        }

        .footer-brand {
            display: flex;
            gap: 0.9rem;
            align-items: flex-start;
        }

        .footer-mark {
            width: 3.6rem;
            height: 3.6rem;
            border-radius: 1rem;
            overflow: hidden;
            flex: 0 0 auto;
            background: #fff;
        }

        .footer-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .footer h4 {
            margin: 0 0 0.8rem;
            color: #ffffff;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .footer p,
        .footer a,
        .footer li {
            color: #e7f1ff;
            line-height: 1.75;
        }

        .footer-links {
            display: grid;
            gap: 0.45rem;
        }

        .footer-bottom {
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            color: #d7e7ff;
            font-size: 0.92rem;
        }

        .footer-bottom-links {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (max-width: 1100px) {
            .hero-grid,
            .page-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .stat-grid,
            .card-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .header-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .site-nav {
                justify-content: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                width: 100%;
            }

            .hero-copy,
            .panel,
            .side-card {
                padding: 1.1rem;
            }

            .stat-grid,
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="site-shell" id="top">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</div>
</body>
</html>
