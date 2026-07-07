@extends('admin.layouts.app')
@section('title', 'Vie & Coutumes')
@section('page-title', 'Vie & Coutumes')
@section('page-subtitle', 'Gérer le contenu Vie & Coutumes')

@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #1c9920;
            --blue: #1565c0;
            --blue-light: #e3f2fd;
            --purple: #6a1b9a;
            --purple-light: #f3e5f5;
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

        body,
        input,
        select,
        textarea,
        button {
            font-family: 'Nunito', sans-serif;
        }

        /* ── Toolbar ── */
        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .page-toolbar h1 {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text);
            margin: 0;
        }

        .page-toolbar h1 span {
            font-weight: 600;
            color: var(--text-light);
            font-size: .9rem;
        }

        /* ── Boutons ── */
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
        }

        .btn-ghost:hover {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-light);
        }

        /* ── Filtres ── */
        .filters-bar {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .filter-input {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            font-size: .82rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            outline: none;
            background: var(--cream);
        }

        .filter-input:focus {
            border-color: var(--green);
        }

        .filter-input--search {
            flex: 1;
            min-width: 180px;
        }

        /* ── Tableau ── */
        .data-table {
            width: 100%;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border-collapse: collapse;
        }

        .data-table th {
            background: var(--cream);
            padding: 11px 16px;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--text-light);
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .data-table td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            font-size: .85rem;
            color: var(--text-mid);
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: #f8fbf8;
        }

        .type-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: .62rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: white;
        }

        .type--article {
            background: #1b5e20;
        }

        .type--photos {
            background: #1565c0;
        }

        .type--video {
            background: #6a1b9a;
        }

        .cat-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: .62rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: white;
        }

        .cat--traditions {
            background: #1b5e20;
        }

        .cat--ceremonies {
            background: #1565c0;
        }

        .cat--gastronomie {
            background: #e65100;
        }

        .cat--temoignages {
            background: #6a1b9a;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: .7rem;
            font-weight: 800;
        }

        .status--publie {
            background: var(--green-light);
            color: var(--green);
        }

        .status--brouillon {
            background: #eceff1;
            color: #546e7a;
        }

        .status--archive {
            background: #fff3e0;
            color: #e65100;
        }

        .action-btns {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-icon {
            width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-icon--view {
            color: var(--green);
        }

        .btn-icon--view:hover {
            background: var(--green-light);
            border-color: var(--green-soft);
        }

        .btn-icon--edit {
            color: var(--blue);
        }

        .btn-icon--edit:hover {
            background: var(--blue-light);
            border-color: #90caf9;
        }

        .btn-icon--del {
            color: #e53935;
        }

        .btn-icon--del:hover {
            background: #ffebee;
            border-color: #ef9a9a;
        }

        /* ── Pagination ── */
        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 4px 0;
        }

        .pagination-info {
            font-size: .78rem;
            color: var(--text-light);
        }

        .pagination-btns {
            display: flex;
            gap: 6px;
        }

        .pag-btn {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-mid);
            transition: all .2s;
        }

        .pag-btn:hover,
        .pag-btn.active {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }
    </style>
@endpush

