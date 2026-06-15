@extends('admin.layouts.app')
@section('title','Projets')
@section('page-title','Projets')
@section('page-subtitle','Gérer les projets de développement')

@push('styles')
<style>
/* ── Variables ─────────────────────────────────────────────────────────── */
:root {
  --green        : #1b5e20;
  --green-dark   : #0a3d14;
  --green-light  : #e8f5e9;
  --green-soft   : #c8e6c9;
  --blue         : #1565c0;
  --blue-light   : #e3f2fd;
  --purple       : #6a1b9a;
  --purple-light : #f3e5f5;
  --white        : #ffffff;
  --cream        : #f4f6f8;
  --border       : #e0e8e4;
  --text         : #1a2e25;
  --text-mid     : #455d4f;
  --text-light   : #7a9585;
  --shadow-sm    : 0 2px 10px rgba(0,0,0,.07);
  --radius-sm    : 8px;
  --radius-md    : 14px;
  --radius-lg    : 20px;
}

/* ── Typographie commune ────────────────────────────────────────────────── */
body, input, select, textarea, button {
  font-family: 'Nunito', sans-serif;
}

/* ── Toolbar ────────────────────────────────────────────────────────────── */
.page-toolbar {
  display         : flex;
  align-items     : center;
  justify-content : space-between;
  margin-bottom   : 22px;
}
.page-toolbar h1 {
  font-size   : 1.15rem;
  font-weight : 800;
  color       : var(--text);
  margin      : 0;
}
.page-toolbar h1 span {
  font-weight : 600;
  color       : var(--text-light);
  font-size   : .9rem;
}

/* ── Boutons ────────────────────────────────────────────────────────────── */
.btn-primary {
  display        : inline-flex;
  align-items    : center;
  gap            : 8px;
  background     : var(--green);
  color          : #fff;
  padding        : 10px 20px;
  border-radius  : var(--radius-sm);
  font-size      : .82rem;
  font-weight    : 800;
  text-transform : uppercase;
  letter-spacing : .05em;
  text-decoration: none;
  border         : none;
  cursor         : pointer;
  transition     : background .2s;
}
.btn-primary:hover { background: var(--green-dark); }

.btn-secondary {
  display        : inline-flex;
  align-items    : center;
  gap            : 6px;
  padding        : 9px 18px;
  border-radius  : var(--radius-sm);
  font-size      : .8rem;
  font-weight    : 800;
  text-transform : uppercase;
  letter-spacing : .05em;
  background     : var(--white);
  color          : var(--text-mid);
  border         : 1px solid var(--border);
  cursor         : pointer;
  transition     : all .18s;
}
.btn-secondary:hover { background: var(--border); color: var(--text); }

.btn-save {
  display        : inline-flex;
  align-items    : center;
  gap            : 8px;
  background     : var(--green);
  color          : #fff;
  padding        : 9px 22px;
  border-radius  : var(--radius-sm);
  font-size      : .8rem;
  font-weight    : 800;
  text-transform : uppercase;
  letter-spacing : .05em;
  border         : none;
  cursor         : pointer;
  transition     : background .2s;
}
.btn-save:hover { background: var(--green-dark); }

