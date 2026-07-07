@extends('layouts.app')

@section('title', 'Vie & Coutumes - MUDEA')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { overflow-x: hidden; font-family: 'Inter', sans-serif; }

    :root {
        --vert:     #1a5c2a;
        --vert-2:   #2a7a3a;
        --or:       #d4890a;
        --or-clair: #f0a500;
        --creme:    #fdf6e3;
        --texte:    #2c2c2c;
        --gris:     #6b6b6b;
        --blanc:    #ffffff;
    }

    /* ─── HERO ─── */
    .hero-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 340px;
    }
    .hero-left {
        padding: 52px 48px 52px clamp(24px, 5vw, 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
        position: relative;
        z-index: 2;
    }
    .hero-left::after {
        content: '';
        position: absolute;
        top: 0; right: -36px; bottom: 0;
        width: 72px;
        background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
        clip-path: polygon(0 0, 0 100%, 100% 100%);
        z-index: 3;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.4rem, 4.5vw, 3.6rem);
        font-weight: 900;
        color: #fffef7;
        line-height: 1.0;
        letter-spacing: -.02em;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(0,0,0,.25);
    }
    .hero-subtitle {
        font-size: .92rem;
        font-weight: 800;
        color: var(--or-clair);
        margin-bottom: 12px;
        line-height: 1.4;
        text-transform: uppercase;
        letter-spacing: .1em;
    }
    .hero-accent-line {
        width: 44px;
        height: 3px;
        background: var(--or-clair);
        border-radius: 2px;
        margin-bottom: 16px;
    }
    .hero-desc {
        color: rgba(255,255,255,.90);
        font-size: .9rem;
        line-height: 1.75;
        max-width: 400px;
    }
    .hero-right {
        position: relative;
        overflow: hidden;
        min-height: 340px;
    }
    .hero-right img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }
    .hero-right-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%);
    }

    /* ─── BREADCRUMB ─── */
    .vc-bc {
        padding: .65rem clamp(1rem, 4vw, 3rem);
        font-size: .83rem;
        color: var(--gris);
        border-bottom: 1px solid #e8e8e8;
        display: flex;
        align-items: center;
        gap: .35rem;
        background: #fff;
    }
    .vc-bc a { color: var(--gris); text-decoration: none; }
    .vc-bc a:hover { color: var(--vert); }
    .vc-bc .cur { color: var(--vert); font-weight: 600; }

    /* ─── SECTION CARTES ─── */
    .vc-section {
        padding: 2rem clamp(1rem, 4vw, 3rem) 2.2rem;
        background: #fff;
    }
    .vc-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.25rem;
    }

    /* ─── CARTE ─── */
    .vc-card {
        background: #fff;
        border: 1px solid #e4e4e4;
        border-radius: 12px;
        display: grid;
        grid-template-columns: 1fr 110px;
        overflow: hidden;
        min-height: 210px;
        width: 100%;
        transition: box-shadow .2s;
    }
    .vc-card:hover {
        box-shadow: 0 4px 18px rgba(0,0,0,.10);
    }
    .vc-card-body {
        min-width: 0;
        padding: 1.1rem 1rem 1rem;
        display: flex;
        flex-direction: column;
    }
    .vc-card-head {
        display: flex;
        align-items: flex-start;
        gap: .55rem;
        margin-bottom: .6rem;
    }
    .vc-icon {
        width: 38px; height: 38px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .ic-vert { background: var(--vert); color: #fff; }
    .ic-or   { background: var(--or-clair); color: #fff; }

    .vc-card-head h3 {
        font-size: .82rem;
        font-weight: 900;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin: 0;
    }
    .tc-vert { color: var(--vert); }
    .tc-or   { color: var(--or); }

    .vc-card-body p {
        font-size: .79rem;
        color: var(--texte);
        line-height: 1.55;
        margin: 0 0 .85rem;
        flex: 1;
    }

    .vc-card-img {
        width: 110px;
        flex-shrink: 0;
    }
    .vc-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* ─── BOUTONS ─── */
    .btn-v {
        display: inline-flex; align-items: center; gap: .3rem;
        background: var(--vert); color: #fff;
        padding: .42rem .88rem;
        border-radius: 6px;
        font-size: .70rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: .07em;
        text-decoration: none;
        transition: background .2s;
        width: fit-content; white-space: nowrap;
    }
    .btn-v:hover { background: var(--vert-2); color: #fff; }

    .btn-o {
        display: inline-flex; align-items: center; gap: .3rem;
        background: var(--or-clair); color: #fff;
        padding: .42rem .88rem;
        border-radius: 6px;
        font-size: .70rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: .07em;
        text-decoration: none;
        transition: background .2s;
        width: fit-content; white-space: nowrap;
    }
    .btn-o:hover { background: var(--or); color: #fff; }

    /* ─── VALEURS ─── */
    .vc-valeurs {
        background: var(--creme);
        padding: 2.2rem clamp(1rem, 4vw, 3rem);
        text-align: center;
    }
    .vc-valeurs h2 {
        font-size: .85rem;
        font-weight: 900;
        letter-spacing: .18em;
        text-transform: uppercase;
        color: var(--vert);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .9rem;
        margin: 0 0 1.8rem;
    }
    .vc-valeurs h2::before,
    .vc-valeurs h2::after {
        content: '';
        flex: 1; max-width: 80px;
        height: 2px;
        background: var(--or-clair);
        border-radius: 1px;
    }
    .val-grid {
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
    }
    .val-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .45rem;
        max-width: 110px;
    }
    .val-icon {
        width: 54px; height: 54px;
        border-radius: 50%;
        border: 2px solid var(--vert);
        background: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
        color: var(--or-clair);
    }
    .val-icon.ic-green { color: var(--vert); }

    .val-item strong {
        font-size: .74rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--texte);
    }
    .val-item span {
        font-size: .71rem;
        color: var(--gris);
        text-align: center;
        line-height: 1.4;
    }

    /* ─── PATRIMOINE ─── */
    .vc-patrimoine {
        padding: 2rem clamp(1rem, 4vw, 3rem) 1.8rem;
        background: #fff;
    }
    .vc-patrimoine h2 {
        font-size: .95rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--vert);
        margin: 0 0 1rem;
    }
    .gal-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: .7rem;
        margin-bottom: 1.3rem;
    }
    .gal-grid img {
        width: 100%;
        height: 118px;
        object-fit: cover;
        border-radius: 9px;
        display: block;
    }
    .gal-cta {
        display: flex;
        justify-content: center;
    }

    /* ─── CITATION ─── */
    .vc-citation {
        background: #fef3d0;
        padding: 1.6rem clamp(1rem, 4vw, 3rem);
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .vc-citation .qm {
        font-size: 4.2rem;
        color: var(--or-clair);
        line-height: .72;
        font-family: Georgia, serif;
        flex-shrink: 0;
    }
    .vc-citation p {
        font-size: .98rem;
        font-weight: 700;
        color: var(--texte);
        margin: 0;
        font-style: italic;
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 1100px) {
        .vc-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 900px) {
        .hero-split { grid-template-columns: 1fr; }
        .hero-left::after { display: none; }
        .hero-right { min-height: 220px; }
        .vc-grid { grid-template-columns: 1fr; }
        .gal-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 600px) {
        .gal-grid { grid-template-columns: repeat(2, 1fr); }
        .hero-title { font-size: 2.2rem; }
        .vc-card-img { width: 85px; }
        .val-grid { gap: 1.8rem; }
    }

    .vc-wrapper{
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .vc-wrapper{
        max-width: 1350px;
        margin: 20px auto;
        padding: 0 25px;
    }

</style>

{{-- HERO --}}
<section class="hero-split">
    <div class="hero-left">
        <h1 class="hero-title">Vie &amp; Coutumes</h1>
        <p class="hero-subtitle">Nos racines, notre identité,<br>notre fierté.</p>
        <div class="hero-accent-line"></div>
        <p class="hero-desc">
            Valoriser notre histoire, nos valeurs, nos traditions et notre patrimoine culturel pour transmettre aux générations futures.
        </p>
    </div>
    <div class="hero-right">
        <img src="{{ asset('images/education/15.png') }}" alt="Village d'Andé"
            onerror="this.style.background='#1b5e20';this.style.display='block'">
        <div class="hero-right-overlay"></div>
    </div>
</section>

{{-- BREADCRUMB --}}
<nav class="vc-bc" aria-label="Fil d'Ariane">
    <a href="{{ route('home') }}">🏠</a>
    <span>›</span>
    <a href="{{ route('home') }}">Accueil</a>
    <span>›</span>
    <span class="cur">Vie &amp; Coutumes</span>
</nav>

<div class="vc-wrapper">

{{-- Remplacement par le contenu géré via l'admin (Vie & Coutumes) --}}
<section class="vc-section">
    <div class="vc-grid">
        @forelse($vieCoutumes as $vie)
            <div class="vc-card" id="vc-{{ $vie->id }}">
                <div class="vc-card-body">
                    <div class="vc-card-head">
                        <div class="vc-icon ic-vert"><i class="fas fa-book"></i></div>
                        <h3 class="tc-vert">{{ Illuminate\Support\Str::limit($vie->titre, 40) }}</h3>
                    </div>
                    <p>{{ Illuminate\Support\Str::limit(strip_tags($vie->description), 160) }}</p>
                    <a href="{{ route('chefferie.detail', $vie->id ?? '') }}" class="btn-v">Lire →</a>
                </div>
                <div class="vc-card-img">
                    @if(!empty($vie->media))
                        <img src="{{ asset('storage/' . $vie->media) }}" alt="{{ $vie->titre }}">
                    @else
                        <img src="{{ asset('images/chefferie/1.JPG') }}" alt="{{ $vie->titre }}">
                    @endif
                </div>
            </div>
        @empty
            <div style="padding:30px;">Aucune entrée Vie &amp; Coutumes publiée pour le moment.</div>
        @endforelse
    </div>
</section>

</div>

@endsection
