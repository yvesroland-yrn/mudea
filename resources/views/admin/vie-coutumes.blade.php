@extends('admin.layouts.app')
@section('title', 'Vie & Coutumes')
@section('page-title', 'Vie & Coutumes')
@section('page-subtitle', 'Gérer le contenu Vie & Coutumes')

@use('Illuminate\Support\Facades\Storage')

@push('styles')
    <style>
        /* ── Variables ─────────────────────────────────────────────────────────── */
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

        /* ── Typographie commune ────────────────────────────────────────────────── */
        body,
        input,
        select,
        textarea,
        button {
            font-family: 'Nunito', sans-serif;
        }

        /* ── Toolbar ────────────────────────────────────────────────────────────── */
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

        /* ── Boutons ────────────────────────────────────────────────────────────── */
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

        .btn-sm {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            font-size: .75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            text-decoration: none;
            background: var(--green-light);
            color: var(--green);
            border: 1px solid var(--green-soft);
            transition: all .18s;
            margin-top: 4px;
        }

        .btn-sm:hover {
            background: var(--green);
            color: #fff;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-size: .8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            background: var(--white);
            color: var(--text-mid);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all .18s;
        }

        .btn-secondary:hover {
            background: var(--border);
            color: var(--text);
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: #fff;
            padding: 9px 22px;
            border-radius: var(--radius-sm);
            font-size: .8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            border: none;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-save:hover {
            background: var(--green-dark);
        }

        /* ── Icône-bouton (tableau) ─────────────────────────────────────────────── */
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

        /* ── Section cards ─────────────────────────────────────────────────────── */
        .sections-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .section-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .section-card-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1.2rem;
        }

        .section-card-title {
            font-size: .9rem;
            font-weight: 800;
            color: var(--text);
        }

        .section-card-count {
            font-size: .78rem;
            color: var(--text-light);
        }

        /* ── Tableau de données ─────────────────────────────────────────────────── */
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
            padding: 12px 16px;
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

        .action-btns {
            display: flex;
            gap: 6px;
        }

        /* ── Badges statut ─────────────────────────────────────────────────────── */
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

        /* ════════════════════════════════════════════════════════════════════════ */
        /* ── MODAL ────────────────────────────────────────────────────────────── */
        /* ════════════════════════════════════════════════════════════════════════ */

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .46);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
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
            width: 560px;
            max-width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 8px 40px rgba(0, 0, 0, .18);
            transform: translateY(24px) scale(.97);
            opacity: 0;
            transition: transform .22s, opacity .22s;
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        /* En-tête */
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
        }

        .modal-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text);
        }

        .modal-subtitle {
            font-size: .75rem;
            color: var(--text-light);
            margin-top: 2px;
        }

        .btn-close {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-light);
            font-size: .88rem;
            transition: all .18s;
            flex-shrink: 0;
        }

        .btn-close:hover {
            background: #ffebee;
            border-color: #ef9a9a;
            color: #e53935;
        }

        /* Corps */
        .modal-body {
            padding: 22px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Formulaire */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-label {
            font-size: .76rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-light);
        }

        .form-label .required {
            color: #e53935;
        }

        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: .85rem;
            color: var(--text);
            background: var(--cream);
            font-family: 'Nunito', sans-serif;
            box-sizing: border-box;
            outline: none;
            transition: border .18s, background .18s;
        }

        .form-control:focus {
            border-color: var(--green);
            background: var(--white);
        }

        .form-control::placeholder {
            color: var(--text-light);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a9585' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 72px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-hint {
            font-size: .72rem;
            color: var(--text-light);
            margin-top: 2px;
        }

        /* Zone de dépôt fichier */
        .file-drop {
            border: 1.5px dashed var(--green-soft);
            border-radius: var(--radius-sm);
            padding: 18px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            background: var(--green-light);
            cursor: pointer;
            transition: border-color .18s;
        }

        .file-drop:hover {
            border-color: var(--green);
        }

        .file-drop-icon {
            font-size: 1.4rem;
            color: var(--green);
            opacity: .7;
        }

        .file-drop-text {
            font-size: .78rem;
            color: var(--text-mid);
            font-weight: 800;
        }

        .file-drop-sub {
            font-size: .7rem;
            color: var(--text-light);
        }

        /* Statut radio-cards */
        .status-row {
            display: flex;
            gap: 12px;
        }

        .radio-card {
            flex: 1;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--cream);
            transition: all .18s;
        }

        .radio-card input {
            accent-color: var(--green);
        }

        .radio-card.selected {
            border-color: var(--green);
            background: var(--green-light);
        }

        .radio-card-label {
            font-size: .8rem;
            font-weight: 800;
            color: var(--text-mid);
        }

        .radio-card-desc {
            font-size: .7rem;
            color: var(--text-light);
        }

        /* Pied */
        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
        }
    </style>
