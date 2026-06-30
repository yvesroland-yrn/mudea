@extends('layouts.app')

@section('title', 'Projets - MUDEA')

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
    --gold-dark:   #d4880a;
    --gold-light:  #fff8e1;
    --white:       #ffffff;
    --cream:       #f5f7f5;
    --border:      #dde8df;
    --text:        #1a2e25;
    --text-mid:    #455d4f;
    --text-light:  #7a9585;
    --shadow-sm:   0 2px 10px rgba(0,0,0,.07);
    --shadow-md:   0 6px 24px rgba(0,0,0,.11);
    --radius-sm:   8px;
    --radius-md:   14px;
    --radius-lg:   20px;
  }

  body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--text); line-height: 1.6; }

  /* ─── HERO ─── */
  .hero-split {
    display: grid; grid-template-columns: 1fr 1fr; min-height: 340px;
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
    font-size: clamp(2.6rem, 5vw, 4rem);
    font-weight: 900; color: white; line-height: 1.0; letter-spacing: -.02em; margin-bottom: 10px;
  }
  .hero-subtitle { font-size: 1.05rem; font-weight: 700; color: var(--gold); margin-bottom: 6px; line-height: 1.35; }
  .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
  .hero-desc { color: rgba(255,255,255,.82); font-size: .92rem; line-height: 1.85; max-width: 380px; }
  .hero-right { position: relative; overflow: hidden; }
  .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
  .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

  /* ─── CONTAINER ─── */
  .pj-wrap { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
  .section-block { padding: 36px 0 8px; }

  /* ─── SECTION TITLES ─── */
  .sec-title-row {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 20px;
  }
  .sec-title-left { display: flex; align-items: center; gap: 10px; }
  .sec-title-left .icon { font-size: 1.1rem; color: var(--green); }
  .sec-title-left h2 { font-size: .95rem; font-weight: 900; text-transform: uppercase; letter-spacing: .08em; color: var(--text); }
  .sec-see-all { font-size: .78rem; font-weight: 700; color: var(--green); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
  .sec-see-all:hover { gap: 9px; }

  /* ─── PROJET À LA UNE ─── */
  .une-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-lg); overflow: hidden;
    display: grid; grid-template-columns: 340px 1fr auto;
    box-shadow: var(--shadow-sm); margin-bottom: 32px;
  }
  .une-img { position: relative; }
  .une-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .une-img-placeholder { width: 100%; height: 100%; min-height: 240px; background: var(--green-light); display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 2.5rem; }
  .une-badge {
    position: absolute; top: 14px; left: 14px;
    background: var(--gold); color: white;
    font-size: .68rem; font-weight: 900; text-transform: uppercase; letter-spacing: .08em;
    padding: 5px 12px; border-radius: var(--radius-sm);
  }
  .une-body { padding: 28px 24px; display: flex; flex-direction: column; gap: 12px; justify-content: center; }
  .une-title { font-size: 1.15rem; font-weight: 800; color: var(--text); line-height: 1.3; margin-bottom: 4px; }
  .une-desc { font-size: .85rem; color: var(--text-mid); line-height: 1.7; }
  .une-meta { display: flex; gap: 20px; flex-wrap: wrap; }
  .une-meta-item { display: flex; align-items: center; gap: 7px; font-size: .75rem; color: var(--text-light); }
  .une-meta-item i { color: var(--green); font-size: .8rem; }
  .une-meta-item span { font-weight: 600; }
  .une-meta-item strong { color: var(--text-mid); font-weight: 700; }
  .progress-wrap { margin-top: 4px; }
  .progress-label { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
  .progress-label span { font-size: .75rem; color: var(--text-light); font-weight: 600; }
  .progress-label strong { font-size: .82rem; font-weight: 800; color: var(--green); }
  .progress-bar { height: 8px; background: var(--green-light); border-radius: 999px; overflow: hidden; }
  .progress-fill { height: 100%; background: var(--green); border-radius: 999px; transition: width .4s; }
  .btn-details {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--green); color: white;
    padding: 11px 22px; border-radius: var(--radius-sm);
    font-size: .8rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .05em; text-decoration: none;
    font-family: 'Nunito', sans-serif; transition: background .2s; margin-top: 4px; width: fit-content;
  }
  .btn-details:hover { background: var(--green-dark); }
  .une-stats {
    padding: 28px 24px; border-left: 1px solid var(--border);
    display: flex; flex-direction: column; gap: 20px; justify-content: center; min-width: 160px;
  }
  .une-stat-item { display: flex; align-items: center; gap: 14px; }
  .une-stat-icon {
    width: 44px; height: 44px; border-radius: 50%;
    background: var(--green-light); border: 2px solid var(--green-soft);
    display: flex; align-items: center; justify-content: center;
    color: var(--green); font-size: 1rem; flex-shrink: 0;
  }
  .une-stat-number { font-size: 1.6rem; font-weight: 900; color: var(--text); line-height: 1; }
  .une-stat-label { font-size: .72rem; color: var(--text-light); font-weight: 600; }

  /* ─── PROJETS EN COURS ─── */
  .projets-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 36px; }
  .projet-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-md); overflow: hidden;
    box-shadow: var(--shadow-sm); display: flex; flex-direction: column;
    transition: transform .3s, box-shadow .3s;
  }
  .projet-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .projet-img { position: relative; aspect-ratio: 16/10; overflow: hidden; }
  .projet-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .4s; }
  .projet-card:hover .projet-img img { transform: scale(1.05); }
  .projet-img-placeholder { width: 100%; height: 100%; min-height: 130px; background: var(--green-light); display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 1.8rem; }
  .projet-pct-badge {
    position: absolute; top: 10px; right: 10px;
    background: var(--gold); color: white;
    font-size: .72rem; font-weight: 900; padding: 4px 10px;
    border-radius: var(--radius-sm);
  }
  .projet-body { padding: 14px 14px 16px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
  .projet-title { font-size: .88rem; font-weight: 800; color: var(--text); line-height: 1.35; }
  .projet-dates { display: flex; align-items: center; gap: 6px; font-size: .72rem; color: var(--text-light); }
  .projet-dates i { color: var(--green); }
  .projet-progress { margin-top: 2px; }
  .projet-progress .progress-bar { height: 6px; }
  .projet-progress .progress-label strong { font-size: .76rem; }
  .voir-details-link { font-size: .75rem; font-weight: 700; color: var(--green); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; margin-top: 2px; }
  .voir-details-link:hover { gap: 8px; }

  /* ─── PROJETS RÉALISÉS ─── */
  .realises-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 36px; }
  .realise-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-md); overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform .3s, box-shadow .3s;
  }
  .realise-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .realise-img { position: relative; aspect-ratio: 16/10; overflow: hidden; }
  .realise-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .4s; }
  .realise-card:hover .realise-img img { transform: scale(1.05); }
  .realise-img-placeholder { width: 100%; height: 100%; min-height: 130px; background: var(--green-light); display: flex; align-items: center; justify-content: center; color: var(--text-light); font-size: 1.8rem; }
  .realise-badge {
    position: absolute; top: 10px; left: 10px;
    background: var(--green); color: white;
    font-size: .65rem; font-weight: 900; text-transform: uppercase; letter-spacing: .06em;
    padding: 4px 10px; border-radius: var(--radius-sm);
  }
  .realise-body { padding: 14px 14px 16px; display: flex; flex-direction: column; gap: 6px; }
  .realise-title { font-size: .88rem; font-weight: 800; color: var(--text); line-height: 1.35; }
  .realise-dates { display: flex; align-items: center; gap: 6px; font-size: .72rem; color: var(--text-light); }
  .realise-dates i { color: var(--green); }

  /* ─── PROJETS FUTURS ─── */
  .futurs-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 36px; }
  .futur-card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: var(--radius-md); padding: 18px 16px;
    box-shadow: var(--shadow-sm); display: flex; flex-direction: column; gap: 10px;
    transition: transform .3s, box-shadow .3s;
  }
  .futur-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .futur-icon-wrap {
    width: 56px; height: 56px; border-radius: var(--radius-md);
    background: var(--gold); display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: white; flex-shrink: 0;
  }
  .futur-title { font-size: .88rem; font-weight: 800; color: var(--text); line-height: 1.35; }
  .futur-dates { display: flex; align-items: center; gap: 6px; font-size: .72rem; color: var(--text-light); }
  .futur-dates i { color: var(--green); }
  .futur-link { font-size: .75rem; font-weight: 700; color: var(--green); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; margin-top: auto; }
  .futur-link:hover { gap: 8px; }

  /* ─── CTA FOOTER ─── */
  .cta-footer {
    background: var(--green-dark);
    padding: 32px 0;
    margin-top: 8px;
  }
  .cta-inner { display: grid; grid-template-columns: auto 1fr auto; gap: 32px; align-items: center; }
  .cta-icon-big { width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,.12); display: flex; align-items: center; justify-content: center; color: var(--gold); font-size: 1.8rem; flex-shrink: 0; }
  .cta-copy h3 { font-size: .88rem; font-weight: 900; text-transform: uppercase; letter-spacing: .1em; color: var(--gold); margin-bottom: 5px; }
  .cta-copy p { font-size: .85rem; color: rgba(255,255,255,.78); line-height: 1.6; max-width: 380px; }
  .btn-contribuer {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--gold); color: white;
    padding: 12px 24px; border-radius: var(--radius-sm);
    font-size: .82rem; font-weight: 900; text-transform: uppercase;
    letter-spacing: .05em; text-decoration: none;
    font-family: 'Nunito', sans-serif; transition: background .2s; white-space: nowrap;
  }
  .btn-contribuer:hover { background: var(--gold-dark); }
  .cta-features { display: flex; gap: 28px; align-items: center; }
  .cta-feature { display: flex; flex-direction: column; align-items: center; gap: 6px; text-align: center; }
  .cta-feature-icon { font-size: 1.4rem; color: rgba(255,255,255,.65); }
  .cta-feature-label { font-size: .7rem; color: rgba(255,255,255,.6); font-weight: 600; line-height: 1.3; }

  /* ─── RESPONSIVE ─── */
  @media (max-width: 1100px) {
    .projets-grid, .realises-grid, .futurs-grid { grid-template-columns: repeat(2, 1fr); }
    .une-card { grid-template-columns: 280px 1fr; }
    .une-stats { display: none; }
    .cta-inner { grid-template-columns: auto 1fr; }
    .cta-features { display: none; }
  }
  @media (max-width: 900px) {
    .hero-split { grid-template-columns: 1fr; }
    .hero-right { min-height: 220px; }
    .hero-left::after { display: none; }
    .pj-wrap { padding: 0 20px; }
    .une-card { grid-template-columns: 1fr; }
    .une-img img { aspect-ratio: 16/7; }
  }
  @media (max-width: 600px) {
    .projets-grid, .realises-grid, .futurs-grid { grid-template-columns: 1fr; }
  }
