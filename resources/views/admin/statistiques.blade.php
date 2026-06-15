@extends('admin.layouts.app')
@section('title','Statistiques')
@section('page-title','Statistiques')
@section('page-subtitle','Analyse des performances du portail')
@push('styles')
<style>
:root{--green:#1b5e20;--green-dark:#0a3d14;--green-light:#e8f5e9;--green-soft:#c8e6c9;--gold:#f5a623;--gold-light:#fff8e1;--blue:#1565c0;--blue-light:#e3f2fd;--purple:#6a1b9a;--purple-light:#f3e5f5;--orange:#e65100;--white:#ffffff;--cream:#f4f6f8;--border:#e0e8e4;--text:#1a2e25;--text-mid:#455d4f;--text-light:#7a9585;--shadow-sm:0 2px 10px rgba(0,0,0,.07);--radius-sm:8px;--radius-md:14px;--radius-lg:20px;}
.kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
.kpi-card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);padding:20px;display:flex;align-items:center;gap:14px;box-shadow:var(--shadow-sm);}
.kpi-icon{width:52px;height:52px;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
.kpi-icon--green{background:var(--green-light);color:var(--green);}.kpi-icon--blue{background:var(--blue-light);color:var(--blue);}.kpi-icon--gold{background:var(--gold-light);color:var(--orange);}.kpi-icon--purple{background:var(--purple-light);color:var(--purple);}
.kpi-number{font-size:1.7rem;font-weight:900;color:var(--text);line-height:1;}.kpi-label{font-size:.72rem;color:var(--text-light);font-weight:700;text-transform:uppercase;letter-spacing:.07em;}.kpi-trend{font-size:.72rem;font-weight:800;color:var(--green);margin-top:2px;}
.charts-grid{display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:20px;}
.chart-card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius-lg);padding:22px;box-shadow:var(--shadow-sm);}
.chart-title{font-size:.9rem;font-weight:800;color:var(--text);margin-bottom:18px;}
.chart-area{height:200px;}
.stat-list{display:flex;flex-direction:column;gap:12px;}
.stat-item{display:flex;align-items:center;gap:10px;}
.stat-name{font-size:.82rem;color:var(--text-mid);flex:1;}
.stat-bar-wrap{flex:2;height:8px;background:var(--cream);border-radius:999px;overflow:hidden;}
.stat-bar-fill{height:100%;border-radius:999px;background:var(--green);}
.stat-pct{font-size:.75rem;font-weight:800;color:var(--green);min-width:36px;text-align:right;}
.bottom-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
</style>
@endpush
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;">
  <h1 style="font-size:1.1rem;font-weight:800;color:var(--text);">Vue d'ensemble</h1>
  <select style="border:1px solid var(--border);border-radius:var(--radius-sm);padding:8px 14px;font-size:.82rem;font-family:'Nunito',sans-serif;background:var(--cream);color:var(--text);outline:none;"><option>6 derniers mois</option><option>12 derniers mois</option><option>Cette année</option></select>
</div>
<div class="kpi-grid">
  <div class="kpi-card"><div class="kpi-icon kpi-icon--green"><i class="fas fa-eye"></i></div><div><div class="kpi-number">28 390</div><div class="kpi-label">Visites totales</div><div class="kpi-trend">+18% ce mois</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--blue"><i class="fas fa-users"></i></div><div><div class="kpi-number">12 450</div><div class="kpi-label">Visiteurs uniques</div><div class="kpi-trend">+12% ce mois</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--gold"><i class="fas fa-clock"></i></div><div><div class="kpi-number">3:24</div><div class="kpi-label">Temps moyen</div><div class="kpi-trend">+0:32 ce mois</div></div></div>
  <div class="kpi-card"><div class="kpi-icon kpi-icon--purple"><i class="fas fa-arrow-trend-down"></i></div><div><div class="kpi-number">42%</div><div class="kpi-label">Taux de rebond</div><div class="kpi-trend" style="color:#e53935;">-2% ce mois</div></div></div>
</div>
<div class="charts-grid">
  <div class="chart-card">
    <div class="chart-title">Évolution des visites</div>
    <div class="chart-area"><canvas id="mainChart"></canvas></div>
  </div>
  <div class="chart-card">
    <div class="chart-title">Pages les plus vues</div>
    <div class="stat-list">
      @php $pages=[['nom'=>'Accueil','pct'=>45],['nom'=>'Éducation','pct'=>28],['nom'=>'Projets','pct'=>22],['nom'=>'Actualités','pct'=>18],['nom'=>'Mutuelle','pct'=>14],['nom'=>'Communauté','pct'=>10]]; @endphp
      @foreach($pages as $p)
      <div class="stat-item">
        <div class="stat-name">{{ $p['nom'] }}</div>
        <div class="stat-bar-wrap"><div class="stat-bar-fill" style="width:{{ $p['pct'] }}%"></div></div>
        <div class="stat-pct">{{ $p['pct'] }}%</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="bottom-grid">
  <div class="chart-card"><div class="chart-title">Contenu publié</div><div style="height:160px;"><canvas id="contentChart"></canvas></div></div>
  <div class="chart-card"><div class="chart-title">Appareils utilisés</div><div style="height:160px;"><canvas id="deviceChart"></canvas></div></div>
  <div class="chart-card"><div class="chart-title">Sources de trafic</div><div style="height:160px;"><canvas id="sourceChart"></canvas></div></div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
const green='#1b5e20',greenLight='rgba(27,94,32,.08)',blue='#1565c0',gold='#f5a623',purple='#6a1b9a',orange='#e65100';
new Chart(document.getElementById('mainChart'),{type:'line',data:{labels:['Jan','Fév','Mar','Avr','Mai','Jun'],datasets:[{label:'Visites',data:[2450,3100,4230,5180,4750,5680],borderColor:green,backgroundColor:greenLight,borderWidth:2.5,fill:true,tension:.35,pointRadius:4}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false},ticks:{font:{family:'Nunito',size:11}}},y:{grid:{color:'rgba(0,0,0,.05)'},ticks:{font:{family:'Nunito',size:11}}}}}});
new Chart(document.getElementById('contentChart'),{type:'bar',data:{labels:['Actus','Projets','Pages','Photos'],datasets:[{data:[125,18,8,320],backgroundColor:[green,blue,gold,purple]}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false},ticks:{font:{family:'Nunito',size:10}}},y:{grid:{color:'rgba(0,0,0,.05)'},ticks:{font:{family:'Nunito',size:10}}}}}});
new Chart(document.getElementById('deviceChart'),{type:'doughnut',data:{labels:['Mobile','Desktop','Tablette'],datasets:[{data:[58,36,6],backgroundColor:[green,blue,gold],borderWidth:0}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{font:{family:'Nunito',size:11},boxWidth:12,padding:12}}}}});
new Chart(document.getElementById('sourceChart'),{type:'doughnut',data:{labels:['Direct','Réseaux','Recherche','Référence'],datasets:[{data:[35,30,25,10],backgroundColor:[green,blue,gold,orange],borderWidth:0}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{font:{family:'Nunito',size:11},boxWidth:12,padding:12}}}}});
</script>
@endpush