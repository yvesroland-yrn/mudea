@extends('admin.layouts.app')
@section('title','Paramètres')
@section('page-title','Paramètres')
@section('page-subtitle','Configuration du site MUDEA')
@push('styles')
<style>
:root{--green:#1b5e20;--green-dark:#0a3d14;--green-light:#e8f5e9;--green-soft:#c8e6c9;--white:#ffffff;--cream:#f4f6f8;--border:#e0e8e4;--text:#1a2e25;--text-mid:#455d4f;--text-light:#7a9585;--shadow-sm:0 2px 10px rgba(0,0,0,.07);--radius-sm:8px;--radius-md:14px;--radius-lg:20px;}
.params-layout{display:grid;grid-template-columns:220px 1fr;gap:24px;}
.params-nav{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);padding:12px 0;box-shadow:var(--shadow-sm);align-self:start;}
.params-nav-item{display:flex;align-items:center;gap:10px;padding:10px 18px;font-size:.85rem;font-weight:600;color:var(--text-mid);cursor:pointer;text-decoration:none;transition:all .18s;border-left:3px solid transparent;}
.params-nav-item:hover{background:var(--cream);color:var(--text);}
.params-nav-item.active{background:var(--green-light);color:var(--green);border-left-color:var(--green);font-weight:800;}
.params-nav-item i{width:18px;text-align:center;}
.params-section{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);padding:28px;box-shadow:var(--shadow-sm);margin-bottom:20px;}
.params-section-title{font-size:.95rem;font-weight:800;color:var(--text);margin-bottom:22px;padding-bottom:12px;border-bottom:1px solid var(--border);}
.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;}
.form-group{display:flex;flex-direction:column;gap:6px;}
.form-group.full{grid-column:1/-1;}
.form-label{font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:var(--text-light);}
.form-input{border:1px solid var(--border);border-radius:var(--radius-sm);padding:10px 12px;font-size:.88rem;font-family:'Nunito',sans-serif;color:var(--text);outline:none;background:var(--cream);transition:border-color .18s;}
.form-input:focus{border-color:var(--green);}
.form-textarea{min-height:90px;resize:vertical;}
.form-toggle{display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--border);}
.form-toggle:last-child{border-bottom:none;}
.toggle-info strong{display:block;font-size:.85rem;font-weight:700;color:var(--text);}
.toggle-info span{font-size:.75rem;color:var(--text-light);}
.switch{position:relative;width:44px;height:24px;flex-shrink:0;}
.switch input{opacity:0;width:0;height:0;}
.slider{position:absolute;cursor:pointer;inset:0;background:#ccc;border-radius:24px;transition:.3s;}
.slider::before{content:'';position:absolute;width:18px;height:18px;left:3px;bottom:3px;background:white;border-radius:50%;transition:.3s;}
.switch input:checked+.slider{background:var(--green);}
.switch input:checked+.slider::before{transform:translateX(20px);}
.btn-save{display:inline-flex;align-items:center;gap:8px;background:var(--green);color:white;padding:11px 24px;border-radius:var(--radius-sm);font-size:.82rem;font-weight:800;text-transform:uppercase;letter-spacing:.05em;border:none;cursor:pointer;font-family:'Nunito',sans-serif;transition:background .2s;margin-top:8px;}
.btn-save:hover{background:var(--green-dark);}
</style>
@endpush
@section('content')
<div class="params-layout">
  <nav class="params-nav">
    <a href="#" class="params-nav-item active"><i class="fas fa-globe"></i> Général</a>
    <a href="#" class="params-nav-item"><i class="fas fa-palette"></i> Apparence</a>
    <a href="#" class="params-nav-item"><i class="fas fa-envelope"></i> Email</a>
    <a href="#" class="params-nav-item"><i class="fas fa-bell"></i> Notifications</a>
    <a href="#" class="params-nav-item"><i class="fas fa-share-nodes"></i> Réseaux sociaux</a>
    <a href="#" class="params-nav-item"><i class="fas fa-shield-halved"></i> Sécurité</a>
    <a href="#" class="params-nav-item"><i class="fas fa-database"></i> Sauvegarde</a>
  </nav>
  <div>
    <div class="params-section">
      <div class="params-section-title">Informations générales du site</div>
      <div class="form-grid">
        <div class="form-group"><label class="form-label">Nom du site</label><input class="form-input" type="text" value="MUDEA – Mutuelle de Développement Durable"></div>
        <div class="form-group"><label class="form-label">Email de contact</label><input class="form-input" type="email" value="contact@mudea-ande.ci"></div>
        <div class="form-group"><label class="form-label">Téléphone</label><input class="form-input" type="text" value="+225 07 00 00 00 00"></div>
        <div class="form-group"><label class="form-label">Localisation</label><input class="form-input" type="text" value="Village d'Andé, Côte d'Ivoire"></div>
        <div class="form-group full"><label class="form-label">Description du site</label><textarea class="form-input form-textarea">La MUDEA œuvre pour le bien-être des populations d'Andé à travers la solidarité, l'éducation, la culture et le développement durable.</textarea></div>
      </div>
      <button class="btn-save"><i class="fas fa-floppy-disk"></i> Sauvegarder</button>
    </div>
    <div class="params-section">
      <div class="params-section-title">Options du site</div>
      <div class="form-toggle"><div class="toggle-info"><strong>Mode maintenance</strong><span>Afficher une page de maintenance aux visiteurs</span></div><label class="switch"><input type="checkbox"><span class="slider"></span></label></div>
      <div class="form-toggle"><div class="toggle-info"><strong>Commentaires activés</strong><span>Autoriser les commentaires sur les actualités</span></div><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></div>
      <div class="form-toggle"><div class="toggle-info"><strong>Inscription ouverte</strong><span>Permettre aux nouveaux membres de s'inscrire</span></div><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></div>
      <div class="form-toggle"><div class="toggle-info"><strong>Newsletter active</strong><span>Permettre l'abonnement à la newsletter</span></div><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></div>
    </div>
  </div>
</div>
@endsection