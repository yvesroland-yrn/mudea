@extends('layouts.app')

@section('title', 'Éducation & Excellence - MUDEA')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
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
            --gold-dark: #d4880a;
            --blue: #1565c0;
            --blue-light: #e3f2fd;
            --purple: #6a1b9a;
            --purple-light: #f3e5f5;
            --orange: #e65100;
            --orange-light: #fff3e0;
            --cream: #f9fafb;
            --white: #ffffff;
            --border: #e0e9e2;
            --text: #1a2e25;
            --text-mid: #455d4f;
            --text-light: #7a9585;
            --shadow-sm: 0 2px 12px rgba(27, 94, 32, .08);
            --shadow-md: 0 6px 28px rgba(27, 94, 32, .12);
            --shadow-lg: 0 14px 48px rgba(27, 94, 32, .16);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 22px;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text);
            line-height: 1.6;
        }

        /* ─── HERO SPLIT ─── */
        .hero-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 440px;
            background: var(--green-dark);
        }

        .hero-left {
            padding: 60px 52px 60px max(28px, calc((100vw - 1280px) / 2));
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
            top: 0;
            right: -36px;
            bottom: 0;
            width: 72px;
            background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
            clip-path: polygon(0 0, 0 100%, 100% 100%);
            z-index: 3;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            font-weight: 900;
            color: white;
            line-height: 1.06;
            letter-spacing: -.02em;
            margin-bottom: 10px;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: .02em;
            margin-bottom: 6px;
        }

        .hero-accent-line {
            width: 48px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            margin-bottom: 18px;
        }

        .hero-desc {
            color: rgba(255, 255, 255, .82);
            font-size: .95rem;
            line-height: 1.85;
            max-width: 440px;
        }

        .hero-right {
            position: relative;
            overflow: hidden;
            min-height: 440px;
        }

        .hero-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            display: block;
        }

        .hero-right-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(7, 31, 11, .55) 0%, transparent 55%);
        }

        /* ─── CONTAINER ─── */
        .edu-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* ─── RUBRIQUES CARDS ─── */
        .rubriques-section {
            padding: 52px 0 40px;
        }

        .rubriques-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
        }

        .rubrique-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 0 0 0;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: transform .3s, box-shadow .3s;
        }

        .rubrique-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .rubrique-top {
            padding: 22px 18px 14px;
        }

        .rubrique-icon-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .rubrique-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .rubrique-icon--green {
            background: var(--green);
            color: white;
        }

        .rubrique-icon--gold {
            background: var(--gold);
            color: white;
        }

        .rubrique-icon--blue {
            background: var(--blue);
            color: white;
        }

        .rubrique-icon--purple {
            background: var(--purple);
            color: white;
        }

        .rubrique-icon--dark {
            background: var(--green-dark);
            color: white;
        }

        .rubrique-title {
            font-size: .82rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .06em;
            line-height: 1.25;
        }

        .rubrique-title--green {
            color: var(--green);
        }

        .rubrique-title--gold {
            color: var(--gold-dark);
        }

        .rubrique-title--blue {
            color: var(--blue);
        }

        .rubrique-title--purple {
            color: var(--purple);
        }

        .rubrique-title--dark {
            color: var(--green-dark);
        }

        .rubrique-desc {
            font-size: .83rem;
            color: var(--text-mid);
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .rubrique-btn {
            display: inline-block;
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            font-size: .75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            transition: opacity .2s;
            font-family: 'Nunito', sans-serif;
            margin-bottom: 4px;
        }

        .rubrique-btn:hover {
            opacity: .85;
        }

        .rubrique-btn--green {
            background: var(--green);
            color: white;
        }

        .rubrique-btn--gold {
            background: var(--gold);
            color: white;
        }

        .rubrique-btn--blue {
            background: var(--blue);
            color: white;
        }

        .rubrique-btn--purple {
            background: var(--purple);
            color: white;
        }

        .rubrique-btn--dark {
            background: var(--green-dark);
            color: white;
        }

        .rubrique-photo {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            margin-top: auto;
        }

        .rubrique-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .4s;
        }

        .rubrique-card:hover .rubrique-photo img {
            transform: scale(1.06);
        }

        .rubrique-photo-placeholder {
            width: 100%;
            height: 100%;
            min-height: 130px;
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 2rem;
        }

        /* ─── BOTTOM SPLIT : Actualités + Témoignages ─── */
        .bottom-split {
            padding: 52px 0 72px;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        /* Actualités */
        .actu-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .actu-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
        }

        .see-all-link {
            font-size: .8rem;
            font-weight: 700;
            color: var(--green);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .see-all-link:hover {
            gap: 10px;
        }

        .actu-list {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-bottom: 24px;
        }

        .actu-item {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            align-items: start;
        }

        .actu-item:first-child {
            border-top: 1px solid var(--border);
        }

        .actu-thumb {
            width: 80px;
            height: 60px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: var(--green-light);
            flex-shrink: 0;
        }

        .actu-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .actu-thumb-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 1.2rem;
        }

        .actu-date {
            font-size: .7rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 4px;
        }

        .actu-title-text {
            font-size: .88rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .actu-excerpt {
            font-size: .78rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        .btn-voir-actu {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--green);
            color: white;
            padding: 13px 28px;
            border-radius: var(--radius-sm);
            font-weight: 800;
            font-size: .82rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            transition: background .2s;
            font-family: 'Nunito', sans-serif;
        }

        .btn-voir-actu:hover {
            background: var(--green-dark);
        }

        /* Témoignages */
        .temoignages-col {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .temoignages-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .temoignages-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
        }

        .temoignage-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: opacity .35s ease, transform .35s ease;
        }

        .temoignage-card.is-updating {
            opacity: .4;
            transform: translateY(4px);
        }

        .temoignage-top {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 14px;
        }

        .temoignage-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--green-light);
            flex-shrink: 0;
            border: 3px solid var(--green-soft);
        }

        .temoignage-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        .temoignage-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1.4rem;
        }

        .temoignage-name {
            font-weight: 800;
            font-size: .95rem;
            color: var(--text);
            margin-bottom: 2px;
        }

        .temoignage-role {
            font-size: .75rem;
            color: var(--text-light);
            font-weight: 600;
        }

        .temoignage-quote {
            font-size: .88rem;
            color: var(--text-mid);
            line-height: 1.8;
            font-style: italic;
            border-left: 3px solid var(--green-soft);
            padding-left: 14px;
        }

        .temoignage-dots {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            margin-top: 4px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--border);
            cursor: pointer;
            transition: background .2s, transform .2s;
            border: 0;
            padding: 0;
        }

        .dot:hover {
            transform: scale(1.08);
        }

        .dot.active {
            background: var(--green);
        }

        /* CTA soutien */
        .cta-soutien {
            background: var(--gold-light);
            border: 1px solid #f5c875;
            border-radius: var(--radius-lg);
            padding: 24px 24px 22px;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 16px;
        }

        .cta-soutien-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(245, 166, 35, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--gold-dark);
            margin-bottom: 10px;
        }

        .cta-soutien h4 {
            font-size: .88rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--green);
            margin-bottom: 5px;
        }

        .cta-soutien p {
            font-size: .82rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        .cta-soutien-right {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .cta-soutien-right img {
            width: 64px;
            opacity: .7;
        }

        .btn-contribuer {
            display: inline-block;
            background: var(--gold);
            color: white;
            padding: 11px 20px;
            border-radius: var(--radius-sm);
            font-weight: 900;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
            font-family: 'Nunito', sans-serif;
        }

        .btn-contribuer:hover {
            background: var(--gold-dark);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1100px) {
            .rubriques-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .forum-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .hero-split {
                grid-template-columns: 1fr;
                min-height: 360px;
            }

            .hero-right {
                min-height: 280px;
            }

            .hero-left::after {
                display: none;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .edu-container {
                padding: 0 20px;
            }
        }

        @media (max-width: 640px) {
            .rubriques-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .forum-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>


    {{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
    <section class="hero-split">
        <div class="hero-left">
            <h1 class="hero-title">Éducation &amp; Excellence</h1>
            <p class="hero-subtitle">Investir dans l'éducation, bâtir l'avenir d'Andé</p>
            <div class="hero-accent-line"></div>
            <p class="hero-desc">
                La MUDEA accompagne les élèves, les étudiants et les jeunes talents du village
                à travers des programmes de soutien, d'orientation et de valorisation de l'excellence.
            </p>
        </div>
        <div class="hero-right">
            <img src="{{ asset('images/education/15.png') }}" alt="Étudiants d'Andé" onerror="this.style.display='none'">
            <div class="hero-right-overlay"></div>
        </div>
    </section>


    <section class="rubriques-section">
        <div class="edu-container">
            <div class="actu-header" style="margin-bottom: 28px;">
                <h2>Éducation &amp; Excellence</h2>
            </div>

            @if($educationEntries->isNotEmpty())
                <div class="rubriques-grid">
                    @foreach($educationEntries as $entry)
                        <div class="rubrique-card">
                            <div class="rubrique-top">
                                <div class="rubrique-icon-row">
                                    <div class="rubrique-icon rubrique-icon--green">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="rubrique-title rubrique-title--green">{{ ucwords(str_replace('-', ' ', $entry->categorie)) }}</div>
                                </div>
                                <div class="rubrique-title" style="font-size:1rem; margin: 10px 0 8px; line-height:1.3;">{{ $entry->titre }}</div>
                                <p class="rubrique-desc">{{ \Illuminate\Support\Str::limit($entry->description, 140) }}</p>
                                <div class="rubrique-desc" style="font-size:.78rem;color:var(--text-light);margin-top:12px;">
                                    Publié le {{ $entry->date_publication ? $entry->date_publication->format('d F Y') : '' }}
                                </div>
                            </div>
                            <div class="rubrique-photo">
                                @if($entry->media)
                                    <img src="{{ asset('storage/' . $entry->media) }}" alt="{{ $entry->titre }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                @else
                                    <div class="rubrique-photo-placeholder"><i class="fas fa-image"></i></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Aucun contenu publié n'est disponible pour le moment. Revenez bientôt pour découvrir les actions Éducation & Excellence.</p>
            @endif
        </div>
    </section>

    {{-- ══════════════════════════════════════════
     ACTUALITÉS ÉDUCATION
══════════════════════════════════════════ --}}
    <section class="bottom-split">
        <div class="edu-container">
            <div class="actu-header">
                <h2>Actualités Éducation</h2>
                <a href="{{ route('actualites') }}#dernieres-actualites" class="see-all-link">Voir toutes
                    &rarr;</a>
            </div>

            @if($educationNews->isNotEmpty())
                <div class="actu-list">
                    @foreach($educationNews as $news)
                        <div class="actu-item">
                            <div class="actu-thumb">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->titre }}"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                @else
                                    <div class="actu-thumb-placeholder"><i class="fas fa-newspaper"></i></div>
                                @endif
                            </div>
                            <div>
                                <div class="actu-date">{{ $news->date_publication ? $news->date_publication->format('d M Y') : '' }}</div>
                                <a href="{{ route('actualites.detail', $news->slug) }}" class="actu-title-text">{{ $news->titre }}</a>
                                <div class="actu-excerpt">{{ \Illuminate\Support\Str::limit($news->resume ?? strip_tags($news->contenu), 120) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Aucune actualité Éducation publiée pour le moment. Revenez bientôt.</p>
            @endif
        </div>
    </section>

@endsection
