@extends('admin.layouts.app')
@section('title','Pages')
@section('page-title','Pages')
@section('page-subtitle','Gérer les pages statiques du site')

@push('styles')
<style>
:root {
  --green        : #1b5e20;
  --green-dark   : #0a3d14;
  --green-light  : #e8f5e9;
  --green-soft   : #c8e6c9;
  --blue         : #1565c0;
  --blue-light   : #e3f2fd;
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
  font-size   : 1.1rem;
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

.status-badge { display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:999px; font-size:.7rem; font-weight:800; }
.status--publie   { background: var(--green-light); color: var(--green); }
.status--brouillon{ background: #eceff1; color: #546e7a; }

.action-btns { display:flex; gap:6px; }
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
.btn-icon--view { color: var(--green); }
.btn-icon--view:hover { background: var(--green-light); border-color: var(--green-soft); }
.btn-icon--edit { color: var(--blue); }
.btn-icon--edit:hover { background: var(--blue-light); border-color: #90caf9; }
.btn-icon--del  { color: #e53935; }
.btn-icon--del:hover  { background: #ffebee; border-color: #ef9a9a; }

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
.form-section-title i      { font-size: .85rem; }
.form-section-title::after { content:''; flex:1; height:1px; background:var(--border); }

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
.field textarea { resize:vertical; min-height:100px; line-height:1.5; }
.field-hint     { font-size:.71rem; color:var(--text-light); }
.char-count     { font-size:.7rem; color:var(--text-light); text-align:right; }

.slug-prefix {
  display       : flex;
  align-items   : center;
  border        : 1px solid var(--border);
  border-radius : var(--radius-sm);
  overflow      : hidden;
  background    : var(--cream);
}
.slug-prefix span {
  padding       : 9px 10px;
  font-size     : .82rem;
  background    : #e8ecea;
  color         : var(--text-light);
  border-right  : 1px solid var(--border);
  white-space   : nowrap;
}
.slug-prefix input {
  border      : none;
  background  : transparent;
  padding     : 9px 12px;
  font-size   : .84rem;
  font-family : 'Nunito', sans-serif;
  color       : var(--text);
  outline     : none;
  flex        : 1;
  width       : 0;
}
.slug-prefix:focus-within { border-color: var(--green); box-shadow: 0 0 0 3px rgba(27,94,32,.08); }

.char-bar      { height:3px; border-radius:999px; background:var(--border); margin-top:4px; overflow:hidden; }
.char-bar-fill { height:100%; border-radius:999px; background:var(--green); transition:width .2s; }

.meta-preview { background:var(--cream); border:1px solid var(--border); border-radius:var(--radius-sm); padding:14px; margin-top:6px; }
.meta-preview .mp-site  { font-size:.7rem; color:#0f9d58; margin-bottom:2px; }
.meta-preview .mp-title { font-size:.88rem; font-weight:800; color:#1a0dab; margin-bottom:3px; }
.meta-preview .mp-desc  { font-size:.78rem; color:var(--text-light); line-height:1.4; }

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
  position     : absolute;
  inset        : 0;
  background   : #c8d5c4;
  border-radius: 999px;
  cursor       : pointer;
  transition   : background .2s;
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
.toggle input:checked + .tslider        { background: var(--green); }
.toggle input:checked + .tslider::after { transform: translateX(16px); }

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

@php
  $pages = $pages ?? [
    ['nom' => 'Accueil',                  'slug' => '/',              'statut' => 'publie'],
    ['nom' => 'La Mutuelle',               'slug' => '/mutuelle',       'statut' => 'publie'],
    ['nom' => 'Éducation & Excellence',    'slug' => '/education',      'statut' => 'publie'],
    ['nom' => 'Espace Communautaire',      'slug' => '/communaute',     'statut' => 'publie'],
    ['nom' => 'Projets',                   'slug' => '/projets',        'statut' => 'publie'],
    ['nom' => 'Actualités',                'slug' => '/actualites',     'statut' => 'publie'],
    ['nom' => 'Vie & Coutumes',            'slug' => '/vie-coutumes',   'statut' => 'brouillon'],
    ['nom' => 'Contact',                   'slug' => '/contact',        'statut' => 'publie'],
  ];
@endphp

{{-- ── Toolbar ── --}}
<div class="page-toolbar">
  <h1>Pages du site <span>({{ count($pages) }})</span></h1>
  <button class="btn-primary" id="btn-open-modal">
    <i class="fas fa-plus"></i> Nouvelle page
  </button>
</div>

{{-- ── Tableau ── --}}
<table class="data-table">
  <thead>
    <tr>
      <th>Page</th>
      <th>Slug</th>
      <th>Statut</th>
      <th>Dernière modification</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pages as $p)
    <tr data-record='@json($p)'>
      <td style="font-weight:800;color:var(--text);">{{ $p['nom'] }}</td>
      <td><code style="background:var(--cream);padding:2px 8px;border-radius:4px;font-size:.78rem;">{{ $p['slug'] }}</code></td>
      <td>
        <span class="status-badge status--{{ $p['statut'] }}">
          <i class="fas fa-circle" style="font-size:.4rem;"></i>
          {{ $p['statut'] === 'publie' ? 'Publié' : 'Brouillon' }}
        </span>
      </td>
      <td style="color:var(--text-light);font-size:.78rem;">{{ $p['maj'] ?? now()->format('d M Y') }}</td>
      <td>
        <div class="action-btns">
          <a href="#" class="btn-icon btn-icon--view" title="Voir" onclick="openPageRecordModal('view', this); return false;"><i class="fas fa-eye"></i></a>
          <a href="#" class="btn-icon btn-icon--edit" title="Modifier" onclick="openPageRecordModal('edit', this); return false;"><i class="fas fa-pen"></i></a>
          <a href="#" class="btn-icon btn-icon--del" title="Supprimer"
             onclick="return confirm('Supprimer cette page ?')"><i class="fas fa-trash"></i></a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- ══════════════════════════════════════════
     MODAL — NOUVELLE PAGE
══════════════════════════════════════════ --}}
<div class="modal-overlay" id="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-title-page">
  <div class="modal-box" id="modal-box-page">

    <div class="modal-header">
      <div class="modal-header-left">
        <div class="modal-icon"><i class="fas fa-file-alt"></i></div>
        <div>
          <div class="modal-title" id="modal-title-page">Nouvelle page</div>
          <div class="modal-subtitle">Créez une page statique pour le site</div>
        </div>
      </div>
      <button class="btn-close" id="btn-close-page" aria-label="Fermer">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="modal-body">

      <div class="tab-bar" role="tablist">
        <button class="tab active" data-tab="general" role="tab">
          <i class="fas fa-cog" style="margin-right:5px;font-size:.75rem;"></i>Général
        </button>
        <button class="tab" data-tab="contenu" role="tab">
          <i class="fas fa-align-left" style="margin-right:5px;font-size:.75rem;"></i>Contenu
        </button>
        <button class="tab" data-tab="seo" role="tab">
          <i class="fas fa-search" style="margin-right:5px;font-size:.75rem;"></i>SEO
        </button>
      </div>

      <form id="form-page" method="POST" action="">
        @csrf
        <input type="hidden" id="p-statut" name="statut" value="brouillon">

        {{-- ─── Onglet Général ─── --}}
        <div id="tab-general">
          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-info-circle"></i> Informations de la page</div>
            <div class="form-row full">
              <div class="field">
                <label for="p-nom">Nom de la page <span class="req">*</span></label>
                <input type="text" id="p-nom" name="nom"
                  placeholder="Ex : À propos de la mutuelle" maxlength="80" required
                  oninput="pSyncSlug(this.value);document.getElementById('p-nc').textContent=this.value.length+'/80'">
                <div style="display:flex;justify-content:flex-end;">
                  <span class="char-count" id="p-nc">0/80</span>
                </div>
              </div>
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="p-slug-input">Slug URL <span class="req">*</span></label>
                <div class="slug-prefix">
                  <span>mudea.ci</span>
                  <input type="text" id="p-slug-input" name="slug" placeholder="/ma-page" oninput="pUpdateMeta()">
                </div>
                <div class="field-hint">Utilisez uniquement des lettres minuscules, chiffres et tirets.</div>
              </div>
            </div>
            <div class="form-row">
              <div class="field">
                <label for="p-statut-select">Statut</label>
                <select id="p-statut-select" name="statut_display" onchange="document.getElementById('p-statut').value=this.value">
                  <option value="brouillon">Brouillon</option>
                  <option value="publie">Publié</option>
                </select>
              </div>
              <div class="field">
                <label for="p-template">Template</label>
                <select id="p-template" name="template">
                  <option value="default">Défaut</option>
                  <option value="full-width">Pleine largeur</option>
                  <option value="sidebar">Avec sidebar</option>
                  <option value="landing">Landing page</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="field">
                <label for="p-ordre">Ordre dans le menu</label>
                <input type="number" id="p-ordre" name="ordre" placeholder="Ex : 5" min="1" max="99">
              </div>
              <div class="field">
                <label for="p-parent">Page parente</label>
                <select id="p-parent" name="parent">
                  <option value="">Aucune (racine)</option>
                  <option value="mutuelle">La Mutuelle</option>
                  <option value="education">Éducation</option>
                  <option value="projets">Projets</option>
                  <option value="communaute">Communauté</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-sliders-h"></i> Options d'affichage</div>
            <div class="toggle-row">
              <div class="toggle-label"><i class="fas fa-bars"></i> Afficher dans le menu principal</div>
              <label class="toggle"><input type="checkbox" name="menu_principal" value="1" checked><span class="tslider"></span></label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label"><i class="fas fa-sitemap"></i> Inclure dans le sitemap</div>
              <label class="toggle"><input type="checkbox" name="sitemap" value="1" checked><span class="tslider"></span></label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label"><i class="fas fa-lock"></i> Accès réservé aux membres</div>
              <label class="toggle"><input type="checkbox" name="membres_only" value="1"><span class="tslider"></span></label>
            </div>
          </div>
        </div>{{-- /tab-general --}}

        {{-- ─── Onglet Contenu ─── --}}
        <div id="tab-contenu" style="display:none;">
          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-heading"></i> En-tête de page</div>
            <div class="form-row full">
              <div class="field">
                <label for="p-titre-h">Titre affiché (H1)</label>
                <input type="text" id="p-titre-h" name="titre_h1" placeholder="Titre visible sur la page…">
                <div class="field-hint">Si vide, le nom de la page sera utilisé.</div>
              </div>
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="p-chapeau">Chapeau / Sous-titre</label>
                <input type="text" id="p-chapeau" name="chapeau" placeholder="Courte phrase introductive sous le titre…">
              </div>
            </div>
          </div>
          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-align-left"></i> Contenu principal</div>
            <div class="form-row full">
              <div class="field">
                <label for="p-contenu">Corps de page <span class="req">*</span></label>
                <textarea id="p-contenu" name="contenu" style="min-height:130px;"
                  placeholder="Rédigez le contenu principal de la page…"></textarea>
                <div class="field-hint">Supporte les balises HTML basiques (gras, italique, liens).</div>
              </div>
            </div>
          </div>
        </div>{{-- /tab-contenu --}}

        {{-- ─── Onglet SEO ─── --}}
        <div id="tab-seo" style="display:none;">
          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-search"></i> Balises meta</div>
            <div class="form-row full">
              <div class="field">
                <label for="p-meta-title">Meta title</label>
                <input type="text" id="p-meta-title" name="meta_title"
                  placeholder="Titre pour les moteurs de recherche…" maxlength="60"
                  oninput="pUpdateMeta();document.getElementById('p-mt-c').textContent=this.value.length+'/60';document.getElementById('p-mt-bar').style.width=Math.min(100,this.value.length/60*100)+'%'">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:3px;">
                  <div class="char-bar" style="flex:1;margin-right:8px;"><div class="char-bar-fill" id="p-mt-bar" style="width:0%"></div></div>
                  <span class="char-count" id="p-mt-c">0/60</span>
                </div>
              </div>
            </div>
            <div class="form-row full">
              <div class="field">
                <label for="p-meta-desc">Meta description</label>
                <textarea id="p-meta-desc" name="meta_description" style="min-height:72px;"
                  placeholder="Description courte pour les résultats Google…" maxlength="160"
                  oninput="pUpdateMeta();document.getElementById('p-md-c').textContent=this.value.length+'/160';document.getElementById('p-md-bar').style.width=Math.min(100,this.value.length/160*100)+'%'"></textarea>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:3px;">
                  <div class="char-bar" style="flex:1;margin-right:8px;"><div class="char-bar-fill" id="p-md-bar" style="width:0%"></div></div>
                  <span class="char-count" id="p-md-c">0/160</span>
                </div>
              </div>
            </div>
            <div class="form-row full">
              <div class="field">
                <label>Aperçu Google</label>
                <div class="meta-preview">
                  <div class="mp-site">mudea.ci › <span id="mp-slug">ma-page</span></div>
                  <div class="mp-title" id="mp-title">Titre de la page — MUDEA</div>
                  <div class="mp-desc" id="mp-desc">La description meta apparaîtra ici une fois saisie.</div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-section">
            <div class="form-section-title"><i class="fas fa-robot"></i> Robots</div>
            <div class="toggle-row">
              <div class="toggle-label"><i class="fas fa-eye"></i> Indexer cette page (index)</div>
              <label class="toggle"><input type="checkbox" name="robots_index" value="1" checked><span class="tslider"></span></label>
            </div>
            <div class="toggle-row">
              <div class="toggle-label"><i class="fas fa-link"></i> Suivre les liens (follow)</div>
              <label class="toggle"><input type="checkbox" name="robots_follow" value="1" checked><span class="tslider"></span></label>
            </div>
          </div>
        </div>{{-- /tab-seo --}}

      </form>
    </div>{{-- /modal-body --}}

    <div class="modal-footer">
      <button type="button" class="btn-draft" id="btn-brouillon-page">
        <i class="fas fa-save"></i> Brouillon
      </button>
      <button type="button" class="btn-ghost" id="btn-annuler-page">
        <i class="fas fa-times"></i> Annuler
      </button>
      <button type="button" class="btn-primary" id="btn-publier-page">
        <i class="fas fa-paper-plane"></i> Créer la page
      </button>
    </div>

  </div>{{-- /modal-box --}}
</div>{{-- /modal-overlay --}}

@endsection

@push('scripts')
<script>
(function () {

  /* ── Références DOM ─────────────────────────────────────────────────── */
  var overlay      = document.getElementById('modal-overlay');
  var btnOpen       = document.getElementById('btn-open-modal');
  var btnClose      = document.getElementById('btn-close-page');
  var btnAnnuler    = document.getElementById('btn-annuler-page');
  var btnBrouillon  = document.getElementById('btn-brouillon-page');
  var btnPublier    = document.getElementById('btn-publier-page');
  var formPage      = document.getElementById('form-page');
  var modalTitle    = document.getElementById('modal-title-page');
  var modalSubtitle = document.querySelector('#modal-overlay .modal-subtitle');
  var modalIcon     = document.querySelector('#modal-overlay .modal-icon i');
  var submitButtons = [btnBrouillon, btnPublier];

  /* ── Ouverture / Fermeture ──────────────────────────────────────────── */
  function openModal() {
    overlay.classList.add('open');
    document.getElementById('p-nom').focus();
  }

  function closeModal() {
    overlay.classList.remove('open');
  }

  function resetModalState() {
    modalTitle.textContent = 'Nouvelle page';
    modalSubtitle.textContent = 'Créez une page statique pour le site';
    modalIcon.className = 'fas fa-file-alt';
    formPage.querySelectorAll('input, select, textarea').forEach(function (field) {
      field.disabled = false;
      field.readOnly = false;
    });
    submitButtons.forEach(function (button) {
      button.style.display = '';
    });
  }

  function setFormMode(mode) {
    var isView = mode === 'view';
    formPage.querySelectorAll('input, select, textarea').forEach(function (field) {
      if (field.type === 'hidden') return;
      if (field.tagName === 'SELECT' || field.type === 'file' || field.type === 'checkbox' || field.type === 'radio') {
        field.disabled = isView;
      } else {
        field.readOnly = isView;
      }
    });
    submitButtons.forEach(function (button) {
      button.style.display = isView ? 'none' : '';
    });
  }

  function fillPageForm(record) {
    document.getElementById('p-nom').value = record.nom || '';
    document.getElementById('p-slug-input').value = record.slug || '';
    document.getElementById('p-statut').value = record.statut || 'brouillon';
    document.getElementById('p-statut-select').value = record.statut || 'brouillon';
    document.getElementById('p-nc').textContent = (record.nom || '').length + '/80';
    pUpdateMeta();
  }

  window.openPageRecordModal = function (mode, trigger) {
    var row = trigger.closest('tr');
    var record = row && row.dataset.record ? JSON.parse(row.dataset.record) : {};

    resetModalState();
    fillPageForm(record);

    if (mode === 'view') {
      modalTitle.textContent = 'Voir la page';
      modalSubtitle.textContent = 'Aperçu des informations de la page';
      modalIcon.className = 'fas fa-eye';
    } else {
      modalTitle.textContent = 'Modifier la page';
      modalSubtitle.textContent = 'Ajustez les informations avant enregistrement';
      modalIcon.className = 'fas fa-pen';
    }

    setFormMode(mode);
    overlay.classList.add('open');
    document.getElementById('p-nom').focus();
  };

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
  var tabIds = ['general', 'contenu', 'seo'];

  document.querySelectorAll('#modal-box-page .tab-bar .tab').forEach(function (tab) {
    tab.addEventListener('click', function () {
      document.querySelectorAll('#modal-box-page .tab-bar .tab').forEach(function (t) {
        t.classList.remove('active');
      });
      this.classList.add('active');
      tabIds.forEach(function (id) {
        document.getElementById('tab-' + id).style.display = 'none';
      });
      document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
    });
  });

  /* ── Slug auto depuis le nom ────────────────────────────────────────── */
  window.pSyncSlug = function (v) {
    var s = '/' + v.toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9\s-]/g, '')
      .trim()
      .replace(/\s+/g, '-');
    document.getElementById('p-slug-input').value = s;
    pUpdateMeta();
  };

  /* ── Aperçu Google ─────────────────────────────────────────────────── */
  window.pUpdateMeta = function () {
    var t = document.getElementById('p-meta-title').value;
    var d = document.getElementById('p-meta-desc').value;
    var s = document.getElementById('p-slug-input').value;
    document.getElementById('mp-title').textContent =
      (t || (document.getElementById('p-nom').value || 'Titre de la page')) + ' — MUDEA';
    document.getElementById('mp-desc').textContent =
      d || 'La description meta apparaîtra ici une fois saisie.';
    document.getElementById('mp-slug').textContent = (s || '/ma-page').replace('/', '');
  };

  /* ── Brouillon ─────────────────────────────────────────────────────── */
  btnBrouillon.addEventListener('click', function () {
    document.getElementById('p-statut').value = 'brouillon';
    formPage.submit();
  });

  /* ── Publier ───────────────────────────────────────────────────────── */
  btnPublier.addEventListener('click', function () {
    var n = document.getElementById('p-nom').value.trim();
    var s = document.getElementById('p-slug-input').value.trim();
    var c = document.getElementById('p-contenu').value.trim();

    if (!n || !s || !c) {
      alert('Veuillez renseigner le nom, le slug et le contenu de la page.');
      return;
    }
    document.getElementById('p-statut').value = 'publie';
    formPage.submit();
  });

})();
</script>
@endpush
