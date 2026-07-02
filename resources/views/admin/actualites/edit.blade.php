@extends('admin.layouts.app')
@section('title', 'Modifier Actualité')
@section('page-title', 'Modifier Actualité')
@section('page-subtitle', 'Modifier les informations de l\'actualité')

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

        /* ── Form Container ── */
        .form-container {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            max-width: 900px;
            margin: 0 auto;
        }

        .form-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-header-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 1.1rem;
        }

        .form-header-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text);
        }

        .form-body {
            padding: 24px;
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
            padding: 10px;
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

        .current-image {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: var(--radius-sm);
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

        /* ── Footer ── */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: .85rem;
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
        <div></div>
        <a href="{{ route('admin.actualites.index') }}" class="btn-ghost">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    {{-- ── Form Container ── --}}
    <div class="form-container">
        <div class="form-header">
            <div class="form-header-icon">
                <i class="fas fa-pen"></i>
            </div>
            <div class="form-header-title">Modifier l'actualité</div>
        </div>
 
        <div class="form-body">
            @if ($errors->any())
                <div class="error-message">
                    <strong>Erreurs de validation :</strong>
                    <ul style="margin: 8px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> 
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.actualites.update', $actualite->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="statut" value="{{ $actualite->statut }}">

                {{-- Onglets --}}
                <div class="tab-bar" role="tablist">
                    <button type="button" class="tab active" data-tab="contenu" role="tab">
                        <i class="fas fa-align-left" style="margin-right:5px;font-size:.75rem;"></i>Contenu
                    </button>
                    <button type="button" class="tab" data-tab="media" role="tab">
                        <i class="fas fa-photo-video" style="margin-right:5px;font-size:.75rem;"></i>Médias
                    </button>
                    <button type="button" class="tab" data-tab="options" role="tab">
                        <i class="fas fa-cog" style="margin-right:5px;font-size:.75rem;"></i>Options
                    </button>
                </div>

                {{-- ─── Onglet Contenu ─── --}}
                <div id="tab-contenu">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-info-circle"></i> Informations générales
                        </div>
                        <div class="form-row full">
                            <div class="field">
                                <label for="titre">Titre <span class="req">*</span></label>
                                <input type="text" id="titre" name="titre"
                                    placeholder="Ex : Inauguration du complexe scolaire d'Andé…" maxlength="120" required
                                    value="{{ old('titre', $actualite->titre) }}"
                                    oninput="document.getElementById('m-tc').textContent=this.value.length+'/120'">
                                <div style="display:flex;justify-content:flex-end;">
                                    <span class="char-count"
                                        id="m-tc">{{ strlen(old('titre', $actualite->titre)) }}/120</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label for="categorie">Catégorie <span class="req">*</span></label>
                                <select id="categorie" name="categorie" required>
                                    <option value="">-- Choisir --</option>
                                    <option value="projets"
                                        {{ old('categorie', $actualite->categorie) == 'projets' ? 'selected' : '' }}>Projets
                                    </option>
                                    <option value="education"
                                        {{ old('categorie', $actualite->categorie) == 'education' ? 'selected' : '' }}>
                                        Éducation</option>
                                    <option value="communaute"
                                        {{ old('categorie', $actualite->categorie) == 'communaute' ? 'selected' : '' }}>
                                        Communauté</option>
                                    <option value="culture"
                                        {{ old('categorie', $actualite->categorie) == 'culture' ? 'selected' : '' }}>
                                        Culture
                                    </option>
                                    <option value="sante"
                                        {{ old('categorie', $actualite->categorie) == 'sante' ? 'selected' : '' }}>Santé
                                    </option>
                                    <option value="actualite"
                                        {{ old('categorie', $actualite->categorie) == 'actualite' ? 'selected' : '' }}>
                                        Actualité</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="date_publication">Date de publication</label>
                                <input type="date" id="date_publication" name="date_publication"
                                    value="{{ old('date_publication', $actualite->date_publication ? $actualite->date_publication->format('Y-m-d') : '') }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label for="auteur">Auteur</label>
                                <input type="text" id="auteur" name="auteur"
                                    value="{{ old('auteur', $actualite->auteur) }}" readonly>
                            </div>
                            <div class="field">
                                <label for="slug">Slug URL</label>
                                <input type="text" id="slug" name="slug" placeholder="Généré automatiquement"
                                    value="{{ old('slug', $actualite->slug) }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-align-left"></i> Contenu
                        </div>
                        <div class="form-row full">
                            <div class="field">
                                <label for="resume">Résumé / Extrait <span class="req">*</span></label>
                                <textarea id="resume" name="resume" maxlength="300" required
                                    placeholder="Courte description affichée dans les listes et aperçus…"
                                    oninput="document.getElementById('m-rc').textContent=this.value.length+'/300'">{{ old('resume', $actualite->resume) }}</textarea>
                                <div style="display:flex;justify-content:flex-end;">
                                    <span class="char-count"
                                        id="m-rc">{{ strlen(old('resume', $actualite->resume)) }}/300</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row full">
                            <div class="field">
                                <label for="contenu">Contenu principal <span class="req">*</span></label>
                                <textarea id="contenu" name="contenu" style="min-height:130px;" required
                                    placeholder="Rédigez le contenu complet de l'actualité…">{{ old('contenu', $actualite->contenu) }}</textarea>
                                <div class="field-hint">Supporte les balises HTML basiques (gras, italique, liens).</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ─── Onglet Médias ─── --}}
                <div id="tab-media" style="display:none;">
                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-image"></i> Image à la une</div>
                        @if ($actualite->image)
                            <img src="{{ asset('storage/' . $actualite->image) }}" class="-current-image"
                                alt="Image actuelle">
                        @endif
                        <label class="upload-zone" for="image" id="uz-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="uz-title">Cliquez pour changer l'image</div>
                            <div class="uz-sub">JPG, PNG ou WEBP — max 2 Mo (laisser vide pour garder l'actuelle)</div>
                            <input type="file" id="image" name="image" accept="image/*">
                        </label>
                        <img id="m-preview" class="preview-img" alt="Aperçu de l'image">
                    </div>

                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-tags"></i> Mots-clés</div>
                        <div class="field">
                            <div class="tags-wrap" id="tags-wrap">
                                <input type="text" id="tag-in" placeholder="Ajouter un mot-clé…">
                            </div>
                            <input type="hidden" id="tags-hidden" name="tags"
                                value="{{ old('tags', is_array($actualite->tags) ? implode(',', $actualite->tags) : $actualite->tags) }}">
                            <div class="field-hint">Appuyez sur Entrée ou virgule pour confirmer.</div>
                        </div>
                    </div>
                </div>

                {{-- ─── Onglet Options ─── --}}
                <div id="tab-options" style="display:none;">
                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-sliders-h"></i> Options de publication</div>
                        <div class="toggle-row">
                            <div class="toggle-label">
                                <i class="fas fa-thumbtack"></i> Épingler en haut de la liste
                            </div>
                            <label class="toggle">
                                <input type="checkbox" name="epingle" value="1"
                                    {{ old('epingle', $actualite->epingle) ? 'checked' : '' }}>
                                <span class="tslider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" name="statut" value="brouillon" class="btn-draft">
                        <i class="fas fa-save"></i> Enregistrer brouillon
                    </button>
                    <button type="submit" name="statut" value="publie" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Publier l'actualité
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            // Gestion des onglets
            var tabIds = ['contenu', 'media', 'options'];

            document.querySelectorAll('.tab-bar .tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab-bar .tab').forEach(function(t) {
                        t.classList.remove('active');
                    });
                    this.classList.add('active');
                    tabIds.forEach(function(id) {
                        document.getElementById('tab-' + id).style.display = 'none';
                    });
                    document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
                });
            });

            // Aperçu image
            document.getElementById('image').addEventListener('change', function(e) {
                var file = e.target.files[0];
                if (!file) return;
                var reader = new FileReader();
                reader.onload = function(ev) {
                    var preview = document.getElementById('m-preview');
                    preview.src = ev.target.result;
                    preview.style.display = 'block';
                    document.querySelector('#uz-label .uz-title').textContent = file.name;
                };
                reader.readAsDataURL(file);
            });

            // Tags
            var tagsWrap = document.getElementById('tags-wrap');
            var tagsInput = document.getElementById('tag-in');
            var tagsHidden = document.getElementById('tags-hidden');
            var actuTags = tagsHidden.value ? tagsHidden.value.split(',') : [];

            // Afficher les tags existants
            actuTags.forEach(function(tag) {
                tag = tag.trim();
                if (!tag) return;
                var pill = document.createElement('span');
                pill.className = 'tag-pill';
                pill.dataset.tag = tag;
                pill.innerHTML = tag + '<button type="button" aria-label="Supprimer">×</button>';
                pill.querySelector('button').addEventListener('click', function() {
                    actuTags = actuTags.filter(function(t) {
                        return t !== pill.dataset.tag;
                    });
                    tagsHidden.value = actuTags.join(',');
                    pill.remove();
                });
                tagsWrap.insertBefore(pill, tagsInput);
            });

            tagsWrap.addEventListener('click', function() {
                tagsInput.focus();
            });

            tagsInput.addEventListener('keydown', function(e) {
                if (e.key !== 'Enter' && e.key !== ',') return;
                e.preventDefault();
                var val = this.value.trim().replace(/,$/, '');
                if (!val || actuTags.includes(val)) {
                    this.value = '';
                    return;
                }
                actuTags.push(val);

                var pill = document.createElement('span');
                pill.className = 'tag-pill';
                pill.dataset.tag = val;
                pill.innerHTML = val + '<button type="button" aria-label="Supprimer">×</button>';
                pill.querySelector('button').addEventListener('click', function() {
                    actuTags = actuTags.filter(function(t) {
                        return t !== pill.dataset.tag;
                    });
                    tagsHidden.value = actuTags.join(',');
                    pill.remove();
                });
                tagsWrap.insertBefore(pill, tagsInput);
                tagsHidden.value = actuTags.join(',');
                this.value = '';
            });

            // Slug auto
            document.getElementById('titre').addEventListener('input', function() {
                var slug = this.value
                    .toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-');
                document.getElementById('slug').value = slug;
            });
        })();
    </script>
@endpush
