@extends('admin.layouts.app')
@section('title','Utilisateurs')
@section('page-title','Utilisateurs')
@section('page-subtitle','Gérer les membres et administrateurs')
@push('styles')
<style>
:root{--green:#1b5e20;--green-dark:#0a3d14;--green-light:#e8f5e9;--green-soft:#c8e6c9;--gold:#f5a623;--gold-light:#fff8e1;--blue:#1565c0;--blue-light:#e3f2fd;--purple:#6a1b9a;--purple-light:#f3e5f5;--white:#ffffff;--cream:#f4f6f8;--border:#e0e8e4;--text:#1a2e25;--text-mid:#455d4f;--text-light:#7a9585;--shadow-sm:0 2px 10px rgba(0,0,0,.07);--radius-sm:8px;--radius-md:14px;--radius-lg:20px;}
.page-toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;}
.btn-primary{display:inline-flex;align-items:center;gap:8px;background:var(--green);color:white;padding:10px 20px;border-radius:var(--radius-sm);font-size:.82rem;font-weight:800;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;font-family:'Nunito',sans-serif;border:none;cursor:pointer;transition:background .2s;}
.btn-primary:hover{background:var(--green-dark);}
.kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:22px;}
.kpi-card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);padding:18px 20px;display:flex;align-items:center;gap:14px;box-shadow:var(--shadow-sm);}
.kpi-icon{width:48px;height:48px;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;}
.kpi-icon--green{background:var(--green-light);color:var(--green);}.kpi-icon--blue{background:var(--blue-light);color:var(--blue);}.kpi-icon--gold{background:var(--gold-light);color:#e65100;}.kpi-icon--purple{background:var(--purple-light);color:var(--purple);}
.kpi-number{font-size:1.6rem;font-weight:900;color:var(--text);line-height:1;}.kpi-label{font-size:.72rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:.07em;}
.filters-bar{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-md);padding:14px 18px;display:flex;align-items:center;gap:12px;margin-bottom:18px;flex-wrap:wrap;}
.filter-input{border:1px solid var(--border);border-radius:var(--radius-sm);padding:8px 12px;font-size:.82rem;font-family:'Nunito',sans-serif;color:var(--text);outline:none;background:var(--cream);min-width:140px;}
.filter-input--search{flex:1;min-width:180px;}
.data-table{width:100%;background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);border-collapse:collapse;}
.data-table th{background:var(--cream);padding:11px 16px;font-size:.72rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:var(--text-light);text-align:left;border-bottom:1px solid var(--border);}
.data-table td{padding:12px 16px;border-bottom:1px solid var(--border);font-size:.85rem;color:var(--text-mid);vertical-align:middle;}
.data-table tr:last-child td{border-bottom:none;}.data-table tr:hover td{background:#f8fbf8;}
.user-cell{display:flex;align-items:center;gap:12px;}
.user-avatar{width:36px;height:36px;border-radius:50%;overflow:hidden;background:var(--green-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--green);font-weight:800;font-size:.82rem;}
.user-avatar img{width:100%;height:100%;object-fit:cover;display:block;}
.user-name{font-weight:800;color:var(--text);font-size:.85rem;}
.user-email{font-size:.72rem;color:var(--text-light);}
.role-badge{display:inline-block;padding:3px 10px;border-radius:999px;font-size:.68rem;font-weight:800;text-transform:uppercase;letter-spacing:.06em;}
.role--admin{background:var(--green-light);color:var(--green);}.role--membre{background:var(--blue-light);color:var(--blue);}.role--moderateur{background:var(--purple-light);color:var(--purple);}
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:999px;font-size:.7rem;font-weight:800;}
.status--actif{background:var(--green-light);color:var(--green);}.status--inactif{background:#eceff1;color:#546e7a;}
.action-btns{display:flex;gap:6px;}
.btn-icon{width:30px;height:30px;border-radius:var(--radius-sm);border:1px solid var(--border);background:var(--cream);display:flex;align-items:center;justify-content:center;font-size:.78rem;cursor:pointer;text-decoration:none;transition:all .2s;}
.btn-icon--edit{color:var(--blue);}.btn-icon--edit:hover{background:var(--blue-light);border-color:#90caf9;}
.btn-icon--del{color:#e53935;}.btn-icon--del:hover{background:#ffebee;border-color:#ef9a9a;}
.pagination{display:flex;align-items:center;justify-content:space-between;padding:14px 4px 0;}
.pagination-info{font-size:.78rem;color:var(--text-light);}
.pagination-btns{display:flex;gap:6px;}
.pag-btn{width:32px;height:32px;border-radius:var(--radius-sm);border:1px solid var(--border);background:var(--cream);display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;cursor:pointer;text-decoration:none;color:var(--text-mid);transition:all .2s;}
.pag-btn:hover,.pag-btn.active{background:var(--green);color:white;border-color:var(--green);}
/* ===== MODAL ===== */
.modal-content{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(0,0,0,.15);
}

.modal-header{
    background:linear-gradient(135deg,var(--green),var(--green-dark));
    color:#fff;
    border:none;
    padding:18px 25px;
}

.modal-title{
    font-weight:800;
    font-size:1rem;
}

.modal-body{
    padding:25px;
    background:#fff;
}

.modal-footer{
    border:none;
    padding:18px 25px;
    background:#fafafa;
}

.form-label{
    font-size:.8rem;
    font-weight:700;
    color:var(--text);
    margin-bottom:6px;
}

.form-control,
.form-select{
    border:1px solid var(--border);
    border-radius:12px;
    min-height:46px;
    background:#fff;
    font-size:.85rem;
    transition:.3s;
}

.form-control:focus,
.form-select:focus{
    border-color:var(--green);
    box-shadow:0 0 0 .2rem rgba(27,94,32,.15);
}

.btn-save{
    background:var(--green);
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:10px;
    font-weight:700;
}

.btn-save:hover{
    background:var(--green-dark);
}

.btn-cancel{
    background:#eceff1;
    color:#455a64;
    border:none;
    padding:10px 20px;
    border-radius:10px;
    font-weight:700;
}

.table-responsive{
    overflow-x:auto;
}

@media(max-width:992px){
    .kpi-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px){
    .page-toolbar{
        flex-direction:column;
        gap:15px;
        align-items:flex-start;
    }

    .kpi-grid{
        grid-template-columns:1fr;
    }

    .filters-bar{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-input{
        width:100%;
    }
}
</style>
@endpush
@section('content')
<div class="page-toolbar">
  <h1>Utilisateurs <span style="font-weight:600;color:var(--text-light);font-size:.9rem;">(520)</span></h1>
  <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
    <i class="fas fa-user-plus"></i>
    Ajouter un utilisateur
</button>
</div>
<div class="kpi-grid">
  <div class="kpi-card"><div class="kpi-icon kpi-icon--green"><i class="fas fa-users"></i></div><div><div class="kpi-number">520</div><div class="kpi-label">Total membres</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--blue"><i class="fas fa-user-check"></i></div><div><div class="kpi-number">498</div><div class="kpi-label">Actifs</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--gold"><i class="fas fa-user-plus"></i></div><div><div class="kpi-number">+15</div><div class="kpi-label">Ce mois</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--purple"><i class="fas fa-user-shield"></i></div><div><div class="kpi-number">3</div><div class="kpi-label">Admins</div></div></div>
</div>
<div class="filters-bar">
  <input class="filter-input filter-input--search" type="text" placeholder="Rechercher un utilisateur...">
  <select class="filter-input"><option>Tous les rôles</option><option>Admin</option><option>Membre</option><option>Modérateur</option></select>
  <select class="filter-input"><option>Tous les statuts</option><option>Actif</option><option>Inactif</option></select>
</div>
<table class="data-table">
  <thead><tr><th><input type="checkbox"></th><th>Utilisateur</th><th>Rôle</th><th>Statut</th><th>Inscription</th><th>Dernière connexion</th><th>Actions</th></tr></thead>
  <tbody>
    @php $users=[['nom'=>'Kouadio Jean','email'=>'kouadio.j@gmail.com','role'=>'admin','statut'=>'actif','inscrit'=>'15 Jan. 2020','derniere'=>'Aujourd\'hui'],['nom'=>'Yao Rosine','email'=>'yao.r@gmail.com','role'=>'moderateur','statut'=>'actif','inscrit'=>'02 Mar. 2021','derniere'=>'Hier'],['nom'=>'Kouassi A. Marie','email'=>'kouassi.m@yahoo.fr','role'=>'membre','statut'=>'actif','inscrit'=>'10 Avr. 2022','derniere'=>'Il y a 3 jours'],['nom'=>'N\'Guessan Marc','email'=>'nguessan.m@gmail.com','role'=>'membre','statut'=>'actif','inscrit'=>'05 Mai 2022','derniere'=>'Il y a 1 sem.'],['nom'=>'Bamba Arlette','email'=>'bamba.a@gmail.com','role'=>'membre','statut'=>'actif','inscrit'=>'18 Juin 2023','derniere'=>'Il y a 2 sem.'],['nom'=>'Yapi Koren','email'=>'yapi.k@gmail.com','role'=>'membre','statut'=>'inactif','inscrit'=>'30 Juil. 2023','derniere'=>'Il y a 2 mois'],['nom'=>'Awo Toure','email'=>'awo.t@gmail.com','role'=>'membre','statut'=>'actif','inscrit'=>'10 Mai 2024','derniere'=>'Hier']]; @endphp
    @foreach($users as $u)
    <tr>
      <td><input type="checkbox"></td>
      <td><div class="user-cell"><div class="user-avatar">{{ strtoupper(substr($u['nom'],0,1)) }}</div><div><div class="user-name">{{ $u['nom'] }}</div><div class="user-email">{{ $u['email'] }}</div></div></div></td>
      <td><span class="role-badge role--{{ $u['role'] }}">{{ ucfirst($u['role']) }}</span></td>
      <td><span class="status-badge status--{{ $u['statut'] }}">{{ ucfirst($u['statut']) }}</span></td>
      <td style="font-size:.78rem;color:var(--text-light);">{{ $u['inscrit'] }}</td>
      <td style="font-size:.78rem;color:var(--text-light);">{{ $u['derniere'] }}</td>
      <td><div class="action-btns"><a href="#" class="btn-icon btn-icon--edit"><i class="fas fa-pen"></i></a><a href="#" class="btn-icon btn-icon--del"><i class="fas fa-trash"></i></a></div></td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="pagination"><div class="pagination-info">Affichage 1–7 sur 520 utilisateurs</div><div class="pagination-btns"><a href="#" class="pag-btn active">1</a><a href="#" class="pag-btn">2</a><a href="#" class="pag-btn">3</a><span class="pag-btn">…</span><a href="#" class="pag-btn">74</a></div></div>

<!-- Modal Ajout Utilisateur -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>
                    Ajouter un utilisateur
                </h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <form action=" " method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nom complet</label>
                            <input type="text"
                                   name="nom"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text"
                                   name="telephone"
                                   class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-select">
                                <option value="membre">Membre</option>
                                <option value="moderateur">Modérateur</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirmation</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Adresse</label>
                            <textarea name="adresse"
                                      rows="3"
                                      class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-cancel"
                            data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i>
                        Enregistrer
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection