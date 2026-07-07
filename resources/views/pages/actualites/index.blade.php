@extends('layouts.app')

@section('title', 'Actualités - MUDEA')

@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-light: #e8f5e9;
            --text: #1a2e25;
            --text-mid: #455d4f;
            --text-light: #7a9585;
            --border: #e0e8e4;
            --white: #ffffff;
            --cream: #f4f6f8;
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, .07);
            --shadow-md: 0 6px 24px rgba(0, 0, 0, .11);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
        }

        .actualites-hero {
            background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
            padding: 80px 24px;
            text-align: center;
            color: white;
        }

        .actualites-hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .actualites-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 500px;
            margin: 0 auto;
        }

        .actualites-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 60px 24px;
        }

        .actualites-filters {
            display: flex;
            gap: 16px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--cream);
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            border-color: var(--green);
        }

        .filter-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 20px;
            border: 1px solid var(--border);
            background: white;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tag:hover,
        .tag.active {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        .actualites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            margin-bottom: 40px;
        }

        .actualite-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: var(--shadow-sm);
        }

        .actualite-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .actualite-image {
            width: 100%;
            height: 200px;
            background: var(--cream);
            overflow: hidden;
            position: relative;
        }

        .actualite-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .actualite-card:hover .actualite-image img {
            transform: scale(1.05);
        }

        .actualite-epinglee {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #f5a623;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .actualite-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .actualite-category {
            display: inline-block;
            padding: 4px 10px;
            background: var(--green-light);
            color: var(--green);
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 8px;
            width: fit-content;
        }

        .actualite-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 10px;
            line-height: 1.4;
            flex: 1;
        }

        .actualite-title a {
            color: inherit;
            text-decoration: none;
        }

        .actualite-title a:hover {
            color: var(--green);
        }

        .actualite-excerpt {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 12px;
            flex: 1;
        }

        .actualite-meta {
            display: flex;
            gap: 16px;
            font-size: 0.8rem;
            color: var(--text-light);
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-lire-plus {
            display: inline-block;
            margin-top: auto;
            padding: 10px 16px;
            background: var(--green);
            color: white;
            border-radius: var(--radius-sm);
            font-weight: 800;
            font-size: 0.85rem;
            text-decoration: none;
            text-transform: uppercase;
            transition: background 0.3s;
            align-self: flex-start;
        }

        .btn-lire-plus:hover {
            background: #0a3d14;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .pagination .active span {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        @media (max-width: 768px) {
            .actualites-filters {
                flex-direction: column;
            }

            .search-box {
                min-width: auto;
            }

            .actualites-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Hero --}}
    <section class="actualites-hero">
        <h1>Actualités MUDEA</h1>
        <p>Restez informé de nos dernières activités, événements et actualités</p>
    </section>

    {{-- Contenu --}}
    <section class="actualites-container">

        {{-- Filtres --}}
        <div class="actualites-filters">
            <form action="{{ route('actualites') }}" method="GET" class="search-box">
                <input type="text" name="search" placeholder="Rechercher une actualité..." value="{{ $searchQuery }}">
            </form>

            @if ($categories->count() > 0)
                <div class="filter-tags">
                    <a href="{{ route('actualites') }}" class="tag {{ !$selectedCategory ? 'active' : '' }}">
                        Toutes
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('actualites', ['categorie' => $category]) }}"
                            class="tag {{ $selectedCategory === $category ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Grille d'actualités --}}
        @if ($actualites->count() > 0)
            <div class="actualites-grid">
                @foreach ($actualites as $actualite)
                    <div class="actualite-card">
                        {{-- Image --}}
                        <div class="actualite-image">
                            @if ($actualite->image)
                                <img src="{{ asset('storage/' . $actualite->image) }}"
                                    alt="{{ $actualite->titre }}" onerror="this.style.display='none'">
                            @else
                                <div style="width:100%;height:100%;background:var(--cream);display:flex;align-items:center;justify-content:center;color:var(--text-light);font-size:3rem;">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif

                            @if ($actualite->epingle)
                                <div class="actualite-epinglee">
                                    <i class="fas fa-thumbtack"></i> À la une
                                </div>
                            @endif
                        </div>

                        {{-- Contenu --}}
                        <div class="actualite-content">
                            @if ($actualite->categorie)
                                <span class="actualite-category">{{ $actualite->categorie }}</span>
                            @endif

                            <h3 class="actualite-title">
                                <a href="{{ route('actualites.detail', $actualite->slug) }}">
                                    {{ $actualite->titre }}
                                </a>
                            </h3>

                            <p class="actualite-excerpt">
                                {{ Illuminate\Support\Str::limit($actualite->resume ?? $actualite->contenu, 100) }}
                            </p>

                            <div class="actualite-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt" style="color:var(--green);"></i>
                                    {{ $actualite->date_publication?->format('d M Y') ?? $actualite->created_at->format('d M Y') }}
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-eye" style="color:var(--green);"></i>
                                    {{ $actualite->vues ?? 0 }} vue{{ ($actualite->vues ?? 0) > 1 ? 's' : '' }}
                                </div>
                            </div>

                            <a href="{{ route('actualites.detail', $actualite->slug) }}" class="btn-lire-plus">
                                Lire plus
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($actualites->hasPages())
                <div class="pagination">
                    @foreach ($actualites->links()->elements[0] as $page => $url)
                        @if ($page == 'PREV')
                            <a href="{{ $url }}" rel="prev">« Précédent</a>
                        @elseif ($page == 'NEXT')
                            <a href="{{ $url }}" rel="next">Suivant »</a>
                        @elseif ($page === $actualites->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Aucune actualité trouvée</h3>
                <p>Revenez bientôt pour découvrir nos dernières actualités.</p>
            </div>
        @endif

    </section>

@endsection
