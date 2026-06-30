@extends('layouts.app')

@section('title', 'Contact - MUDEA')

@section('content')

<style>
    :root {
        --vert:        #2d6a2d;
        --vert-fonce:  #1a4a1a;
        --vert-clair:  #4a8c2a;
        --jaune:       #f5c518;
        --jaune-clair: #ffd740;
        --gold:        #d4880a;
        --green-dark:  #071f0b;
        --gris-fond:   #f5f5f5;
        --gris-bord:   #e0e0e0;
        --texte:       #1a1a1a;
        --texte-sec:   #555;
        --blanc:       #ffffff;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--texte); background: var(--blanc); overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    /* ══ HERO SPLIT ══════════════════════════════════ */
    .hero-split {
        display: grid; grid-template-columns: 1fr 1fr;
        min-height: 340px; background: var(--green-dark);
    }
    .hero-left {
        padding: 56px 52px 56px clamp(24px, 5vw, 72px);
        display: flex; flex-direction: column; justify-content: center;
        background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
        position: relative; z-index: 2;
    }
    .hero-left::after {
        content: ''; position: absolute; top: 0; right: -36px; bottom: 0; width: 72px;
        background: linear-gradient(135deg, #071f0b 0%, #1b5e20 100%);
        clip-path: polygon(0 0, 0 100%, 100% 100%); z-index: 3;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 900; color: #fffef7; line-height: 1.05;
        letter-spacing: -.02em; margin-bottom: 10px;
    }
    .hero-subtitle {
        font-size: .9rem; font-weight: 800; color: var(--gold);
        margin-bottom: 8px; text-transform: uppercase; letter-spacing: .1em;
    }
    .hero-accent-line { width: 44px; height: 3px; background: var(--gold); border-radius: 2px; margin-bottom: 16px; }
    .hero-desc { color: rgba(255,255,255,.88); font-size: .9rem; line-height: 1.75; max-width: 420px; }
    .hero-right { position: relative; overflow: hidden; min-height: 340px; }
    .hero-right img { width: 100%; height: 100%; object-fit: cover; object-position: center; }
    .hero-right-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(7,31,11,.5) 0%, transparent 55%); }

    /* ══ MAIN CONTACT GRID ═══════════════════════════ */
    .contact-page-wrap {
        background: var(--gris-fond);
        padding: 44px 24px;
    }
    .contact-grid-3 {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: 280px 1fr 260px; gap: 24px;
        align-items: start;
    }

    /* ── Card générique ── */
    .c-card {
        background: var(--blanc); border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        padding: 24px 22px; margin-bottom: 20px;
    }
    .c-card:last-child { margin-bottom: 0; }

    /* ── Card header (titre avec icône) ── */
    .card-head {
        display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
    }
    .card-head-icon {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--vert); display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .card-head-icon svg { color: var(--blanc); }
    .card-head h3 {
        font-size: .82rem; font-weight: 900; text-transform: uppercase;
        letter-spacing: .06em; color: var(--vert-fonce);
    }

    /* ══ COLONNE GAUCHE : Coordonnées ═══════════════ */
    .coord-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 10px 0; border-bottom: 1px solid var(--gris-bord);
    }
    .coord-item:last-child { border-bottom: none; padding-bottom: 0; }
    .coord-icon {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--vert); display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; margin-top: 1px;
    }
    .coord-icon svg { color: var(--blanc); }
    .coord-body h5 { font-size: .77rem; font-weight: 800; color: var(--texte); margin-bottom: 2px; }
    .coord-body p, .coord-body a { font-size: .78rem; color: var(--texte-sec); line-height: 1.55; }
    .coord-body a:hover { color: var(--vert); }

    /* ══ COLONNE CENTRE : Formulaire ════════════════ */
    .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .fg { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
    .fg label {
        font-size: .76rem; font-weight: 700; color: var(--vert-fonce);
        display: flex; align-items: center; gap: 4px;
    }
    .fg label .req { color: #e53935; }
    .fg input, .fg select, .fg textarea {
        border: 1.5px solid var(--gris-bord); border-radius: 7px;
        padding: 10px 13px; font-size: .86rem; font-family: inherit;
        color: var(--texte); outline: none; background: #fafafa;
        transition: border-color .2s, box-shadow .2s;
    }
    .fg input:focus, .fg select:focus, .fg textarea:focus {
        border-color: var(--vert);
        box-shadow: 0 0 0 3px rgba(45,106,45,.1);
        background: var(--blanc);
    }
    .fg textarea { resize: vertical; min-height: 110px; }
    .fg input::placeholder, .fg textarea::placeholder { color: #bbb; }

    .btn-send {
        width: 100%; background: var(--vert); color: var(--blanc);
        border: none; cursor: pointer;
        font-weight: 800; font-size: .88rem; text-transform: uppercase; letter-spacing: .5px;
        padding: 13px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; gap: 9px;
        transition: background .2s, transform .15s; margin-top: 2px;
    }
    .btn-send:hover { background: var(--vert-fonce); transform: translateY(-2px); }

    /* ══ COLONNE DROITE : Assistant ═════════════════ */
    .assist-question {
        font-size: .8rem; font-weight: 700; color: var(--texte-sec); margin-bottom: 14px;
    }
    .assist-option {
        display: flex; align-items: flex-start; gap: 11px;
        padding: 10px 0; border-bottom: 1px solid var(--gris-bord); cursor: pointer;
    }
    .assist-option:last-child { border-bottom: none; padding-bottom: 0; }
    .assist-option input[type="radio"] {
        margin-top: 3px; accent-color: var(--vert); flex-shrink: 0;
    }
    .assist-opt-icon {
        width: 30px; height: 30px; border-radius: 50%;
        background: #eef5ee; display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .assist-opt-icon svg { color: var(--vert); }
    .assist-opt-body h5 { font-size: .77rem; font-weight: 800; color: var(--texte); margin-bottom: 1px; }
    .assist-opt-body p  { font-size: .72rem; color: var(--texte-sec); line-height: 1.4; }

    /* ══ DEUXIÈME RANGÉE ════════════════════════════ */
    .contact-grid-3-bottom {
        max-width: 1200px; margin: 0 auto;
        display: grid; grid-template-columns: 280px 1fr 260px; gap: 24px;
        align-items: start;
    }

    /* ── FAQ Accordion ── */
    .faq-item {
        border-bottom: 1px solid var(--gris-bord);
    }
    .faq-item:last-child { border-bottom: none; }
    .faq-btn {
        width: 100%; background: none; border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: space-between;
        padding: 11px 0; text-align: left; gap: 8px;
    }
    .faq-btn span {
        font-size: .79rem; font-weight: 700; color: var(--texte); line-height: 1.3;
    }
    .faq-btn svg { flex-shrink: 0; transition: transform .25s; color: var(--vert); }
    .faq-btn.open svg { transform: rotate(180deg); }
    .faq-answer {
        font-size: .76rem; color: var(--texte-sec); line-height: 1.55;
        max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s;
        padding-bottom: 0;
    }
    .faq-answer.open { max-height: 200px; padding-bottom: 10px; }

    /* ── Carte localisation ── */
    .map-embed {
        border-radius: 8px; overflow: hidden; margin-bottom: 14px;
        border: 1px solid var(--gris-bord);
    }
    .map-embed iframe { display: block; width: 100%; height: 210px; border: none; }
    .map-info p { font-size: .77rem; color: var(--texte-sec); line-height: 1.5; margin-bottom: 12px; }
    .map-info strong { color: var(--texte); font-weight: 800; font-size: .79rem; }
    .btn-itineraire {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; background: var(--vert); color: var(--blanc);
        border-radius: 7px; padding: 10px; font-size: .8rem;
        font-weight: 800; text-transform: uppercase; letter-spacing: .4px;
        transition: background .2s;
    }
    .btn-itineraire:hover { background: var(--vert-fonce); }

    /* ── Réseaux sociaux ── */
    .social-desc { font-size: .8rem; color: var(--texte-sec); margin-bottom: 14px; line-height: 1.5; }
    .social-list { display: flex; flex-direction: column; gap: 10px; }
    .social-link {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 8px; border: 1px solid var(--gris-bord);
        transition: border-color .2s, background .2s;
    }
    .social-link:hover { border-color: var(--vert); background: #f5fbf5; }
    .social-link-icon {
        width: 32px; height: 32px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .social-link-icon.fb   { background: #1877f2; }
    .social-link-icon.wa   { background: #25d366; }
    .social-link-icon.yt   { background: #ff0000; }
    .social-link-icon.li   { background: #0a66c2; }
    .social-link-icon svg  { color: var(--blanc); }
    .social-link-body h5   { font-size: .78rem; font-weight: 800; color: var(--vert); margin-bottom: 1px; }
    .social-link-body p    { font-size: .72rem; color: var(--texte-sec); }

    /* ══ CTA BAS DE PAGE ════════════════════════════ */
    .cta-bottom {
        background: var(--vert-fonce);
        padding: 32px 24px;
    }
    .cta-bottom-inner {
        max-width: 1200px; margin: 0 auto;
        display: flex; align-items: center; gap: 28px; flex-wrap: wrap;
    }
    .cta-avatar {
        width: 90px; height: 90px; border-radius: 50%; overflow: hidden;
        border: 3px solid rgba(255,255,255,.2); flex-shrink: 0;
        background: var(--vert);
        display: flex; align-items: center; justify-content: center;
    }
    .cta-avatar svg { color: rgba(255,255,255,.6); }
    .cta-text-block { flex: 1; min-width: 200px; }
    .cta-text-block h3 { font-size: 1.05rem; font-weight: 900; color: var(--blanc); margin-bottom: 5px; }
    .cta-text-block p  { font-size: .84rem; color: rgba(255,255,255,.72); line-height: 1.5; }
    .cta-track-form {
        display: flex; gap: 10px; flex-wrap: wrap;
        margin-top: 16px; align-items: center;
    }
    .cta-track-form input {
        min-width: 240px;
        flex: 1;
        border: 1px solid rgba(255,255,255,.18);
        background: rgba(255,255,255,.08);
        color: var(--blanc);
        padding: 12px 14px;
        border-radius: 7px;
        font-size: .84rem;
        outline: none;
    }
    .cta-track-form input::placeholder {
        color: rgba(255,255,255,.55);
    }
    .cta-track-form input:focus {
        border-color: rgba(255,255,255,.42);
        background: rgba(255,255,255,.12);
    }
    .cta-track-btn {
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--jaune); color: var(--vert-fonce);
        font-weight: 900; font-size: .84rem; text-transform: uppercase; letter-spacing: .4px;
        padding: 12px 18px; border-radius: 7px; transition: transform .15s, background .2s;
        flex-shrink: 0;
    }
    .cta-track-btn:hover { background: #ffd740; transform: translateY(-1px); }
    .cta-track-result {
        margin-top: 14px;
        padding: 12px 14px;
        border-radius: 8px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        color: rgba(255,255,255,.92);
        font-size: .82rem;
        line-height: 1.5;
    }

    /* ══ RESPONSIVE ══════════════════════════════════ */
    @media (max-width: 1080px) {
        .contact-grid-3,
        .contact-grid-3-bottom { grid-template-columns: 1fr 1fr; }
        .contact-grid-3 > *:last-child,
        .contact-grid-3-bottom > *:last-child { grid-column: 1 / -1; }
    }
    @media (max-width: 768px) {
        .hero-split { grid-template-columns: 1fr; }
        .hero-right { min-height: 200px; }
        .hero-left::after { display: none; }
        .contact-grid-3,
        .contact-grid-3-bottom { grid-template-columns: 1fr; }
        .contact-grid-3 > *:last-child,
        .contact-grid-3-bottom > *:last-child { grid-column: auto; }
        .form-row-2 { grid-template-columns: 1fr; }
        .cta-badges { display: none; }
        .cta-bottom-inner { flex-direction: column; align-items: flex-start; gap: 18px; }
    }

            .cta-badge {
            display: flex; flex-direction: column; align-items: center;
            text-align: center; min-width: 90px;
        }
        .cta-badge-icon {
            width: 44px; height: 44px; border-radius: 50%;
            background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 8px; color: var(--jaune);
        }
        .cta-badges { display: flex; gap: 20px; flex-wrap: wrap; }
        .cta-badge h5 { font-size: .75rem; font-weight: 900; color: var(--blanc); margin-bottom: 2px; }
        .cta-badge p  { font-size: .68rem; color: rgba(255,255,255,.6); line-height: 1.4; }
</style>

{{-- ══ HERO ══════════════════════════════════════════ --}}
<section class="hero-split">
    <div class="hero-left">
        <h1 class="hero-title">Contact &amp;<br>Assistance MUDEA</h1>
        <p class="hero-subtitle">Nous sommes à votre écoute</p>
        <div class="hero-accent-line"></div>
        <p class="hero-desc">Vous avez une question, une suggestion, une demande d'information ou souhaitez nous proposer un projet ? Contactez-nous, nous serons ravis de vous répondre.</p>
    </div>
    <div class="hero-right">
        <img src="{{ asset('images/communaute/1.png') }}" alt="Village d'Andé" onerror="this.style.display='none'">
        <div class="hero-right-overlay"></div>
    </div>
</section>

{{-- ══ RANGÉE PRINCIPALE ══════════════════════════════ --}}
<div class="contact-page-wrap">

 <div class="contact-grid-3">
        {{-- ── Colonne 1 : Coordonnées ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3>Coordonnées MUDEA</h3>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Adresse</h5>
                        <p>Village officiel, Sous-préfecture d'Agne,<br>Région de la Nde, Côte d'Ivoire</p>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Téléphone</h5>
                        <a href="tel:+22507000060000">+225 07 00 00 60 00</a>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon" style="background:#25d366;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>WhatsApp</h5>
                        <a href="https://wa.me/22507000060000" target="_blank">+225 07 00 00 60 00</a>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><polyline points="22 6 12 13 2 6"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Email</h5>
                        <a href="mailto:contact@mudea-ande.ci">contact@mudea-ande.ci</a>
                    </div>
                </div>

                <div class="coord-item">
                    <div class="coord-icon">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="coord-body">
                        <h5>Site web</h5>
                        <a href="https://www.mudea-ande.ci" target="_blank">www.mudea-ande.ci</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Colonne 2 : Formulaire ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <h3>Formulaire de contact</h3>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row-2">
                        <div class="fg">
                            <label>Nom <span class="req">*</span></label>
                            <input type="text" name="nom" placeholder="Nom *" required value="{{ old('nom') }}">
                        </div>
                        <div class="fg">
                            <label>Prénom <span class="req">*</span></label>
                            <input type="text" name="prenom" placeholder="Prénom *" required value="{{ old('prenom') }}">
                        </div>
                    </div>

                    <div class="fg">
                        <label>Téléphone <span class="req">*</span></label>
                        <input type="tel" name="telephone" placeholder="Téléphone *" required value="{{ old('telephone') }}">
                    </div>

                    <div class="fg">
                        <label>Email <span class="req">*</span></label>
                        <input type="email" name="email" placeholder="Email *" required value="{{ old('email') }}">
                    </div>

                    <div class="fg">
                        <label>Objet <span class="req">*</span></label>
                        <select name="objet" required>
                            <option value="" disabled {{ old('objet') ? '' : 'selected' }}>Objet *</option>
                            <option value="adhesion"     {{ old('objet') === 'adhesion'     ? 'selected' : '' }}>Adhésion / Membership</option>
                            <option value="contribution" {{ old('objet') === 'contribution' ? 'selected' : '' }}>Contribution / Don</option>
                            <option value="projet"       {{ old('objet') === 'projet'       ? 'selected' : '' }}>Proposition de projet</option>
                            <option value="education"    {{ old('objet') === 'education'    ? 'selected' : '' }}>Éducation &amp; Excellence</option>
                            <option value="information"  {{ old('objet') === 'information'  ? 'selected' : '' }}>Information générale</option>
                            <option value="autre"        {{ old('objet') === 'autre'        ? 'selected' : '' }}>Autre demande</option>
                        </select>
                    </div>

                    <div class="fg">
                        <label>Votre message <span class="req">*</span></label>
                        <textarea name="message" placeholder="Votre message *" required>{{ old('message') }}</textarea>
                    </div>

                    <div class="fg">
                        <label>Joindre un document</label>
                        <input type="file" name="document" accept=".pdf,.doc,.docx,image/*">
                    </div>

                    @if(session('success'))
                        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:10px 14px;border-radius:7px;font-size:.8rem;margin-bottom:12px;font-weight:700;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div style="background:#ffebee;border:1px solid #ef9a9a;color:#c62828;padding:10px 14px;border-radius:7px;font-size:.8rem;margin-bottom:12px;">
                            @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn-send">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Colonne 3 : Assistant MUDEA ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h3>Assistant MUDEA</h3>
                </div>
                <p class="assist-question">Comment pouvons-nous vous aider ?</p>

                <div>
                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="adhesion">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Adhésion</h5>
                            <p>Informations sur l'adhésion à la MUDEA</p>
                        </div>
                    </label>

                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="contribution">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Contribution</h5>
                            <p>Faire une contribution ou un don</p>
                        </div>
                    </label>

                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="projet">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="12" y2="17"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Projet</h5>
                            <p>Proposer ou réaliser un projet</p>
                        </div>
                    </label>

                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="education">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Éducation &amp; Excellence</h5>
                            <p>Bourses, formations, accompagnement</p>
                        </div>
                    </label>

                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="information">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Information générale</h5>
                            <p>En savoir + d'informations générale</p>
                        </div>
                    </label>

                    <label class="assist-option">
                        <input type="radio" name="assist_topic" value="autre">
                        <div class="assist-opt-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <div class="assist-opt-body">
                            <h5>Autre demande</h5>
                            <p>Autre type de demande</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>


    </div>


    <br>

    
    {{-- ══ RANGÉE BAS ══════════════════════════════════ --}}
    <div class="contact-grid-3-bottom" style="margin-top: 0;">

        {{-- ── FAQ ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3>Questions fréquentes (FAQ)</h3>
                </div>

                @php
                $faqs = [
                    ['q' => 'Comment adhérer à la MUDEA ?',            'a' => "Vous pouvez adhérer en remplissant le formulaire en ligne ou en vous rendant directement au siège de l'association à Andé. Des frais d'adhésion s'appliquent selon votre catégorie."],
                    ['q' => 'Comment contribuer à la MUDEA ?',          'a' => "Les contributions peuvent être faites par virement bancaire, Mobile Money (Orange, MTN, Wave) ou en espèces au siège. Contactez-nous pour les détails."],
                    ['q' => 'Comment proposer un projet ?',             'a' => "Soumettez votre proposition via le formulaire de contact en sélectionnant l'objet \"Projet\". Notre comité vous recontactera sous 72h."],
                    ['q' => 'Comment rejoindre une commission ?',        'a' => "Les commissions sont ouvertes à tous les membres actifs. Exprimez votre intérêt via le formulaire ou lors des assemblées générales."],
                    ['q' => 'Comment publier une actualité ?',          'a' => "Envoyez votre contenu à contact@mudea-ande.ci avec la mention \"Actualité\". L'équipe éditoriale validera et publiera sous 48h."],
                    ['q' => 'Comment devenir bénévole ?',               'a' => "Remplissez le formulaire de contact avec l'objet \"Autre demande\" et précisez vos disponibilités et compétences."],
                    ['q' => "Où puis-je suivre l'évolution des projets ?", 'a' => "La section \"Projets\" du site est mise à jour régulièrement. Vous pouvez aussi vous abonner à notre newsletter."],
                    ['q' => 'Comment contacter un responsable ?',       'a' => "Utilisez le formulaire de contact ou appelez directement le +225 07 00 00 60 00 durant les heures de bureau (8h–17h)."],
                ];
                @endphp

                @foreach($faqs as $i => $faq)
                <div class="faq-item">
                    <button class="faq-btn" onclick="toggleFaq({{ $i }})">
                        <span>{{ $faq['q'] }}</span>
                        <svg id="faq-icon-{{ $i }}" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-answer" id="faq-answer-{{ $i }}">{{ $faq['a'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── Localisation ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    </div>
                    <h3>Notre localisation</h3>
                </div>

                <div class="map-embed">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126964.70957125207!2d-4.106706602734375!3d6.0430538000000125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc169ddc55c5ed7%3A0x475845056c185c45!2zQW5kw6k!5e0!3m2!1sfr!2sci!4v1781600875162!5m2!1sfr!2sci" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="map-info">
                    <strong>MUDEA – Mutuelle de Développement d'Andé</strong>
                    <p>Village officiel, Sous-préfecture d'Agne,<br>Région de la Nde, Côte d'Ivoire</p>
                </div>

                <a href="https://maps.google.com/?q=Ande,Cote+d'Ivoire" target="_blank" class="btn-itineraire">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    Itinéraire
                </a>
            </div>
        </div>

        {{-- ── Réseaux sociaux ── --}}
        <div>
            <div class="c-card">
                <div class="card-head">
                    <div class="card-head-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                    </div>
                    <h3>Suivez-nous</h3>
                </div>
                <p class="social-desc">Restez connectés avec nous<br>sur nos réseaux sociaux.</p>

                <div class="social-list">
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon fb">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>Facebook</h5>
                            <p>Mudea.ande</p>
                        </div>
                    </a>
                    <a href="https://wa.me/22507000060000" class="social-link" target="_blank">
                        <div class="social-link-icon wa">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>WhatsApp</h5>
                            <p>+225 07 00 00 60 00</p>
                        </div>
                    </a>
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon yt">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>YouTube</h5>
                            <p>MUDEA Andé Officiel</p>
                        </div>
                    </a>
                    <a href="#" class="social-link" target="_blank">
                        <div class="social-link-icon li">
                            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.2" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                        </div>
                        <div class="social-link-body">
                            <h5>LinkedIn</h5>
                            <p>MUDEA – Mutuelle d'Andé</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ══ CTA BAS DE PAGE ══════════════════════════════ --}}


{{-- ══ CTA BAS DE PAGE : Discussion immédiate ══ --}}


{{-- ══ CTA BAS DE PAGE ══════════════════════════════ --}}
<div class="cta-bottom">
    <div class="cta-bottom-inner">

        <div class="cta-avatar">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M12 8v5l3 2"/>
                <circle cx="12" cy="12" r="10"/>
            </svg>
        </div>

        <div class="cta-text-block">
            <h3>Suivre une demande</h3>
            <p>
                Entrez votre email ou votre numéro de téléphone pour retrouver
                le statut de votre dernière demande.
            </p>

            <form class="cta-track-form" action="{{ route('contact') }}" method="GET">
                <input
                    type="text"
                    name="suivi"
                    value="{{ request('suivi') }}"
                    placeholder="Email ou téléphone"
                >
                <button type="submit" class="cta-track-btn">
                    Vérifier
                </button>
            </form>

            @if(!empty($suiviDemande))
                <div class="cta-track-result">
                    <strong>Statut :</strong> {{ ucfirst($suiviDemande->statut) }}<br>
                    <strong>Objet :</strong> {{ $suiviDemande->objet }}<br>
                    <strong>Dernière mise à jour :</strong>
                    {{ $suiviDemande->updated_at?->format('d/m/Y H:i') }}
                </div>
            @elseif(!empty($suiviErreur))
                <div class="cta-track-result">
                    {{ $suiviErreur }}
                </div>
            @endif
        </div>

        {{-- Badges --}}
        <div class="cta-badges">
            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h5>Réponse rapide</h5>
                <p>Nous répondons dans les meilleurs délais</p>
            </div>

            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h5>Confidentialité</h5>
                <p>Vos données sont sécurisées</p>
            </div>

            <div class="cta-badge">
                <div class="cta-badge-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h5>À votre écoute</h5>
                <p>Notre équipe est là pour vous aider</p>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function toggleFaq(i) {
        const answer = document.getElementById('faq-answer-' + i);
        const icon   = document.getElementById('faq-icon-'   + i);
        const btn    = icon.closest('.faq-btn');
        const isOpen = answer.classList.contains('open');

        // Ferme tous les autres
        document.querySelectorAll('.faq-answer').forEach(el => el.classList.remove('open'));
        document.querySelectorAll('.faq-btn').forEach(el => el.classList.remove('open'));

        if (!isOpen) {
            answer.classList.add('open');
            btn.classList.add('open');
        }
    }

    // Pré-remplir l'objet du formulaire depuis le sélecteur "Assistant"
    document.querySelectorAll('input[name="assist_topic"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var select = document.querySelector('select[name="objet"]');
            if (select) select.value = this.value;
        });
   });
</script>
@endpush

@endsection