@section('content')

    {{-- ── Messages Flash ── --}}
    @if (session('success'))
        <div class="alert alert-success"
            style="background: #e8f5e9; color: #1b5e20; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c8e6c9;">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error"
            style="background: #ffebee; color: #c62828; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ffcdd2;">
            <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- ── Toolbar ── --}}
    <div class="page-toolbar">
        <h1>Tous les contenus <span>({{ $total ?? 0 }})</span></h1>
        <a href="{{ route('admin.vie-coutumes.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Nouveau contenu
        </a>
    </div>

    {{-- ── Filtres ── --}}
    <form action="{{ route('admin.vie-coutumes.index') }}" method="GET" class="filters-bar">
        <input type="text" name="search" class="filter-input filter-input--search"
            placeholder="Rechercher un contenu..." value="{{ request('search') }}">
        <select name="type" class="filter-input">
            <option value="">Tous types</option>
            <option value="article" {{ request('type') == 'article' ? 'selected' : '' }}>Article</option>
            <option value="photos" {{ request('type') == 'photos' ? 'selected' : '' }}>Photos</option>
            <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Vidéo</option>
        </select>
        <select name="categorie" class="filter-input">
            <option value="">Toutes catégories</option>
            <option value="traditions" {{ request('categorie') == 'traditions' ? 'selected' : '' }}>Traditions</option>
            <option value="ceremonies" {{ request('categorie') == 'ceremonies' ? 'selected' : '' }}>Cérémonies</option>
            <option value="gastronomie" {{ request('categorie') == 'gastronomie' ? 'selected' : '' }}>Gastronomie</option>
            <option value="temoignages" {{ request('categorie') == 'temoignages' ? 'selected' : '' }}>Témoignages</option>
        </select>
        <select name="statut" class="filter-input">
            <option value="">Tous statuts</option>
            <option value="publie" {{ request('statut') == 'publie' ? 'selected' : '' }}>Publié</option>
            <option value="brouillon" {{ request('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
            <option value="archive" {{ request('statut') == 'archive' ? 'selected' : '' }}>Archivé</option>
        </select>
        <select name="sort_by" class="filter-input">
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Trier par date</option>
            <option value="titre" {{ request('sort_by') == 'titre' ? 'selected' : '' }}>Trier par titre</option>
            <option value="vues" {{ request('sort_by') == 'vues' ? 'selected' : '' }}>Trier par vues</option>
        </select>
        <button type="submit" class="btn-ghost">
            <i class="fas fa-filter"></i> Filtrer
        </button>
    </form>

    {{-- ── Tableau ── --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Vues</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vieCoutumes as $vieCoutume)
                <tr data-record='@json($vieCoutume->toArray())'>
                    <td>
                        <div style="font-weight:800;color:var(--text);">{{ $vieCoutume->titre }}</div>
                        <div style="font-size:.72rem;color:var(--text-light);">{{ Str::limit($vieCoutume->description, 60) }}</div>
                    </td>
                    <td>
                        <span class="type-badge type--{{ $vieCoutume->type }}">
                            {{ ucfirst($vieCoutume->type) }}
                        </span>
                    </td>
                    <td>
                        @if ($vieCoutume->categorie)
                            <span class="cat-badge cat--{{ $vieCoutume->categorie }}">
                                {{ ucfirst($vieCoutume->categorie) }}
                            </span>
                        @else
                            <span style="color:var(--text-light);font-size:.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status--{{ $vieCoutume->statut }}">
                            <i class="fas fa-circle" style="font-size:.4rem;"></i>
                            @if ($vieCoutume->statut === 'publie')
                                Publié
                            @elseif($vieCoutume->statut === 'brouillon')
                                Brouillon
                            @else
                                Archivé
                            @endif
                        </span>
                    </td>
                    <td>{{ $vieCoutume->auteur ?? 'Admin MUDEA' }}</td>
                    <td style="font-size:.78rem; color:var(--text-light);">
                        {{ $vieCoutume->created_at ? \Carbon\Carbon::parse($vieCoutume->created_at)->format('d/m/Y H:i') : '' }}</td>
                    <td style="font-size:.78rem; font-weight:700;">{{ $vieCoutume->vues ?? 0 }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.vie-coutumes.show', $vieCoutume->id) }}" class="btn-icon btn-icon--view"
                                title="Voir"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.vie-coutumes.edit', $vieCoutume->id) }}" class="btn-icon btn-icon--edit"
                                title="Modifier"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.vie-coutumes.destroy', $vieCoutume->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon--del" title="Supprimer"
                                    onclick="return confirm('Supprimer ce contenu ?')"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:40px; color:var(--text-light);">
                        <i class="fas fa-masks-theater" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Aucun contenu trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Pagination ── --}}
    @if ($vieCoutumes->hasPages())
        <div class="pagination">
            <div class="pagination-info">
                Affichage {{ $vieCoutumes->firstItem() }}–{{ $vieCoutumes->lastItem() }} sur {{ $vieCoutumes->total() }}
                contenus
            </div>
            <div class="pagination-btns">
                @if ($vieCoutumes->onFirstPage())
                    <span class="pag-btn" style="cursor:not-allowed; opacity:0.5;"><i
                            class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $vieCoutumes->previousPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-left"></i></a>
                @endif

                @foreach ($vieCoutumes->getUrlRange(1, $vieCoutumes->lastPage()) as $page => $url)
                    @if ($page == $vieCoutumes->currentPage())
                        <span class="pag-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pag-btn">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($vieCoutumes->hasMorePages())
                    <a href="{{ $vieCoutumes->nextPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="pag-btn" style="cursor:not-allowed; opacity:0.5;"><i
                            class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    @endif

@endsection