</style>

{{-- ══ HERO ══ --}}
<section class="hero-split">
  <div class="hero-left">
    <h1 class="hero-title">Projets</h1>
    <p class="hero-subtitle">Construire aujourd'hui<br>le futur d'Andé</p>
    <div class="hero-accent-line"></div>
    <p class="hero-desc">Découvrez nos projets de développement, suivez leur avancement et participez à la transformation durable de notre village.</p>
  </div>
  <div class="hero-right">
    <img src="{{ asset('images/projets/1.png') }}" alt="Village d'Andé"
      onerror="this.style.display='none'">
    <div class="hero-right-overlay"></div>
  </div>
</section>

<div class="pj-wrap">

  {{-- ══ PROJET À LA UNE ══ --}}
  <div class="section-block" id="projet-a-la-une">
    <div class="sec-title-row" style="margin-bottom:16px;">
      <div class="sec-title-left">
        <i class="fas fa-star icon" style="color:var(--green);"></i>
        <h2>Projet à la Une</h2>
      </div>
    </div>

    <div class="une-card">
      <div class="une-img">
        <img src="{{ asset('images/projets/2.png') }}" alt="Complexe Scolaire"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <div class="une-img-placeholder" style="display:none;"><i class="fas fa-school"></i></div>
        <div class="une-badge">À la Une</div>
      </div>
      <div class="une-body">
        <div class="une-title">Construction du Complexe Scolaire<br>d'Excellence d'Andé</div>
        <div class="une-desc">Un cadre moderne et équipé pour offrir à nos enfants une éducation de qualité et les préparer à l'avenir.</div>
        <div class="une-meta">
          <div class="une-meta-item">
            <i class="fas fa-calendar-days"></i>
            <span>Durée</span>
            <strong>2023 – 2026</strong>
          </div>
          <div class="une-meta-item">
            <i class="fas fa-lock"></i>
            <span>Budget</span>
            <strong>150 000 000 FCFA</strong>
          </div>
          <div class="une-meta-item">
            <i class="fas fa-user-tie"></i>
            <span>Responsable</span>
            <strong>Commission Éducation</strong>
          </div>
        </div>
        <div class="progress-wrap">
          <div class="progress-label">
            <span>Avancement global</span>
            <strong>65%</strong>
          </div>
          <div class="progress-bar"><div class="progress-fill" style="width:65%"></div></div>
        </div>
        <a href="{{ route('projets.detail', 'complexe-scolaire') }}" class="btn-details">Voir les détails &rarr;</a>
      </div>
      <div class="une-stats">
        <div class="une-stat-item">
          <div class="une-stat-icon"><i class="fas fa-spinner"></i></div>
          <div>
            <div class="une-stat-number">07</div>
            <div class="une-stat-label">Projets en cours</div>
          </div>
        </div>
        <div class="une-stat-item">
          <div class="une-stat-icon"><i class="fas fa-circle-check"></i></div>
          <div>
            <div class="une-stat-number">15</div>
            <div class="une-stat-label">Projets réalisés</div>
          </div>
        </div>
        <div class="une-stat-item">
          <div class="une-stat-icon"><i class="fas fa-hourglass-half"></i></div>
          <div>
            <div class="une-stat-number">05</div>
            <div class="une-stat-label">Projets futurs</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ══ PROJETS EN COURS ══ --}}
  <div class="section-block" id="projets-en-cours">
    <div class="sec-title-row">
      <div class="sec-title-left">
        <i class="fas fa-rotate icon"></i>
        <h2>Projets en Cours</h2>
      </div>
      <a href="{{ route('projets.detail', 'adduction-eau') }}" class="sec-see-all">Voir tous les projets en cours &rarr;</a>
    </div>

    @php
      $en_cours = [
        ['titre' => 'Adduction d\'eau potable pour Andé',        'dates' => '2023 – 2025', 'pct' => 65, 'img' => '1.JPG', 'slug' => 'adduction-eau'],
        ['titre' => 'Construction du Centre de Santé Intégré',   'dates' => '2024 – 2026', 'pct' => 40, 'img' => '2.JPG', 'slug' => 'centre-sante'],
        ['titre' => 'Réhabilitation des pistes rurales',         'dates' => '2024 – 2025', 'pct' => 30, 'img' => '3.JPG', 'slug' => 'pistes-rurales'],
        ['titre' => 'Électrification solaire de 5 quartiers',    'dates' => '2023 – 2025', 'pct' => 60, 'img' => '4.JPG', 'slug' => 'electrification-solaire'],
      ];
    @endphp

    <div class="projets-grid">
      @foreach($en_cours as $p)
      <div class="projet-card">
        <div class="projet-img">
          <img src="{{ asset('images/projets/' . $p['img']) }}" alt="{{ $p['titre'] }}"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="projet-img-placeholder" style="display:none;"><i class="fas fa-city"></i></div>
          <div class="projet-pct-badge">{{ $p['pct'] }}%</div>
        </div>
        <div class="projet-body">
          <div class="projet-title">{{ $p['titre'] }}</div>
          <div class="projet-dates"><i class="fas fa-calendar-days"></i> {{ $p['dates'] }}</div>
          <div class="projet-progress">
            <div class="progress-label">
              <span></span><strong>{{ $p['pct'] }}%</strong>
            </div>
            <div class="progress-bar"><div class="progress-fill" style="width:{{ $p['pct'] }}%"></div></div>
          </div>
          <a href="{{ route('projets.detail', $p['slug']) }}" class="voir-details-link">Voir les détails &rarr;</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- ══ PROJETS RÉALISÉS ══ --}}
  <div class="section-block" id="projets-realises">
    <div class="sec-title-row">
      <div class="sec-title-left">
        <i class="fas fa-circle-check icon"></i>
        <h2>Projets Réalisés</h2>
      </div>
      <a href="{{ route('projets.detail', 'ecole') }}" class="sec-see-all">Voir tous les projets réalisés &rarr;</a>
    </div>

    @php
      $realises = [
        ['titre' => 'Réhabilitation de l\'école primaire d\'Andé', 'dates' => '2001 – 2002', 'img' => 'ecole.jpg', 'slug' => 'ecole'],
        ['titre' => 'Construction de la Maison des Jeunes',        'dates' => '2020 – 2022', 'img' => 'chateau.jpg', 'slug' => 'chateau'],
        ['titre' => 'Programme d\'appui à l\'agriculture locale',  'dates' => '2019 – 2021', 'img' => 'route.jpg', 'slug' => 'agriculture-locale'],
        ['titre' => 'Aménagement de la place publique',            'dates' => '2021 – 2021', 'img' => '5.JPG', 'slug' => 'place-publique'],
      ];
    @endphp

    <div class="realises-grid">
      @foreach($realises as $r)
      <div class="realise-card">
        <div class="realise-img">
          <img src="{{ asset('images/projets/' . $r['img']) }}" alt="{{ $r['titre'] }}"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
          <div class="realise-img-placeholder" style="display:none;"><i class="fas fa-city"></i></div>
          <div class="realise-badge">Réalisé</div>
        </div>
        <div class="realise-body">
          <div class="realise-title">{{ $r['titre'] }}</div>
          <div class="realise-dates"><i class="fas fa-calendar-days"></i> {{ $r['dates'] }}</div>
          <a href="{{ route('projets.detail', $r['slug']) }}" class="voir-details-link">Voir les détails &rarr;</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- ══ PROJETS FUTURS ══ --}}
  <div class="section-block" style="padding-bottom:44px;" id="projets-futurs">
    <div class="sec-title-row">
      <div class="sec-title-left">
        <i class="fas fa-hourglass-half icon"></i>
        <h2>Projets Futurs</h2>
      </div>
      <a href="{{ route('projets.detail', 'complexe-sportif-culturel') }}" class="sec-see-all">Voir tous les projets futurs &rarr;</a>
    </div>

    @php
      $futurs = [
        ['titre' => 'Bitumage de l\'axe principal Andé – Carrefour',         'dates' => '2026 – 2027', 'icon' => 'fa-road', 'slug' => 'adduction-eau'],
        ['titre' => 'Construction d\'un complexe sportif et culturel',        'dates' => '2026 – 2027', 'icon' => 'fa-futbol', 'slug' => 'complexe-sportif-culturel'],
        ['titre' => 'Construction d\'un marché moderne',                      'dates' => '2026 – 2027', 'icon' => 'fa-store', 'slug' => 'place-publique'],
        ['titre' => 'Programme de reboisement et protection de l\'environnement', 'dates' => '2026 – 2028', 'icon' => 'fa-seedling', 'slug' => 'agriculture-locale'],
      ];
    @endphp

    <div class="futurs-grid">
      @foreach($futurs as $f)
      <div class="futur-card">
        <div class="futur-icon-wrap">
          <i class="fas {{ $f['icon'] }}"></i>
        </div>
        <div class="futur-title">{{ $f['titre'] }}</div>
        <div class="futur-dates"><i class="fas fa-calendar-days"></i> {{ $f['dates'] }}</div>
        <a href="{{ route('projets.detail', $f['slug']) }}" class="futur-link">En savoir plus &rarr;</a>
      </div>
      @endforeach
    </div>
  </div>

</div>

{{-- ══ CTA FOOTER ══ --}}
<div class="cta-footer">
  <div class="pj-wrap">
    <div class="cta-inner">
      <div class="cta-icon-big"><i class="fas fa-hands-holding-heart"></i></div>
      <div class="cta-copy">
        <h3>Soutenez nos projets</h3>
        <p>Votre contribution, même petite, peut faire une grande différence pour le développement durable d'Andé.</p>
        <a href="{{ route('contact') }}#formulaire-contact" class="btn-contribuer" style="margin-top:14px;">Contribuer maintenant <i class="fas fa-heart"></i></a>
      </div>
      <div class="cta-features">
        <div class="cta-feature">
          <div class="cta-feature-icon"><i class="fas fa-eye"></i></div>
          <div class="cta-feature-label">Transparence<br>Suivi régulier</div>
        </div>
        <div class="cta-feature">
          <div class="cta-feature-icon"><i class="fas fa-leaf"></i></div>
          <div class="cta-feature-label">Impact durable<br>pour la communauté</div>
        </div>
        <div class="cta-feature">
          <div class="cta-feature-icon"><i class="fas fa-bolt"></i></div>
          <div class="cta-feature-label">Participez au<br>changement</div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
