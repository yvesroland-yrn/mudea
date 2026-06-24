@extends('layouts.app')

@section('title', 'Actualités - MUDEA')

@section('content')

<style>
    /* ===== VARIABLES ===== */
    :root {
        --vert: #2d6a2d;
        --vert-fonce: #1a4a1a;
        --vert-clair: #4a8c2a;
        --jaune: #f5c518;
        --jaune-clair: #ffd740;
        --gold: #d4880a;
        --green-dark: #071f0b;
        --gris-fond: #f5f5f5;
        --gris-bord: #e0e0e0;
        --texte: #1a1a1a;
        --texte-sec: #555;
        --blanc: #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--texte); background: var(--blanc); overflow-x: hidden; }

    /* ===== HERO BANNER ===== */
    /* ─── HERO ─── */
  .hero-split {
    display: grid; grid-template-columns: 1fr 1fr;
    min-height: 360px; background: var(--green-dark);
  }
  .hero-left {
    padding: 56px 52px 56px clamp(24px, 5vw, 72px);
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
    font-weight: 900; color: #fffef7; line-height: 1.0; letter-spacing: -.02em; margin-bottom: 10px; text-shadow: 0 2px 10px rgba(0,0,0,.25);
  }
  .hero-subtitle { font-size: 1rem; font-weight: 800; color: var(--gold); margin-bottom: 6px; line-height: 1.35; text-transform: uppercase; letter-spacing: .12em; }
  .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
  .hero-desc { color: rgba(255,255,255,.92); font-size: .95rem; line-height: 1.85; max-width: 420px; }
  .hero-right { position: relative; overflow: hidden; min-height: 360px; }
  .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
  .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

    /* ===== LAYOUT PRINCIPAL ===== */
    .page-actualites {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px 60px;
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--texte);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
        padding-top: 32px;
    }
    .section-title .icon {
        color: var(--jaune);
        font-size: 1.3rem;
    }
    .section-title a {
        margin-left: auto;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--vert);
        text-decoration: none;
        border: 1.5px solid var(--vert);
        border-radius: 4px;
        padding: 4px 12px;
        transition: background 0.2s, color 0.2s;
    }
    .section-title a:hover { background: var(--vert); color: var(--blanc); }

    /* ===== GRID VEDETTE + ÉVÉNEMENTS ===== */
    .top-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        margin-bottom: 40px;
    }

    /* --- VEDETTE --- */
    .vedette-card {
        background: var(--blanc);
        border: 1.5px solid var(--gris-bord);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .vedette-img {
        position: relative;
        height: 500px;
        overflow: hidden;
    }
    .vedette-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .vedette-card:hover .vedette-img img { transform: scale(1.03); }
    .vedette-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
    }
    .vedette-dots span {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
    }
    .vedette-dots span.active { background: var(--blanc); }

    .vedette-body {
        padding: 20px 24px 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .badge {
        display: inline-block;
        background: var(--vert);
        color: var(--blanc);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 10px;
        border-radius: 20px;
        margin-bottom: 12px;
        width: fit-content;
    }
    .badge.education  { background: #2196f3; }
    .badge.communaute { background: #9c27b0; }
    .badge.culture    { background: #e65100; }
    .badge.projet     { background: #00796b; }
    .badge.sante      { background: #c62828; }

    .vedette-body h2 {
        font-size: 1.3rem;
        font-weight: 700;
        line-height: 1.35;
        margin-bottom: 12px;
        color: var(--texte);
    }
    .vedette-body p {
        font-size: 0.9rem;
        color: var(--texte-sec);
        line-height: 1.6;
        flex: 1;
    }
    .vedette-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 16px;
        font-size: 0.8rem;
        color: #888;
    }
    .vedette-meta span { display: flex; align-items: center; gap: 5px; }
    .btn-lire {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--vert);
        color: var(--blanc);
        font-size: 0.82rem;
        font-weight: 700;
        padding: 9px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 18px;
        width: fit-content;
        transition: background 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .btn-lire:hover { background: var(--vert-fonce); }

    /* --- ÉVÉNEMENTS SIDEBAR --- */
    .evenements-aside {
        display: flex;
        flex-direction: column;
    }
    .event-item {
        display: flex;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--gris-bord);
    }
    .event-item:last-of-type { border-bottom: none; }
    .event-date {
        min-width: 52px;
        background: var(--vert);
        color: var(--blanc);
        text-align: center;
        border-radius: 8px;
        padding: 8px 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .event-date .day  { font-size: 1.6rem; font-weight: 800; line-height: 1; }
    .event-date .month{ font-size: 0.65rem; font-weight: 700; text-transform: uppercase; }
    .event-date .year { font-size: 0.65rem; opacity: 0.8; }
    .event-info h4  { font-size: 0.88rem; font-weight: 700; line-height: 1.3; margin-bottom: 4px; }
    .event-info .lieu{ font-size: 0.78rem; color: var(--texte-sec); display: flex; align-items: center; gap: 4px; }
    .event-info .heure{ font-size: 0.78rem; color: var(--texte-sec); display: flex; align-items: center; gap: 4px; margin-top: 3px; }
    .btn-events {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--vert);
        color: var(--blanc);
        font-size: 0.82rem;
        font-weight: 700;
        padding: 11px 20px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 16px;
        text-transform: uppercase;
        transition: background 0.2s;
    }
    .btn-events:hover { background: var(--vert-fonce); }

    /* ===== DERNIÈRES ACTUALITÉS ===== */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }
    .news-card {
        background: var(--blanc);
        border: 1.5px solid var(--gris-bord);
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .news-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }
    .news-card img {
        width: 100%;
        height: 155px;
        object-fit: cover;
        display: block;
    }
    .news-card-body { padding: 14px 14px 12px; }
    .news-card-body h3 {
        font-size: 0.9rem;
        font-weight: 700;
        line-height: 1.4;
        margin: 8px 0 6px;
        color: var(--texte);
    }
    .news-card-body p {
        font-size: 0.8rem;
        color: var(--texte-sec);
        line-height: 1.55;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.75rem;
        color: #999;
    }
    .news-meta a {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--vert);
        text-decoration: none;
    }
    .news-meta a:hover { text-decoration: underline; }

    /* ===== GALERIE PHOTOS ===== */
    .galerie-section { margin-bottom: 40px; }
    .galerie-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }
    .galerie-grid img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        border-radius: 6px;
        transition: transform 0.3s, opacity 0.3s;
        cursor: pointer;
    }
    .galerie-grid img:hover { transform: scale(1.04); opacity: 0.9; }

    /* ===== NEWSLETTER BANNER ===== */
    .newsletter-banner {
        background: var(--vert-fonce);
        padding: 28px 32px;
        display: flex;
        align-items: center;
        gap: 24px;
        border-radius: 10px;
        margin-top: 8px;
    }
    .newsletter-banner .nl-icon {
        background: var(--jaune);
        width: 52px; height: 52px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 1.4rem;
    }
    .newsletter-banner .nl-text h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--blanc);
    }
    .newsletter-banner .nl-text p {
        font-size: 0.82rem;
        color: rgba(255,255,255,0.75);
        margin-top: 3px;
    }
    .newsletter-form {
        display: flex;
        gap: 10px;
        margin-left: auto;
        flex-shrink: 0;
    }
    .newsletter-form input[type="email"] {
        padding: 10px 16px;
        border-radius: 5px;
        border: none;
        font-size: 0.88rem;
        width: 260px;
        outline: none;
    }
    .newsletter-form button {
        background: var(--jaune);
        color: var(--vert-fonce);
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        transition: background 0.2s;
    }
    .newsletter-form button:hover { background: var(--jaune-clair); }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .top-grid { grid-template-columns: 1fr; }
        .news-grid { grid-template-columns: repeat(2, 1fr); }
        .galerie-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .hero-split { grid-template-columns: 1fr; }
        .hero-right { min-height: 220px; }
        .hero-left::after { display: none; }
    }
    @media (max-width: 640px) {
        .hero-actualites h1 { font-size: 1.8rem; }
        .news-grid { grid-template-columns: 1fr; }
        .galerie-grid { grid-template-columns: repeat(2, 1fr); }
        .newsletter-banner { flex-direction: column; }
        .newsletter-form { flex-direction: column; width: 100%; margin-left: 0; }
        .newsletter-form input[type="email"] { width: 100%; }
    }