@endpush

@section('content')

    {{-- Messages d'alerte --}}
    @if ($errors->any())
        <div style="margin-bottom: 20px; padding: 14px 16px; background: #ffebee; border: 1px solid #ef9a9a; border-radius: 8px; color: #e53935;">
            <div style="font-weight: 800; margin-bottom: 8px;">
                <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                Erreur de validation
            </div>
            <ul style="margin: 0; padding-left: 24px;">
                @foreach ($errors->all() as $error)
                    <li style="font-size: 0.85rem; margin-bottom: 4px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="margin-bottom: 20px; padding: 14px 16px; background: var(--green-light); border: 1px solid var(--green-soft); border-radius: 8px; color: var(--green); display: flex; align-items: center; gap: 10px; animation: slideDown 0.3s ease-out;"
            id="successAlert">
            <i class="fas fa-check-circle" style="flex-shrink: 0; font-size: 1.1rem;"></i>
            <span style="font-weight: 800;">{{ session('success') }}</span>
            <button onclick="document.getElementById('successAlert').remove()" style="margin-left: auto; background: none; border: none; cursor: pointer; color: var(--green); font-size: 1.2rem; padding: 0;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- ── Toolbar ────────────────────────────────────────────────────────────── --}}
    <div class="page-toolbar">
        <h1>Contenu – Vie &amp; Coutumes</h1>
        <button class="btn-primary" onclick="openModal()">
            <i class="fas fa-plus"></i> Ajouter du contenu
        </button>
    </div>

    {{-- ── Tableau ─────────────────────────────────────────────────────────────── --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vieCoutumes as $item)
                <tr data-record='@json($item->toArray())'>
                    <td style="width:80px; padding:8px 12px;">
                        @if($item->media)
                            <img src="{{ Storage::url($item->media) }}" alt="{{ $item->titre }}"
                                style="width:70px; height:70px; object-fit:cover; border-radius:6px; border:1px solid var(--border); cursor:pointer;"
                                title="Cliquer pour agrandir" onclick="openVieCoutumesRecordModal('view', this); return false;">
                        @else
                            <div style="width:70px; height:70px; background:var(--cream); border-radius:6px; display:flex; align-items:center; justify-content:center; color:var(--text-light); font-size:.9rem;">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight:800;color:var(--text);">{{ $item->titre }}</td>
                    <td style="font-size:.78rem;color:var(--text-light);">
                        @if($item->categorie)
                            <span style="background:var(--green-light); color:var(--green); padding:3px 8px; border-radius:4px; display:inline-block; font-weight:700;">
                                {{ ucfirst($item->categorie) }}
                            </span>
                        @else
                            <span style="color:var(--text-light);">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status--{{ $item->statut }}">
                            {{ $item->statut === 'publie' ? 'Publié' : 'Brouillon' }}
                        </span>
                    </td>
                    <td style="font-size:.78rem;color:var(--text-light);">
                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '' }}
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="#" class="btn-icon btn-icon--view" title="Voir"
                                onclick="openVieCoutumesRecordModal('view', this); return false;"> <i
                                    class="fas fa-eye"></i> </a>
                            <a href="#" class="btn-icon btn-icon--edit" title="Modifier"
                                onclick="openVieCoutumesRecordModal('edit', this); return false;"><i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.vie-coutumes.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon--del" title="Supprimer"
                                    onclick="return confirm('Supprimer ce contenu ?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:40px; color:var(--text-light);">
                        <i class="fas fa-masks-theater" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Aucun contenu Vie & Coutumes trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ════════════════════════════════════════════════════════════════════════ --}}
    {{-- ── MODAL – Ajouter du contenu ────────────────────────────────────────── --}}
    {{-- ════════════════════════════════════════════════════════════════════════ --}}
    <div class="modal-overlay" id="modalOverlay" onclick="handleOverlayClick(event)" role="dialog" aria-modal="true"
        aria-labelledby="modalTitle">
        <div class="modal-box" id="modalBox">

            {{-- En-tête --}}
            <div class="modal-header">
                <div class="modal-header-left">
                    <div class="modal-icon"><i class="fas fa-plus"></i></div>
                    <div>
                        <div class="modal-title" id="modalTitle">Ajouter du contenu</div>
                        <div class="modal-subtitle">Vie &amp; Coutumes — Nouveau contenu</div>
                    </div>
                </div>
                <button class="btn-close" onclick="closeModal()" aria-label="Fermer">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Formulaire --}}
            <form action="{{ route('admin.vie-coutumes.store') }}" method="POST" enctype="multipart/form-data"
                id="vieCoutumeForm">
                @csrf
                <input type="hidden" name="id" id="f-id" value="">
                <input type="hidden" name="_method" id="f-method" value="">

                <div class="modal-body">

                    {{-- Titre --}}
                    <div class="form-group">
                        <label class="form-label" for="f-titre">Titre <span class="required">*</span></label>
                        <input id="f-titre" type="text" name="titre" class="form-control"
                            placeholder="Ex : Fête de la récolte 2024…" required>
                    </div>

                    {{-- Type (caché en photos) + Catégorie --}}
                    {{-- <div class="form-row"> --}}
                        <input type="hidden" id="f-type" name="type" value="photos">
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="f-categorie">Catégorie <span class="required">*</span></label>
                            <select id="f-categorie" name="categorie" class="form-control" required>
                                <option value="">— Sélectionner —</option>
                                <option value="traditions">Traditions</option>
                                <option value="ceremonies">Cérémonies</option>
                                <option value="gastronomie">Gastronomie</option>
                                <option value="temoignages">Témoignages</option>
                            </select>
                        </div>
                    {{-- </div> --}}

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="form-label" for="f-description">Description <span class="required">*</span></label>
                        <textarea id="f-description" name="description" class="form-control" placeholder="Résumé ou description du contenu…"
                            required></textarea>
                    </div>

                    {{-- Aperçu du média (mode vue) --}}
                    <div class="form-group" id="media-preview-container" style="display:none;">
                        <label class="form-label">Aperçu du média</label>
                        <div id="media-preview" style="width:100%; border-radius:8px; overflow:hidden; background:#f5f5f5; max-height:300px; display:flex; align-items:center; justify-content:center;">
                        </div>
                    </div>

                    {{-- Fichier / Image --}}
                    <div class="form-group" id="file-drop-container">
                        <label class="form-label">Image <span class="required">*</span></label>
                        <div class="file-drop" onclick="document.getElementById('f-media').click()">
                            <div class="file-drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="file-drop-text">Glisser-déposer ou cliquer pour importer</div>
                            <div class="file-drop-sub">JPG, PNG — max 20 Mo</div>
                        </div>
                        <input id="f-media" type="file" name="media" accept=".jpg,.jpeg,.png" required
                            style="display:none">
                        <div id="media-name" style="margin-top:8px; font-size:0.78rem; color:var(--text-light);"></div>
                    </div>

                    {{-- Statut --}}
                    <div class="form-group">
                        <label class="form-label">Statut de publication</label>
                        <div class="status-row">
                            <label class="radio-card selected" id="rc-publie" onclick="selectStatus('publie')">
                                <input type="radio" name="statut" value="publie" checked>
                                <div>
                                    <div class="radio-card-label">Publié</div>
                                    <div class="radio-card-desc">Visible immédiatement</div>
                                </div>
                            </label>
                            <label class="radio-card" id="rc-brouillon" onclick="selectStatus('brouillon')">
                                <input type="radio" name="statut" value="brouillon">
                                <div>
                                    <div class="radio-card-label">Brouillon</div>
                                    <div class="radio-card-desc">Enregistré, non publié</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Date (cachée, automatique) --}}
                    <input type="hidden" id="f-date" name="date_publication" value="">

                </div>{{-- /.modal-body --}}

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>

        </div>{{-- /.modal-box --}}
    </div>{{-- /.modal-overlay --}}

