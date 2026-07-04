@extends('layouts.app')

@section('title', $actualite->titre . ' - Actualités - MUDEA')

@push('styles')
    <style>
        :root {
            --vert: #2d6a2d;
            --vert-fonce: #1a4a1a;
            --gris-fond: #f5f5f5;
            --gris-bord: #e0e0e0;
            --texte: #1a1a1a;
            --texte-sec: #555;
            --blanc: #ffffff;
        }

        .article-hero {
            background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
            padding: 60px 24px;
            color: white;
        }

        .article-hero h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .article-meta {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .article-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 60px 24px;
        }

        .article-image {
            width: 100%;
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 40px;
            background: var(--gris-fond);
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-badge {
            display: inline-block;
            background: var(--vert);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .article-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--texte);
        }

        .article-content p {
            margin-bottom: 20px;
        }

        .article-content h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 30px 0 16px;
            color: var(--texte);
        }

        .article-content h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 24px 0 12px;
            color: var(--texte);
        }

        .article-content ul {
            list-style: disc;
            padding-left: 24px;
            margin-bottom: 20px;
        }

        .article-content li {
            margin-bottom: 8px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--vert);
            text-decoration: none;
            font-weight: 700;
            margin-bottom: 32px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--vert-fonce);
        }

        .related-articles {
            margin-top: 60px;
            padding-top: 60px;
            border-top: 2px solid var(--gris-bord);
        }

        .related-articles h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--texte);
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .related-card {
            background: white;
            border: 1px solid var(--gris-bord);
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .related-card:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .related-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .related-card-body {
            padding: 16px;
        }

        .related-card-title {
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 8px;
            color: var(--texte);
        }

        .related-card a {
            color: inherit;
            text-decoration: none;
        }

        .related-card a:hover .related-card-title {
            color: var(--vert);
        }

        .related-card-meta {
            font-size: 0.8rem;
            color: var(--texte-sec);
        }

        @media (max-width: 768px) {
            .article-image {
                height: 250px;
            }

            .article-content {
                font-size: 1rem;
            }

            .article-content h2 {
                font-size: 1.4rem;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Hero Banner --}}
    <section class="article-hero">
        <div style="max-width: 900px; margin: 0 auto;">
            @if($actualite->categorie)
                <span class="article-badge">{{ $actualite->categorie }}</span>
            @endif
            <h1>{{ $actualite->titre }}</h1>
            <div class="article-meta">
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ $actualite->date_publication ? $actualite->date_publication->format('d M Y') : $actualite->created_at->format('d M Y') }}
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M5.2 20c.4-3.4 3.4-6 6.8-6s6.4 2.6 6.8 6"/>
                    </svg>
                    {{ $actualite->user?->name ?? ($actualite->auteur ?? 'Admin MUDEA') }}
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $actualite->vues ?? 0 }} vue{{ ($actualite->vues ?? 0) > 1 ? 's' : '' }}
                </div>
            </div>
        </div>
    </section>

    {{-- Article Content --}}
    <div class="article-container">
        <a href="{{ route('actualites') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Retour aux actualités
        </a>

        {{-- Featured Image --}}
        @if($actualite->image)
            <div class="article-image">
                <img src="{{ asset('storage/' . $actualite->image) }}" alt="{{ $actualite->titre }}"
                    onerror="this.style.display='none'">
            </div>
        @endif

        {{-- Article Content --}}
        <div class="article-content">
            {{-- Tags --}}
            @if(!empty($actualite->tags) && is_array($actualite->tags) && count($actualite->tags) > 0)
                <div style="margin-bottom:18px; display:flex; gap:8px; flex-wrap:wrap;">
                    @foreach($actualite->tags as $tag)
                        <span style="background:#eef7ee;color:var(--vert-fonce);padding:6px 10px;border-radius:14px;font-weight:700;font-size:0.85rem;">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
            @if($actualite->resume)
                <p style="font-size: 1.2rem; font-weight: 600; color: var(--vert); margin-bottom: 24px;">
                    {{ $actualite->resume }}
                </p>
            @endif

            {!! nl2br(e($actualite->contenu)) !!}
        </div>

        {{-- Related Articles --}}
        @if($connexes->count() > 0)
            <div class="related-articles">
                <h2>Actualités connexes</h2>
                <div class="related-grid">
                    @foreach($connexes as $article)
                        <div class="related-card">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}"
                                    onerror="this.src='{{ asset('images/actualites/reunion.png') }}'">
                            @else
                                <div style="width:100%;height:150px;background:var(--gris-fond);display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-newspaper" style="font-size:2rem;color:#ccc;"></i>
                                </div>
                            @endif
                            <div class="related-card-body">
                                <a href="{{ route('actualites.detail', $article->slug) }}">
                                    <h3 class="related-card-title">{{ $article->titre }}</h3>
                                </a>
                                <div class="related-card-meta">
                                    {{ $article->date_publication ? $article->date_publication->format('d M Y') : $article->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

@endsection
