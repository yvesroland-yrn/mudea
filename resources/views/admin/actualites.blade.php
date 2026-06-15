@extends('admin.layouts.app')
@section('title','Actualités')
@section('page-title','Actualités')
@section('page-subtitle','Gérer les actualités du site')

@push('styles')
<style>
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

body, input, select, textarea, button {
  font-family: 'Nunito', sans-serif;
}

/* ── Toolbar ── */
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

/* ── Boutons ── */
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

.btn-ghost {
  display        : inline-flex;
  align-items    : center;
  gap            : 7px;
  background     : transparent;
  color          : var(--text-mid);
  padding        : 9px 16px;
  border-radius  : var(--radius-sm);
  font-size      : .82rem;
  font-weight    : 800;
  border         : 1px solid var(--border);
  cursor         : pointer;
  transition     : all .18s;
}
.btn-ghost:hover { border-color: var(--green); color: var(--green); background: var(--green-light); }

.btn-draft {
  display        : inline-flex;
  align-items    : center;
  gap            : 7px;
  background     : #eceff1;
  color          : #546e7a;
  padding        : 9px 16px;
  border-radius  : var(--radius-sm);
  font-size      : .82rem;
  font-weight    : 800;
  border         : 1px solid #cfd8dc;
  cursor         : pointer;
  transition     : all .18s;
}
.btn-draft:hover { background: #cfd8dc; color: #455a64; }

/* ── Filtres ── */
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
}
.filter-input:focus    { border-color: var(--green); }
.filter-input--search  { flex: 1; min-width: 180px; }

/* ── Tableau ── */
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

.article-thumb { width:52px; height:38px; border-radius:6px; overflow:hidden; background:var(--green-light); flex-shrink:0; }
.article-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.article-thumb-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--text-light); font-size:.8rem; }
.article-title-cell { display:flex; align-items:center; gap:12px; }
.article-title { font-weight:800; color:var(--text); font-size:.85rem; line-height:1.3; }

