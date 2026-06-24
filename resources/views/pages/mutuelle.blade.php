@extends('layouts.app')

@section('title', 'La Mutuelle - MUDEA')

@push('styles')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush

@section('content')
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --green:       #1b5e20;
    --green-dark:  #0a3d14;
    --green-mid:   #2e7d32;
    --green-light: #e8f5e9;
    --green-soft:  #c8e6c9;
    --gold:        #f5a623;
    --gold-light:  #fff8e1;
    --blue:        #1565c0;
    --blue-light:  #e3f2fd;
    --cream:       #f9fafb;
    --white:       #ffffff;
    --border:      #e0e9e2;
    --text:        #1a2e25;
    --text-mid:    #455d4f;
    --text-light:  #7a9585;
    --shadow-sm:   0 2px 12px rgba(27,94,32,.08);
    --shadow-md:   0 6px 28px rgba(27,94,32,.12);
    --shadow-lg:   0 14px 48px rgba(27,94,32,.16);
    --radius-sm:   10px;
    --radius-md:   16px;
    --radius-lg:   24px;
  }

  body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--text); line-height: 1.6; }

  /* ─── HERO SPLIT ─── */
  .hero-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 420px;
    background: var(--green-dark);
  }
  .hero-left {
    padding: 64px 56px 64px max(32px, calc((100vw - 1280px) / 2));
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: linear-gradient(135deg, #0a2e14 0%, #1b5e20 100%);
    position: relative;
    z-index: 2;
  }
  .hero-left::after {
    content: '';
    position: absolute;
    top: 0; right: -40px; bottom: 0;
    width: 80px;
    background: linear-gradient(135deg, #0a2e14 0%, #1b5e20 100%);
    clip-path: polygon(0 0, 0 100%, 100% 100%);
    z-index: 3;
  }
  .hero-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    font-size: .8rem; color: rgba(255,255,255,.65);
    margin-bottom: 20px;
  }
  .hero-breadcrumb a { color: rgba(255,255,255,.8); text-decoration: none; }
  .hero-breadcrumb a:hover { color: white; }
  .hero-breadcrumb span { opacity: .5; }
  .hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.9);
    padding: 6px 16px; border-radius: 999px;
    font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
    margin-bottom: 18px; width: fit-content;
  }
  .hero-eyebrow::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: #4dffb4; flex-shrink: 0; }
  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.6rem, 4.5vw, 4rem);
    font-weight: 900; color: white;
    line-height: 1.05; letter-spacing: -.02em;
    margin-bottom: 8px;
  }
  .hero-subtitle {
    font-size: 1rem; font-weight: 600;
    color: var(--gold);
    letter-spacing: .05em;
    margin-bottom: 18px;
  }
  .hero-desc {
    color: rgba(255,255,255,.78);
    font-size: .95rem; line-height: 1.85;
    max-width: 460px;
    margin-bottom: 28px;
  }
  .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
  .btn-gold { background: var(--gold); color: white; border: 2px solid var(--gold); padding: 11px 24px; border-radius: 8px; font-weight: 800; font-size: .88rem; text-transform: uppercase; letter-spacing: .04em; text-decoration: none; transition: all .22s; display: inline-flex; align-items: center; gap: 8px; font-family: 'Nunito', sans-serif; }
  .btn-gold:hover { background: #d4880a; border-color: #d4880a; }
  .btn-outline-w { background: transparent; color: white; border: 2px solid rgba(255,255,255,.5); padding: 11px 24px; border-radius: 8px; font-weight: 800; font-size: .88rem; text-transform: uppercase; letter-spacing: .04em; text-decoration: none; transition: all .22s; display: inline-flex; align-items: center; gap: 8px; font-family: 'Nunito', sans-serif; }
  .btn-outline-w:hover { background: rgba(255,255,255,.1); border-color: white; }
  .hero-right {
    position: relative;
    overflow: hidden;
    min-height: 420px;
  }
  .hero-right img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: center;
    display: block;
  }
  .hero-right-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to right, rgba(10,46,20,.45) 0%, transparent 60%);
  }

  /* ─── CONTAINER ─── */
  .container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
  .section-gap { padding: 72px 0; }
  .section-gap-sm { padding: 52px 0; }

  /* ─── SECTION HEADER ─── */
  .sec-header { display: flex; align-items: center; gap: 20px; margin-bottom: 44px; }
  .sec-header-center { text-align: center; flex-direction: column; align-items: center; }
  .sec-line { flex: 1; height: 1px; background: var(--border); }
  .sec-label {
    font-size: .72rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .14em; color: var(--green);
    white-space: nowrap;
  }
  .sec-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 2.8vw, 2rem);
    font-weight: 700; color: var(--text);
    margin-bottom: 0;
  }

  /* ─── HISTORIQUE ─── */
  .history-grid {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 48px;
    align-items: start;
  }
  .history-img-wrap {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    position: relative;
  }
  .history-img-wrap img {
    width: 100%; aspect-ratio: 4/3;
    object-fit: cover; display: block;
    transition: transform .5s;
    filter: sepia(.25) contrast(1.05);
  }
  .history-img-wrap:hover img { transform: scale(1.04); }
  .history-img-year {
    position: absolute; bottom: 16px; left: 16px;
    background: white; border-radius: 12px;
    padding: 12px 18px; box-shadow: 0 6px 20px rgba(0,0,0,.14);
  }
  .history-img-year strong { display: block; font-size: 1.7rem; font-weight: 900; color: var(--green); font-family: 'Playfair Display', serif; line-height: 1; }
  .history-img-year span { font-size: .68rem; color: var(--text-light); text-transform: uppercase; letter-spacing: .08em; font-weight: 700; }

  .history-content { display: flex; flex-direction: column; gap: 0; }
  .history-icon-row { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
  .history-icon-circle {
    width: 52px; height: 52px; border-radius: 50%;
    background: var(--green-light); border: 2px solid var(--green-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--green); font-size: 1.2rem; flex-shrink: 0;
  }
  .history-icon-label { font-size: 1.15rem; font-weight: 800; color: var(--green); font-family: 'Playfair Display', serif; }
  .history-text { color: var(--text-mid); font-size: .95rem; line-height: 1.85; margin-bottom: 28px; }
  .history-text p + p { margin-top: 12px; }
  .history-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .history-meta-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 20px 22px;
    display: flex; align-items: center; gap: 16px;
    box-shadow: var(--shadow-sm);
  }
  .history-meta-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: var(--green-light); border: 1px solid var(--green-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--green); font-size: 1rem; flex-shrink: 0;
  }
  .history-meta-card h6 { font-size: .7rem; text-transform: uppercase; letter-spacing: .1em; color: var(--text-light); font-weight: 700; margin-bottom: 4px; }
  .history-meta-card strong, .history-meta-card p { font-size: .95rem; font-weight: 800; color: var(--text); line-height: 1.35; }

  /* ─── VISION / MISSION / VALEURS ─── */
  .vmv-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .vmv-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px 26px 28px;
    box-shadow: var(--shadow-sm);
    transition: transform .3s, box-shadow .3s;
    position: relative; overflow: hidden;
  }
  .vmv-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
  .vmv-icon-wrap {
    width: 66px; height: 66px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    font-size: 1.7rem;
  }
  .vmv-icon-wrap--green { background: var(--green); color: white; }
  .vmv-icon-wrap--gold  { background: var(--gold);  color: white; }
  .vmv-icon-wrap--blue  { background: var(--blue);  color: white; }
  .vmv-card h4 {
    font-size: .72rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .12em; color: var(--text-light);
    margin-bottom: 6px;
  }
  .vmv-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem; font-weight: 700;
    color: var(--text); margin-bottom: 14px;
  }
  .vmv-card--green h3 { color: var(--green); }
  .vmv-card--gold  h3 { color: #c17a00; }
  .vmv-card--blue  h3 { color: var(--blue); }
  .vmv-card p { color: var(--text-mid); font-size: .92rem; line-height: 1.8; }
  .vmv-card ul { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 8px; }
  .vmv-card ul li {
    display: flex; align-items: center; gap: 10px;
    font-size: .92rem; color: var(--text-mid); font-weight: 600;
  }
  .vmv-card ul li::before {
    content: '✓'; width: 20px; height: 20px; border-radius: 50%;
    background: var(--blue); color: white; font-size: .65rem;
    display: flex; align-items: center; justify-content: center;
    font-weight: 900; flex-shrink: 0;
  }
  .vmv-accent-line {
    position: absolute; bottom: 0; left: 0; right: 0; height: 4px;
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
  }
  .vmv-card--green .vmv-accent-line { background: var(--green); }
  .vmv-card--gold  .vmv-accent-line { background: var(--gold); }
  .vmv-card--blue  .vmv-accent-line { background: var(--blue); }

  /* ─── ORGANISATION ─── */
  .org-bg {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 52px 48px;
    box-shadow: var(--shadow-sm);
  }
  .org-title {
    text-align: center;
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem; font-weight: 700;
    color: var(--text); margin-bottom: 40px;
    display: flex; align-items: center; gap: 20px; justify-content: center;
  }
  .org-title-line { flex: 1; max-width: 100px; height: 2px; background: var(--green); border-radius: 2px; }

  /* Row 1: AG + Sages */
  .org-row1 {
    display: flex; justify-content: center; align-items: center;
    gap: 0; position: relative; margin-bottom: 0;
  }
  .org-row1-inner {
    display: flex; align-items: center; gap: 20px;
    width: 100%; max-width: 680px; justify-content: center;
  }
  .org-block-primary {
    background: var(--green); color: white;
    border-radius: var(--radius-sm);
    padding: 14px 32px;
    font-weight: 800; font-size: .9rem; text-transform: uppercase;
    letter-spacing: .06em; text-align: center;
    min-width: 220px;
  }
  .org-block-secondary {
    background: white; color: var(--green);
    border: 2px solid var(--green);
    border-radius: var(--radius-sm);
    padding: 12px 24px;
    font-weight: 700; font-size: .82rem; text-transform: uppercase;
    letter-spacing: .05em; text-align: center;
    min-width: 160px;
  }
  .org-dash-connector {
    flex: 1; max-width: 80px; height: 0;
    border-top: 2px dashed var(--green-soft);
  }

  /* Row 2: connector down + Bureau */
  .org-v-connector { display: flex; flex-direction: column; align-items: center; }
  .org-v-line { width: 2px; background: var(--green-soft); }
  .org-v-line--short { height: 24px; }
  .org-v-line--tall  { height: 28px; }
  .org-block-bureau {
    background: var(--green); color: white;
    border-radius: var(--radius-sm);
    padding: 14px 40px;
    font-weight: 800; font-size: .9rem; text-transform: uppercase;
    letter-spacing: .06em; text-align: center;
    min-width: 220px;
  }

  /* Row 3: branches */
  .org-branches-wrap {
    position: relative; width: 100%; margin-top: 0;
  }
  .org-h-line {
    width: 84%; height: 2px; background: var(--green-soft);
    margin: 0 auto;
  }
  .org-branches {
    display: flex; justify-content: space-between;
    width: 84%; margin: 0 auto;
  }
  .org-branch-item { display: flex; flex-direction: column; align-items: center; }
  .org-block-accent {
    background: var(--gold-light);
    border: 1.5px solid #f5c875;
    border-radius: var(--radius-sm);
    padding: 12px 14px;
    font-weight: 700; font-size: .75rem; text-align: center;
    color: #7a5500;
    min-width: 130px; max-width: 160px;
    line-height: 1.4;
  }

  /* ─── BUREAU EXÉCUTIF ─── */
  .bureau-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 18px;
    margin-bottom: 32px;
  }
  .bureau-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform .3s, box-shadow .3s;
    display: flex; flex-direction: column;
  }
  .bureau-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
  .bureau-photo {
    width: 100%; aspect-ratio: 3/4;
    overflow: hidden; background: var(--green-light);
    position: relative;
  }
  .bureau-photo img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: top;
    display: block; transition: transform .4s;
  }
  .bureau-card:hover .bureau-photo img { transform: scale(1.06); }
  .bureau-photo-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--green);
  }
  .bureau-photo-placeholder svg { opacity: .25; }
  .bureau-body {
    padding: 14px 14px 18px;
    flex: 1; display: flex; flex-direction: column; gap: 4px;
  }
  .bureau-role {
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .08em;
    color: var(--green); margin-bottom: 2px;
  }
  .bureau-name { font-size: .88rem; font-weight: 800; color: var(--text); line-height: 1.3; }
  .bureau-underline { width: 28px; height: 3px; background: var(--green); border-radius: 2px; margin-top: 8px; }

  .btn-voir-tous {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--green); color: white;
    padding: 14px 36px; border-radius: 8px;
    font-weight: 800; font-size: .9rem; text-transform: uppercase;
    letter-spacing: .05em; text-decoration: none;
    transition: background .2s, transform .2s;
    font-family: 'Nunito', sans-serif;
  }
  .btn-voir-tous:hover { background: var(--green-dark); transform: translateY(-2px); }

  /* ─── COMMISSIONS ─── */
  .commissions-header {
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 28px;
  }
  .commissions-icon-circle {
    width: 48px; height: 48px; border-radius: 50%;
    background: var(--green-light); border: 2px solid var(--green-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--green); font-size: 1.15rem; flex-shrink: 0;
  }
  .commissions-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem; font-weight: 700; color: var(--text);
  }

  .commission-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 14px;
  }
  .commission-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 22px 12px 18px;
    text-align: center;
    display: flex; flex-direction: column; align-items: center; gap: 12px;
    transition: all .28s;
    cursor: default;
  }
  .commission-card:hover {
    background: var(--green);
    border-color: var(--green);
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(27,94,32,.2);
  }
  .commission-card:hover .commission-icon-wrap { background: rgba(255,255,255,.2); color: white; border-color: rgba(255,255,255,.3); }
  .commission-card:hover .commission-label { color: white; }
  .commission-icon-wrap {
    width: 52px; height: 52px; border-radius: 14px;
    background: var(--green-light); border: 1px solid var(--green-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--green); font-size: 1.25rem;
    transition: all .28s;
  }
  .commission-label {
    font-size: .72rem; font-weight: 800; color: var(--text);
    text-transform: uppercase; letter-spacing: .05em;
    line-height: 1.35; transition: color .28s;
  }

  /* ─── RESPONSIVE ─── */
  @media (max-width: 1100px) {
    .bureau-grid { grid-template-columns: repeat(3, 1fr); }
    .commission-grid { grid-template-columns: repeat(4, 1fr); }
    .history-grid { grid-template-columns: 1fr; }
  }
  @media (max-width: 900px) {
    .hero-split { grid-template-columns: 1fr; }
    .hero-right { min-height: 280px; }
    .hero-left::after { display: none; }
    .vmv-grid { grid-template-columns: 1fr; }
    .org-bg { padding: 32px 20px; }
    .container { padding: 0 20px; }
  }
  @media (max-width: 640px) {
    .bureau-grid { grid-template-columns: repeat(2, 1fr); }
    .commission-grid { grid-template-columns: repeat(2, 1fr); }
    .history-meta { grid-template-columns: 1fr; }
  }
