@extends('admin.layouts.app')
@section('title', 'Voir Contenu')
@section('page-title', 'Voir Contenu')
@section('page-subtitle', 'Détails du contenu Vie & Coutumes')

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
            text-decoration: none;
        }

        .btn-ghost:hover {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-light);
        }

        /* ── Detail Card ── */
        .detail-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            max-width: 900px;
            margin: 0 auto;
        }

        .detail-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
        }

        .detail-header h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text);
            margin: 0 0 8px 0;
        }

        .detail-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: .78rem;
            color: var(--text-light);
        }

        .detail-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-body {
            padding: 24px;
        }

        .detail-section {
            margin-bottom: 24px;
        }

        .detail-section-title {
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

        .detail-section-title i {
            font-size: .85rem;
        }

        .detail-section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .detail-content {
            font-size: .9rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        .detail-media {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }

        .type-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: .7rem;
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
            padding: 4px 12px;
            border-radius: 999px;
            font-size: .7rem;
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

        .detail-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>
@endpush

@section('content')
    {{-- ── Toolbar ── --}}
    <div class="page-toolbar">
        <div></div>
        <a href="{{ route('admin.vie-coutumes.index') }}" class="btn-ghost">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    {{-- ── Detail Card ── --}}
    <div class="detail-card">
        <div class="detail-header">
            <h1>{{ $vieCoutume->titre }}</h1>
            <div class="detail-meta">
                <div class="detail-meta-item">
                    <i class="fas fa-tag"></i>
                    <span class="type-badge type--{{ $vieCoutume->type }}">{{ ucfirst($vieCoutume->type) }}</span>
                </div>
                @if ($vieCoutume->categorie)
                    <div class="detail-meta-item">
                        <i class="fas fa-folder"></i>
                        <span class="cat-badge cat--{{ $vieCoutume->categorie }}">{{ ucfirst($vieCoutume->categorie) }}</span>
                    </div>
                @endif
                <div class="detail-meta-item">
                    <i class="fas fa-circle" style="font-size:.4rem;"></i>
                    <span class="status-badge status--{{ $vieCoutume->statut }}">
                        @if ($vieCoutume->statut === 'publie')
                            Publié
                        @elseif($vieCoutume->statut === 'brouillon')
                            Brouillon
                        @else
                            Archivé
                        @endif
                    </span>
                </div>
                <div class="detail-meta-item">
                    <i class="fas fa-user"></i>
                    <span>{{ $vieCoutume->auteur ?? 'Admin MUDEA' }}</span>
                </div>
                <div class="detail-meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $vieCoutume->created_at ? \Carbon\Carbon::parse($vieCoutume->created_at)->format('d/m/Y H:i') : '' }}</span>
                </div>
                <div class="detail-meta-item">
                    <i class="fas fa-eye"></i>
                    <span>{{ $vieCoutume->vues ?? 0 }} vues</span>
                </div>
            </div>
        </div>

        <div class="detail-body">
            {{-- Description --}}
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fas fa-align-left"></i> Description
                </div>
                <div class="detail-content">
                    {{ $vieCoutume->description }}
                </div>
            </div>

            {{-- Média --}}
            @if ($vieCoutume->media)
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="fas fa-image"></i> Média
                    </div>
                    @if ($vieCoutume->type === 'video')
                        <video src="{{ asset($vieCoutume->media) }}" class="detail-media" controls></video>
                    @else
                        <img src="{{ asset($vieCoutume->media) }}" class="detail-media" alt="{{ $vieCoutume->titre }}">
                    @endif
                </div>
            @endif

            {{-- Contenu --}}
            @if ($vieCoutume->contenu)
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="fas fa-file-alt"></i> Contenu
                    </div>
                    <div class="detail-content">
                        {!! $vieCoutume->contenu !!}
                    </div>
                </div>
            @endif

            {{-- Informations supplémentaires --}}
            <div class="detail-section">
                <div class="detail-section-title">
                    <i class="fas fa-info-circle"></i> Informations supplémentaires
                </div>
                <div class="detail-content">
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                        <div>
                            <strong style="color: var(--text);">Slug URL :</strong>
                            <span style="color: var(--text-light);">{{ $vieCoutume->slug }}</span>
                        </div>
                        <div>
                            <strong style="color: var(--text);">Épinglé :</strong>
                            <span style="color: var(--text-light);">{{ $vieCoutume->epingle ? 'Oui' : 'Non' }}</span>
                        </div>
                        @if ($vieCoutume->date_publication)
                            <div>
                                <strong style="color: var(--text);">Date de publication :</strong>
                                <span style="color: var(--text-light);">{{ \Carbon\Carbon::parse($vieCoutume->date_publication)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-footer">
            <a href="{{ route('admin.vie-coutumes.edit', $vieCoutume->id) }}" class="btn-primary">
                <i class="fas fa-pen"></i> Modifier
            </a>
        </div>
    </div>
@endsection