.cat-badge { display:inline-block; padding:3px 10px; border-radius:999px; font-size:.62rem; font-weight:900; text-transform:uppercase; letter-spacing:.08em; color:white; }
.cat--projets    { background: #1b5e20; }
.cat--education  { background: #1565c0; }
.cat--communaute { background: #2e7d32; }
.cat--culture    { background: #6a1b9a; }
.cat--sante      { background: #c62828; }
.cat--actualite  { background: #e65100; }

.status-badge { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:999px; font-size:.7rem; font-weight:800; }
.status--publie   { background: var(--green-light); color: var(--green); }
.status--brouillon{ background: #eceff1; color: #546e7a; }
.status--archive  { background: #fff3e0; color: #e65100; }

.action-btns { display:flex; gap:6px; align-items:center; }
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

/* ── Pagination ── */
.pagination { display:flex; align-items:center; justify-content:space-between; padding:14px 4px 0; }
.pagination-info { font-size:.78rem; color:var(--text-light); }
.pagination-btns { display:flex; gap:6px; }
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

/* ══════════════════════════════════════════
   MODAL
══════════════════════════════════════════ */
.modal-overlay {
  position       : fixed;
  inset          : 0;
  background     : rgba(10,20,14,.52);
  display        : flex;
  align-items    : center;
  justify-content: center;
  z-index        : 1050;
  padding        : 16px;
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
  width         : 100%;
  max-width     : 700px;
  max-height    : 92vh;
  overflow-y    : auto;
  box-shadow    : 0 24px 60px rgba(0,0,0,.2);
  transform     : translateY(20px) scale(.98);
  opacity       : 0;
  transition    : transform .25s cubic-bezier(.22,1,.36,1), opacity .22s;
}
.modal-overlay.open .modal-box {
  transform : translateY(0) scale(1);
  opacity   : 1;
}

/* ── Header modal ── */
.modal-header {
  display         : flex;
  align-items     : center;
  justify-content : space-between;
  padding         : 18px 22px 16px;
  border-bottom   : 1px solid var(--border);
  position        : sticky;
  top             : 0;
  background      : var(--white);
  z-index         : 2;
}
.modal-header-left { display:flex; align-items:center; gap:10px; }
.modal-icon {
  width          : 36px;
  height         : 36px;
  border-radius  : var(--radius-sm);
  background     : var(--green-light);
  display        : flex;
  align-items    : center;
  justify-content: center;
  color          : var(--green);
  font-size      : 1rem;
  flex-shrink    : 0;
}
.modal-title    { font-size:.95rem; font-weight:800; color:var(--text); margin:0; }
.modal-subtitle { font-size:.75rem; color:var(--text-light); margin:2px 0 0; }

.btn-close {
  width          : 30px;
  height         : 30px;
  border-radius  : var(--radius-sm);
  border         : 1px solid var(--border);
  background     : var(--cream);
  display        : flex;
  align-items    : center;
  justify-content: center;
  cursor         : pointer;
  color          : var(--text-mid);
  font-size      : .9rem;
  transition     : all .18s;
  flex-shrink    : 0;
}
.btn-close:hover { background: #ffebee; color: #e53935; border-color: #ef9a9a; }

/* ── Corps modal ── */
.modal-body { padding: 20px 22px; }

.tab-bar {
  display       : flex;
  gap           : 2px;
  background    : var(--cream);
  border-radius : var(--radius-sm);
  padding       : 3px;
  margin-bottom : 20px;
}
.tab {
  flex           : 1;
  padding        : 8px;
  text-align     : center;
  font-size      : .75rem;
  font-weight    : 800;
  border-radius  : 6px;
  cursor         : pointer;
  border         : none;
  background     : transparent;
  color          : var(--text-light);
  font-family    : 'Nunito', sans-serif;
  transition     : all .18s;
}
.tab.active { background: var(--white); color: var(--green); box-shadow: 0 1px 4px rgba(0,0,0,.08); }

.form-section       { margin-bottom: 22px; }
.form-section-title {
  font-size      : .7rem;
  font-weight    : 900;
  text-transform : uppercase;
  letter-spacing : .1em;
  color          : var(--text-light);
  margin-bottom  : 12px;
  display        : flex;
  align-items    : center;
  gap            : 7px;
}
.form-section-title i     { font-size: .85rem; }
.form-section-title::after{ content:''; flex:1; height:1px; background:var(--border); }

.form-row      { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
.form-row.full { grid-template-columns: 1fr; }

.field { display:flex; flex-direction:column; gap:5px; }
.field label {
  font-size      : .72rem;
  font-weight    : 900;
  color          : var(--text);
  text-transform : uppercase;
  letter-spacing : .07em;
  display        : flex;
  align-items    : center;
  gap            : 4px;
}
.field label .req { color: #c62828; font-size:.8rem; }
.field input,
.field select,
.field textarea {
  border        : 1px solid var(--border);
  border-radius : var(--radius-sm);
  padding       : 9px 12px;
  font-size     : .84rem;
  font-family   : 'Nunito', sans-serif;
  color         : var(--text);
  background    : var(--cream);
  outline       : none;
  transition    : border-color .18s, background .18s;
}
.field input:focus,
.field select:focus,
.field textarea:focus {
  border-color : var(--green);
  background   : var(--white);
  box-shadow   : 0 0 0 3px rgba(27,94,32,.08);
}
.field textarea  { resize:vertical; min-height:88px; line-height:1.5; }
.field-hint      { font-size:.71rem; color:var(--text-light); }
.char-count      { font-size:.7rem; color:var(--text-light); text-align:right; }

/* ── Upload ── */
.upload-zone {
  border        : 1.5px dashed var(--green-soft);
  border-radius : var(--radius-sm);
  background    : var(--green-light);
  padding       : 22px 16px;
  text-align    : center;
  cursor        : pointer;
  display       : block;
  transition    : all .18s;
}
.upload-zone:hover          { border-color: var(--green); background: #dcedc8; }
.upload-zone i              { font-size:1.5rem; color:var(--green); display:block; margin-bottom:6px; }
.upload-zone .uz-title      { font-size:.82rem; font-weight:800; color:var(--green); }
.upload-zone .uz-sub        { font-size:.71rem; color:var(--text-light); margin-top:3px; }
.upload-zone input[type=file]{ display:none; }
.preview-img {
  width         : 100%;
  height        : 110px;
  object-fit    : cover;
  border-radius : var(--radius-sm);
  display       : none;
  margin-top    : 8px;
  border        : 1px solid var(--border);
}

/* ── Tags ── */
.tags-wrap {
  border        : 1px solid var(--border);
  border-radius : var(--radius-sm);
  padding       : 7px 10px;
  background    : var(--cream);
  display       : flex;
  flex-wrap     : wrap;
  gap           : 6px;
  min-height    : 40px;
  align-items   : center;
  cursor        : text;
  transition    : all .18s;
}
.tags-wrap:focus-within {
  border-color : var(--green);
  background   : var(--white);
  box-shadow   : 0 0 0 3px rgba(27,94,32,.08);
}
.tag-pill {
  display     : inline-flex;
  align-items : center;
  gap         : 4px;
  background  : var(--green-soft);
  color       : #1b5e20;
  padding     : 2px 8px 2px 10px;
  border-radius: 999px;
  font-size   : .72rem;
  font-weight : 800;
}
.tag-pill button {
  background  : none;
  border      : none;
  cursor      : pointer;
  color       : #1b5e20;
  padding     : 0;
  line-height : 1;
  font-size   : .82rem;
  opacity     : .7;
}
.tag-pill button:hover { opacity: 1; }
.tags-wrap input {
  border      : none;
  background  : none;
  outline     : none;
  font-size   : .82rem;
  font-family : 'Nunito', sans-serif;
  color       : var(--text);
  flex        : 1;
  min-width   : 80px;
}

/* ── Toggles ── */
.toggle-row {
  display         : flex;
  align-items     : center;
  justify-content : space-between;
  padding         : 10px 0;
  border-bottom   : 1px solid var(--border);
}
.toggle-row:last-child { border-bottom: none; }
.toggle-label {
  display    : flex;
  align-items: center;
  gap        : 8px;
  font-size  : .83rem;
  font-weight: 700;
  color      : var(--text-mid);
}
.toggle-label i { color: var(--text-light); font-size:.9rem; }
.toggle { position:relative; width:38px; height:22px; flex-shrink:0; }
.toggle input { opacity:0; width:0; height:0; position:absolute; }
.tslider {
  position    : absolute;
  inset       : 0;
  background  : #c8d5c4;
  border-radius: 999px;
  cursor      : pointer;
  transition  : background .2s;
}
.tslider::after {
  content      : '';
  position     : absolute;
  left         : 3px;
  top          : 3px;
  width        : 16px;
  height       : 16px;
  border-radius: 50%;
  background   : white;
  transition   : transform .2s;
  box-shadow   : 0 1px 3px rgba(0,0,0,.2);
}
.toggle input:checked + .tslider             { background: var(--green); }
.toggle input:checked + .tslider::after      { transform: translateX(16px); }

/* ── Footer modal ── */
.modal-footer {
  display         : flex;
  align-items     : center;
  justify-content : flex-end;
  gap             : 10px;
  padding         : 14px 22px 18px;
  border-top      : 1px solid var(--border);
  background      : var(--cream);
  position        : sticky;
  bottom          : 0;
  z-index         : 2;
}
</style>
@endpush

@section('content')

{{-- ── Toolbar ── --}}
<div class="page-toolbar">
  <h1>Toutes les actualités <span>({{ $total ?? 125 }})</span></h1>
  <button class="btn-primary" id="btn-open-modal">
    <i class="fas fa-plus"></i> Nouvelle actualité
  </button>
</div>

{{-- ── Filtres ── --}}
<div class="filters-bar">
  <input type="text" class="filter-input filter-input--search" placeholder="Rechercher une actualité...">
  <select class="filter-input">
    <option>Toutes catégories</option>
    <option>Projets</option>
    <option>Éducation</option>
    <option>Communauté</option>
    <option>Culture</option>
  </select>
  <select class="filter-input">
    <option>Tous statuts</option>
    <option>Publié</option>
    <option>Brouillon</option>
    <option>Archivé</option>
  </select>
  <select class="filter-input">
    <option>Trier par date</option>
    <option>Trier par titre</option>
    <option>Trier par vues</option>
  </select>
</div>

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
    @php
      $actus = [
        ['titre' => "Inauguration du Complexe Scolaire d'Excellence", 'cat' => 'education',  'cat_l' => 'Éducation',  'statut' => 'publie',   'auteur' => 'Admin MUDEA', 'date' => '12 Mai 2024',  'vues' => '1 240', 'img' => 'actu-1'],
        ['titre' => "Avancement des travaux du château d'eau",        'cat' => 'projets',    'cat_l' => 'Projets',    'statut' => 'publie',   'auteur' => 'Admin MUDEA', 'date' => '08 Mai 2024',  'vues' => '892',   'img' => 'actu-2'],
        ['titre' => 'Lancement des cours de soutien pour les examens','cat' => 'education',  'cat_l' => 'Éducation',  'statut' => 'publie',   'auteur' => 'Admin MUDEA', 'date' => '05 Mai 2024',  'vues' => '654',   'img' => 'actu-3'],
        ['titre' => 'Rencontre avec les chefs de familles',           'cat' => 'communaute', 'cat_l' => 'Communauté', 'statut' => 'publie',   'auteur' => 'Admin MUDEA', 'date' => '02 Mai 2024',  'vues' => '431',   'img' => 'actu-4'],
        ['titre' => "Festival des masques d'Andé 2024",              'cat' => 'culture',    'cat_l' => 'Culture',    'statut' => 'publie',   'auteur' => 'Admin MUDEA', 'date' => '28 Avr. 2024', 'vues' => '2 100', 'img' => 'actu-5'],
        ['titre' => 'Brouillon – Programme de reboisement',          'cat' => 'projets',    'cat_l' => 'Projets',    'statut' => 'brouillon','auteur' => 'Admin MUDEA', 'date' => '25 Avr. 2024', 'vues' => '0',     'img' => ''],
        ['titre' => 'Résultats du CEP 2023',                         'cat' => 'education',  'cat_l' => 'Éducation',  'statut' => 'archive',  'auteur' => 'Admin MUDEA', 'date' => '15 Juin 2023', 'vues' => '3 450', 'img' => ''],
      ];
    @endphp

    @foreach($actus as $a)
    <tr>
      <td><input type="checkbox"></td>
      <td>
        <div class="article-title-cell">
          <div class="article-thumb">
            <img src="{{ asset('images/actualites/'.$a['img'].'.jpg') }}" alt=""
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
            <div class="article-thumb-placeholder" style="display:none;">
              <i class="fas fa-image"></i>
            </div>
          </div>
          <div class="article-title">{{ $a['titre'] }}</div>
        </div>
      </td>
      <td><span class="cat-badge cat--{{ $a['cat'] }}">{{ $a['cat_l'] }}</span></td>
      <td>
        <span class="status-badge status--{{ $a['statut'] }}">
          <i class="fas fa-circle" style="font-size:.4rem;"></i>
          @if($a['statut'] === 'publie') Publié
          @elseif($a['statut'] === 'brouillon') Brouillon
          @else Archivé
          @endif
        </span>
      </td>
      <td>{{ $a['auteur'] }}</td>
      <td style="font-size:.78rem; color:var(--text-light);">{{ $a['date'] }}</td>
      <td style="font-size:.78rem; font-weight:700;">{{ $a['vues'] }}</td>
      <td>
        <div class="action-btns">
          <a href="#" class="btn-icon btn-icon--view" title="Voir"><i class="fas fa-eye"></i></a>
          <a href="#" class="btn-icon btn-icon--edit" title="Modifier"><i class="fas fa-pen"></i></a>
          <a href="#" class="btn-icon btn-icon--del" title="Supprimer"
            onclick="return confirm('Supprimer cette actualité ?')"><i class="fas fa-trash"></i></a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- ── Pagination ── --}}
<div class="pagination">
  <div class="pagination-info">Affichage 1–7 sur 125 actualités</div>
  <div class="pagination-btns">
    <a href="#" class="pag-btn"><i class="fas fa-chevron-left"></i></a>
    <a href="#" class="pag-btn active">1</a>
    <a href="#" class="pag-btn">2</a>
    <a href="#" class="pag-btn">3</a>
    <span class="pag-btn" style="cursor:default;">…</span>
    <a href="#" class="pag-btn">18</a>
    <a href="#" class="pag-btn"><i class="fas fa-chevron-right"></i></a>
  </div>
</div>

{{-- ══════════════════════════════════════════
     MODAL — NOUVELLE ACTUALITÉ
══════════════════════════════════════════ --}}
<div class="modal-overlay" id="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-title-actu">
  <div class="modal-box" id="modal-box-actu">

    {{-- Header --}}
    <div class="modal-header">
      <div class="modal-header-left">
        <div class="modal-icon"><i class="fas fa-newspaper"></i></div>
        <div>
          <div class="modal-title" id="modal-title-actu">Nouvelle actualité</div>
          <div class="modal-subtitle">Remplissez les informations puis publiez</div>
        </div>
      </div>
      <button class="btn-close" id="btn-close-actu" aria-label="Fermer">
        <i class="fas fa-times"></i>
      </button>
    </div>

    {{-- Body --}}
    <div class="modal-body">

      {{-- Onglets --}}
      <div class="tab-bar" role="tablist">
        <button class="tab active" data-tab="contenu" role="tab">
          <i class="fas fa-align-left" style="margin-right:5px;font-size:.75rem;"></i>Contenu
        </button>
        <button class="tab" data-tab="media" role="tab">
          <i class="fas fa-photo-video" style="margin-right:5px;font-size:.75rem;"></i>Médias
        </button>
        <button class="tab" data-tab="options" role="tab">
          <i class="fas fa-cog" style="margin-right:5px;font-size:.75rem;"></i>Options
        </button>
      </div>

      <form id="form-actu" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="m-statut" name="statut" value="brouillon">

        {{-- ─── Onglet Contenu ─── --}}
        <div id="tab-contenu">

          <div class="form-section">
            <div class="form-section-title">
              <i class="fas fa-info-circle"></i> Informations générales
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="m-titre">Titre <span class="req">*</span></label>
                <input type="text" id="m-titre" name="titre"
                  placeholder="Ex : Inauguration du complexe scolaire d'Andé…"
                  maxlength="120" required
                  oninput="document.getElementById('m-tc').textContent=this.value.length+'/120'">
                <div style="display:flex;justify-content:flex-end;">
                  <span class="char-count" id="m-tc">0/120</span>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="field">
                <label for="m-cat">Catégorie <span class="req">*</span></label>
                <select id="m-cat" name="categorie" required>
                  <option value="">-- Choisir --</option>
                  <option value="projets">Projets</option>
                  <option value="education">Éducation</option>
                  <option value="communaute">Communauté</option>
                  <option value="culture">Culture</option>
                  <option value="sante">Santé</option>
                  <option value="actualite">Actualité</option>
                </select>
              </div>
              <div class="field">
                <label for="m-date">Date de publication</label>
                <input type="date" id="m-date" name="date_publication">
              </div>
            </div>
            <div class="form-row">
              <div class="field">
                <label for="m-auteur">Auteur</label>
                <input type="text" id="m-auteur" name="auteur" value="Admin MUDEA">
              </div>
              <div class="field">
                <label for="m-slug">Slug URL</label>
                <input type="text" id="m-slug" name="slug" placeholder="Généré automatiquement">
              </div>
            </div>
          </div>

          <div class="form-section">
            <div class="form-section-title">
              <i class="fas fa-align-left"></i> Contenu
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="m-resume">Résumé / Extrait <span class="req">*</span></label>
                <textarea id="m-resume" name="resume" maxlength="300" required
                  placeholder="Courte description affichée dans les listes et aperçus…"
                  oninput="document.getElementById('m-rc').textContent=this.value.length+'/300'"></textarea>
                <div style="display:flex;justify-content:flex-end;">
                  <span class="char-count" id="m-rc">0/300</span>
                </div>
              </div>
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="m-contenu">Contenu principal <span class="req">*</span></label>
                <textarea id="m-contenu" name="contenu" style="min-height:130px;" required
                  placeholder="Rédigez le contenu complet de l'actualité…"></textarea>
                <div class="field-hint">Supporte les balises HTML basiques (gras, italique, liens).</div>
              </div>
            </div>
          </div>

        </div>{{-- /tab-contenu --}}

        {{-- ─── Onglet Médias ─── --}}
        <div id="tab-media" style="display:none;">

          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-image"></i> Image à la une</div>
            <label class="upload-zone" for="m-img" id="uz-label">
              <i class="fas fa-cloud-upload-alt"></i>
              <div class="uz-title">Cliquez pour choisir une image</div>
              <div class="uz-sub">JPG, PNG ou WEBP — max 2 Mo</div>
              <input type="file" id="m-img" name="image" accept="image/*">
            </label>
            <img id="m-preview" class="preview-img" alt="Aperçu de l'image">
          </div>

          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-tags"></i> Mots-clés</div>
            <div class="field">
              <div class="tags-wrap" id="tags-wrap">
                <input type="text" id="tag-in" placeholder="Ajouter un mot-clé…">
              </div>
              <input type="hidden" id="tags-hidden" name="tags">
              <div class="field-hint">Appuyez sur Entrée ou virgule pour confirmer.</div>
            </div>
          </div>

        </div>{{-- /tab-media --}}

        {{-- ─── Onglet Options ─── --}}
        <div id="tab-options" style="display:none;">

          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-sliders-h"></i> Options de publication</div>
            <div class="toggle-row">
              <div class="toggle-label">
                <i class="fas fa-bell"></i> Notifier les abonnés par email
              </div>
              <label class="toggle">
                <input type="checkbox" name="notifier" value="1" checked>
                <span class="tslider"></span>
              </label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label">
                <i class="fas fa-share-alt"></i> Partager automatiquement sur les réseaux
              </div>
              <label class="toggle">
                <input type="checkbox" name="partager_reseaux" value="1">
                <span class="tslider"></span>
              </label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label">
                <i class="fas fa-thumbtack"></i> Épingler en haut de la liste
              </div>
              <label class="toggle">
                <input type="checkbox" name="epingle" value="1">
                <span class="tslider"></span>
              </label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label">
                <i class="fas fa-comments"></i> Autoriser les commentaires
              </div>
              <label class="toggle">
                <input type="checkbox" name="commentaires" value="1" checked>
                <span class="tslider"></span>
              </label>
            </div>
          </div>

        </div>{{-- /tab-options --}}

      </form>
    </div>{{-- /modal-body --}}

    {{-- Footer --}}
    <div class="modal-footer">
      <button type="button" class="btn-draft" id="btn-brouillon">
        <i class="fas fa-save"></i> Enregistrer brouillon
      </button>
      <button type="button" class="btn-ghost" id="btn-annuler-actu">
        <i class="fas fa-times"></i> Annuler
      </button>
      <button type="button" class="btn-primary" id="btn-publier">
        <i class="fas fa-paper-plane"></i> Publier l'actualité
      </button>
    </div>

  </div>{{-- /modal-box --}}
</div>{{-- /modal-overlay --}}

@endsection

@push('scripts')
<script>
(function () {

  /* ── Références DOM ─────────────────────────────────────────────────── */
  var overlay    = document.getElementById('modal-overlay');
  var btnOpen    = document.getElementById('btn-open-modal');
  var btnClose   = document.getElementById('btn-close-actu');
  var btnAnnuler = document.getElementById('btn-annuler-actu');
  var btnBrouillon = document.getElementById('btn-brouillon');
  var btnPublier = document.getElementById('btn-publier');
  var formActu   = document.getElementById('form-actu');
  var tagsInput  = document.getElementById('tag-in');
  var tagsWrap   = document.getElementById('tags-wrap');

  var actuTags   = [];

  /* ── Ouverture / Fermeture ──────────────────────────────────────────── */
  function openModal() {
    overlay.classList.add('open');
    document.getElementById('m-titre').focus();
  }

  function closeModal() {
    overlay.classList.remove('open');
  }

  btnOpen.addEventListener('click', openModal);
  btnClose.addEventListener('click', closeModal);
  btnAnnuler.addEventListener('click', closeModal);

  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeModal();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
  });

  /* ── Onglets ────────────────────────────────────────────────────────── */
  var tabIds = ['contenu', 'media', 'options'];

  document.querySelectorAll('#modal-box-actu .tab-bar .tab').forEach(function (tab) {
    tab.addEventListener('click', function () {
      document.querySelectorAll('#modal-box-actu .tab-bar .tab').forEach(function (t) {
        t.classList.remove('active');
      });
      this.classList.add('active');
      tabIds.forEach(function (id) {
        document.getElementById('tab-' + id).style.display = 'none';
      });
      document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
    });
  });

  /* ── Aperçu image ───────────────────────────────────────────────────── */
  document.getElementById('m-img').addEventListener('change', function (e) {
    var file = e.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function (ev) {
      var preview = document.getElementById('m-preview');
      preview.src = ev.target.result;
      preview.style.display = 'block';
      document.querySelector('#uz-label .uz-title').textContent = file.name;
    };
    reader.readAsDataURL(file);
  });

  /* Clic sur la zone upload → ouvre le sélecteur */
  document.getElementById('uz-label').addEventListener('click', function (e) {
    if (e.target !== document.getElementById('m-img')) {
      document.getElementById('m-img').click();
    }
  });

  /* ── Tags ───────────────────────────────────────────────────────────── */
  tagsWrap.addEventListener('click', function () {
    tagsInput.focus();
  });

  tagsInput.addEventListener('keydown', function (e) {
    if (e.key !== 'Enter' && e.key !== ',') return;
    e.preventDefault();
    var val = this.value.trim().replace(/,$/, '');
    if (!val || actuTags.includes(val)) { this.value = ''; return; }
    actuTags.push(val);

    var pill = document.createElement('span');
    pill.className  = 'tag-pill';
    pill.dataset.tag = val;
    pill.innerHTML  = val + '<button type="button" aria-label="Supprimer">×</button>';
    pill.querySelector('button').addEventListener('click', function () {
      actuTags = actuTags.filter(function (t) { return t !== pill.dataset.tag; });
      document.getElementById('tags-hidden').value = actuTags.join(',');
      pill.remove();
    });
    tagsWrap.insertBefore(pill, tagsInput);
    document.getElementById('tags-hidden').value = actuTags.join(',');
    this.value = '';
  });

  /* ── Slug auto depuis le titre ──────────────────────────────────────── */
  document.getElementById('m-titre').addEventListener('input', function () {
    var slug = this.value
      .toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9\s-]/g, '')
      .trim()
      .replace(/\s+/g, '-');
    document.getElementById('m-slug').value = slug;
  });

  /* ── Brouillon ──────────────────────────────────────────────────────── */
  btnBrouillon.addEventListener('click', function () {
    document.getElementById('m-statut').value = 'brouillon';
    formActu.submit();
  });

  /* ── Publier ────────────────────────────────────────────────────────── */
  btnPublier.addEventListener('click', function () {
    var titre = document.getElementById('m-titre').value.trim();
    var cat   = document.getElementById('m-cat').value;
    var resume = document.getElementById('m-resume').value.trim();
    var contenu = document.getElementById('m-contenu').value.trim();

    if (!titre || !cat || !resume || !contenu) {
      alert('Veuillez renseigner tous les champs obligatoires (titre, catégorie, résumé, contenu).');
      return;
    }
    document.getElementById('m-statut').value = 'publie';
    formActu.submit();
  });

})();
</script>
@endpush