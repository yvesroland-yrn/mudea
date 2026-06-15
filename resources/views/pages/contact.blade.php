@extends('layouts.app')

@section('title', 'Accueil - MUDEA')

@section('content')

<style>
    :root {
        --vert:        #2d6a2d;
        --vert-fonce:  #1a4a1a;
        --vert-clair:  #4a8c2a;
        --jaune:       #f5c518;
        --jaune-clair: #ffd740;
        --gold:        #d4880a;
        --green-dark:  #071f0b;
        --gris-fond:   #f5f5f5;
        --gris-bord:   #e0e0e0;
        --texte:       #1a1a1a;
        --texte-sec:   #555;
        --blanc:       #ffffff;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--texte); background: var(--blanc); }
    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    /* ── HERO ─────────────────────────────── */
    /* ─── HERO ─── */
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
    font-weight: 900; color: #fffef7; line-height: 1.0; letter-spacing: -.02em; margin-bottom: 10px; text-shadow: 0 2px 10px rgba(0,0,0,.25);
  }
  .hero-subtitle { font-size: 1rem; font-weight: 800; color: var(--gold); margin-bottom: 6px; line-height: 1.35; text-transform: uppercase; letter-spacing: .12em; }
  .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
  .hero-desc { color: rgba(255,255,255,.92); font-size: .95rem; line-height: 1.85; max-width: 420px; }
  .hero-right { position: relative; overflow: hidden; min-height: 360px; }
  .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
  .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

    /* ── VALEURS STRIP ────────────────────── */
    .valeurs-strip { background: var(--blanc); border-bottom: 2px solid var(--gris-bord); }
    .valeurs-inner {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(5,1fr);
        border-top: 4px solid var(--vert);
    }
    .valeur-item {
        padding: 22px 14px 18px;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        gap: 8px; border-right: 1px solid var(--gris-bord);
        transition: background .2s;
    }
    .valeur-item:hover { background: #f9fdf9; }
    .valeur-item:last-child { border-right: none; }
    .valeur-icon {
        width: 50px; height: 50px; border-radius: 50%;
        background: var(--vert); display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .valeur-item h4 { font-size: .82rem; font-weight: 800; text-transform: uppercase; color: var(--vert-fonce); }
    .valeur-item p  { font-size: .75rem; color: var(--texte-sec); line-height: 1.45; }

    /* ── MID: IMPACT + ACTUALITÉS ─────────── */
    .mid-section {
        max-width: 1200px; margin: 0 auto; padding: 52px 24px 44px;
        display: grid; grid-template-columns: 1.1fr .9fr; gap: 40px; align-items: start;
    }
    .section-eyebrow {
        font-size: .75rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: 1px; color: var(--vert); margin-bottom: 22px;
    }
    .stats-grid {
        display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 28px;
    }
    .stat-box { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 6px; }
    .stat-icon {
        width: 54px; height: 54px; border-radius: 50%;
        background: var(--gris-fond); display: flex; align-items: center; justify-content: center;
    }
    .stat-box .number { font-size: 1.65rem; font-weight: 900; color: var(--vert-fonce); }
    .stat-box .label  { font-size: .7rem; color: var(--texte-sec); line-height: 1.3; }
    .btn-impact {
        display: inline-flex; align-items: center; gap: 8px;
        border: 2px solid var(--vert); color: var(--vert);
        font-weight: 700; font-size: .82rem; text-transform: uppercase;
        padding: 10px 22px; border-radius: 5px; transition: background .2s, color .2s;
    }
    .btn-impact:hover { background: var(--vert); color: var(--blanc); }
    .actu-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .actu-header a { font-size: .8rem; color: var(--vert); font-weight: 700; }
    .actu-item { display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--gris-bord); }
    .actu-item:last-child { border-bottom: none; }
    .actu-img { width: 72px; height: 60px; border-radius: 6px; object-fit: cover; flex-shrink: 0; }
    .actu-text .date { font-size: .72rem; color: #999; margin-bottom: 3px; }
    .actu-text h4    { font-size: .84rem; font-weight: 700; line-height: 1.35; margin-bottom: 3px; }
    .actu-text p     { font-size: .77rem; color: var(--texte-sec); line-height: 1.45; }

    /* ── DOMAINES ─────────────────────────── */
    .domaines-section { background: var(--gris-fond); padding: 52px 24px; text-align: center; }
    .domaines-section > h2 {
        font-size: 1.25rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: .5px; margin-bottom: 28px; color: var(--texte);
    }
    .domaines-grid {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(6,1fr); gap: 14px;
    }
    .domaine-card {
        position: relative; border-radius: 10px; overflow: hidden; cursor: pointer;
        transition: transform .3s, box-shadow .3s;
    }
    .domaine-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,.2); }
    .domaine-card img { width: 100%; height: 155px; object-fit: cover; }
    .domaine-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(0deg, rgba(20,50,20,.84) 48%, transparent 100%);
        display: flex; flex-direction: column; align-items: center; justify-content: flex-end;
        padding: 12px 8px;
    }
    .domaine-icon-wrap {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--jaune); display: flex; align-items: center; justify-content: center;
        margin-bottom: 7px;
    }
    .domaine-overlay h4 {
        font-size: .7rem; font-weight: 800; text-transform: uppercase;
        color: var(--blanc); text-align: center; line-height: 1.3; margin-bottom: 3px;
    }
    .domaine-overlay p { font-size: .63rem; color: rgba(255,255,255,.8); text-align: center; line-height: 1.4; }

    /* ── CTA BANDE ────────────────────────── */
    .cta-bande {
        background: var(--vert-fonce); padding: 28px 32px;
        display: flex; align-items: center; gap: 24px; justify-content: space-between; flex-wrap: wrap;
    }
    .cta-bande-left { display: flex; align-items: center; gap: 16px; }
    .cta-icon {
        background: rgba(255,255,255,.12); border-radius: 50%;
        width: 52px; height: 52px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .cta-bande-left h3 { font-size: 1rem; font-weight: 800; color: var(--blanc); }
    .cta-bande-left p  { font-size: .82rem; color: rgba(255,255,255,.72); margin-top: 3px; }
    .cta-bande-btns    { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-membre {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--blanc); color: var(--vert-fonce);
        font-weight: 700; font-size: .85rem; text-transform: uppercase;
        padding: 11px 22px; border-radius: 5px; transition: background .2s;
    }
    .btn-membre:hover { background: #e8e8e8; }
    .btn-don {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--jaune); color: var(--vert-fonce);
        font-weight: 800; font-size: .85rem; text-transform: uppercase;
        padding: 11px 22px; border-radius: 5px; transition: background .2s;
    }
    .btn-don:hover { background: var(--jaune-clair); }

    /* ═══════════════════════════════════════
       SECTION CONTACT  — REDESIGN COMPLET
    ═══════════════════════════════════════ */
    .contact-wrap {
        background: linear-gradient(160deg, #0f2e0f 0%, #1a4a1a 60%, #2d6a2d 100%);
        padding: 72px 24px;
        position: relative;
        overflow: hidden;
    }
    /* motif déco subtil */
    .contact-wrap::before {
        content: '';
        position: absolute; top: -80px; right: -80px;
        width: 400px; height: 400px; border-radius: 50%;
        background: radial-gradient(circle, rgba(245,197,24,.12) 0%, transparent 70%);
        pointer-events: none;
    }
    .contact-wrap::after {
        content: '';
        position: absolute; bottom: -60px; left: -60px;
        width: 300px; height: 300px; border-radius: 50%;
        background: radial-gradient(circle, rgba(245,197,24,.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .contact-inner {
        max-width: 1100px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1.45fr; gap: 52px; align-items: start;
        position: relative; z-index: 2;
    }

    /* — Colonne gauche : infos —————————— */
    .contact-left {}
    .contact-left .section-label {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(245,197,24,.15); border: 1px solid rgba(245,197,24,.4);
        color: var(--jaune); font-size: .72rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: 1px;
        padding: 5px 14px; border-radius: 20px; margin-bottom: 20px;
    }
    .contact-left h2 {
        font-size: 2rem; font-weight: 900; color: var(--blanc);
        line-height: 1.2; text-transform: uppercase; margin-bottom: 14px;
    }
    .contact-left h2 span { color: var(--jaune); }
    .contact-left > p {
        font-size: .88rem; color: rgba(255,255,255,.72); line-height: 1.7;
        margin-bottom: 36px; max-width: 360px;
    }

    .info-cards { display: flex; flex-direction: column; gap: 16px; margin-bottom: 36px; }
    .info-card {
        display: flex; align-items: flex-start; gap: 14px;
        background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
        border-radius: 10px; padding: 16px 18px;
        transition: background .2s, border-color .2s;
    }
    .info-card:hover { background: rgba(255,255,255,.1); border-color: rgba(245,197,24,.4); }
    .info-card-icon {
        width: 42px; height: 42px; border-radius: 10px;
        background: var(--jaune); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .info-card-icon svg { color: var(--vert-fonce); }
    .info-card-body h5 { font-size: .78rem; font-weight: 800; color: var(--jaune); margin-bottom: 4px; text-transform: uppercase; letter-spacing: .5px; }
    .info-card-body p  { font-size: .82rem; color: rgba(255,255,255,.8); line-height: 1.55; }

    .social-row { display: flex; gap: 10px; }
    .social-btn {
        width: 38px; height: 38px; border-radius: 8px;
        background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
        display: flex; align-items: center; justify-content: center;
        transition: background .2s, border-color .2s;
    }
    .social-btn:hover { background: var(--jaune); border-color: var(--jaune); }
    .social-btn:hover svg { color: var(--vert-fonce) !important; }
    .social-btn svg { color: rgba(255,255,255,.75); transition: color .2s; }

    /* — Colonne droite : formulaire ————— */
    .contact-form-card {
        background: var(--blanc);
        border-radius: 16px;
        padding: 40px 40px 36px;
        box-shadow: 0 24px 60px rgba(0,0,0,.35);
    }
    .contact-form-card .form-header { margin-bottom: 28px; }
    .contact-form-card .form-header h3 {
        font-size: 1.15rem; font-weight: 800; color: var(--vert-fonce); margin-bottom: 6px;
    }
    .contact-form-card .form-header p { font-size: .82rem; color: var(--texte-sec); }

    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .fg {
        display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px;
    }
    .fg label {
        font-size: .78rem; font-weight: 700; color: var(--vert-fonce);
        display: flex; align-items: center; gap: 5px;
    }
    .fg label .req { color: #e53935; }
    .fg input, .fg select, .fg textarea {
        border: 1.5px solid var(--gris-bord); border-radius: 8px;
        padding: 11px 14px; font-size: .88rem; font-family: inherit;
        color: var(--texte); outline: none; background: #fafafa;
        transition: border-color .2s, box-shadow .2s;
    }
    .fg input:focus, .fg select:focus, .fg textarea:focus {
        border-color: var(--vert);
        box-shadow: 0 0 0 3px rgba(45,106,45,.12);
        background: var(--blanc);
    }
    .fg textarea { resize: vertical; min-height: 120px; }

    .btn-send {
        width: 100%; background: var(--vert); color: var(--blanc);
        border: none; cursor: pointer;
        font-weight: 800; font-size: .92rem; text-transform: uppercase; letter-spacing: .5px;
        padding: 14px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        transition: background .2s, transform .15s;
        margin-top: 4px;
    }
    .btn-send:hover { background: var(--vert-fonce); transform: translateY(-2px); }

    .form-note {
        text-align: center; font-size: .73rem; color: #aaa; margin-top: 12px;
        display: flex; align-items: center; justify-content: center; gap: 5px;
    }

    /* ── RESPONSIVE ───────────────────────── */
    @media (max-width: 1024px) {
        .domaines-grid { grid-template-columns: repeat(3,1fr); }
        .valeurs-inner { grid-template-columns: repeat(3,1fr); }
        .contact-inner { grid-template-columns: 1fr; gap: 36px; }
        .contact-left h2 { font-size: 1.6rem; }
    }
    @media (max-width: 768px) {
        .hero-content h1 { font-size: 2rem; }
        .mid-section     { grid-template-columns: 1fr; }
        .stats-grid      { grid-template-columns: repeat(2,1fr); }
        .domaines-grid   { grid-template-columns: repeat(2,1fr); }
        .valeurs-inner   { grid-template-columns: repeat(2,1fr); }
        .cta-bande       { flex-direction: column; text-align: center; }
        .form-row-2      { grid-template-columns: 1fr; }
        .contact-form-card { padding: 24px 18px; }
    }
    @media (max-width: 480px) {
        .domaines-grid { grid-template-columns: 1fr 1fr; }
    }
</style>

{{-- ── HERO ─────────────────────────────────────── --}}

<section class="hero-split">
  <div class="hero-left">
    <h1 class="hero-title">Contact</h1>
    <p class="hero-subtitle">Ensemble pour un <span>Andé</span> meilleur</p>
    <div class="hero-accent-line"></div>
    <p class="hero-desc">La MUDEA œuvre pour le développement durable de notre communauté à travers l'entraide, l'éducation, le respect de nos valeurs et la valorisation de notre patrimoine.</p>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/communaute/1.png') }}" alt="Communauté d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>

{{-- ── VALEURS ──────────────────────────────────── --}}
<div class="valeurs-strip">
    <div class="valeurs-inner">
        <div class="valeur-item">
            <div class="valeur-icon">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h4>Solidarité</h4>
            <p>S'unir pour soutenir chaque membre de notre communauté.</p>
        </div>
        <div class="valeur-item">
            <div class="valeur-icon">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <h4>Éducation</h4>
            <p>Former nos jeunes pour construire l'avenir d'Andé.</p>
        </div>
        <div class="valeur-item">
            <div class="valeur-icon">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </div>
            <h4>Entraide</h4>
            <p>S'entraider aujourd'hui pour un demain meilleur.</p>
        </div>
        <div class="valeur-item">
            <div class="valeur-icon">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h4>Respect</h4>
            <p>Respecter nos valeurs, nos traditions et notre identité.</p>
        </div>
        <div class="valeur-item">
            <div class="valeur-icon">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
            </div>
            <h4>Développement</h4>
            <p>Agir ensemble pour un développement durable de notre village.</p>
        </div>
    </div>
</div>

{{-- ── IMPACT + ACTUALITÉS ──────────────────────── --}}
<div class="mid-section">
    <div>
        <div class="section-eyebrow">Nos actions, notre impact</div>
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-icon"><svg width="26" height="26" fill="none" stroke="#f5c518" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <span class="number">850+</span><span class="label">Membres actifs</span>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><svg width="26" height="26" fill="none" stroke="#f5c518" stroke-width="2" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
                <span class="number">12+</span><span class="label">Projets réalisés</span>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><svg width="26" height="26" fill="none" stroke="#f5c518" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
                <span class="number">5</span><span class="label">Projets en cours</span>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><svg width="26" height="26" fill="none" stroke="#f5c518" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
                <span class="number">2500+</span><span class="label">Bénéficiaires directs</span>
            </div>
        </div>
        <a href="/impacts" class="btn-impact">
            Voir nos impacts
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>

    <div>
        <div class="actu-header">
            <div class="section-eyebrow" style="margin-bottom:0">Actualités récentes</div>
            <a href="/actualites">Voir toutes →</a>
        </div>
        <div class="actu-item">
            <img class="actu-img" src="{{ asset('images/education/7.JPG') }}" alt="Festival des Masques">
            <div class="actu-text">
                <div class="date">12 Mai 2024</div>
                <h4>Festival des Masques d'Andé 2024</h4>
                <p>Une édition mémorable qui a célébré notre culture et rassemblé toute la communauté.</p>
            </div>
        </div>
        <div class="actu-item">
            <img class="actu-img" src="{{ asset('images/education/8.JPG') }}" alt="Complexe Scolaire">
            <div class="actu-text">
                <div class="date">05 Mai 2024</div>
                <h4>Inauguration du Complexe Scolaire d'Excellence d'Andé</h4>
                <p>Un pas important pour l'éducation et l'avenir de nos enfants.</p>
            </div>
        </div>
        <div class="actu-item">
            <img class="actu-img" src="{{ asset('images/education/9.JPG') }}" alt="Rencontre chefs de familles">
            <div class="actu-text">
                <div class="date">28 Avr. 2024</div>
                <h4>Rencontre d'échanges avec les Chefs de familles</h4>
                <p>Discuter ensemble de nos priorités pour le développement du village.</p>
            </div>
        </div>
    </div>
</div>

{{-- ── DOMAINES ─────────────────────────────────── --}}
<section class="domaines-section">
    <h2>Nos domaines d'intervention</h2>
    <div class="domaines-grid">
        <div class="domaine-card">
            <img src="{{ asset('images/education/1.JPG') }}" alt="Éducation">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
                <h4>Éducation<br>& Excellence</h4>
                <p>Soutenir l'éducation et l'excellence scolaire de nos jeunes.</p>
            </div>
        </div>
        <div class="domaine-card">
            <img src="{{ asset('images/projets/1.JPG') }}" alt="Eau">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C6 9 4 13 4 16a8 8 0 0 0 16 0c0-3-2-7-8-14z"/></svg></div>
                <h4>Eau, Hygiène<br>& Assainissement</h4>
                <p>Améliorer l'accès à l'eau potable et promouvoir l'hygiène.</p>
            </div>
        </div>
        <div class="domaine-card">
            <img src="{{ asset('images/projets/2.JPG') }}" alt="Infrastructures">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="10" width="18" height="11" rx="1"/><path d="M9 21V10M15 21V10M3 10l9-7 9 7"/></svg></div>
                <h4>Infrastructures<br>& Équipements</h4>
                <p>Développer les infrastructures pour un Andé moderne.</p>
            </div>
        </div>
        <div class="domaine-card">
            <img src="{{ asset('images/projets/3.JPG') }}" alt="Agriculture">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 22V12M12 12C12 7 17 2 22 2c0 5-5 10-10 10zM12 12C12 7 7 2 2 2c0 5 5 10 10 10z"/></svg></div>
                <h4>Agriculture<br>& Environnement</h4>
                <p>Promouvoir une agriculture durable et protéger notre environnement.</p>
            </div>
        </div>
        <div class="domaine-card">
            <img src="{{ asset('images/chefferie/2.JPG') }}" alt="Cohésion">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <h4>Cohésion Sociale<br>& Culture</h4>
                <p>Renforcer la cohésion et valoriser notre culture et nos traditions.</p>
            </div>
        </div>
        <div class="domaine-card">
            <img src="{{ asset('images/communaute/1.png') }}" alt="Santé">
            <div class="domaine-overlay">
                <div class="domaine-icon-wrap"><svg width="18" height="18" fill="none" stroke="#1a4a1a" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
                <h4>Santé<br>& Bien-Être</h4>
                <p>Agir pour le bien-être et la santé de tous les membres.</p>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════
     CONTACT : INFOS GAUCHE  |  FORMULAIRE DROITE
════════════════════════════════════════════════ --}}
<div class="contact-wrap">
    <div class="contact-inner">

        {{-- ── Colonne gauche ── --}}
        <div class="contact-left">
            <div class="section-label">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Nous contacter
            </div>
            <h2>Parlons de<br><span>votre projet</span></h2>
            <p>Vous avez une question, une idée, ou souhaitez rejoindre la MUDEA ? Écrivez-nous, nous vous répondons dans les meilleurs délais.</p>

            <div class="info-cards">
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg width="20" height="20" fill="none" stroke="#1a4a1a" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <div class="info-card-body">
                        <h5>Adresse</h5>
                        <p>Village d'Andé, Région du Bélier<br>Côte d'Ivoire</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-icon">
                        <svg width="20" height="20" fill="none" stroke="#1a4a1a" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="info-card-body">
                        <h5>Téléphone</h5>
                        <p>+225 07 00 00 00 00<br>+225 01 00 00 00 00</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-icon">
                        <svg width="20" height="20" fill="none" stroke="#1a4a1a" stroke-width="2.2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><polyline points="22 6 12 13 2 6"/></svg>
                    </div>
                    <div class="info-card-body">
                        <h5>Email</h5>
                        <p>contact@mudea.org<br>info@mudea.org</p>
                    </div>
                </div>
            </div>

            {{-- Réseaux sociaux --}}
            <div class="social-row">
                <a href="#" class="social-btn" title="Facebook">
                    <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,.75)" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" class="social-btn" title="Twitter / X">
                    <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,.75)" stroke-width="2" viewBox="0 0 24 24"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </a>
                <a href="#" class="social-btn" title="WhatsApp">
                    <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,.75)" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                </a>
                <a href="#" class="social-btn" title="YouTube">
                    <svg width="16" height="16" fill="none" stroke="rgba(255,255,255,.75)" stroke-width="2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                </a>
            </div>
        </div>

        {{-- ── Colonne droite : formulaire ── --}}
        <div class="contact-form-card">
            <div class="form-header">
                <h3>Envoyez-nous un message</h3>
                <p>Tous les champs marqués <strong style="color:#e53935">*</strong> sont obligatoires.</p>
            </div>

            <form action="/contact" method="POST">
                @csrf

                <div class="form-row-2">
                    <div class="fg">
                        <label>Nom complet <span class="req">*</span></label>
                        <input type="text" name="nom" placeholder="Votre nom et prénom" required>
                    </div>
                    <div class="fg">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" placeholder="+225 07 00 00 00 00">
                    </div>
                </div>

                <div class="fg">
                    <label>Adresse email <span class="req">*</span></label>
                    <input type="email" name="email" placeholder="votre@email.com" required>
                </div>

                <div class="fg">
                    <label>Objet <span class="req">*</span></label>
                    <select name="objet" required>
                        <option value="" disabled selected>Sélectionnez un objet</option>
                        <option value="adhesion">Adhésion / Membership</option>
                        <option value="don">Don / Soutien financier</option>
                        <option value="projet">Proposition de projet</option>
                        <option value="partenariat">Partenariat</option>
                        <option value="information">Demande d'information</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="fg">
                    <label>Message <span class="req">*</span></label>
                    <textarea name="message" placeholder="Décrivez votre demande en détail..." required></textarea>
                </div>

                <button type="submit" class="btn-send">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Envoyer le message
                </button>

                <p class="form-note">
                    <svg width="12" height="12" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Vos données sont protégées et ne seront jamais partagées.
                </p>
            </form>
        </div>

    </div>
</div>

@endsection