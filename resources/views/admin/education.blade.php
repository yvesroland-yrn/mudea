@extends('admin.layouts.app')
@section('title', 'Education et Excellence')
@section('page-title', 'Education et Excellence')
@section('page-subtitle', 'Gérer le contenu Éducation')

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
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--green);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* ── Tableau ────────────────────────────────────────────────────────────── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .data-table thead {
            background: var(--cream);
            border-bottom: 2px solid var(--border);
        }

        .data-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .data-table tbody tr:hover {
            background: rgba(27, 94, 32, 0.02);
        }

        .data-table td {
            padding: 12px 16px;
            font-size: 0.85rem;
            color: var(--text);
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .status-badge.status--publie {
            background: var(--green-light);
            color: var(--green);
        }

        .status-badge.status--brouillon {
            background: var(--blue-light);
            color: var(--blue);
        }

        .action-btns {
            display: flex;
            gap: 6px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text);
            cursor: pointer;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: var(--green-light);
            border-color: var(--green);
            color: var(--green);
        }

        .btn-icon--del:hover {
            background: #ffebee;
            border-color: #ef9a9a;
            color: #e53935;
        }

        /* ── Modal ──────────────────────────────────────────────────────────────── */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1000;
            animation: fadeIn 0.2s ease-out;
        }

        .modal-overlay.open {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 40px;
            overflow-y: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-box {
            background: white;
            border-radius: var(--radius-md);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 95%;
            margin-bottom: 40px;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px;
            border-bottom: 1px solid var(--border);
            background: var(--cream);
        }

        .modal-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .modal-icon {
            width: 44px;
            height: 44px;
            background: var(--green-light);
            color: var(--green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text);
        }

        .modal-subtitle {
            font-size: 0.75rem;
            color: var(--text-light);
            margin-top: 2px;
        }

        .btn-close {
            width: 32px;
            height: 32px;
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 1.3rem;
            padding: 0;
            transition: color 0.2s;
        }

        .btn-close:hover {
            color: var(--text);
        }

        .modal-body {
            padding: 24px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .required {
            color: #e53935;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-family: 'Nunito', sans-serif;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(27, 94, 32, 0.1);
        }

        .form-control[readonly] {
            background: var(--cream);
            cursor: not-allowed;
        }

        .form-control[disabled] {
            background: var(--cream);
            cursor: not-allowed;
            opacity: 0.6;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .file-drop {
            padding: 24px;
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--cream);
        }

        .file-drop:hover {
            border-color: var(--green);
            background: var(--green-light);
        }

        .file-drop-icon {
            font-size: 2rem;
            color: var(--green);
            margin-bottom: 8px;
        }

        .file-drop-text {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .file-drop-sub {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .status-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .radio-card {
            padding: 12px;
            border: 2px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.2s;
            display: block;
            background: white;
        }

        .radio-card:hover {
            border-color: var(--green);
        }

        .radio-card.selected {
            border-color: var(--green);
            background: var(--green-light);
        }

        .radio-card input {
            display: none;
        }

        .radio-card-label {
            font-weight: 700;
            color: var(--text);
            font-size: 0.85rem;
        }

        .radio-card-desc {
            font-size: 0.7rem;
            color: var(--text-light);
            margin-top: 2px;
        }

        /* Modal footer */
        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--cream);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background: #f0f2f4;
            border-color: var(--text-light);
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--green);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-save:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

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

    {{-- Toolbar --}}
    <div class="page-toolbar">
        <h1>Contenu – Éducation & Excellence</h1>
        <button class="btn-primary" onclick="openModal()">
            <i class="fas fa-plus"></i> Ajouter du contenu
        </button>
    </div>

    {{-- Table --}}
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
            @forelse ($educations as $item)
                <tr data-record='@json($item->toArray())'>
                    <td style="width:80px; padding:8px 12px;">
                        @if($item->media)
                            <img src="{{ Storage::url($item->media) }}" alt="{{ $item->titre }}"
                                style="width:70px; height:70px; object-fit:cover; border-radius:6px; border:1px solid var(--border); cursor:pointer;"
                                title="Cliquer pour agrandir" onclick="openEducationRecordModal('view', this); return false;">
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
                                onclick="openEducationRecordModal('view', this); return false;"> <i
                                    class="fas fa-eye"></i> </a>
                            <a href="#" class="btn-icon btn-icon--edit" title="Modifier"
                                onclick="openEducationRecordModal('edit', this); return false;"><i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.education.destroy', $item->id) }}" method="POST"
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
                        <i class="fas fa-graduation-cap" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Aucun contenu Éducation trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Modal --}}
    <div class="modal-overlay" id="modalOverlay" onclick="handleOverlayClick(event)" role="dialog" aria-modal="true"
        aria-labelledby="modalTitle">
        <div class="modal-box" id="modalBox">

            <div class="modal-header">
                <div class="modal-header-left">
                    <div class="modal-icon"><i class="fas fa-plus"></i></div>
                    <div>
                        <div class="modal-title" id="modalTitle">Ajouter du contenu</div>
                        <div class="modal-subtitle">Éducation & Excellence — Nouveau contenu</div>
                    </div>
                </div>
                <button class="btn-close" onclick="closeModal()" aria-label="Fermer">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.education.store') }}" method="POST" enctype="multipart/form-data"
                id="educationForm">
                @csrf
                <input type="hidden" name="id" id="f-id" value="">
                <input type="hidden" name="_method" id="f-method" value="">

                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label" for="f-titre">Titre <span class="required">*</span></label>
                        <input id="f-titre" type="text" name="titre" class="form-control"
                            placeholder="Ex : Programme d'excellence pédagogique…" required>
                    </div>

                    <div class="form-row">
                        <input type="hidden" id="f-type" name="type" value="photos">
                        <div class="form-group" style="flex: 1;">
                            <label class="form-label" for="f-categorie">Catégorie <span class="required">*</span></label>
                            <select id="f-categorie" name="categorie" class="form-control" required>
                                <option value="">— Sélectionner —</option>
                                <option value="excellence">Excellence</option>
                                <option value="numerique">Numérique</option>
                                <option value="innovation">Innovation</option>
                                <option value="bourses">Bourses</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="f-description">Description <span class="required">*</span></label>
                        <textarea id="f-description" name="description" class="form-control" placeholder="Résumé ou description du contenu…"
                            required></textarea>
                    </div>

                    <div class="form-group" id="media-preview-container" style="display:none;">
                        <label class="form-label">Aperçu du média</label>
                        <div id="media-preview" style="width:100%; border-radius:8px; overflow:hidden; background:#f5f5f5; max-height:300px; display:flex; align-items:center; justify-content:center;">
                        </div>
                    </div>

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

                    <input type="hidden" id="f-date" name="date_publication" value="">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openModal() {
            document.getElementById('educationForm').reset();
            document.getElementById('f-id').value = '';
            document.getElementById('f-method').value = '';
            document.getElementById('educationForm').action = '{{ route('admin.education.store') }}';
            selectStatus('publie');
            setEducationFormMode(false);

            document.getElementById('modalTitle').textContent = 'Ajouter du contenu';
            document.querySelector('#modalBox .modal-subtitle').textContent = 'Éducation & Excellence — Nouveau contenu';
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

        function fillEducationForm(record) {
            document.getElementById('f-titre').value = record.titre || '';
            document.getElementById('f-categorie').value = record.categorie || '';
            document.getElementById('f-description').value = record.description || '';
            document.getElementById('f-date').value = record.date_publication || '';
            document.getElementById('f-id').value = record.id || '';
            selectStatus(record.statut || 'publie');

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

        function setEducationFormMode(isView) {
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

            if (isView) {
                fileDropContainer.style.display = 'none';
            } else {
                fileDropContainer.style.display = 'block';
                if (document.getElementById('f-id').value === '') {
                    mediaPreviewContainer.style.display = 'none';
                }
            }
        }

        window.openEducationRecordModal = function(mode, trigger) {
            var row = trigger.closest('tr');
            var record = row && row.dataset.record ? JSON.parse(row.dataset.record) : {};

            fillEducationForm(record);
            setEducationFormMode(mode === 'view');

            var form = document.getElementById('educationForm');
            var methodInput = document.getElementById('f-method');
            var idInput = document.getElementById('f-id');

            if (mode === 'edit' && record.id) {
                form.action = '/admin/education/' + record.id;
                methodInput.value = 'PUT';
            } else {
                form.action = '{{ route('admin.education.store') }}';
                methodInput.value = '';
                idInput.value = '';
            }

            document.getElementById('modalTitle').textContent = mode === 'view' ? 'Voir le contenu' :
                (mode === 'edit' ? 'Modifier le contenu' : 'Ajouter du contenu');
            document.querySelector('#modalBox .modal-subtitle').textContent = mode === 'view' ?
                'Aperçu des informations d\'éducation' :
                (mode === 'edit' ? 'Ajustez les informations avant enregistrement' :
                    'Éducation & Excellence — Nouveau contenu');
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