/* ── Icône-bouton (tableau) ─────────────────────────────────────────────── */
.btn-icon {
  width          : 30px;
  height         : 30px;
  border-radius  : var(--radius-sm);
  border         : 1px solid var(--border);
  background     : var(--cream);
  display        : flex;
  align-items    : center;
  justify-content: center;
  font-size      : .78rem;
  cursor         : pointer;
  text-decoration: none;
  transition     : all .2s;
}
.btn-icon--view  { color: var(--green); }
.btn-icon--view:hover  { background: var(--green-light); border-color: var(--green-soft); }
.btn-icon--edit  { color: var(--blue); }
.btn-icon--edit:hover  { background: var(--blue-light); border-color: #90caf9; }
.btn-icon--del   { color: #e53935; }
.btn-icon--del:hover   { background: #ffebee; border-color: #ef9a9a; }
.btn-icon--reply { color: var(--purple); }
.btn-icon--reply:hover { background: var(--purple-light); border-color: #ce93d8; }

/* ── Barre de filtres ───────────────────────────────────────────────────── */
.filters-bar {
  background    : var(--white);
  border        : 1px solid var(--border);
  border-radius : var(--radius-md);
  padding       : 14px 18px;
  display       : flex;
  align-items   : center;
  gap           : 12px;
  margin-bottom : 18px;
  flex-wrap     : wrap;
}
.filter-input {
  border        : 1px solid var(--border);
  border-radius : var(--radius-sm);
  padding       : 8px 12px;
  font-size     : .82rem;
  font-family   : 'Nunito', sans-serif;
  color         : var(--text);
  outline       : none;
  background    : var(--cream);
  min-width     : 140px;
  transition    : border .18s;
}
.filter-input:focus      { border-color: var(--green); }
.filter-input--search    { flex: 1; min-width: 180px; }

/* ── Tableau de données ─────────────────────────────────────────────────── */
.data-table {
  width           : 100%;
  background      : var(--white);
  border          : 1px solid var(--border);
  border-radius   : var(--radius-lg);
  overflow        : hidden;
  box-shadow      : var(--shadow-sm);
  border-collapse : collapse;
}
.data-table th {
  background     : var(--cream);
  padding        : 11px 16px;
  font-size      : .72rem;
  font-weight    : 800;
  text-transform : uppercase;
  letter-spacing : .08em;
  color          : var(--text-light);
  text-align     : left;
  border-bottom  : 1px solid var(--border);
}
.data-table td {
  padding        : 13px 16px;
  border-bottom  : 1px solid var(--border);
  font-size      : .85rem;
  color          : var(--text-mid);
  vertical-align : middle;
}
.data-table tr:last-child td { border-bottom: none; }
.data-table tr:hover td      { background: #f8fbf8; }

.action-btns { display: flex; gap: 6px; }

/* ── Badges statut ─────────────────────────────────────────────────────── */
.status-badge {
  display        : inline-flex;
  align-items    : center;
  gap            : 5px;
  padding        : 4px 10px;
  border-radius  : 999px;
  font-size      : .7rem;
  font-weight    : 800;
}
.status--en-cours,
.status--actif,
.status--realise  { background: var(--green-light); color: var(--green); }
.status--brouillon,
.status--inactif  { background: #eceff1; color: #546e7a; }
.status--futur,
.status--archive  { background: #fff8e1; color: #e65100; }

/* ── Barre de progression ───────────────────────────────────────────────── */
.progress-bar {
  height        : 6px;
  background    : var(--green-light);
  border-radius : 999px;
  overflow      : hidden;
  flex          : 1;
}
.progress-fill {
  height        : 100%;
  background    : var(--green);
  border-radius : 999px;
}
.progress-wrap {
  display     : flex;
  align-items : center;
  gap         : 8px;
  min-width   : 120px;
}
.progress-pct {
  font-size   : .72rem;
  font-weight : 800;
  color       : var(--green);
  white-space : nowrap;
}

/* ── Pagination ─────────────────────────────────────────────────────────── */
.pagination {
  display         : flex;
  align-items     : center;
  justify-content : space-between;
  padding         : 14px 4px 0;
}
.pagination-info { font-size: .78rem; color: var(--text-light); }
.pagination-btns { display: flex; gap: 6px; }
.pag-btn {
  width          : 32px;
  height         : 32px;
  border-radius  : var(--radius-sm);
  border         : 1px solid var(--border);
  background     : var(--cream);
  display        : flex;
  align-items    : center;
  justify-content: center;
  font-size      : .78rem;
  font-weight    : 700;
  cursor         : pointer;
  text-decoration: none;
  color          : var(--text-mid);
  transition     : all .2s;
}
.pag-btn:hover,
.pag-btn.active { background: var(--green); color: #fff; border-color: var(--green); }

/* ════════════════════════════════════════════════════════════════════════ */
/* ── MODAL ────────────────────────────────────────────────────────────── */
/* ════════════════════════════════════════════════════════════════════════ */

.modal-overlay {
  position       : fixed;
  inset          : 0;
  background     : rgba(0,0,0,.46);
  display        : flex;
  align-items    : center;
  justify-content: center;
  z-index        : 1000;
  opacity        : 0;
  pointer-events : none;
  transition     : opacity .22s;
}
.modal-overlay.open {
  opacity        : 1;
  pointer-events : all;
}

.modal-box {
  background    : var(--white);
  border-radius : var(--radius-lg);
  width         : 580px;
  max-width     : 95vw;
  max-height    : 90vh;
  overflow-y    : auto;
  box-shadow    : 0 8px 40px rgba(0,0,0,.18);
  transform     : translateY(24px) scale(.97);
  opacity       : 0;
  transition    : transform .22s, opacity .22s;
}
.modal-overlay.open .modal-box {
  transform : translateY(0) scale(1);
  opacity   : 1;
}

/* En-tête */
.modal-header {
  display         : flex;
  align-items     : center;
  justify-content : space-between;
  padding         : 20px 24px 16px;
  border-bottom   : 1px solid var(--border);
}
.modal-header-left {
  display    : flex;
  align-items: center;
  gap        : 12px;
}
.modal-icon {
  width          : 40px;
  height         : 40px;
  border-radius  : var(--radius-md);
  background     : var(--green-light);
  display        : flex;
  align-items    : center;
  justify-content: center;
  color          : var(--green);
  font-size      : 1.1rem;
  flex-shrink    : 0;
}
.modal-title    { font-size: 1rem;  font-weight: 800; color: var(--text); }
.modal-subtitle { font-size: .75rem; color: var(--text-light); margin-top: 2px; }

.btn-close {
  width          : 32px;
  height         : 32px;
  border-radius  : var(--radius-sm);
  border         : 1px solid var(--border);
  background     : var(--cream);
  display        : flex;
  align-items    : center;
  justify-content: center;
  cursor         : pointer;
  color          : var(--text-light);
  font-size      : .88rem;
  transition     : all .18s;
  flex-shrink    : 0;
}
.btn-close:hover { background: #ffebee; border-color: #ef9a9a; color: #e53935; }

/* Corps */
.modal-body {
  padding       : 22px 24px;
  display       : flex;
  flex-direction: column;
  gap           : 16px;
}

/* Formulaire */
.form-group {
  display       : flex;
  flex-direction: column;
  gap           : 5px;
}
.form-label {
  font-size      : .76rem;
  font-weight    : 800;
  text-transform : uppercase;
  letter-spacing : .06em;
  color          : var(--text-light);
}
.form-label .required { color: #e53935; }

.form-control {
  width         : 100%;
  padding       : 9px 12px;
  border        : 1px solid var(--border);
  border-radius : var(--radius-sm);
  font-size     : .85rem;
  color         : var(--text);
  background    : var(--cream);
  font-family   : 'Nunito', sans-serif;
  box-sizing    : border-box;
  outline       : none;
  transition    : border .18s, background .18s;
}
.form-control:focus        { border-color: var(--green); background: var(--white); }
.form-control::placeholder { color: var(--text-light); }

select.form-control {
  appearance         : none;
  background-image   : url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a9585' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat  : no-repeat;
  background-position: right 12px center;
  padding-right      : 32px;
}

textarea.form-control {
  resize    : vertical;
  min-height: 72px;
}

.form-row {
  display               : grid;
  grid-template-columns : 1fr 1fr;
  gap                   : 14px;
}

.form-row-3 {
  display               : grid;
  grid-template-columns : 1fr 1fr 1fr;
  gap                   : 14px;
}

.form-hint { font-size: .72rem; color: var(--text-light); margin-top: 2px; }

/* Zone de dépôt fichier */
.file-drop {
  border        : 1.5px dashed var(--green-soft);
  border-radius : var(--radius-sm);
  padding       : 18px;
  display       : flex;
  flex-direction: column;
  align-items   : center;
  gap           : 6px;
  background    : var(--green-light);
  cursor        : pointer;
  transition    : border-color .18s;
}
.file-drop:hover    { border-color: var(--green); }
.file-drop-icon     { font-size: 1.4rem; color: var(--green); opacity: .7; }
.file-drop-text     { font-size: .78rem; color: var(--text-mid); font-weight: 800; }
.file-drop-sub      { font-size: .7rem;  color: var(--text-light); }

/* Statut radio-cards */
.status-row { display: flex; gap: 10px; }

.radio-card {
  flex          : 1;
  border        : 1.5px solid var(--border);
  border-radius : var(--radius-sm);
  padding       : 10px 12px;
  cursor        : pointer;
  display       : flex;
  align-items   : center;
  gap           : 10px;
  background    : var(--cream);
  transition    : all .18s;
}
.radio-card input    { accent-color: var(--green); }
.radio-card.selected { border-color: var(--green); background: var(--green-light); }
.radio-card-label    { font-size: .78rem; font-weight: 800; color: var(--text-mid); }
.radio-card-desc     { font-size: .68rem; color: var(--text-light); }

/* Pied */
.modal-footer {
  display         : flex;
  align-items     : center;
  justify-content : flex-end;
  gap             : 10px;
  padding         : 16px 24px;
  border-top      : 1px solid var(--border);
  background      : var(--cream);
}
</style>
@endpush

@section('content')

{{-- ── Toolbar ────────────────────────────────────────────────────────────── --}}
<div class="page-toolbar">
  <h1>Tous les projets <span>(18)</span></h1>
  <button class="btn-primary" onclick="openModal()">
    <i class="fas fa-plus"></i> Nouveau projet
  </button>
</div>

{{-- ── Filtres ─────────────────────────────────────────────────────────────── --}}
<div class="filters-bar">
  <input class="filter-input filter-input--search" type="text" placeholder="Rechercher un projet…">
  <select class="filter-input">
    <option value="">Tous les statuts</option>
    <option value="en-cours">En cours</option>
    <option value="realise">Réalisé</option>
    <option value="futur">Futur</option>
  </select>
</div>

{{-- ── Tableau ─────────────────────────────────────────────────────────────── --}}
<table class="data-table">
  <thead>
    <tr>
      <th>Projet</th>
      <th>Statut</th>
      <th>Durée</th>
      <th>Budget</th>
      <th>Avancement</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @php
      $projets = [
        ['titre' => "Construction du Complexe Scolaire d'Excellence", 'statut' => 'en-cours', 'dates' => '2023–2026', 'budget' => '150 000 000 FCFA', 'pct' => 65],
        ['titre' => "Adduction d'eau potable pour Andé",              'statut' => 'en-cours', 'dates' => '2023–2025', 'budget' => '80 000 000 FCFA',  'pct' => 65],
        ['titre' => 'Construction du Centre de Santé Intégré',        'statut' => 'en-cours', 'dates' => '2024–2026', 'budget' => '120 000 000 FCFA', 'pct' => 40],
        ['titre' => 'Réhabilitation des pistes rurales',              'statut' => 'en-cours', 'dates' => '2024–2025', 'budget' => '45 000 000 FCFA',  'pct' => 30],
        ['titre' => 'Électrification solaire de 5 quartiers',        'statut' => 'en-cours', 'dates' => '2023–2025', 'budget' => '95 000 000 FCFA',  'pct' => 60],
        ['titre' => "Réhabilitation de l'école primaire d'Andé",     'statut' => 'realise',  'dates' => '2001–2002', 'budget' => '12 000 000 FCFA',  'pct' => 100],
        ['titre' => 'Aménagement de la place publique',              'statut' => 'realise',  'dates' => '2021–2021', 'budget' => '8 000 000 FCFA',   'pct' => 100],
        ['titre' => 'Bitumage axe Andé–Carrefour',                   'statut' => 'futur',    'dates' => '2026–2027', 'budget' => '200 000 000 FCFA', 'pct' => 0],
      ];
      $labels = ['en-cours' => 'En cours', 'realise' => 'Réalisé', 'futur' => 'Futur'];
    @endphp

    @foreach($projets as $p)
    <tr>
      <td style="font-weight:800;color:var(--text);max-width:260px;">{{ $p['titre'] }}</td>
      <td>
        <span class="status-badge status--{{ $p['statut'] }}">
          {{ $labels[$p['statut']] ?? $p['statut'] }}
        </span>
      </td>
      <td style="font-size:.78rem;color:var(--text-light);">{{ $p['dates'] }}</td>
      <td style="font-size:.8rem;font-weight:700;">{{ $p['budget'] }}</td>
      <td>
        <div class="progress-wrap">
          <div class="progress-bar">
            <div class="progress-fill" style="width:{{ $p['pct'] }}%"></div>
          </div>
          <span class="progress-pct">{{ $p['pct'] }}%</span>
        </div>
      </td>
      <td>
        <div class="action-btns">
          <a href="#" class="btn-icon btn-icon--view"  title="Voir">     <i class="fas fa-eye"></i>    </a>
          <a href="#" class="btn-icon btn-icon--edit"  title="Modifier"> <i class="fas fa-pen"></i>    </a>
          <a href="#" class="btn-icon btn-icon--del"   title="Supprimer"><i class="fas fa-trash"></i>  </a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="pagination">
  <div class="pagination-info">Affichage 1–8 sur 18 projets</div>
  <div class="pagination-btns">
    <a href="#" class="pag-btn active">1</a>
    <a href="#" class="pag-btn">2</a>
    <a href="#" class="pag-btn">3</a>
  </div>
</div>

{{-- ════════════════════════════════════════════════════════════════════════ --}}
{{-- ── MODAL – Nouveau projet ─────────────────────────────────────────────── --}}
{{-- ════════════════════════════════════════════════════════════════════════ --}}
<div class="modal-overlay" id="modalOverlay" onclick="handleOverlayClick(event)" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-box" id="modalBox">

    {{-- En-tête --}}
    <div class="modal-header">
      <div class="modal-header-left">
        <div class="modal-icon"><i class="fas fa-folder-plus"></i></div>
        <div>
          <div class="modal-title" id="modalTitle">Nouveau projet</div>
          <div class="modal-subtitle">Projets — Ajouter un projet de développement</div>
        </div>
      </div>
      <button class="btn-close" onclick="closeModal()" aria-label="Fermer">
        <i class="fas fa-times"></i>
      </button>
    </div>

    {{-- Formulaire --}}
    <form action="" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="modal-body">

        {{-- Titre --}}
        <div class="form-group">
          <label class="form-label" for="f-titre">Titre du projet <span class="required">*</span></label>
          <input id="f-titre" type="text" name="titre" class="form-control"
                 placeholder="Ex : Construction du Complexe Scolaire…" required>
        </div>

        {{-- Statut + Secteur --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="f-statut-sel">Statut <span class="required">*</span></label>
            <select id="f-statut-sel" name="statut" class="form-control" required>
              <option value="">— Sélectionner —</option>
              <option value="en-cours">En cours</option>
              <option value="realise">Réalisé</option>
              <option value="futur">Futur</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="f-secteur">Secteur</label>
            <select id="f-secteur" name="secteur" class="form-control">
              <option value="">— Sélectionner —</option>
              <option value="education">Éducation</option>
              <option value="sante">Santé</option>
              <option value="eau">Eau &amp; Assainissement</option>
              <option value="infrastructure">Infrastructure</option>
              <option value="energie">Énergie</option>
              <option value="agriculture">Agriculture</option>
            </select>
          </div>
        </div>

        {{-- Description --}}
        <div class="form-group">
          <label class="form-label" for="f-description">Description <span class="required">*</span></label>
          <textarea id="f-description" name="description" class="form-control"
                    placeholder="Décrivez les objectifs et le périmètre du projet…" required></textarea>
        </div>

        {{-- Budget + Avancement --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="f-budget">Budget (FCFA) <span class="required">*</span></label>
            <input id="f-budget" type="text" name="budget" class="form-control"
                   placeholder="Ex : 150 000 000" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="f-avancement">Avancement (%) </label>
            <input id="f-avancement" type="number" name="avancement" class="form-control"
                   min="0" max="100" placeholder="0 – 100">
            <div class="form-hint">Laisser vide si non démarré.</div>
          </div>
        </div>

        {{-- Dates --}}
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="f-date-debut">Date de début <span class="required">*</span></label>
            <input id="f-date-debut" type="date" name="date_debut" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="f-date-fin">Date de fin prévisionnelle</label>
            <input id="f-date-fin" type="date" name="date_fin" class="form-control">
          </div>
        </div>

        {{-- Fichier / Document --}}
        <div class="form-group">
          <label class="form-label">Document / Média</label>
          <div class="file-drop" onclick="document.getElementById('f-media').click()">
            <div class="file-drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
            <div class="file-drop-text">Glisser-déposer ou cliquer pour importer</div>
            <div class="file-drop-sub">JPG, PNG, PDF — max 20 Mo</div>
          </div>
          <input id="f-media" type="file" name="media"
                 accept=".jpg,.jpeg,.png,.pdf" style="display:none">
        </div>

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
  document.getElementById('modalOverlay').classList.add('open');
  document.getElementById('f-titre').focus();
}

function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
}

function handleOverlayClick(e) {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
}

document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModal();
});
</script>
@endpush