@endsection

@push('scripts')
    <script>
        /* ── Modal ────────────────────────────────────────────────────────────────── */
        function openModal() {
            // Reset form
            document.getElementById('vieCoutumeForm').reset();
            document.getElementById('f-id').value = '';
            document.getElementById('f-method').value = '';
            document.getElementById('vieCoutumeForm').action = '{{ route('admin.vie-coutumes.store') }}';
            selectStatus('publie');
            setVieCoutumesFormMode(false);

            document.getElementById('modalTitle').textContent = 'Ajouter du contenu';
            document.querySelector('#modalBox .modal-subtitle').textContent = 'Vie & Coutumes — Nouveau contenu';
            document.querySelector('#modalBox .modal-icon i').className = 'fas fa-plus';

            document.getElementById('modalOverlay').classList.add('open');
            document.getElementById('f-titre').focus();
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('open');
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('modalOverlay')) closeModal();
        }

        function selectStatus(val) {
            document.querySelectorAll('.radio-card').forEach(el => el.classList.remove('selected'));
            document.getElementById('rc-' + val).classList.add('selected');
            document.querySelector('input[name="statut"][value="' + val + '"]').checked = true;
        }

        function fillVieCoutumesForm(record) {
            document.getElementById('f-titre').value = record.titre || '';
            document.getElementById('f-type').value = (record.type || '').toLowerCase();
            document.getElementById('f-categorie').value = record.categorie || '';
            document.getElementById('f-description').value = record.description || '';
            document.getElementById('f-date').value = record.date_publication || '';
            document.getElementById('f-id').value = record.id || '';
            selectStatus(record.statut || 'publie');

            // Afficher l'aperçu du média
            var mediaPreviewContainer = document.getElementById('media-preview-container');
            var mediaPreview = document.getElementById('media-preview');
            var mediaName = document.getElementById('media-name');

            if (record.media) {
                var mediaPath = '/storage/' + record.media;
                var ext = record.media.split('.').pop().toLowerCase();

                mediaPreview.innerHTML = '';
                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                    var img = document.createElement('img');
                    img.src = mediaPath;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    mediaPreview.appendChild(img);
                } else if (['mp4', 'webm', 'avi'].includes(ext)) {
                    var video = document.createElement('video');
                    video.src = mediaPath;
                    video.style.width = '100%';
                    video.style.height = '100%';
                    video.style.objectFit = 'cover';
                    video.controls = true;
                    mediaPreview.appendChild(video);
                } else if (ext === 'pdf') {
                    mediaPreview.innerHTML = '<i class="fas fa-file-pdf" style="font-size:3rem; color:#f44336;"></i>';
                } else {
                    mediaPreview.innerHTML = '<i class="fas fa-file" style="font-size:3rem; color:var(--text-light);"></i>';
                }
                mediaName.textContent = '📎 ' + record.media.split('/').pop();
                mediaPreviewContainer.style.display = 'block';
            } else {
                mediaPreviewContainer.style.display = 'none';
                mediaName.textContent = '';
            }
        }

        function setVieCoutumesFormMode(isView) {
            var fileDropContainer = document.getElementById('file-drop-container');
            var mediaPreviewContainer = document.getElementById('media-preview-container');

            document.querySelectorAll('#modalBox input, #modalBox select, #modalBox textarea').forEach(function(field) {
                if (field.type === 'file') {
                    field.disabled = isView;
                } else if (field.tagName === 'SELECT' || field.type === 'checkbox' || field.type === 'radio') {
                    field.disabled = isView;
                } else {
                    field.readOnly = isView;
                }
            });

            // Afficher/cacher les zones d'upload selon le mode
            if (isView) {
                fileDropContainer.style.display = 'none';
            } else {
                fileDropContainer.style.display = 'block';
                // Cacher l'aperçu si on ne regarde pas
                if (document.getElementById('f-id').value === '') {
                    mediaPreviewContainer.style.display = 'none';
                }
            }
        }

        window.openVieCoutumesRecordModal = function(mode, trigger) {
            var row = trigger.closest('tr');
            var record = row && row.dataset.record ? JSON.parse(row.dataset.record) : {};

            fillVieCoutumesForm(record);
            setVieCoutumesFormMode(mode === 'view');

            var form = document.getElementById('vieCoutumeForm');
            var methodInput = document.getElementById('f-method');
            var idInput = document.getElementById('f-id');

            if (mode === 'edit' && record.id) {
                form.action = '/admin/vie-coutumes/' + record.id;
                methodInput.value = 'PUT';
            } else {
                form.action = '{{ route('admin.vie-coutumes.store') }}';
                methodInput.value = '';
                idInput.value = '';
            }

            document.getElementById('modalTitle').textContent = mode === 'view' ? 'Voir le contenu' :
                (mode === 'edit' ? 'Modifier le contenu' : 'Ajouter du contenu');
            document.querySelector('#modalBox .modal-subtitle').textContent = mode === 'view' ?
                'Aperçu des informations de vie et coutumes' :
                (mode === 'edit' ? 'Ajustez les informations avant enregistrement' :
                    'Vie & Coutumes — Nouveau contenu');
            document.querySelector('#modalBox .modal-icon i').className = mode === 'view' ? 'fas fa-eye' : (mode ===
                'edit' ? 'fas fa-pen' : 'fas fa-plus');
            document.getElementById('modalOverlay').classList.add('open');
            document.getElementById('f-titre').focus();
        };

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
@endpush
