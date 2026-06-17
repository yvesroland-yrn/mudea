@extends('layouts.app')

@section('title', 'Espace Communautaire - MUDEA')

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
    --green:        #1b5e20;
    --green-dark:   #0a3d14;
    --green-mid:    #2e7d32;
    --green-light:  #e8f5e9;
    --green-soft:   #c8e6c9;
    --gold:         #f5a623;
    --gold-light:   #fff8e1;
    --gold-dark:    #d4880a;
    --blue:         #1565c0;
    --blue-light:   #e3f2fd;
    --purple:       #6a1b9a;
    --purple-light: #f3e5f5;
    --orange:       #f57c00;
    --red:          #e53935;
    --teal:         #00897b;
    --white:        #ffffff;
    --cream:        #f4f6f8;
    --border:       #e0e8e4;
    --text:         #1a2e25;
    --text-mid:     #455d4f;
    --text-light:   #7a9585;
    --shadow-sm:    0 2px 12px rgba(0,0,0,.07);
    --shadow-md:    0 6px 28px rgba(0,0,0,.11);
    --radius-sm:    8px;
    --radius-md:    14px;
    --radius-lg:    20px;
  }

  body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--text); line-height: 1.6; }

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
    font-weight: 900; color: white; line-height: 1.0; letter-spacing: -.02em; margin-bottom: 10px;
  }
  .hero-subtitle { font-size: 1rem; font-weight: 700; color: var(--gold); margin-bottom: 6px; line-height: 1.35; }
  .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
  .hero-desc { color: rgba(255,255,255,.82); font-size: .92rem; line-height: 1.85; max-width: 400px; }
  .hero-right { position: relative; overflow: hidden; min-height: 360px; }
  .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
  .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

  /* ─── CONTAINER ─── */
  .com-wrap { max-width: 1200px; margin: 0 auto; padding: 0 40px; }

  /* ─── MAIN GRID (2 colonnes) ─── */
  .main-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; padding: 36px 0; }

  /* ─── CARD COMMUNE ─── */
  .com-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 28px 26px;
    box-shadow: var(--shadow-sm); display: flex; flex-direction: column; gap: 16px;
  }
  .com-card-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
  .com-card-header-left { display: flex; align-items: center; gap: 14px; }
  .com-icon {
    width: 54px; height: 54px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
  }
  .com-icon--blue   { background: var(--blue);   color: white; }
  .com-icon--green  { background: var(--green);  color: white; }
  .com-icon--gold   { background: var(--gold);   color: white; }
  .com-icon--purple { background: var(--purple); color: white; }
  .com-card-title { font-size: 1rem; font-weight: 900; text-transform: uppercase; letter-spacing: .05em; line-height: 1.2; }
  .com-card-title--blue   { color: var(--blue); }
  .com-card-title--green  { color: var(--green); }
  .com-card-title--gold   { color: var(--gold-dark); }
  .com-card-title--purple { color: var(--purple); }
  .com-card-sub { font-size: .78rem; color: var(--text-light); font-weight: 600; margin-top: 2px; }
  .com-card-desc { font-size: .87rem; color: var(--text-mid); line-height: 1.75; }

  /* Bouton action header */
  .btn-action {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px; border-radius: var(--radius-sm);
    font-size: .75rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .04em; text-decoration: none; white-space: nowrap;
    font-family: 'Nunito', sans-serif; transition: opacity .2s; flex-shrink: 0;
  }
  .btn-action:hover { opacity: .85; }
  .btn-action--blue   { background: var(--blue);   color: white; }
  .btn-action--green  { background: var(--green);  color: white; }
  .btn-action--gold   { background: var(--gold);   color: white; }
  .btn-action--purple { background: var(--purple); color: white; }

  /* ─── PLACE PUBLIQUE ─── */
  .sujets-label { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
  .sujets-label span { font-size: .85rem; font-weight: 800; color: var(--text); }
  .voir-tous-link { font-size: .78rem; font-weight: 700; color: var(--blue); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
  .voir-tous-link:hover { gap: 9px; }
  .voir-tous-link--green  { color: var(--green); }
  .voir-tous-link--gold   { color: var(--gold-dark); }
  .voir-tous-link--purple { color: var(--purple); }

  .sujet-list { display: flex; flex-direction: column; gap: 0; }
  .sujet-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 0; border-bottom: 1px solid var(--border);
  }
  .sujet-item:last-child { border-bottom: none; }
  .sujet-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    overflow: hidden; background: var(--green-light); flex-shrink: 0;
  }
  .sujet-avatar img { width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; }
  .sujet-avatar-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: .85rem; }
  .sujet-body { flex: 1; min-width: 0; }
  .sujet-title { font-size: .88rem; font-weight: 800; color: var(--text); line-height: 1.3; }
  .sujet-meta { font-size: .72rem; color: var(--text-light); margin-top: 2px; }
  .sujet-count {
    display: flex; align-items: center; gap: 5px;
    font-size: .78rem; font-weight: 700; color: var(--blue); flex-shrink: 0;
  }

  .btn-full {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px; border-radius: var(--radius-sm);
    font-size: .8rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .05em; text-decoration: none;
    font-family: 'Nunito', sans-serif; transition: opacity .2s; margin-top: 4px;
  }
  .btn-full:hover { opacity: .85; }
  .btn-full--blue   { background: var(--blue-light); color: var(--blue); border: 1.5px solid #90caf9; }
  .btn-full--green  { background: var(--green-light); color: var(--green); border: 1.5px solid var(--green-soft); }
  .btn-full--gold   { background: var(--gold-light);  color: var(--gold-dark); border: 1.5px solid #ffe082; }
  .btn-full--purple { background: var(--purple-light); color: var(--purple); border: 1.5px solid #ce93d8; }

  /* ─── RESSOURCES & COMPÉTENCES ─── */
  .comp-search {
    display: grid; grid-template-columns: 1.6fr 1fr 1fr auto; gap: 8px;
  }
  .comp-search-input, .comp-search-select {
    width: 100%; padding: 9px 12px; border: 1.5px solid var(--border);
    border-radius: var(--radius-sm); font-size: .78rem; font-family: 'Nunito', sans-serif;
    color: var(--text); background: var(--white); appearance: none;
  }
  .comp-search-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237a9585' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 10px center; background-size: 14px;
    padding-right: 28px; color: var(--text-light); cursor: pointer;
  }
  .comp-search-input::placeholder { color: var(--text-light); }
  .comp-search-input:focus, .comp-search-select:focus { outline: none; border-color: var(--green-mid); }
  .comp-search-btn {
    padding: 9px 18px; border-radius: var(--radius-sm); border: none;
    background: var(--green); color: white; font-size: .73rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .04em; cursor: pointer;
    font-family: 'Nunito', sans-serif; white-space: nowrap; transition: opacity .2s;
  }
  .comp-search-btn:hover { opacity: .85; }

  .competences-label { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
  .competences-label span { font-size: .85rem; font-weight: 800; color: var(--text); }

  .competences-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
  .comp-item {
    display: flex; align-items: center; gap: 10px; padding: 12px;
    background: var(--cream); border: 1px solid var(--border); border-radius: var(--radius-sm);
  }
  .comp-icon {
    width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; color: white;
    display: flex; align-items: center; justify-content: center; font-size: .95rem;
  }
  .comp-icon--orange { background: var(--orange); }
  .comp-icon--leaf   { background: var(--green-mid); }
  .comp-icon--laptop { background: var(--blue); }
  .comp-icon--red    { background: var(--red); }
  .comp-icon--cap    { background: var(--teal); }
  .comp-name  { font-size: .74rem; font-weight: 800; color: var(--text); line-height: 1.25; }
  .comp-count { font-size: .68rem; color: var(--text-light); font-weight: 600; margin-top: 2px; }
  .comp-more {
    width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
    text-align: center; font-size: .76rem; font-weight: 800; color: var(--green); line-height: 1.3;
  }

  /* ─── PARTAGE D'EXPÉRIENCES ─── */
  .temoignage-card {
    background: var(--cream); border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden; display: grid; grid-template-columns: 110px 1fr; gap: 0;
  }
  .temoignage-img {
    width: 110px; background: var(--green-light);
  }
  .temoignage-img img { width: 100%; height: 100%; object-fit: cover; object-position: top; display: block; }
  .temoignage-img-placeholder { width: 100%; height: 100%; min-height: 120px; display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 1.8rem; }
  .temoignage-body { padding: 14px 16px; }
  .temoignage-title { font-size: .88rem; font-weight: 800; color: var(--text); margin-bottom: 3px; }
  .temoignage-by { font-size: .72rem; color: var(--text-light); margin-bottom: 8px; }
  .temoignage-excerpt { font-size: .8rem; color: var(--text-mid); line-height: 1.65; }
  .temo-dots { display: flex; gap: 7px; margin-top: 8px; }
  .dot { width: 9px; height: 9px; border-radius: 50%; background: var(--border); }
  .dot.active { background: var(--gold); }

  /* ─── ENTRAIDE & SOLIDARITÉ ─── */
  .entraide-cols { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .entraide-sub-title { font-size: .82rem; font-weight: 800; color: var(--text); margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between; }
  .entraide-list { display: flex; flex-direction: column; gap: 0; }
  .entraide-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 0; border-bottom: 1px solid var(--border);
  }
  .entraide-item:last-child { border-bottom: none; }
  .entraide-avatar { width: 34px; height: 34px; border-radius: 50%; overflow: hidden; background: var(--green-light); flex-shrink: 0; }
  .entraide-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .entraide-avatar-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: .8rem; }
  .entraide-item-title { font-size: .8rem; font-weight: 700; color: var(--text); line-height: 1.3; }
  .entraide-item-meta { font-size: .68rem; color: var(--text-light); }

  /* ─── BOTTOM STRIP ─── */
  .bottom-strip {
    background: var(--white); border-top: 1px solid var(--border);
    padding: 32px 0 40px;
  }
  .bottom-inner { display: grid; grid-template-columns: 200px 1fr; gap: 36px; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 40px; }
  .bottom-illo img { width: 100%; max-width: 180px; }
  .bottom-illo-placeholder { width: 180px; height: 140px; background: var(--green-light); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 2.5rem; }
  .bottom-right { display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; }
  .bottom-copy h3 { font-family: 'Playfair Display', serif; font-size: 1.15rem; font-weight: 700; color: var(--green); margin-bottom: 6px; }
  .bottom-copy p { font-size: .85rem; color: var(--text-mid); line-height: 1.7; max-width: 440px; }
  .stats-row { display: flex; gap: 16px; flex-shrink: 0; }
  .stat-box {
    background: var(--cream); border: 1px solid var(--border);
    border-radius: var(--radius-md); padding: 18px 20px;
    display: flex; align-items: center; gap: 12px;
    min-width: 150px;
  }
  .stat-icon { font-size: 1.6rem; }
  .stat-icon--green  { color: var(--green); }
  .stat-icon--blue   { color: var(--blue); }
  .stat-icon--gold   { color: var(--gold); }
  .stat-number { font-size: 1.5rem; font-weight: 900; color: var(--text); line-height: 1; }
  .stat-label { font-size: .72rem; color: var(--text-light); font-weight: 600; text-transform: uppercase; letter-spacing: .06em; }

  /* ─── RESPONSIVE ─── */
  @media (max-width: 1000px) {
    .main-grid { grid-template-columns: 1fr; }
    .bottom-right { grid-template-columns: 1fr; }
    .stats-row { flex-wrap: wrap; }
  }
  @media (max-width: 760px) {
    .hero-split { grid-template-columns: 1fr; }
    .hero-right { min-height: 220px; }
    .hero-left::after { display: none; }
    .com-wrap { padding: 0 16px; }
    .bottom-inner { grid-template-columns: 1fr; padding: 0 16px; }
    .entraide-cols { grid-template-columns: 1fr; }
    .competences-grid { grid-template-columns: repeat(2, 1fr); }
    .comp-search { grid-template-columns: 1fr; }
  }
</style>

{{-- ══ HERO ══ --}}
<section class="hero-split">
  <div class="hero-left">
    <h1 class="hero-title">Espace<br>Communautaire</h1>
    <p class="hero-subtitle">Échanger, partager, s'entraider et construire<br>ensemble le développement d'Andé.</p>
    <div class="hero-accent-line"></div>
    <p class="hero-desc">Un espace ouvert à tous les membres de la communauté pour dialoguer, partager les compétences, les expériences et les bonnes initiatives.</p>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/communaute/1.png') }}" alt="Communauté d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>

{{-- ══ MAIN GRID ══ --}}
<div class="com-wrap">
  <div class="main-grid">

    {{-- ══ PLACE PUBLIQUE ══ --}}
    <div class="com-card">
      <div class="com-card-header">
        <div class="com-card-header-left">
          <div class="com-icon com-icon--blue"><i class="fas fa-comments"></i></div>
          <div>
            <div class="com-card-title com-card-title--blue">Place Publique</div>
            <div class="com-card-sub">Discussions générales</div>
          </div>
        </div>
        <a href="#" class="btn-action btn-action--blue"><i class="fas fa-pencil"></i> Nouveau sujet</a>
      </div>
      <p class="com-card-desc">Participez aux discussions, posez vos questions, donnez votre avis et échangez sur la vie du village.</p>

      <div class="sujets-label">
        <span>Sujets récents</span>
        <a href="#" class="voir-tous-link">Voir tous &rarr;</a>
      </div>

      <div class="sujet-list">
        @php
          $sujets = [
            ['titre' => 'Amélioration de l\'accès à l\'eau potable', 'par' => 'K. Jean',  'temps' => 'Il y a 2 heures', 'count' => 12, 'img' => '2.png'],
            ['titre' => 'Organisation de la fête des ignames 2024', 'par' => 'A. Marie', 'temps' => 'Il y a 5 heures', 'count' => 8,  'img' => '3.png'],
            ['titre' => 'Transport scolaire : vos suggestions',     'par' => 'Y. Konan',  'temps' => 'Il y a 1 jour',    'count' => 15, 'img' => '4.png'],
          ];
        @endphp
        @foreach($sujets as $s)
        <div class="sujet-item">
          <div class="sujet-avatar">
            <img src="{{ asset('images/communaute/' . $s['img']) }}" alt=""
              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
            <div class="sujet-avatar-placeholder" style="display:none;"><i class="fas fa-user"></i></div>
          </div>
          <div class="sujet-body">
            <div class="sujet-title">{{ $s['titre'] }}</div>
            <div class="sujet-meta">Par {{ $s['par'] }} · {{ $s['temps'] }}</div>
          </div>
          <div class="sujet-count"><i class="fas fa-comment"></i> {{ $s['count'] }}</div>
        </div>
        @endforeach
      </div>

      <a href="#" class="btn-full btn-full--blue">Accéder aux discussions &rarr;</a>
    </div>

    {{-- ══ RESSOURCES & COMPÉTENCES ══ --}}
    <div class="com-card">
      <div class="com-card-header">
        <div class="com-card-header-left">
          <div class="com-icon com-icon--green"><i class="fas fa-people-group"></i></div>
          <div>
            <div class="com-card-title com-card-title--green">Ressources &amp; Compétences</div>
            <div class="com-card-sub">Référencement des compétences</div>
          </div>
        </div>
        <a href="#" class="btn-action btn-action--green"><i class="fas fa-user-plus"></i> Ajouter ma compétence</a>
      </div>
      <p class="com-card-desc">Découvrez les talents de la communauté et proposez vos compétences.</p>

      <form class="comp-search" action="#" method="GET">
        <input type="text" name="q" class="comp-search-input" placeholder="Rechercher une compétence...">
        <select name="domaine" class="comp-search-select">
          <option value="">Domaine</option>
          <option value="batiment">Bâtiment &amp; Construction</option>
          <option value="agriculture">Agriculture &amp; Élevage</option>
          <option value="informatique">Informatique &amp; Digital</option>
          <option value="sante">Santé &amp; Bien-Être</option>
          <option value="education">Éducation &amp; Formation</option>
        </select>
        <select name="localisation" class="comp-search-select">
          <option value="">Localisation</option>
          <option value="ande-centre">Andé Centre</option>
          <option value="ande-nord">Andé Nord</option>
          <option value="ande-sud">Andé Sud</option>
        </select>
        <button type="submit" class="comp-search-btn"><i class="fas fa-magnifying-glass"></i> Rechercher</button>
      </form>

      <div class="competences-label">
        <span>Compétences disponibles</span>
        <a href="#" class="voir-tous-link voir-tous-link--green">Voir toutes &rarr;</a>
      </div>

      <div class="competences-grid">
        <div class="comp-item">
          <div class="comp-icon comp-icon--orange"><i class="fas fa-hard-hat"></i></div>
          <div>
            <div class="comp-name">Bâtiment &amp;<br>Construction</div>
            <div class="comp-count">16 membres</div>
          </div>
        </div>
        <div class="comp-item">
          <div class="comp-icon comp-icon--leaf"><i class="fas fa-seedling"></i></div>
          <div>
            <div class="comp-name">Agriculture &amp;<br>Élevage</div>
            <div class="comp-count">24 membres</div>
          </div>
        </div>
        <div class="comp-item">
          <div class="comp-icon comp-icon--laptop"><i class="fas fa-laptop-code"></i></div>
          <div>
            <div class="comp-name">Informatique &amp;<br>Digital</div>
            <div class="comp-count">15 membres</div>
          </div>
        </div>
        <div class="comp-item">
          <div class="comp-icon comp-icon--red"><i class="fas fa-heart-pulse"></i></div>
          <div>
            <div class="comp-name">Santé &amp;<br>Bien-Être</div>
            <div class="comp-count">12 membres</div>
          </div>
        </div>
        <div class="comp-item">
          <div class="comp-icon comp-icon--cap"><i class="fas fa-graduation-cap"></i></div>
          <div>
            <div class="comp-name">Éducation &amp;<br>Formation</div>
            <div class="comp-count">20 membres</div>
          </div>
        </div>
        <a href="#" class="comp-item" style="text-decoration:none; cursor:pointer;">
          <div class="comp-more">Voir plus<br>de domaines &rarr;</div>
        </a>
      </div>

      <a href="#" class="btn-full btn-full--green" style="margin-top:4px;">Découvrir les compétences &rarr;</a>
    </div>

    {{-- ══ PARTAGE D'EXPÉRIENCES ══ --}}
    <div class="com-card">
      <div class="com-card-header">
        <div class="com-card-header-left">
          <div class="com-icon com-icon--gold"><i class="fas fa-people-arrows"></i></div>
          <div>
            <div class="com-card-title com-card-title--gold">Partage d'Expériences</div>
            <div class="com-card-sub">Témoignages et retours d'expérience</div>
          </div>
        </div>
        <a href="#" class="btn-action btn-action--gold"><i class="fas fa-pencil"></i> Partager une expérience</a>
      </div>
      <p class="com-card-desc">Inspirez et soyez inspiré par les parcours, réussites et initiatives de notre communauté.</p>

      <div class="sujets-label">
        <span>Derniers témoignages</span>
        <a href="#" class="voir-tous-link voir-tous-link--gold">Voir tous &rarr;</a>
      </div>

      <div class="temoignage-card">
        <div class="temoignage-img">
          <img src="{{ asset('images/communaute/5.png') }}" alt="Coulibaly S."
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="temoignage-img-placeholder" style="display:none;"><i class="fas fa-user"></i></div>
        </div>
        <div class="temoignage-body">
          <div class="temoignage-title">Mon expérience dans l'entrepreneuriat agricole</div>
          <div class="temoignage-by">Par Coulibaly S. · Il y a 3 jours</div>
          <div class="temoignage-excerpt">Comment j'ai démarré une activité agricole et surmonté les défis pour réussir. Mon parcours peut aider les jeunes qui veulent se lancer.</div>
          <div class="temo-dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
          </div>
        </div>
      </div>

      <a href="#" class="btn-full btn-full--gold" style="margin-top:4px;">Lire les témoignages &rarr;</a>
    </div>

    {{-- ══ ENTRAIDE & SOLIDARITÉ ══ --}}
    <div class="com-card">
      <div class="com-card-header">
        <div class="com-card-header-left">
          <div class="com-icon com-icon--purple"><i class="fas fa-hands-holding-heart"></i></div>
          <div>
            <div class="com-card-title com-card-title--purple">Entraide &amp; Solidarité</div>
            <div class="com-card-sub">Assistance et soutien communautaire</div>
          </div>
        </div>
        <a href="#" class="btn-action btn-action--purple"><i class="fas fa-plus"></i> Publier une demande</a>
      </div>
      <p class="com-card-desc">Besoin d'aide ou envie d'aider ? Ensemble, nous sommes plus forts.</p>

      <div class="entraide-cols">

        {{-- Demandes récentes --}}
        <div>
          <div class="entraide-sub-title">
            <span>Demandes récentes</span>
            <a href="#" class="voir-tous-link voir-tous-link--purple" style="font-size:.72rem;">Voir toutes &rarr;</a>
          </div>
          <div class="entraide-list">
            @php
              $demandes = [
                ['titre' => 'Aide pour frais médicaux',        'par' => 'K. Koffi', 'temps' => 'Il y a 4 heures', 'img' => '2.png'],
                ['titre' => 'Soutien scolaire en maths',       'par' => 'B. Yao',   'temps' => 'Il y a 1 jour',   'img' => '3.png'],
                ['titre' => 'Matériel pour activité agricole', 'par' => 'D. Assi',  'temps' => 'Il y a 2 jours',  'img' => '4.png'],
              ];
            @endphp
            @foreach($demandes as $d)
            <div class="entraide-item">
              <div class="entraide-avatar">
                <img src="{{ asset('images/communaute/' . $d['img']) }}" alt=""
                  onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div class="entraide-avatar-placeholder" style="display:none;"><i class="fas fa-user"></i></div>
              </div>
              <div>
                <div class="entraide-item-title">{{ $d['titre'] }}</div>
                <div class="entraide-item-meta">Par {{ $d['par'] }} · {{ $d['temps'] }}</div>
              </div>
            </div>
            @endforeach
          </div>
          <a href="#" class="voir-tous-link voir-tous-link--purple" style="font-size:.72rem; margin-top:10px;">Voir toutes les demandes &rarr;</a>
        </div>

        {{-- Offres d'aide récentes --}}
        <div>
          <div class="entraide-sub-title">
            <span>Offres d'aide récentes</span>
            <a href="#" class="voir-tous-link voir-tous-link--purple" style="font-size:.72rem;">Voir toutes &rarr;</a>
          </div>
          <div class="entraide-list">
            @php
              $offres = [
                ['titre' => 'Don de livres scolaires',   'par' => 'K. Marie',   'temps' => 'Il y a 6 heures', 'img' => '6.JPG'],
                ['titre' => 'Cours de soutien gratuit',  'par' => 'A. Sané',    'temps' => 'Il y a 1 jour',   'img' => '1.png'],
                ['titre' => 'Offre de stages étudiants', 'par' => 'N. Konaté',  'temps' => 'Il y a 3 jours',  'img' => '5.png'],
              ];
            @endphp
            @foreach($offres as $o)
            <div class="entraide-item">
              <div class="entraide-avatar">
                <img src="{{ asset('images/communaute/' . $o['img']) }}" alt=""
                  onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div class="entraide-avatar-placeholder" style="display:none;"><i class="fas fa-user"></i></div>
              </div>
              <div>
                <div class="entraide-item-title">{{ $o['titre'] }}</div>
                <div class="entraide-item-meta">Par {{ $o['par'] }} · {{ $o['temps'] }}</div>
              </div>
            </div>
            @endforeach
          </div>
          <a href="#" class="voir-tous-link voir-tous-link--purple" style="font-size:.72rem; margin-top:10px;">Voir toutes les offres &rarr;</a>
        </div>

      </div>

      <a href="#" class="btn-full btn-full--purple" style="margin-top:4px;">Voir toutes les annonces &rarr;</a>
    </div>

  </div>
</div>

{{-- ══ BOTTOM STRIP ══ --}}
<section class="bottom-strip">
  <div class="bottom-inner">
    <div class="bottom-illo">
      <img src="{{ asset('images/communaute/6.JPG') }}" alt="Ensemble"
        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
      <div class="bottom-illo-placeholder" style="display:none;"><i class="fas fa-puzzle-piece"></i></div>
    </div>
    <div class="bottom-right">
      <div class="bottom-copy">
        <h3>Ensemble pour un Andé meilleur</h3>
        <p>Votre participation active fait la richesse de notre communauté. Partageons nos idées, nos compétences et nos expériences pour bâtir ensemble un avenir prospère pour notre village.</p>
      </div>
      <div class="stats-row">
        <div class="stat-box">
          <div class="stat-icon stat-icon--green"><i class="fas fa-people-group"></i></div>
          <div>
            <div class="stat-number">+520</div>
            <div class="stat-label">Membres actifs</div>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-icon stat-icon--blue"><i class="fas fa-comments"></i></div>
          <div>
            <div class="stat-number">+1 250</div>
            <div class="stat-label">Discussions</div>
          </div>
        </div>
        <div class="stat-box">
          <div class="stat-icon stat-icon--gold"><i class="fas fa-hands-holding-heart"></i></div>
          <div>
            <div class="stat-number">+320</div>
            <div class="stat-label">Actions d'entraide</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection