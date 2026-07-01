@extends('admin.layouts.app')
@section('title', 'Actualités')
@section('page-title', 'Actualités')
@section('page-subtitle', 'Gérer les actualités du site')  

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

        .btn-draft {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #eceff1;
            color: #546e7a;
            padding: 9px 16px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            border: 1px solid #cfd8dc;
            cursor: pointer;
            transition: all .18s;
        }

        .btn-draft:hover {
            background: #cfd8dc;
            color: #455a64;
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

        .article-thumb {
            width: 52px;
            height: 38px;
            border-radius: 6px;
            overflow: hidden;
            background: var(--green-light);
            flex-shrink: 0;
        }

        .article-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .article-thumb-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: .8rem;
        }

        .article-title-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .article-title {
            font-weight: 800;
            color: var(--text);
            font-size: .85rem;
            line-height: 1.3;
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

        .cat--projets {
            background: #1b5e20;
        }

        .cat--education {
            background: #1565c0;
        }

        .cat--communaute {
            background: #2e7d32;
        }

        .cat--culture {
            background: #6a1b9a;
        }

        .cat--sante {
            background: #c62828;
        }

        .cat--actualite {
            background: #e65100;
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

        /* ══════════════════════════════════════════
                                   MODAL
                                ══════════════════════════════════════════ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10, 20, 14, .52);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            padding: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .22s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: var(--white);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 700px;
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .2);
            transform: translateY(20px) scale(.98);
            opacity: 0;
            transition: transform .25s cubic-bezier(.22, 1, .36, 1), opacity .22s;
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        /* ── Header modal ── */
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px 16px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            background: var(--white);
            z-index: 2;
        }

        .modal-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .modal-title {
            font-size: .95rem;
            font-weight: 800;
            color: var(--text);
            margin: 0;
        }

        .modal-subtitle {
            font-size: .75rem;
            color: var(--text-light);
            margin: 2px 0 0;
        }

        .btn-close {
            width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-mid);
            font-size: .9rem;
            transition: all .18s;
            flex-shrink: 0;
        }

        .btn-close:hover {
            background: #ffebee;
            color: #e53935;
            border-color: #ef9a9a;
        }

        /* ── Corps modal ── */
        .modal-body {
            padding: 20px 22px;
        }

        .tab-bar {
            display: flex;
            gap: 2px;
            background: var(--cream);
            border-radius: var(--radius-sm);
            padding: 3px;
            margin-bottom: 20px;
        }

        .tab {
            flex: 1;
            padding: 8px;
            text-align: center;
            font-size: .75rem;
            font-weight: 800;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            background: transparent;
            color: var(--text-light);
            font-family: 'Nunito', sans-serif;
            transition: all .18s;
        }

        .tab.active {
            background: var(--white);
            color: var(--green);
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
        }

        .form-section {
            margin-bottom: 22px;
        }

        .form-section-title {
            font-size: .7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-light);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .form-section-title i {
            font-size: .85rem;
        }

        .form-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .field label {
            font-size: .72rem;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .07em;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .field label .req {
            color: #c62828;
            font-size: .8rem;
        }

        .field input,
        .field select,
        .field textarea {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 9px 12px;
            font-size: .84rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            background: var(--cream);
            outline: none;
            transition: border-color .18s, background .18s;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(27, 94, 32, .08);
        }

        .field textarea {
            resize: vertical;
            min-height: 88px;
            line-height: 1.5;
        }

        .field-hint {
            font-size: .71rem;
            color: var(--text-light);
        }

        .char-count {
            font-size: .7rem;
            color: var(--text-light);
            text-align: right;
        }

        /* ── Upload ── */
        .upload-zone {
            border: 1.5px dashed var(--green-soft);
            border-radius: var(--radius-sm);
            background: var(--green-light);
            padding: 22px 16px;
            text-align: center;
            cursor: pointer;
            display: block;
            transition: all .18s;
        }

        .upload-zone:hover {
            border-color: var(--green);
            background: #dcedc8;
        }

        .upload-zone i {
            font-size: 1.5rem;
            color: var(--green);
            display: block;
            margin-bottom: 6px;
        }

        .upload-zone .uz-title {
            font-size: .82rem;
            font-weight: 800;
            color: var(--green);
        }

        .upload-zone .uz-sub {
            font-size: .71rem;
            color: var(--text-light);
            margin-top: 3px;
        }

        .upload-zone input[type=file] {
            display: none;
        }

        .preview-img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            display: none;
            margin-top: 8px;
            border: 1px solid var(--border);
        }

        /* ── Tags ── */
        .tags-wrap {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 7px 10px;
            background: var(--cream);
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            min-height: 40px;
            align-items: center;
            cursor: text;
            transition: all .18s;
        }

        .tags-wrap:focus-within {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(27, 94, 32, .08);
        }

        .tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--green-soft);
            color: #1b5e20;
            padding: 2px 8px 2px 10px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 800;
        }

        .tag-pill button {
            background: none;
            border: none;
            cursor: pointer;
            color: #1b5e20;
            padding: 0;
            line-height: 1;
            font-size: .82rem;
            opacity: .7;
        }

        .tag-pill button:hover {
            opacity: 1;
        }

        .tags-wrap input {
            border: none;
            background: none;
            outline: none;
            font-size: .82rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            flex: 1;
            min-width: 80px;
        }

        /* ── Toggles ── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .toggle-row:last-child {
            border-bottom: none;
        }

        .toggle-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .83rem;
            font-weight: 700;
            color: var(--text-mid);
        }

        .toggle-label i {
            color: var(--text-light);
            font-size: .9rem;
        }

        .toggle {
            position: relative;
            width: 38px;
            height: 22px;
            flex-shrink: 0;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .tslider {
            position: absolute;
            inset: 0;
            background: #c8d5c4;
            border-radius: 999px;
            cursor: pointer;
            transition: background .2s;
        }

        .tslider::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 3px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            transition: transform .2s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .2);
        }

        .toggle input:checked+.tslider {
            background: var(--green);
        }

        .toggle input:checked+.tslider::after {
            transform: translateX(16px);
        }

        /* ── Footer modal ── */
        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 14px 22px 18px;
            border-top: 1px solid var(--border);
            background: var(--cream);
            position: sticky;
            bottom: 0;
            z-index: 2;
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
        <h1>Toutes les actualités <span>({{ $total ?? 0 }})</span></h1>
        <a href="{{ route('admin.actualites.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Nouvelle actualité
        </a>
    </div>

    {{-- ── Filtres ── --}}
    <form action="{{ route('admin.actualites.index') }}" method="GET" class="filters-bar">
        <input type="text" name="search" class="filter-input filter-input--search"
            placeholder="Rechercher une actualité..." value="{{ request('search') }}">
        <select name="categorie" class="filter-input">
            <option value="">Toutes catégories</option>
            <option value="projets" {{ request('categorie') == 'projets' ? 'selected' : '' }}>Projets</option>
            <option value="education" {{ request('categorie') == 'education' ? 'selected' : '' }}>Éducation</option>
            <option value="communaute" {{ request('categorie') == 'communaute' ? 'selected' : '' }}>Communauté</option>
            <option value="culture" {{ request('categorie') == 'culture' ? 'selected' : '' }}>Culture</option>
            <option value="sante" {{ request('categorie') == 'sante' ? 'selected' : '' }}>Santé</option>
            <option value="actualite" {{ request('categorie') == 'actualite' ? 'selected' : '' }}>Actualité</option>
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
                <th style="width:40px;"><input type="checkbox"></th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Vues</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($actualites as $actualite)
                <tr data-record='@json($actualite->toArray())'>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="article-title-cell">
                            <div class="article-thumb">
                                @if ($actualite->image)
                                    <img src="{{ asset('storage/' . $actualite->image) }}" alt=""
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                @endif
                                <div class="article-thumb-placeholder"
                                    @if ($actualite->image) style="display:none;" @endif>
                                    <i class="fas fa-image"></i>
                                </div>
                            </div>
                            <div class="article-title">{{ $actualite->titre }}</div>
                        </div>
                    </td>
                    <td><span
                            class="cat-badge cat--{{ $actualite->categorie }}">{{ ucfirst($actualite->categorie) }}</span>
                    </td>
                    <td>
                        <span class="status-badge status--{{ $actualite->statut }}">
                            <i class="fas fa-circle" style="font-size:.4rem;"></i>
                            @if ($actualite->statut === 'publie')
                                Publié
                            @elseif($actualite->statut === 'brouillon')
                                Brouillon
                            @else
                                Archivé
                            @endif
                        </span>
                    </td>
                    <td>{{ $actualite->auteur ?? 'Admin MUDEA' }}</td>
                    <td style="font-size:.78rem; color:var(--text-light);">
                        {{ $actualite->created_at ? \Carbon\Carbon::parse($actualite->created_at)->format('d/m/Y H:i') : '' }}</td>
                    <td style="font-size:.78rem; font-weight:700;">{{ $actualite->vues ?? 0 }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.actualites.show', $actualite->id) }}" class="btn-icon btn-icon--view"
                                title="Voir"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.actualites.edit', $actualite->id) }}" class="btn-icon btn-icon--edit"
                                title="Modifier"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('admin.actualites.destroy', $actualite->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon--del" title="Supprimer"
                                    onclick="return confirm('Supprimer cette actualité ?')"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:40px; color:var(--text-light);">
                        <i class="fas fa-newspaper" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Aucune actualité trouvée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Pagination ── --}}
    @if ($actualites->hasPages())
        <div class="pagination">
            <div class="pagination-info">
                Affichage {{ $actualites->firstItem() }}–{{ $actualites->lastItem() }} sur {{ $actualites->total() }}
                actualités
            </div>
            <div class="pagination-btns">
                @if ($actualites->onFirstPage())
                    <span class="pag-btn" style="cursor:not-allowed; opacity:0.5;"><i
                            class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $actualites->previousPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-left"></i></a>
                @endif

                @foreach ($actualites->getUrlRange(1, $actualites->lastPage()) as $page => $url)
                    @if ($page == $actualites->currentPage())
                        <span class="pag-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pag-btn">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($actualites->hasMorePages())
                    <a href="{{ $actualites->nextPageUrl() }}" class="pag-btn"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="pag-btn" style="cursor:not-allowed; opacity:0.5;"><i
                            class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    @endif

@endsection
