@extends('admin.layouts.app')
@section('title', 'Bureau')
@section('page-title', 'Bureau')
@section('page-subtitle', 'Gerer les membres du bureau')


@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
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
            --shadow-md: 0 6px 24px rgba(0, 0, 0, .11);
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

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .page-toolbar h1 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--text);
        }

        .page-toolbar h1 span {
            color: var(--text-light);
            font-size: .9rem;
            font-weight: 600;
        }

        .btn-primary,
        .btn-secondary,
        .btn-icon {
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: var(--green);
            color: #fff;
            border-radius: var(--radius-sm);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #fff;
            color: var(--text-mid);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-weight: 800;
        }

        .btn-primary:hover {
            background: var(--green-dark);
        }

        .btn-secondary:hover {
            background: var(--cream);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }

        .kpi-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .kpi-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            background: var(--green-light);
            color: var(--green);
            flex-shrink: 0;
        }

        .kpi-number {
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
        }

        .kpi-label {
            color: var(--text-light);
            font-size: .78rem;
            font-weight: 600;
            margin-top: 4px;
        }

        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .panel-head h2 {
            margin: 0;
            font-size: .98rem;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-input {
            min-width: 170px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 12px;
            background: var(--cream);
            outline: none;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            background: var(--cream);
            color: var(--text-light);
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 12px 16px;
        }

        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-mid);
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: #f8fbf8;
        }

        .member-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .member-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green-light), var(--blue-light));
            color: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            flex-shrink: 0;
            overflow: hidden;
        }

        .member-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .member-name {
            font-weight: 800;
            color: var(--text);
        }

        .member-meta {
            font-size: .78rem;
            color: var(--text-light);
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 800;
        }

        .role--president {
            background: var(--green-light);
            color: var(--green);
        }

        .role--vice-president {
            background: var(--blue-light);
            color: var(--blue);
        }

        .role--secretaire {
            background: var(--purple-light);
            color: var(--purple);
        }

        .role--tresorier {
            background: #fff8e1;
            color: #e65100;
        }

        .photo-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            background: #f1f5f3;
            font-size: .72rem;
            color: var(--text-mid);
            font-weight: 700;
        }

        .action-btns {
            display: flex;
            gap: 6px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
            border: 1px solid var(--border);
            color: var(--text-mid);
        }

        .btn-icon--view {
            color: var(--green);
        }

        .btn-icon--edit {
            color: var(--blue);
        }

        .btn-icon--del {
            color: #e53935;
        }

        .btn-icon--view:hover {
            background: var(--green-light);
        }

        .btn-icon--edit:hover {
            background: var(--blue-light);
        }

        .btn-icon--del:hover {
            background: #ffebee;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 20, 9, .55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            width: min(760px, 100%);
            background: var(--white);
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .25);
            overflow: hidden;
        }

        .modal-header,
        .modal-footer {
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .modal-header {
            border-bottom: 1px solid var(--border);
        }

        .modal-footer {
            border-top: 1px solid var(--border);
        }

        .modal-title {
            font-size: 1.05rem;
            font-weight: 900;
            color: var(--text);
        }

        .modal-subtitle {
            font-size: .8rem;
            color: var(--text-light);
        }

        .modal-body {
            padding: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: .8rem;
            font-weight: 800;
            color: var(--text);
        }

        .form-control {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 11px 12px;
            background: var(--cream);
            outline: none;
        }

        .file-drop {
            border: 1.5px dashed #bfd5c3;
            border-radius: 18px;
            padding: 22px;
            background: #fbfdfb;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-align: center;
            cursor: pointer;
        }

        .file-drop i {
            font-size: 1.4rem;
            color: var(--green);
        }

        .file-drop strong {
            color: var(--text);
        }

        @media (max-width: 1100px) {
            .kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 780px) {

            .page-toolbar,
            .panel-head {
                flex-direction: column;
                align-items: flex-start;
            }

            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <div class="panel" style="border-color: #c8e6c9; background: #e8f5e9; margin-bottom: 20px;">
            <div class="panel-head" style="border:none; color:#1b5e20;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="panel" style="border-color: #ffcdd2; background: #ffebee; margin-bottom: 20px;">
            <div class="panel-head" style="border:none; color:#b71c1c;">
                <ul style="margin:0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="page-toolbar">
        <h1>Bureau <span>({{ $members->count() }} membres)</span></h1>
        <button class="btn-primary" type="button" onclick="openModal()">
            <i class="fas fa-plus"></i> Nouveau membre
        </button>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="kpi-number">{{ $stats['total'] }}</div>
                <div class="kpi-label">Membres du bureau</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--blue-light);color:var(--blue);"><i class="fas fa-user-tie"></i>
            </div>
            <div>
                <div class="kpi-number">{{ $stats['president'] }}</div>
                <div class="kpi-label">Président</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--purple-light);color:var(--purple);"><i
                    class="fas fa-pen-to-square"></i></div>
            <div>
                <div class="kpi-number">{{ $stats['secretaires'] }}</div>
                <div class="kpi-label">Secrétaires</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:#fff8e1;color:#e65100;"><i class="fas fa-coins"></i></div>
            <div>
                <div class="kpi-number">{{ $stats['tresoriers'] }}</div>
                <div class="kpi-label">Trésorier(s)</div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h2>Liste des membres du bureau</h2>
            <form method="GET" action="{{ route('admin.bureau.index') }}" id="filterForm" class="filters">
                <input class="filter-input" type="text" name="search" placeholder="Rechercher un membre"
                    value="{{ $filters['search'] }}" onkeyup="document.getElementById('filterForm').submit();">
                <select class="filter-input" name="role_id" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Tous les rôles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $filters['role_id'] == $role->id ? 'selected' : '' }}>
                            {{ $role->nom }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Rôle</th>
                    <th>Photo</th>
                    <th>Mandat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr data-record='@json($member)'>
                        <td>
                            <div class="member-cell">
                                <div class="member-avatar">
                                    @if ($member->photo)
                                        <img src="{{ asset($member->photo) }}"
                                            alt="{{ $member->prenom }} {{ $member->nom }}">
                                    @else
                                        {{ $member->initials }}
                                    @endif
                                </div>
                                <div>
                                    <div class="member-name">{{ $member->prenom }} {{ $member->nom }}</div>
                                    <div class="member-meta">{{ $member->mandat ?? $member->role_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span
                                class="role-badge role--{{ \Illuminate\Support\Str::slug($member->role_name) }}">{{ $member->role_name }}</span>
                        </td>
                        <td>
                            <span class="photo-chip">
                                <i class="fas fa-image"></i>
                                {{ $member->photo ? 'Photo disponible' : 'Aucune photo' }}
                            </span>
                        </td>
                        <td>{{ $member->mandat ?? '-' }}</td>
                        <td>
                            <div class="action-btns">
                                {{-- <a href="#" class="btn-icon btn-icon--view" title="Voir"
                                    onclick="openMemberModal('view', this); return false;"><i class="fas fa-eye"></i></a> --}}
                                <a href="#" class="btn-icon btn-icon--edit" title="Modifier"
                                    onclick="openMemberModal('edit', this); return false;"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.bureau.destroy', $member->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon--del" title="Supprimer"
                                        onclick="return confirm('Supprimer ce membre ?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:18px 16px; color:var(--text-light); text-align:center;">Aucun
                            membre du bureau trouvé. Ajoutez-en un nouveau.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal-overlay" id="memberModal" onclick="handleOverlayClick(event)" aria-hidden="true">
        <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="memberModalTitle">
            <div class="modal-header">
                <div>
                    <div class="modal-title" id="memberModalTitle">Nouveau membre du bureau</div>
                    <div class="modal-subtitle">Formulaire frontend pour ajouter ou modifier un membre</div>
                </div>
                <button class="btn-secondary" type="button" onclick="closeModal()">
                    <i class="fas fa-times"></i> Fermer
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('admin.bureau.store') }}" enctype="multipart/form-data"
                    id="memberForm">
                    @csrf
                    <input type="hidden" name="id" id="f-id" value="">
                    <input type="hidden" name="_method" id="f-method" value="">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="role_id">Rôle</label>
                            <select id="role_id" name="role_id" class="form-control" required onchange="toggleCustomRole()">
                                <option value="">-- Sélectionner un rôle --</option>
                                @foreach($roles as $role)
                                    @if(!$role->is_custom)
                                        <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                    @endif
                                @endforeach
                                <option value="custom">Autre</option>
                            </select>
                        </div>
                        <div class="form-group" id="customRoleGroup" style="display: none;">
                            <label class="form-label" for="custom_role">Préciser le rôle</label>
                            <input id="custom_role" name="custom_role" type="text" class="form-control"
                                placeholder="Ex: Coordinateur">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="prenom">Prénom</label>
                            <input id="prenom" name="prenom" type="text" class="form-control"
                                placeholder="Prénom" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="nom">Nom</label>
                            <input id="nom" name="nom" type="text" class="form-control" placeholder="Nom"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="mandat">Mandat</label>
                            <input id="mandat" name="mandat" type="text" class="form-control"
                                placeholder="Ex: 2024 - 2026">
                        </div>
                        <div class="form-group full">
                            <label class="form-label" for="photo">Photo</label>
                            <div class="file-drop" onclick="document.getElementById('photo').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <strong>Cliquez pour ajouter une photo</strong>
                                <span style="font-size:.8rem;color:var(--text-light);">JPG, PNG ou WEBP</span>
                            </div>
                            <input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.webp"
                                style="display:none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-secondary" type="button" onclick="closeModal()">
                            Annuler
                        </button>
                        <button class="btn-primary" type="submit">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleCustomRole() {
            const roleSelect = document.getElementById('role_id');
            const customRoleGroup = document.getElementById('customRoleGroup');
            const customRoleInput = document.getElementById('custom_role');

            if (roleSelect.value === 'custom') {
                customRoleGroup.style.display = 'block';
                customRoleInput.required = true;
            } else {
                customRoleGroup.style.display = 'none';
                customRoleInput.required = false;
                customRoleInput.value = '';
            }
        }

        function openModal() {
            // Reset form
            document.getElementById('memberForm').reset();
            document.getElementById('f-id').value = '';
            document.getElementById('f-method').value = '';
            document.getElementById('memberForm').action = '{{ route('admin.bureau.store') }}';

            document.getElementById('memberModalTitle').textContent = 'Nouveau membre du bureau';
            document.getElementById('memberModal').classList.add('open');
            toggleCustomRole();
        }

        function closeModal() {
            document.getElementById('memberModal').classList.remove('open');
        }

        function handleOverlayClick(event) {
            if (event.target === document.getElementById('memberModal')) {
                closeModal();
            }
        }

        function fillMemberForm(record) {
            document.getElementById('role_id').value = record.role_id || '';
            document.getElementById('custom_role').value = '';
            document.getElementById('prenom').value = record.prenom || '';
            document.getElementById('nom').value = record.nom || '';
            document.getElementById('mandat').value = record.mandat || '';
            document.getElementById('f-id').value = record.id || '';
            toggleCustomRole();
        }

        function setReadOnly(isReadOnly) {
            document.querySelectorAll('#memberModal input, #memberModal select').forEach(function(field) {
                field.disabled = isReadOnly;
            });
        }

        window.openMemberModal = function(mode, trigger) {
            var row = trigger.closest('tr');
            var record = row && row.dataset.record ? JSON.parse(row.dataset.record) : {};

            fillMemberForm(record);
            setReadOnly(mode === 'view');

            var form = document.getElementById('memberForm');
            var methodInput = document.getElementById('f-method');
            var idInput = document.getElementById('f-id');

            if (mode === 'edit' && record.id) {
                form.action = '/admin/bureau/' + record.id;
                methodInput.value = 'PUT';
            } else {
                form.action = '{{ route('admin.bureau.store') }}';
                methodInput.value = '';
                idInput.value = '';
            }

            document.getElementById('memberModalTitle').textContent = mode === 'view' ?
                'Voir le membre du bureau' :
                (mode === 'edit' ? 'Modifier le membre du bureau' : 'Nouveau membre du bureau');
            document.getElementById('memberModal').classList.add('open');
        };

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endpush
