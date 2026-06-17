@extends('layouts.app')

@section('title', 'Gouvernance - MUDEA')

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
        --purple:       #6a1b9a;
        --purple-light: #f3e5f5;
        --blue:         #1565c0;
        --blue-light:   #e3f2fd;
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
    body { font-family: var(--font-body); color: var(--text); background: var(--white); -webkit-font-smoothing: antialiased; }
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }
    img { max-width: 100%; display: block; }
    .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }

    /* ============================================================
       HERO GOUVERNANCE
    ============================================================ */
   .hero-split {
    display: grid; grid-template-columns: 1fr 1fr;
    min-height: 360px; background: var(--green-dark);
  }
  .hero-left {
    padding: 56px 52px 56px max(28px, calc((100vw - 1280px) / 2));
    display: flex; flex-direction: column; justify-content: center;
    background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
    position: relative; z-index: 2;
  }
  .hero-left::after {
    content: ''; position: absolute; top: 0; right: -36px; bottom: 0; width: 72px;
    background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
    clip-path: polygon(0 0, 0 100%, 100% 100%); z-index: 3;
  }
  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 4.5vw, 3.8rem);
    font-weight: 900; color: white; line-height: 1.0; letter-spacing: -.02em; margin-bottom: 10px;
  }
  .hero-subtitle { font-size: 1rem; font-weight: 700; color: var(--gold); margin-bottom: 6px; line-height: 1.35; }
  .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
  .hero-desc { color: rgba(255,255,255,.82); font-size: .92rem; line-height: 1.85; max-width: 400px; }
  .hero-right { position: relative; overflow: hidden; min-height: 360px; }
  .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
  .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

    /* ============================================================
       BREADCRUMB
    ============================================================ */
    .breadcrumb {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 14px 0;
    }

    .breadcrumb-inner {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .83rem;
        color: var(--muted);
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .breadcrumb-inner a { color: var(--muted); transition: color var(--transition); }
    .breadcrumb-inner a:hover { color: var(--green); }
    .breadcrumb-inner .bc-current { font-weight: 700; color: var(--green); }
    .breadcrumb-inner svg { width: 14px; height: 14px; fill: var(--muted); }
    .breadcrumb-inner .bc-sep { color: var(--border); }

    /* ============================================================
       SECTION COMMUNE
    ============================================================ */
    .gov-section {
        padding: 60px 24px;
    }

    .gov-section--gray { background: var(--off-white); }

    .gov-section-inner {
        max-width: 1240px;
        margin: 0 auto;
    }

    .gov-section-head {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 10px;
    }

    .gov-section-icon {
        width: 44px; height: 44px;
        background: var(--green-pale);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .gov-section-icon svg { width: 22px; height: 22px; fill: var(--green); }
    .gov-section-icon--blue { background: var(--blue-light); }
    .gov-section-icon--blue svg { fill: var(--blue); }
    .gov-section-icon--purple { background: var(--purple-light); }
    .gov-section-icon--purple svg { fill: var(--purple); }
    .gov-section-icon--gold { background: #fff8e1; }
    .gov-section-icon--gold svg { fill: var(--gold-dark); }

    .gov-section-title {
        font-size: 1.1rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--dark);
    }

    .gov-section-divider {
        height: 2px;
        background: linear-gradient(to right, var(--green), transparent);
        margin-bottom: 32px;
        margin-top: 10px;
    }
    .gov-section-divider--blue { background: linear-gradient(to right, var(--blue), transparent); }
    .gov-section-divider--purple { background: linear-gradient(to right, var(--purple), transparent); }
    .gov-section-divider--gold { background: linear-gradient(to right, var(--gold), transparent); }

    /* ============================================================
       NOTRE ORGANISATION
    ============================================================ */
    .org-layout {
        display: grid;
        grid-template-columns: 1fr 260px;
        gap: 28px;
        align-items: start;
    }

    .org-desc {
        font-size: .92rem;
        color: var(--muted);
        line-height: 1.65;
        margin-bottom: 28px;
    }

    .org-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .org-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 22px 18px;
        text-align: center;
        transition: box-shadow var(--transition), transform var(--transition);
    }

    .org-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }

    .org-card-icon {
        width: 56px; height: 56px;
        background: var(--green);
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }
    .org-card-icon svg { width: 28px; height: 28px; fill: white; }

    .org-card-title {
        font-size: .78rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .org-card-desc {
        font-size: .78rem;
        color: var(--muted);
        line-height: 1.55;
    }

    /* Principes box */
    .principes-box {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 24px 22px;
    }

    .principes-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: .85rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--dark);
        margin-bottom: 16px;
    }

    .principes-title-icon {
        width: 38px; height: 38px;
        background: var(--green);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .principes-title-icon svg { width: 20px; height: 20px; fill: white; }

    .principe-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
        border-bottom: 1px solid var(--border);
        font-size: .85rem;
        font-weight: 600;
        color: var(--text);
    }
    .principe-item:last-child { border-bottom: none; }

    .principe-check {
        width: 22px; height: 22px;
        background: var(--green);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .principe-check svg { width: 12px; height: 12px; fill: white; }

    /* ============================================================
       DOCUMENTS & RAPPORTS
    ============================================================ */
    .docs-rapports-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }

    .docs-box {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
    }

    .docs-box-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .docs-box-icon {
        width: 42px; height: 42px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
    }
    .docs-box-icon svg { width: 22px; height: 22px; fill: white; }
    .docs-box-icon--blue { background: var(--blue); }
    .docs-box-icon--purple { background: var(--purple); }

    .docs-box-title {
        font-size: .9rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .docs-box-icon--blue ~ .docs-box-title { color: var(--blue); }
    .docs-box-icon--purple ~ .docs-box-title { color: var(--purple); }

    .doc-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid var(--border);
    }
    .doc-item:last-of-type { border-bottom: none; margin-bottom: 18px; }

    .doc-pdf-icon {
        width: 36px; height: 36px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: .62rem;
        font-weight: 900;
        color: white;
        letter-spacing: .5px;
    }
    .doc-pdf-icon--red { background: #e53935; }
    .doc-pdf-icon--purple { background: var(--purple); }

    .doc-info { flex: 1; }

    .doc-name {
        font-size: .86rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 2px;
    }

    .doc-meta {
        font-size: .75rem;
        color: var(--muted);
    }

    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border: 1.5px solid var(--border);
        border-radius: 6px;
        font-size: .75rem;
        font-weight: 700;
        color: var(--text);
        background: var(--white);
        white-space: nowrap;
        transition: border-color var(--transition), color var(--transition), background var(--transition);
        cursor: pointer;
        flex-shrink: 0;
    }
    .btn-download:hover { border-color: var(--green); color: var(--green); background: var(--green-pale); }
    .btn-download svg { width: 14px; height: 14px; fill: currentColor; }

    .btn-all-docs {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 26px;
        border-radius: 8px;
        font-size: .84rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: white;
        margin-top: 4px;
        transition: opacity var(--transition), transform var(--transition);
        cursor: pointer;
    }
    .btn-all-docs:hover { opacity: .88; transform: translateY(-2px); }
    .btn-all-docs--blue { background: var(--blue); }
    .btn-all-docs--purple { background: var(--purple); }
    .btn-all-docs svg { width: 16px; height: 16px; fill: white; }

    /* ============================================================
       CALENDRIER
    ============================================================ */
    .calendar-box {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 28px;
    }

    .calendar-events {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .cal-event {
        background: var(--off-white);
        border-radius: var(--radius-sm);
        padding: 16px;
        border-left: 4px solid var(--green);
    }

    .cal-date-box {
        display: flex;
        align-items: baseline;
        gap: 6px;
        margin-bottom: 10px;
    }

    .cal-day {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--green);
        line-height: 1;
    }

    .cal-month-year {
        display: flex;
        flex-direction: column;
        font-size: .68rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--muted);
        line-height: 1.3;
    }

    .cal-event-title {
        font-size: .85rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 8px;
        line-height: 1.35;
    }

    .cal-event-meta {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .cal-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .75rem;
        color: var(--muted);
    }
    .cal-meta-item svg { width: 12px; height: 12px; fill: var(--muted); flex-shrink: 0; }

    .btn-cal {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        border-radius: 8px;
        background: var(--green);
        color: white;
        font-size: .84rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        transition: background var(--transition), transform var(--transition);
    }
    .btn-cal:hover { background: var(--green-mid); transform: translateY(-2px); }
    .btn-cal svg { width: 16px; height: 16px; fill: white; }

    /* ============================================================
       ENGAGEMENT + PARTICIPATION
    ============================================================ */
    .engage-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .engage-card {
        border-radius: var(--radius);
        padding: 32px 30px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }

    .engage-card--blue {
        background: var(--blue-light);
        border: 1px solid #bbdefb;
    }

    .engage-card--gold {
        background: #fff8e1;
        border: 1px solid #ffe082;
    }

    .engage-card-icon {
        width: 60px; height: 60px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .engage-card--blue  .engage-card-icon { background: var(--blue); }
    .engage-card--gold  .engage-card-icon { background: var(--gold); }
    .engage-card-icon svg { width: 30px; height: 30px; fill: white; }

    .engage-card-title {
        font-size: .95rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .engage-card--blue .engage-card-title { color: var(--blue); }
    .engage-card--gold .engage-card-title { color: var(--gold-dark); }

    .engage-card-desc {
        font-size: .87rem;
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 18px;
    }

    .btn-engage {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        border-radius: 8px;
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        transition: opacity var(--transition), transform var(--transition);
    }
    .btn-engage:hover { opacity: .88; transform: translateY(-2px); }
    .btn-engage--blue { background: var(--blue); color: white; }
    .btn-engage--gold { background: var(--gold); color: white; }
    .btn-engage svg { width: 14px; height: 14px; fill: white; }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 1024px) {
        .org-cards { grid-template-columns: repeat(2, 1fr); }
        .org-layout { grid-template-columns: 1fr; }
        .calendar-events { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .gov-hero { grid-template-columns: 1fr; }
        .gov-hero-right { display: none; }
        .docs-rapports-grid { grid-template-columns: 1fr; }
        .engage-grid { grid-template-columns: 1fr; }
        .org-cards { grid-template-columns: 1fr 1fr; }
        .calendar-events { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 480px) {
        .org-cards { grid-template-columns: 1fr; }
        .calendar-events { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- ============================================================
     HERO
============================================================ --}}

<section class="hero-split">
  <div class="hero-left">
    <h1 class="hero-title">MUDEA  GOUVERNANCE</h1>
    <p class="hero-subtitle">Transparence, responsabilité et engagement</p>
    <div class="hero-accent-line"></div>
    <p class="hero-desc">La MUDEA s'appuie sur une gouvernance participative, démocratique et transparente pour conduire ses actions au service du développement d'Ahodjé.</p>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/communaute/1.png') }}" alt="Communauté d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>

{{-- ============================================================
     BREADCRUMB
============================================================ --}}
<nav class="breadcrumb">
    <div class="breadcrumb-inner">
        <svg viewBox="0 0 20 20"><path d="M10 2L2 8v10h6v-6h4v6h6V8z"/></svg>
        <span class="bc-sep">›</span>
        <a href="{{ route('home') }}">Accueil</a>
        <span class="bc-sep">›</span>
        <span class="bc-current">Gouvernance</span>
    </div>
</nav>

{{-- ============================================================
     NOTRE ORGANISATION
============================================================ --}}
<section class="gov-section">
    <div class="gov-section-inner">

        <div class="gov-section-head">
            <div class="gov-section-icon">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <h2 class="gov-section-title">Notre Organisation</h2>
        </div>
        <div class="gov-section-divider"></div>

        <div class="org-layout">
            <div>
                <p class="org-desc">La MUDEA est organisée autour d'instances de décision et de structures opérationnelles qui travaillent ensemble pour atteindre nos objectifs.</p>

                <div class="org-cards">
                    <div class="org-card">
                        <div class="org-card-icon">
                            <svg viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                        </div>
                        <div class="org-card-title">Assemblée<br>Générale</div>
                        <p class="org-card-desc">Instance suprême qui définit les orientations générales et approuve les rapports.</p>
                    </div>

                    <div class="org-card">
                        <div class="org-card-icon">
                            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                        </div>
                        <div class="org-card-title">Bureau<br>Exécutif</div>
                        <p class="org-card-desc">Organe exécutif chargé de la mise en œuvre des décisions et du suivi des activités.</p>
                    </div>

                    <div class="org-card">
                        <div class="org-card-icon">
                            <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4c1.4 0 2.8 1.1 2.8 2.5V9c.6 0 1.2.6 1.2 1.3v3.5c0 .6-.6 1.2-1.2 1.2H9.2c-.6 0-1.2-.6-1.2-1.2v-3.5C8 9.6 8.6 9 9.2 9V7.5C9.2 6.1 10.6 5 12 5z"/></svg>
                        </div>
                        <div class="org-card-title">Conseil<br>des Sages</div>
                        <p class="org-card-desc">Instance consultative qui veille au respect des valeurs et à la cohésion de la mutuelle.</p>
                    </div>

                    <div class="org-card">
                        <div class="org-card-icon">
                            <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                        </div>
                        <div class="org-card-title">Les 13<br>Commissions</div>
                        <p class="org-card-desc">Structures opérationnelles chargées de la mise en œuvre des actions par domaine.</p>
                    </div>
                </div>
            </div>

            <div class="principes-box">
                <div class="principes-title">
                    <div class="principes-title-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                    Nos Principes
                </div>

                @foreach(['Transparence', 'Responsabilité', 'Égalité', 'Participation', 'Redevabilité', 'Le service de la communauté'] as $principe)
                <div class="principe-item">
                    <div class="principe-check">
                        <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    </div>
                    {{ $principe }}
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     DOCUMENTS OFFICIELS + RAPPORTS D'ACTIVITÉS
============================================================ --}}
<section class="gov-section gov-section--gray">
    <div class="gov-section-inner">

        <div class="docs-rapports-grid">

            {{-- Documents Officiels --}}
            <div class="docs-box">
                <div class="docs-box-head">
                    <div class="docs-box-icon docs-box-icon--blue">
                        <svg viewBox="0 0 24 24"><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/></svg>
                    </div>
                    <h3 class="docs-box-title" style="color:var(--blue)">Documents Officiels</h3>
                </div>

                @php
                $docs = [
                    ['name' => 'Statuts et Règlement intérieur',      'size' => 'PDF • 1,7 Mo'],
                    ['name' => 'Code d\'éthique et de déontologie',   'size' => 'PDF • 940 Ko'],
                    ['name' => 'Manuel de procédures',                'size' => 'PDF • 2,1 Mo'],
                    ['name' => 'Plan stratégique 2023–2027',          'size' => 'PDF • 1,8 Mo'],
                ];
                @endphp

                @foreach($docs as $doc)
                <div class="doc-item">
                    <div class="doc-pdf-icon doc-pdf-icon--red">PDF</div>
                    <div class="doc-info">
                        <div class="doc-name">{{ $doc['name'] }}</div>
                        <div class="doc-meta">{{ $doc['size'] }}</div>
                    </div>
                    <a href="#" class="btn-download">
                        <svg viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                        Télécharger
                    </a>
                </div>
                @endforeach

                <a href="#" class="btn-all-docs btn-all-docs--blue">
                    Voir tous les documents
                    <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                </a>
            </div>

            {{-- Rapports d'activités --}}
            <div class="docs-box">
                <div class="docs-box-head">
                    <div class="docs-box-icon docs-box-icon--purple">
                        <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    </div>
                    <h3 class="docs-box-title" style="color:var(--purple)">Rapports d'Activités</h3>
                </div>

                @php
                $rapports = [
                    ['name' => 'Rapport d\'activités 2023', 'size' => 'PDF • 2,3 Mo'],
                    ['name' => 'Rapport d\'activités 2022', 'size' => 'PDF • 2,0 Mo'],
                    ['name' => 'Rapport d\'activités 2021', 'size' => 'PDF • 1,9 Mo'],
                    ['name' => 'Rapport d\'activités 2020', 'size' => 'PDF • 1,7 Mo'],
                ];
                @endphp

                @foreach($rapports as $rapport)
                <div class="doc-item">
                    <div class="doc-pdf-icon doc-pdf-icon--purple">PDF</div>
                    <div class="doc-info">
                        <div class="doc-name">{{ $rapport['name'] }}</div>
                        <div class="doc-meta">{{ $rapport['size'] }}</div>
                    </div>
                    <a href="#" class="btn-download">
                        <svg viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                        Télécharger
                    </a>
                </div>
                @endforeach

                <a href="#" class="btn-all-docs btn-all-docs--purple">
                    Voir tous les rapports
                    <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     CALENDRIER DES ACTIVITÉS
============================================================ --}}
<section class="gov-section">
    <div class="gov-section-inner">

        <div class="gov-section-head">
            <div class="gov-section-icon gov-section-icon--gold">
                <svg viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            </div>
            <h2 class="gov-section-title">Calendrier des Activités</h2>
        </div>
        <div class="gov-section-divider gov-section-divider--gold"></div>

        <div class="calendar-box">
            <div class="calendar-events">
                @php
                $events = [
                    ['day'=>'15','month'=>'JANV.','year'=>'2025','title'=>'Assemblée Générale Ordinaire','lieu'=>'Salle polyvalente d\'Ahodjé','heure'=>'08h00 – 13h00'],
                    ['day'=>'20','month'=>'AVR.', 'year'=>'2025','title'=>'Journée de solidarité communautaire','lieu'=>'Village d\'Akodé','heure'=>'08h00 – 16h00'],
                    ['day'=>'10','month'=>'AOÛT', 'year'=>'2025','title'=>'Formation des membres','lieu'=>'Salle de conférence','heure'=>'09h00 – 12h00'],
                    ['day'=>'05','month'=>'OCT.', 'year'=>'2025','title'=>'Forum des cadres et de la diaspora','lieu'=>'Abidjan','heure'=>'09h00 – 17h00'],
                ];
                @endphp

                @foreach($events as $event)
                <div class="cal-event">
                    <div class="cal-date-box">
                        <span class="cal-day">{{ $event['day'] }}</span>
                        <div class="cal-month-year">
                            <span>{{ $event['month'] }}</span>
                            <span>{{ $event['year'] }}</span>
                        </div>
                    </div>
                    <div class="cal-event-title">{{ $event['title'] }}</div>
                    <div class="cal-event-meta">
                        <div class="cal-meta-item">
                            <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            {{ $event['lieu'] }}
                        </div>
                        <div class="cal-meta-item">
                            <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                            {{ $event['heure'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="text-align:center;">
                <a href="#" class="btn-cal">
                    Voir tout le calendrier
                    <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     ENGAGEMENT + PARTICIPATION
============================================================ --}}
<section class="gov-section gov-section--gray">
    <div class="gov-section-inner">
        <div class="engage-grid">

            <div class="engage-card engage-card--blue">
                <div class="engage-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                </div>
                <div>
                    <h3 class="engage-card-title">Notre Engagement<br>pour la Transparence</h3>
                    <p class="engage-card-desc">La MUDEA s'engage à gérer de façon transparente les ressources qui lui sont confiées et à rendre compte régulièrement à tous ses membres.</p>
                    <a href="#" class="btn-engage btn-engage--blue">
                        En savoir plus
                        <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                    </a>
                </div>
            </div>

            <div class="engage-card engage-card--gold">
                <div class="engage-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
                <div>
                    <h3 class="engage-card-title">Votre Participation<br>est Essentielle</h3>
                    <p class="engage-card-desc">Votre implication et vos idées contribuent à la bonne gouvernance et au développement durable de notre village.</p>
                    <a href="#" class="btn-engage btn-engage--gold">
                        Participer aux activités
                        <svg viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection