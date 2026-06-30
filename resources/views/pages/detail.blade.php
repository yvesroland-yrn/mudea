@extends('layouts.app')

@section('title', $item['title'] . ' - MUDEA')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
<style>
    :root {
        --green: #1b5e20;
        --green-dark: #0a3d14;
        --gold: #f5a623;
        --cream: #f6f8f6;
        --white: #ffffff;
        --text: #1a2e25;
        --muted: #516458;
        --border: #dde6df;
        --shadow: 0 20px 60px rgba(0,0,0,.12);
    }

    * { box-sizing: border-box; }
    body { font-family: 'Nunito', sans-serif; background: var(--cream); color: var(--text); }
    a { color: inherit; text-decoration: none; }

    .detail-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px 20px 72px;
    }

    .detail-hero {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .detail-image {
        position: relative;
        min-height: min(74vh, 760px);
        background: #dfe9e0;
    }

    .detail-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .detail-image::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(7,31,11,.45) 0%, transparent 42%);
        pointer-events: none;
    }

    .detail-badge {
        position: absolute;
        top: 22px;
        left: 22px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.92);
        color: var(--green-dark);
        padding: 10px 14px;
        border-radius: 999px;
        font-size: .78rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .detail-content {
        padding: 30px 28px 34px;
    }

    .detail-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        line-height: 1.05;
        color: var(--green-dark);
        margin-bottom: 10px;
    }

    .detail-subtitle {
        color: var(--gold);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        font-size: .82rem;
        margin-bottom: 18px;
    }

    .detail-lead {
        font-size: 1.08rem;
        line-height: 1.8;
        color: var(--text);
        max-width: 900px;
        margin-bottom: 18px;
    }

    .detail-body {
        max-width: 900px;
        color: var(--muted);
        font-size: .98rem;
        line-height: 1.9;
    }

    .detail-body p + p { margin-top: 14px; }

    .detail-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .detail-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        font-size: .8rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .05em;
        transition: transform .2s, opacity .2s;
    }
    .detail-btn:hover { transform: translateY(-2px); }
    .detail-btn--primary { background: var(--green); color: #fff; }
    .detail-btn--secondary { background: #eef4ef; color: var(--green-dark); border: 1px solid var(--border); }

    @media (max-width: 768px) {
        .detail-page { padding-inline: 12px; }
        .detail-image { min-height: 340px; }
        .detail-content { padding: 22px 18px 24px; }
    }
</style>
@endpush

@section('content')
<main class="detail-page">
    <article class="detail-hero">
        <div class="detail-image">
            <span class="detail-badge">{{ ucfirst($section) }}</span>
            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
        </div>
        <div class="detail-content">
            <h1 class="detail-title">{{ $item['title'] }}</h1>
            <div class="detail-subtitle">{{ $item['subtitle'] }}</div>
            <p class="detail-lead">{{ $item['lead'] }}</p>
            <div class="detail-body">
                @foreach($item['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="detail-actions">
                @if($section === 'chefferie')
                    <a href="{{ route('chefferie') }}" class="detail-btn detail-btn--primary">Retour à Vie & Coutumes</a>
                @elseif($section === 'education')
                    <a href="{{ route('education') }}" class="detail-btn detail-btn--primary">Retour à Éducation</a>
                @elseif($section === 'projets')
                    <a href="{{ route('projets') }}" class="detail-btn detail-btn--primary">Retour aux projets</a>
                @else
                    <a href="{{ route('actualites') }}" class="detail-btn detail-btn--primary">Retour aux actualités</a>
                @endif
                <a href="{{ route('contact') }}#formulaire-contact" class="detail-btn detail-btn--secondary">Nous contacter</a>
            </div>
        </div>
    </article>
</main>
@endsection