</style>

<!-- ======== HERO BANNER ======== -->

<section class="hero-split">
  <div class="hero-left">
    <h1 class="hero-title">Actualités</h1>
    <p class="hero-subtitle">Rester informé, rester engagé.</p>
    <div class="hero-accent-line"></div>
    <p class="hero-desc">Suivez les dernières nouvelles, les événements et les activités qui dynamisent notre communauté et font avancer le développement d'Andé.</p>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/communaute/1.png') }}" alt="Communauté d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>

<!-- ======== CONTENU PRINCIPAL ======== -->
<div class="page-actualites">

    <!-- ===== VEDETTE + ÉVÉNEMENTS ===== -->
    <div class="top-grid">

        <!-- Actualité vedette -->
        <div>
            <div class="section-title">
                <span class="icon">&#9733;</span>
                Actualité vedette
            </div>
            <div class="vedette-card">
                <div class="vedette-img">
                    <img src="{{ asset('images/actualites/eleve.JPG') }}" alt="Inauguration du Complexe Scolaire">
                    <div class="vedette-dots">
                        <span class="active"></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="vedette-body">
                    <span class="badge education">Éducation</span>
                    <h2>Inauguration du Complexe Scolaire d'Excellence d'Andé</h2>
                    <p>Le nouveau complexe scolaire a été officiellement inauguré en présence des autorités locales, des membres de la MUDEA et des populations.</p>
                    <div class="vedette-meta">
                        <span>
                            <!-- Calendrier SVG -->
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            12 Mai 2024
                        </span>
                        <span>
                            <!-- Personne SVG -->
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="7" r="4"/><path d="M5.2 20c.4-3.4 3.4-6 6.8-6s6.4 2.6 6.8 6"/></svg>
                            Admin MUDEA
                        </span>
                    </div>
                    <a href="/actualites/inauguration-complexe-scolaire" class="btn-lire">
                        Lire l'article
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Événements à venir -->
        <div class="evenements-aside">
            <div class="section-title">
                <!-- Calendrier SVG -->
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f5c518" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Événements à venir
            </div>

            <!-- Événement 1 -->
            <div class="event-item">
                <div class="event-date">
                    <span class="day">15</span>
                    <span class="month">Juin</span>
                    <span class="year">2024</span>
                </div>
                <div class="event-info">
                    <h4>Assemblée Générale Ordinaire</h4>
                    <span class="lieu">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        Salle polyvalente d'Andé
                    </span>
                    <span class="heure">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        09h00 – 13h00
                    </span>
                </div>
            </div>

            <!-- Événement 2 -->
            <div class="event-item">
                <div class="event-date">
                    <span class="day">20</span>
                    <span class="month">Juil.</span>
                    <span class="year">2024</span>
                </div>
                <div class="event-info">
                    <h4>Journée de solidarité communautaire</h4>
                    <span class="lieu">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        Village d'Andé
                    </span>
                    <span class="heure">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        08h00 – 14h00
                    </span>
                </div>
            </div>

            <!-- Événement 3 -->
            <div class="event-item">
                <div class="event-date">
                    <span class="day">05</span>
                    <span class="month">Août</span>
                    <span class="year">2024</span>
                </div>
                <div class="event-info">
                    <h4>Forum des cadres et de la diaspora</h4>
                    <span class="lieu">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        Abidjan
                    </span>
                    <span class="heure">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        09h00 – 17h00
                    </span>
                </div>
            </div>

            <a href="{{ url('/actualites') }}" class="btn-events">
                Voir tous les événements
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>

    <!-- ===== DERNIÈRES ACTUALITÉS ===== -->
    <div class="section-title">
        <!-- Icône journal SVG -->
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f5c518" stroke-width="2"><path d="M4 4h16v16H4z"/><path d="M8 4v16"/><line x1="12" y1="8" x2="18" y2="8"/><line x1="12" y1="12" x2="18" y2="12"/><line x1="12" y1="16" x2="18" y2="16"/></svg>
        Dernières actualités
        <a href="{{ url('/actualites') }}">Voir toutes les actualités →</a>
    </div>

    <div class="news-grid">

        <!-- Article 1 -->
        <div class="news-card">
            <img src="{{ asset('images/actualites/reunion.png') }}" alt="Avancement des travaux du château d'eau">
            <div class="news-card-body">
                <span class="badge projet">Projet</span>
                <h3>Avancement des travaux du château d'eau</h3>
                <p>Les travaux avancent bien et la livraison est prévue pour juillet 2024.</p>
                <div class="news-meta">
                    <span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        08 Mai 2024
                    </span>
                    <a href="{{ url('/actualites/avancement-travaux-chateau-eau') }}">Lire la suite →</a>
                </div>
            </div>
        </div>

        <!-- Article 2 -->
        <div class="news-card">
            <img src="{{ asset('images/actualites/examen.png') }}" alt="Lancement des cours de soutien pour les examens">
            <div class="news-card-body">
                <span class="badge education">Éducation</span>
                <h3>Lancement des cours de soutien pour les examens</h3>
                <p>La MUDEA accompagne les élèves dans leur préparation aux examens scolaires.</p>
                <div class="news-meta">
                    <span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        05 Mai 2024
                    </span>
                    <a href="{{ url('/actualites/cours-soutien-examens') }}">Lire la suite →</a>
                </div>
            </div>
        </div>

        <!-- Article 3 -->
        <div class="news-card">
            <img src="{{ asset('images/actualites/solidarite.png') }}" alt="Rencontre d'échanges avec les chefs de familles">
            <div class="news-card-body">
                <span class="badge communaute">Communauté</span>
                <h3>Rencontre d'échanges avec les chefs de familles</h3>
                <p>Une rencontre fructueuse pour discuter des priorités de développement du village.</p>
                <div class="news-meta">
                    <span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        02 Mai 2024
                    </span>
                    <a href="/actualites/rencontre-chefs-familles">Lire la suite →</a>
                </div>
            </div>
        </div>

        <!-- Article 4 -->
        <div class="news-card">
            <img src="{{ asset('images/actualites/union.png') }}" alt="Festival des masques d'Andé 2024">
            <div class="news-card-body">
                <span class="badge culture">Culture</span>
                <h3>Festival des masques d'Andé 2024</h3>
                <p>Une édition réussie qui célèbre notre riche patrimoine culturel.</p>
                <div class="news-meta">
                    <span>
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        28 Avr. 2024
                    </span>
                    <a href="/actualites/festival-masques-2024">Lire la suite →</a>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== GALERIE PHOTOS ===== -->
    <div class="galerie-section">
        <div class="section-title">
            <!-- Icône image SVG -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f5c518" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            Galerie Photos
            <a href="/galerie">Voir toute la galerie →</a>
        </div>
        <div class="galerie-grid">
            <img src="{{ asset('images/actualites/eleve.JPG') }}" alt="Photo galerie 1">
            <img src="{{ asset('images/actualites/examen.png') }}" alt="Photo galerie 2">
            <img src="{{ asset('images/actualites/reunion.png') }}" alt="Photo galerie 3">
            <img src="{{ asset('images/actualites/solidarite.png') }}" alt="Photo galerie 4">
            <img src="{{ asset('images/actualites/union.png') }}" alt="Photo galerie 5">
        </div>
    </div>

    <!-- ===== NEWSLETTER ===== -->
    <div class="newsletter-banner">
        <div class="nl-icon">
            <!-- Enveloppe SVG -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1a4a1a" stroke-width="2.5"><path d="M4 4h16v16H4z"/><polyline points="22 6 12 13 2 6"/></svg>
        </div>
        <div class="nl-text">
            <h3>Ne manquez aucune actualité !</h3>
            <p>Abonnez-vous à notre newsletter et recevez les dernières informations directement dans votre boîte mail.</p>
        </div>
        <form class="newsletter-form" action="/newsletter/subscribe" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse email" required>
            <button type="submit">
                S'abonner
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </form>
    </div>

</div>

@endsection
