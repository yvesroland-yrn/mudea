@extends('admin.layouts.app')
@section('title', 'Voir Actualité')
@section('page-title', 'Voir Actualité')
@section('page-subtitle', 'Détails de l\'actualité')

@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
            --blue: #1565c0;
            --blue-light: #e3f2fd;
            --white: #ffffff;
            --cream: #f4f6f8;
            --border: #e0e8e4;
            --text: #1a2e25;
            --text-mid: #455d4f;
            --text-light: #7a9585;
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, .07);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
        }

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: #fff;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: var(--green-dark);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--text-mid);
            padding: 9px 16px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all .18s;
            text-decoration: none;
        }

        .btn-ghost:hover {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-light);
        }

        .show-container {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            max-width: 900px;
            margin: 0 auto;
        }

        .show-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
        }

        .show-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
        }

        .show-meta {
            display: flex;
            gap: 16px;
            font-size: .85rem;
            color: var(--text-light);
        }

        .show-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .show-body {
            padding: 24px;
        }

        .show-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
        }

        .show-section {
            margin-bottom: 24px;
        }

        .show-section-title {
            font-size: .75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-light);
            margin-bottom: 12px;
        }

        .show-content {
            font-size: .95rem;
            line-height: 1.7;
            color: var(--text-mid);
        }

        .show-content p {
            margin-bottom: 16px;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: .7rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .badge--publie {
            background: var(--green-light);
            color: var(--green);
        }

        .badge--brouillon {
            background: #eceff1;
            color: #546e7a;
        }

        .badge--archive {
            background: #fff3e0;
            color: #e65100;
        }

        .tag {
            display: inline-block;
            padding: 4px 10px;
            background: var(--green-soft);
            color: var(--green);
            border-radius: var(--radius-sm);
            font-size: .75rem;
            font-weight: 700;
            margin-right: 6px;
            margin-bottom: 6px;
        }

        .show-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text);
        }

        .stat-label {
            font-size: .7rem;
            color: var(--text-light);
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    {{-- ── Toolbar ── --}}
    <div class="page-toolbar">
        <div></div>
        <a href="{{ route('admin.actualites.index') }}" class="btn-ghost">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    {{-- ── Show Container ── --}}
    <div class="show-container">
        <div class="show-header">
            <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:16px;">
                <h1 class="show-title">{{ $actualite->titre }}</h1>
                <span class="badge badge--{{ $actualite->statut }}">
                    @if ($actualite->statut === 'publie') Publié
                    @elseif($actualite->statut === 'brouillon') Brouillon
                    @else Archivé
                    @endif
                </span>
            </div>
            <div class="show-meta">
                <div class="show-meta-item">
                    <i class="fas fa-user"></i>
                    <span>{{ $actualite->auteur ?? 'Admin MUDEA' }}</span>
                </div>
                <div class="show-meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $actualite->created_at ? $actualite->created_at->format('d M Y à H:i') : '' }}</span>
                </div>
                <div class="show-meta-item">
                    <i class="fas fa-folder"></i>
                    <span>{{ ucfirst($actualite->categorie) }}</span>
                </div>
            </div>
        </div>

        <div class="show-body">
            @if ($actualite->image)
                <img src="{{ asset('storage/' . $actualite->image) }}" alt="{{ $actualite->titre }}" class="show-image">
            @endif

            <div class="show-section">
                <div class="show-section-title">Résumé</div>
                <div class="show-content">{{ $actualite->resume }}</div>
            </div>

            <div class="show-section">
                <div class="show-section-title">Contenu</div>
                <div class="show-content">{!! $actualite->contenu !!}</div>
            </div>

            @if ($actualite->tags && is_array($actualite->tags) && count($actualite->tags) > 0)
                <div class="show-section">
                    <div class="show-section-title">Mots-clés</div>
                    <div>
                        @foreach ($actualite->tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="show-section">
                <div class="show-section-title">Options</div>
                <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:12px; font-size:.85rem; color:var(--text-mid);">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-thumbtack" style="color:{{ $actualite->epingle ? 'var(--green)' : 'var(--text-light)' }};"></i>
                        Épinglé : {{ $actualite->epingle ? 'Oui' : 'Non' }}
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-comments" style="color:{{ $actualite->commentaires ? 'var(--green)' : 'var(--text-light)' }};"></i>
                        Commentaires : {{ $actualite->commentaires ? 'Oui' : 'Non' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="show-footer">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ $actualite->vues ?? 0 }}</div>
                    <div class="stat-label">Vues</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $actualite->created_at ? $actualite->created_at->diffForHumans() : '' }}</div>
                    <div class="stat-label">Créé il y a</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $actualite->updated_at ? $actualite->updated_at->diffForHumans() : '' }}</div>
                    <div class="stat-label">Modifié il y a</div>
                </div>
            </div>
            <div style="display:flex; gap:10px;">
                <a href="{{ route('admin.actualites.edit', $actualite->id) }}" class="btn-ghost">
                    <i class="fas fa-pen"></i> Modifier
                </a>
                <form action="{{ route('admin.actualites.destroy', $actualite->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-ghost" style="color:#e53935; border-color:#e53935;" onclick="return confirm('Supprimer cette actualité ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
