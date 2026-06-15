@extends('admin.layouts.app')
@section('title','Messages')
@section('page-title','Messages')
@section('page-subtitle','Gérer les messages reçus')
@push('styles')
<style>
:root{--green:#1b5e20;--green-dark:#0a3d14;--green-light:#e8f5e9;--green-soft:#c8e6c9;--gold:#f5a623;--blue:#1565c0;--blue-light:#e3f2fd;--purple:#6a1b9a;--purple-light:#f3e5f5;--white:#ffffff;--cream:#f4f6f8;--border:#e0e8e4;--text:#1a2e25;--text-mid:#455d4f;--text-light:#7a9585;--shadow-sm:0 2px 10px rgba(0,0,0,.07);--radius-sm:8px;--radius-md:14px;--radius-lg:20px;}
.page-toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;}
.msg-layout{display:grid;grid-template-columns:320px 1fr;gap:0;background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);min-height:600px;}
.msg-sidebar{border-right:1px solid var(--border);overflow-y:auto;}
.msg-sidebar-header{padding:14px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:8px;}
.msg-search{flex:1;border:1px solid var(--border);border-radius:var(--radius-sm);padding:7px 10px;font-size:.8rem;font-family:'Nunito',sans-serif;outline:none;background:var(--cream);}
.msg-item{padding:14px 16px;border-bottom:1px solid var(--border);cursor:pointer;transition:background .18s;display:flex;align-items:flex-start;gap:12px;}
.msg-item:hover{background:#f8fbf8;} .msg-item.active{background:var(--green-light);}
.msg-item.unread .msg-name{font-weight:900;} .msg-item.unread .msg-preview{font-weight:700;color:var(--text);}
.msg-avatar{width:38px;height:38px;border-radius:50%;background:var(--green-soft);display:flex;align-items:center;justify-content:center;color:var(--green);font-weight:800;font-size:.85rem;flex-shrink:0;}
.msg-name{font-size:.83rem;font-weight:700;color:var(--text);}
.msg-preview{font-size:.75rem;color:var(--text-light);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;}
.msg-time{font-size:.68rem;color:var(--text-light);margin-left:auto;white-space:nowrap;}
.unread-dot{width:8px;height:8px;border-radius:50%;background:#e53935;flex-shrink:0;margin-top:6px;}
.msg-main{padding:28px;display:flex;flex-direction:column;gap:16px;}
.msg-main-header{padding-bottom:16px;border-bottom:1px solid var(--border);}
.msg-main-subject{font-size:1.1rem;font-weight:800;color:var(--text);margin-bottom:8px;}
.msg-main-meta{display:flex;align-items:center;gap:16px;flex-wrap:wrap;}
.msg-meta-item{font-size:.78rem;color:var(--text-mid);display:flex;align-items:center;gap:5px;}
.msg-meta-item i{color:var(--green);}
.msg-body-text{font-size:.9rem;color:var(--text-mid);line-height:1.85;flex:1;}
.reply-box{border-top:1px solid var(--border);padding-top:16px;}
.reply-box label{font-size:.78rem;font-weight:700;color:var(--text-light);text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;display:block;}
.reply-textarea{width:100%;border:1px solid var(--border);border-radius:var(--radius-md);padding:12px;font-size:.85rem;font-family:'Nunito',sans-serif;color:var(--text);resize:vertical;min-height:100px;outline:none;background:var(--cream);}
.reply-textarea:focus{border-color:var(--green);}
.btn-primary{display:inline-flex;align-items:center;gap:8px;background:var(--green);color:white;padding:10px 20px;border-radius:var(--radius-sm);font-size:.82rem;font-weight:800;text-transform:uppercase;letter-spacing:.05em;border:none;cursor:pointer;font-family:'Nunito',sans-serif;transition:background .2s;}
.btn-primary:hover{background:var(--green-dark);}
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:999px;font-size:.7rem;font-weight:800;}
.status--non-lu{background:#ffebee;color:#e53935;} .status--lu{background:var(--green-light);color:var(--green);} .status--repondu{background:var(--blue-light);color:var(--blue);}
</style>
@endpush
@section('content')
<div class="page-toolbar">
  <h1>Messages <span style="background:#e53935;color:white;padding:2px 8px;border-radius:999px;font-size:.75rem;margin-left:8px;">46 non lus</span></h1>
</div>
<div class="msg-layout">
  <div class="msg-sidebar">
    <div class="msg-sidebar-header">
      <input class="msg-search" type="text" placeholder="Rechercher...">
    </div>
    @php
    $msgs=[
      ['init'=>'KJ','nom'=>'Kouassi Jean','preview'=>'Bonjour, je souhaite adhérer à...','time'=>'10:24','unread'=>true,'active'=>true],
      ['init'=>'AB','nom'=>'Aya Bamba','preview'=>'Quand aura lieu la prochaine AG ?','time'=>'09:15','unread'=>true,'active'=>false],
      ['init'=>'DG','nom'=>'Déo Gbato','preview'=>'Merci pour votre réponse...','time'=>'Hier','unread'=>false,'active'=>false],
      ['init'=>'MT','nom'=>'Marie Traore','preview'=>'Comment postuler pour la bourse ?','time'=>'Hier','unread'=>true,'active'=>false],
      ['init'=>'YK','nom'=>'Yao Konan','preview'=>'Félicitations pour le projet eau...','time'=>'Lun.','unread'=>false,'active'=>false],
      ['init'=>'SN','nom'=>'Soro N\'Golo','preview'=>'Je veux faire un don pour...','time'=>'Lun.','unread'=>true,'active'=>false],
    ];
    @endphp
    @foreach($msgs as $m)
    <div class="msg-item {{ $m['unread']?'unread':'' }} {{ $m['active']?'active':'' }}">
      <div class="msg-avatar">{{ $m['init'] }}</div>
      <div style="flex:1;min-width:0;">
        <div style="display:flex;justify-content:space-between;"><div class="msg-name">{{ $m['nom'] }}</div><div class="msg-time">{{ $m['time'] }}</div></div>
        <div class="msg-preview">{{ $m['preview'] }}</div>
      </div>
      @if($m['unread'])<div class="unread-dot"></div>@endif
    </div>
    @endforeach
  </div>
  <div class="msg-main">
    <div class="msg-main-header">
      <div class="msg-main-subject">Demande d'adhésion à la MUDEA</div>
      <div class="msg-main-meta">
        <div class="msg-meta-item"><i class="fas fa-user"></i> Kouassi Jean</div>
        <div class="msg-meta-item"><i class="fas fa-envelope"></i> kouassi.jean@gmail.com</div>
        <div class="msg-meta-item"><i class="fas fa-calendar"></i> 12 Mai 2024 à 10h24</div>
        <span class="status-badge status--non-lu">Non lu</span>
      </div>
    </div>
    <div class="msg-body-text">
      Bonjour,<br><br>
      Je me nomme Kouassi Jean, originaire du village d'Andé. Je souhaite adhérer à la MUDEA afin de contribuer au développement de notre communauté. Pourriez-vous m'indiquer la procédure d'adhésion ainsi que les documents requis ?<br><br>
      Je suis également intéressé par le programme de bourses pour mon fils qui passera le BAC cette année.<br><br>
      Dans l'attente de votre réponse, je vous adresse mes cordiales salutations.
    </div>
    <div class="reply-box">
      <label>Répondre</label>
      <textarea class="reply-textarea" placeholder="Votre réponse..."></textarea>
      <div style="display:flex;gap:10px;margin-top:10px;">
        <button class="btn-primary"><i class="fas fa-paper-plane"></i> Envoyer la réponse</button>
        <button class="btn-primary" style="background:#eceff1;color:var(--text-mid);" onclick="this.closest('.btn-primary')"><i class="fas fa-archive"></i> Archiver</button>
      </div>
    </div>
  </div>
</div>
@endsection