</style>


{{-- ══════════════════════════════════════════
     HERO SPLIT
══════════════════════════════════════════ --}}
<section class="hero-split">
  <div class="hero-left">
    <div class="hero-breadcrumb">
      <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
      <span>/</span>
      <a href="{{ route('home') }}">Accueil</a>
      <span>/</span>
      <span>La Mutuelle</span>
    </div>
    <div class="hero-eyebrow">Association active depuis 2013</div>
    <h1 class="hero-title">La Mutuelle</h1>
    <p class="hero-subtitle">Notre histoire, notre mission, notre engagement</p>
    <p class="hero-desc">
      La Mutuelle de Développement d'Andé (MUDEA) œuvre pour le bien-être des populations
      à travers la solidarité, l'éducation, la culture et le développement durable.
    </p>
    <div class="hero-btns">
      <a href="{{ route('projets') }}" class="btn-gold">Voir nos projets &rarr;</a>
      <a href="{{ route('actualites') }}" class="btn-outline-w">Nos actualités &rarr;</a>
    </div>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/mutuelles/village-andé.png') }}" alt="Village d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>


{{-- ══════════════════════════════════════════
     MAIN
══════════════════════════════════════════ --}}
<div class="container">

  {{-- ── HISTORIQUE ── --}}
  <div class="section-gap">
    <div class="history-grid">

      <div class="history-img-wrap">
        <img src="{{ asset('images/mutuelles/hommes.png') }}" alt="Membres fondateurs d'Andé"
          onerror="this.parentElement.style.background='linear-gradient(135deg,#e8f5e9,#c8e6c9)'; this.style.display='none'">
        <div class="history-img-year">
          <strong>2013</strong>
          <span>Année de création</span>
        </div>
      </div>

      <div class="history-content">
        <div class="history-icon-row">
          <div class="history-icon-circle"><i class="fas fa-clock"></i></div>
          <span class="history-icon-label">Historique</span>
        </div>
        <div class="history-text">
          <p>
            La MUDEA est née de la volonté des filles et fils d'Andé de se rassembler pour œuvrer
            ensemble au développement durable de leur village.
          </p>
          <p>
            Depuis sa création, elle n'a cessé de renforcer la solidarité, de promouvoir l'éducation,
            la culture et d'accompagner les initiatives porteuses de progrès pour Andé.
          </p>
        </div>
        <div class="history-meta">
          <div class="history-meta-card">
            <div class="history-meta-icon"><i class="fas fa-landmark"></i></div>
            <div>
              <h6>Année de création</h6>
              <strong>2013</strong>
            </div>
          </div>
          <div class="history-meta-card">
            <div class="history-meta-icon"><i class="fas fa-file-contract"></i></div>
            <div>
              <h6>Statut</h6>
              <p>Association à but non lucratif</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- ── VISION / MISSION / VALEURS ── --}}
  <div class="vmv-grid" style="margin-bottom: 72px;">

    <div class="vmv-card vmv-card--green">
      <div class="vmv-icon-wrap vmv-icon-wrap--green"><i class="fas fa-eye"></i></div>
      <h4>Notre</h4>
      <h3>Vision</h3>
      <p>Faire d'Andé un village uni, prospère et modèle, où chaque génération contribue à un avenir meilleur.</p>
      <div class="vmv-accent-line"></div>
    </div>

    <div class="vmv-card vmv-card--gold">
      <div class="vmv-icon-wrap vmv-icon-wrap--gold"><i class="fas fa-bullseye"></i></div>
      <h4>Notre</h4>
      <h3>Mission</h3>
      <p>Mobiliser les ressources humaines, matérielles et financières pour réaliser des projets de développement durables au bénéfice de la communauté.</p>
      <div class="vmv-accent-line"></div>
    </div>

    <div class="vmv-card vmv-card--blue">
      <div class="vmv-icon-wrap vmv-icon-wrap--blue"><i class="fas fa-gem"></i></div>
      <h4>Nos</h4>
      <h3>Valeurs</h3>
      <ul>
        <li>Solidarité</li>
        <li>Transparence</li>
        <li>Engagement</li>
        <li>Respect des traditions</li>
        <li>Excellence</li>
      </ul>
      <div class="vmv-accent-line"></div>
    </div>

  </div>

  {{-- ── ORGANISATION ── --}}
  <div class="section-gap-sm">
    <div class="sec-header sec-header-center">
      <div class="sec-line"></div>
      <span class="sec-label">Structure</span>
      <div class="sec-line"></div>
    </div>

    <div class="org-bg">
      <div class="org-title">
        <div class="org-title-line"></div>
        Notre Organisation
        <div class="org-title-line"></div>
      </div>

      {{-- Ligne 1 : AG + Conseil des Sages --}}
      <div class="org-row1">
        <div class="org-row1-inner">
          <div class="org-block-primary">Assemblée Générale</div>
          <div class="org-dash-connector"></div>
          <div class="org-block-secondary">Conseil des Sages</div>
        </div>
      </div>

      {{-- Connecteur vertical --}}
      <div class="org-v-connector">
        <div class="org-v-line org-v-line--short"></div>
      </div>

      {{-- Ligne 2 : Bureau Exécutif --}}
      <div style="display:flex;justify-content:center;">
        <div class="org-block-primary" style="min-width:240px;">Bureau Exécutif</div>
      </div>

      {{-- Connecteur ramifié --}}
      <div class="org-v-connector">
        <div class="org-v-line org-v-line--short"></div>
      </div>
      <div class="org-branches-wrap">
        <div class="org-h-line"></div>
        <div class="org-branches" style="margin-top:0;">
          <div class="org-branch-item">
            <div class="org-v-line org-v-line--tall"></div>
          </div>
          <div class="org-branch-item">
            <div class="org-v-line org-v-line--tall"></div>
          </div>
          <div class="org-branch-item">
            <div class="org-v-line org-v-line--tall"></div>
          </div>
          <div class="org-branch-item">
            <div class="org-v-line org-v-line--tall"></div>
          </div>
          <div class="org-branch-item">
            <div class="org-v-line org-v-line--tall"></div>
          </div>
        </div>
      </div>

      {{-- Ligne 3 : 5 branches --}}
      <div style="display:flex;justify-content:space-between;width:84%;margin:0 auto;gap:12px;">
        <div class="org-block-accent">13 Commissions<br>Spécialisées</div>
        <div class="org-block-accent">Secrétariat<br>Général</div>
        <div class="org-block-accent">Trésorerie<br>Générale</div>
        <div class="org-block-accent">Contrôle &amp;<br>Évaluation</div>
        <div class="org-block-accent">Communication &amp;<br>Relations Publiques</div>
      </div>
    </div>
  </div>

  {{-- ── BUREAU EXÉCUTIF ── --}}
  <div class="section-gap-sm">
    <div class="sec-header sec-header-center" style="margin-bottom:32px;">
      <div class="sec-line"></div>
      <div style="text-align:center;">
        <div class="sec-label" style="margin-bottom:6px;">Gouvernance</div>
        <h2 class="sec-title">Notre Bureau Exécutif</h2>
      </div>
      <div class="sec-line"></div>
    </div>

    <div class="bureau-grid">

      @php
        $membres = [
          ['role' => 'Président',                 'nom' => 'Kouadio Jean',       'img' => 'bureau-1'],
          ['role' => 'Vice-Président',             'nom' => 'Yao Kouassi',        'img' => 'bureau-2'],
          ['role' => 'Secrétaire Générale',        'nom' => 'Kouassi A. Marie',   'img' => 'bureau-3'],
          ['role' => 'Trésorier Général',          'nom' => 'Kouamé Marc',        'img' => 'bureau-4'],
          ['role' => 'Secrétaire à la Communication', 'nom' => 'Bamba Adjoua',   'img' => 'bureau-5'],
          ['role' => 'Chargé à l\'Organisation',  'nom' => 'Yapi Koren',          'img' => 'bureau-6'],
        ];
      @endphp

      @foreach($membres as $m)
      <div class="bureau-card">
        <div class="bureau-photo">
          <img src="{{ asset('images/mutuelles/' . $m['img'] . '.jpg') }}" alt="{{ $m['nom'] }}"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="bureau-photo-placeholder" style="display:none;">
            <svg width="52" height="52" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
          </div>
        </div>
        <div class="bureau-body">
          <div class="bureau-role">{{ $m['role'] }}</div>
          <div class="bureau-name">{{ $m['nom'] }}</div>
          <div class="bureau-underline"></div>
        </div>
      </div>
      @endforeach

    </div>

    <div style="text-align:center;margin-top:8px;">
      <a href="#" class="btn-voir-tous">
        Voir tous les membres du bureau &nbsp;<i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>

  {{-- ── COMMISSIONS ── --}}
  <div class="section-gap-sm" style="padding-bottom:80px;">
    <div class="commissions-header">
      <div class="commissions-icon-circle">
        <i class="fas fa-sitemap"></i>
      </div>
      <h2>Nos 13 Commissions</h2>
    </div>

    <div class="commission-grid">

      @php
        $commissions = [
          ['icon' => 'fa-graduation-cap', 'label' => 'Éducation & Formation'],
          ['icon' => 'fa-heart-pulse',    'label' => 'Santé & Social'],
          ['icon' => 'fa-chart-line',     'label' => 'Développement Économique'],
          ['icon' => 'fa-building-columns','label' => 'Infrastructures & Équipements'],
          ['icon' => 'fa-masks-theater',  'label' => 'Culture & Sport'],
          ['icon' => 'fa-seedling',       'label' => 'Environnement & Dév. Durable'],
          ['icon' => 'fa-users',          'label' => 'Jeunesse & Emploi'],
          ['icon' => 'fa-people-group',   'label' => 'Femmes & Famille'],
          ['icon' => 'fa-bullhorn',       'label' => 'Communication & Relations Publiques'],
          ['icon' => 'fa-coins',          'label' => 'Finances & Mobilisation'],
          ['icon' => 'fa-shield-halved',  'label' => 'Sécurité & Prévention'],
          ['icon' => 'fa-chart-pie',      'label' => 'Suivi-Évaluation & Qualité'],
          ['icon' => 'fa-globe',          'label' => 'Diaspora & Partenariats'],
        ];
      @endphp

      @foreach($commissions as $c)
      <div class="commission-card">
        <div class="commission-icon-wrap">
          <i class="fas {{ $c['icon'] }}"></i>
        </div>
        <div class="commission-label">{{ $c['label'] }}</div>
      </div>
      @endforeach

    </div>
  </div>

</div>





@endsection