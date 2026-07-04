@extends('admin.layouts.app')
@section('title', 'Messages')
@section('page-title', 'Messages')
@section('page-subtitle', 'Gérer les messages reçus')
@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
            --gold: #f5a623;
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

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text-mid);
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .filter-tab:hover {
            background: var(--cream);
        }

        .filter-tab.active {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .filter-tab .count {
            background: rgba(255, 255, 255, .3);
            padding: 2px 6px;
            border-radius: 999px;
            margin-left: 4px;
        }

        .msg-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 0;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            min-height: 600px;
        }

        .msg-sidebar {
            border-right: 1px solid var(--border);
            overflow-y: auto;
        }

        .msg-sidebar-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .msg-pagination {
            padding: 12px 16px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
            background: var(--cream);
        }

        .msg-pagination a,
        .msg-pagination span {
            padding: 6px 10px;
            border-radius: var(--radius-sm);
            font-size: .75rem;
            font-weight: 700;
            color: var(--text-mid);
            text-decoration: none;
            border: 1px solid var(--border);
            background: white;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            text-align: center;
        }

        .msg-pagination a:hover {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .msg-pagination .active span {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .msg-pagination .disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .msg-pagination .disabled:hover {
            background: white;
            color: var(--text-mid);
            border-color: var(--border);
        }

        .msg-search {
            flex: 1;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 7px 10px;
            font-size: .8rem;
            font-family: 'Nunito', sans-serif;
            outline: none;
            background: var(--cream);
        }

        .msg-item {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: background .18s;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-decoration: none;
            color: inherit;
        }

        .msg-item:hover {
            background: #f8fbf8;
        }

        .msg-item.active {
            background: var(--green-light);
        }

        .msg-item.unread .msg-name {
            font-weight: 900;
        }

        .msg-item.unread .msg-preview {
            font-weight: 700;
            color: var(--text);
        }

        .msg-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--green-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-weight: 800;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .msg-name {
            font-size: .83rem;
            font-weight: 700;
            color: var(--text);
        }

        .msg-preview {
            font-size: .75rem;
            color: var(--text-light);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .msg-time {
            font-size: .68rem;
            color: var(--text-light);
            margin-left: auto;
            white-space: nowrap;
        }

        .unread-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e53935;
            flex-shrink: 0;
            margin-top: 6px;
        }

        .msg-main {
            padding: 28px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .msg-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding: 16px;
            background: var(--cream);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
        }

        .msg-actions label {
            font-size: .78rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 8px;
            display: block;
            width: 100%;
        }

        .msg-main-header {
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .msg-main-subject {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
        }

        .msg-main-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .msg-meta-item {
            font-size: .78rem;
            color: var(--text-mid);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .msg-meta-item i {
            color: var(--green);
        }

        .msg-body-text {
            font-size: .9rem;
            color: var(--text-mid);
            line-height: 1.85;
            flex: 1;
        }

        .reply-box {
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }

        .reply-box label {
            font-size: .78rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 8px;
            display: block;
        }

        .reply-textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 12px;
            font-size: .85rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            resize: vertical;
            min-height: 100px;
            outline: none;
            background: var(--cream);
        }

        .reply-textarea:focus {
            border-color: var(--green);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: var(--green-dark);
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

        .status--non-lu {
            background: #ffebee;
            color: #e53935;
        }

        .status--lu {
            background: var(--green-light);
            color: var(--green);
        }

        .status--repondu {
            background: var(--blue-light);
            color: var(--blue);
        }

        @media(max-width:1100px) {
            .msg-layout {
                grid-template-columns: 1fr;
            }

            .msg-sidebar {
                border-right: none;
                border-bottom: 1px solid var(--border);
                max-height: 280px;
            }
        }

        @media(max-width:768px) {
            .page-toolbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .msg-main {
                padding: 20px 18px;
            }

            .msg-main-meta {
                gap: 10px;
            }

            .msg-item {
                padding: 12px 14px;
            }
        }

        @media(max-width:520px) {
            .msg-main-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .reply-box .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush
@section('content')
    @php
        $unreadCount = $unreadCount ?? 0;
        $currentStatut = request('statut', 'all');
    @endphp
    <div class="page-toolbar">
        <h1>Messages <span
                style="background:#e53935;color:white;padding:2px 8px;border-radius:999px;font-size:.75rem;margin-left:8px;">{{ $unreadCount }}
                non lus</span></h1>
        <div class="filter-tabs">
            <a href="{{ route('admin.messages') }}" class="filter-tab {{ $currentStatut === 'all' ? 'active' : '' }}">
                Tous <span class="count">{{ $messages->count() }}</span>
            </a>
            <a href="{{ route('admin.messages', ['statut' => 'nouveau']) }}"
                class="filter-tab {{ $currentStatut === 'nouveau' ? 'active' : '' }}">
                Non lus <span class="count">{{ \App\Models\Message::where('statut', 'nouveau')->count() }}</span>
            </a>
            <a href="{{ route('admin.messages', ['statut' => 'lu']) }}"
                class="filter-tab {{ $currentStatut === 'lu' ? 'active' : '' }}">
                lus <span class="count">{{ \App\Models\Message::where('statut', 'lu')->count() }}</span>
            </a>
            <a href="{{ route('admin.messages', ['statut' => 'traite']) }}"
                class="filter-tab {{ $currentStatut === 'traite' ? 'active' : '' }}">
                Traités <span class="count">{{ \App\Models\Message::where('statut', 'traite')->count() }}</span>
            </a>
            <a href="{{ route('admin.messages', ['statut' => 'archive']) }}"
                class="filter-tab {{ $currentStatut === 'archive' ? 'active' : '' }}">
                Archivés <span class="count">{{ \App\Models\Message::where('statut', 'archive')->count() }}</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div
            style="margin-bottom:16px;padding:12px 14px;border-radius:10px;background:#e8f5e9;color:#1b5e20;border:1px solid #a5d6a7;font-weight:700;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            style="margin-bottom:16px;padding:12px 14px;border-radius:10px;background:#ffebee;color:#c62828;border:1px solid #ef9a9a;font-weight:700;">
            {{ session('error') }}
        </div>
    @endif

    <div class="msg-layout">
        <div class="msg-sidebar">
            <div class="msg-sidebar-header">
                <form action="{{ route('admin.messages') }}" method="GET" style="display:flex;gap:8px;flex:1;">
                    <input class="msg-search" type="text" name="search" placeholder="Rechercher..."
                        value="{{ request('search') }}">
                </form>
            </div>

            @forelse($messages as $message)
                <a href="{{ route('admin.messages.show', $message) }}"
                    class="msg-item {{ $message->statut === 'nouveau' ? 'unread' : '' }} {{ $selectedMessage && $selectedMessage->id === $message->id ? 'active' : '' }}">
                    <div class="msg-avatar">
                        {{ strtoupper(substr($message->prenom ?? 'U', 0, 1) . substr($message->nom ?? 'U', 0, 1)) }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;justify-content:space-between;gap:8px;">
                            <div class="msg-name">
                                {{ trim(($message->prenom ?? '') . ' ' . ($message->nom ?? '')) ?: 'Utilisateur' }}
                            </div>
                        </div>
                        <div class="msg-preview">{{ \Illuminate\Support\Str::limit($message->message, 70) }}</div>
                    </div>
                    @if ($message->statut === 'nouveau')
                        <div class="unread-dot"></div>
                    @endif
                </a>
            @empty
                <div style="padding:20px 16px;color:var(--text-light);font-size:.85rem;">Aucun message pour le moment.</div>
            @endforelse

            @if ($messages->hasPages())
                <div class="msg-pagination">
                    {{-- Lien précédent --}}
                    @if ($messages->onFirstPage())
                        <span class="disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $messages->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Numéros de pages --}}
                    @foreach ($messages->getUrlRange(1, $messages->lastPage()) as $page => $url)
                        @if ($page == $messages->currentPage())
                            <span class="active"><span>{{ $page }}</span></span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Lien suivant --}}
                    @if ($messages->hasMorePages())
                        <a href="{{ $messages->nextPageUrl() }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="disabled">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            @endif
        </div>

        <div class="msg-main">
            @if ($selectedMessage)
                <div class="msg-main-header">
                    <div class="msg-main-subject">{{ $selectedMessage->objet }}</div>
                    <div class="msg-main-meta">
                        <div class="msg-meta-item">
                            <i class="fas fa-user"></i>
                            {{ trim(($selectedMessage->prenom ?? '') . ' ' . ($selectedMessage->nom ?? '')) ?: 'Utilisateur' }}
                        </div>
                        <div class="msg-meta-item">
                            <i class="fas fa-envelope"></i>
                            {{ !empty($selectedMessage->email) ? $selectedMessage->email : 'Non renseigné' }}
                        </div>
                        <div class="msg-meta-item">
                            <i class="fas fa-calendar"></i>
                            {{ $selectedMessage->created_at->translatedFormat('d M Y à H\hi') }}
                        </div>
                        @php
                            $statusLabel = match ($selectedMessage->statut) {
                                'nouveau' => 'Non lu',
                                'lu' => 'Lu',
                                'traite' => 'Traité',
                                'archive' => 'Archivé',
                                default => ucfirst($selectedMessage->statut),
                            };
                            $statusClass = match ($selectedMessage->statut) {
                                'nouveau' => 'status--non-lu',
                                'lu' => 'status--lu',
                                'traite' => 'status--repondu',
                                'archive' => 'status--repondu',
                                default => 'status--lu',
                            };
                        @endphp
                        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    </div>

                    <div class="msg-body-text">
                        {!! nl2br(e($selectedMessage->message)) !!}
                    </div>

                    @if ($selectedMessage->fichier)
                        <div
                            style="margin-top:16px;padding:12px;background:var(--cream);border-radius:8px;border:1px solid var(--border);">
                            <div
                                style="font-size:.78rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;">
                                <i class="fas fa-paperclip"></i> Fichier joint
                            </div>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.messages.file', [$selectedMessage, 'view']) }}" target="_blank"
                                    style="display:inline-flex;align-items:center;gap:8px;padding:8px 14px;background:#1565c0;color:white;border-radius:6px;text-decoration:none;font-size:.82rem;font-weight:700;">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('admin.messages.file', [$selectedMessage, 'download']) }}"
                                    style="display:inline-flex;align-items:center;gap:8px;padding:8px 14px;background:var(--green);color:white;border-radius:6px;text-decoration:none;font-size:.82rem;font-weight:700;">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="msg-actions">
                        <label>Actions rapides</label>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;">
                            @if ($selectedMessage->statut !== 'lu')
                                <form method="POST" action="{{ route('admin.messages.status', $selectedMessage) }}"
                                    style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="read">
                                    <button type="submit" class="btn-primary" style="background:#1565c0;">
                                        <i class="fas fa-eye"></i> Marquer comme lu
                                    </button>
                                </form>
                            @endif
                            @if ($selectedMessage->statut !== 'archive')
                                <form method="POST" action="{{ route('admin.messages.status', $selectedMessage) }}"
                                    style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="archive">
                                    <button type="submit" class="btn-primary" style="background:#6a1b9a;">
                                        <i class="fas fa-archive"></i> Archiver
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.messages.destroy', $selectedMessage) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-primary" style="background:#e53935;"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="reply-box">
                        <label>Répondre à ce message</label>
                        <form method="POST" action="{{ route('admin.messages.reply', $selectedMessage) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <textarea name="reply" class="reply-textarea" placeholder="Écrivez votre réponse ici..." required></textarea>

                            <div style="margin-top:12px;">
                                <label
                                    style="font-size:.78rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;display:block;">
                                    <i class="fas fa-paperclip"></i> Pièces jointes (optionnel)
                                </label>
                                <input type="file" name="attachments[]" multiple
                                    style="width:100%;padding:8px;border:1px solid var(--border);border-radius:6px;background:var(--cream);font-size:.85rem;font-family:'Nunito',sans-serif;">
                                <p style="font-size:.75rem;color:var(--text-light);margin-top:4px;">Maximum 10 Mo par
                                    fichier. Plusieurs fichiers acceptés.</p>
                            </div>

                            <div style="margin-top:12px;">
                                <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Envoyer la
                                    réponse</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div style="padding:24px;border:1px dashed var(--border);border-radius:12px;color:var(--text-light);">
                        Sélectionnez un message pour le consulter.</div>
            @endif
        </div>
    </div>
@endsection
