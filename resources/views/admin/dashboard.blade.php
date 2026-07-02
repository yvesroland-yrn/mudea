@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Bienvenue dans l\'administration MUDEA')

@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
            --gold: #f5a623;
            --gold-light: #fff8e1;
            --blue: #1565c0;
            --blue-light: #e3f2fd;
            --purple: #6a1b9a;
            --purple-light: #f3e5f5;
            --orange: #e65100;
            --orange-light: #fff3e0;
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

        /* ── KPI CARDS ── */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .kpi-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--shadow-sm);
            transition: transform .25s, box-shadow .25s;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .kpi-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .kpi-icon--green {
            background: var(--green-light);
            color: var(--green);
        }

        .kpi-icon--blue {
            background: var(--blue-light);
            color: var(--blue);
        }

        .kpi-icon--gold {
            background: var(--gold-light);
            color: var(--orange);
        }

        .kpi-icon--purple {
            background: var(--purple-light);
            color: var(--purple);
        }

        .kpi-label {
            font-size: .75rem;
            color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 4px;
        }

        .kpi-number {
            font-size: 2rem;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
            margin-bottom: 6px;
        }

        .kpi-link {
            font-size: .75rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap .18s;
        }

        .kpi-link:hover {
            gap: 8px;
        }

        .kpi-link--green {
            color: var(--green);
        }

        .kpi-link--blue {
            color: var(--blue);
        }

        .kpi-link--gold {
            color: var(--orange);
        }

        .kpi-link--purple {
            color: var(--purple);
        }

        /* ── BOTTOM GRID ── */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            margin-bottom: 28px;
        }

        /* ── CHART CARD ── */
        .chart-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-sm);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: .95rem;
            font-weight: 800;
            color: var(--text);
        }

        .select-period {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--cream);
            font-size: .78rem;
            color: var(--text-mid);
            padding: 6px 12px;
            font-family: 'Nunito', sans-serif;
            cursor: pointer;
            outline: none;
        }

        .chart-area {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        canvas#visitesChart {
            width: 100% !important;
            height: 100% !important;
        }

        /* ── ACTIVITIES ── */
        .side-col {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
        }

        .info-card-title {
            font-size: .88rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 16px;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .activity-icon--green {
            background: var(--green-light);
            color: var(--green);
        }

        .activity-icon--blue {
            background: var(--blue-light);
            color: var(--blue);
        }

        .activity-icon--gold {
            background: var(--gold-light);
            color: var(--orange);
        }

        .activity-icon--purple {
            background: var(--purple-light);
            color: var(--purple);
        }

        .activity-icon--teal {
            background: #e0f7fa;
            color: #00838f;
        }

        .activity-body {
            flex: 1;
        }

        .activity-title {
            font-size: .82rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.3;
        }

        .activity-sub {
            font-size: .75rem;
            color: var(--text-mid);
        }

        .activity-time {
            font-size: .7rem;
            color: var(--text-light);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .see-all-link {
            font-size: .78rem;
            font-weight: 700;
            color: var(--green);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 12px;
        }

        .see-all-link:hover {
            gap: 8px;
        }

        /* Tâches */
        .tasks-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .task-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .task-check {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .task-check i {
            font-size: .6rem;
            color: white;
        }

        .task-name {
            font-size: .83rem;
            font-weight: 700;
            color: var(--text);
        }

        .task-status {
            font-size: .75rem;
            font-weight: 800;
        }

        .task-status--green {
            color: var(--green);
        }

        .task-status--blue {
            color: var(--blue);
        }

        .task-status--teal {
            color: #00838f;
        }

        .task-status--orange {
            color: var(--orange);
        }

        .btn-stats {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--green);
            color: white;
            padding: 13px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            font-family: 'Nunito', sans-serif;
            transition: background .2s;
            margin-top: 8px;
        }

        .btn-stats:hover {
            background: var(--green-dark);
        }

        /* ── ACCÈS RAPIDE + MINI STATS ── */
        .quick-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px 24px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-top: 16px;
        }

        .quick-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 16px 10px;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            cursor: pointer;
            text-decoration: none;
            transition: all .25s;
            background: var(--cream);
        }

        .quick-item:hover {
            background: var(--green-light);
            border-color: var(--green-soft);
            transform: translateY(-2px);
        }

        .quick-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .quick-icon--green {
            background: var(--green-light);
            color: var(--green);
        }

        .quick-icon--blue {
            background: var(--blue-light);
            color: var(--blue);
        }

        .quick-icon--gold {
            background: var(--gold-light);
            color: var(--orange);
        }

        .quick-icon--purple {
            background: var(--purple-light);
            color: var(--purple);
        }

        .quick-icon--dark {
            background: #eceff1;
            color: #455a64;
        }

        .quick-label {
            font-size: .75rem;
            font-weight: 700;
            color: var(--text-mid);
            text-align: center;
            line-height: 1.3;
        }

        .mini-stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
        }

        .mini-stat {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px;
            box-shadow: var(--shadow-sm);
        }

        .mini-stat-label {
            font-size: .72rem;
            color: var(--text-light);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .mini-stat-number {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }

        .mini-stat-trend {
            font-size: .72rem;
            font-weight: 700;
        }

        .mini-stat-trend--up {
            color: var(--green);
        }

        .mini-stat-trend--down {
            color: #e53935;
        }

        .mini-sparkline {
            margin-top: 10px;
            height: 32px;
        }

        .mini-sparkline svg {
            width: 100%;
            height: 32px;
        }

        @media (max-width: 1200px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .quick-grid,
            .mini-stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .quick-grid,
            .mini-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .chart-card,
            .quick-card,
            .info-card {
                padding: 18px;
            }

            .activity-item {
                flex-wrap: wrap;
            }

            .activity-time {
                width: 100%;
                margin-left: 0;
            }
        }

        @media (max-width: 560px) {

            .quick-grid,
            .mini-stats-grid {
                grid-template-columns: 1fr;
            }

            .task-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-stats {
                text-align: center;
            }
        }
    </style>
@endpush

@section('content')

    {{-- KPI --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--green"><i class="fas fa-newspaper"></i></div>
            <div>
                <div class="kpi-label">Actualités</div>
                <div class="kpi-number">125</div>
                <a href="{{ route('admin.actualites.index') }}" class="kpi-link kpi-link--green">Voir tous &rarr;</a>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--blue"><i class="fas fa-folder-open"></i></div>
            <div>
                <div class="kpi-label">Projets</div>
                <div class="kpi-number">18</div>
                <a href="{{ route('admin.projets') }}" class="kpi-link kpi-link--blue">Voir tous &rarr;</a>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--gold"><i class="fas fa-people-group"></i></div>
            <div>
                <div class="kpi-label">Membres</div>
                <div class="kpi-number">520</div>
                <a href="{{ route('admin.utilisateurs') }}" class="kpi-link kpi-link--gold">Voir tous &rarr;</a>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon--purple"><i class="fas fa-envelope"></i></div>
            <div>
                <div class="kpi-label">Messages</div>
                <div class="kpi-number">46</div>
                <a href="{{ route('admin.messages') }}" class="kpi-link kpi-link--purple">Voir tous &rarr;</a>
            </div>
        </div>
    </div>

    {{-- CHART + SIDE --}}
    <div class="dashboard-grid">

        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Chart --}}
            <div class="chart-card">
                <div class="card-header">
                    <div class="card-title">Visites du portail</div>
                    <select class="select-period">
                        <option>6 derniers mois</option>
                        <option>3 derniers mois</option>
                        <option>12 derniers mois</option>
                    </select>
                </div>
                <div class="chart-area">
                    <canvas id="visitesChart"></canvas>
                </div>
            </div>

            {{-- Accès rapide --}}
            <div class="quick-card">
                <div class="card-title">Accès rapide</div>
                <div class="quick-grid">
                    <a href="{{ route('admin.actualites.index') }}" class="quick-item">
                        <div class="quick-icon quick-icon--green"><i class="fas fa-pencil"></i></div>
                        <div class="quick-label">Créer une actualité</div>
                    </a>
                    <a href="{{ route('admin.projets') }}" class="quick-item">
                        <div class="quick-icon quick-icon--blue"><i class="fas fa-folder-plus"></i></div>
                        <div class="quick-label">Créer un projet</div>
                    </a>
                    <a href="{{ route('admin.communaute') }}" class="quick-item">
                        <div class="quick-icon quick-icon--gold"><i class="fas fa-calendar-plus"></i></div>
                        <div class="quick-label">Créer un événement</div>
                    </a>
                    <!-- <a href="{{ route('admin.pages') }}" class="quick-item">
              <div class="quick-icon quick-icon--purple"><i class="fas fa-file-circle-plus"></i></div>
              <div class="quick-label">Publier une page</div>
            </a> -->
                    <a href="{{ route('admin.messages') }}" class="quick-item">
                        <div class="quick-icon quick-icon--dark"><i class="fas fa-envelope-open-text"></i></div>
                        <div class="quick-label">Voir les messages</div>
                    </a>
                </div>
            </div>

            {{-- Mini stats --}}
            <div class="mini-stats-grid">
                @php
                    $ministats = [
                        [
                            'label' => 'Actualités publiées',
                            'val' => '125',
                            'trend' => '+10 ce mois',
                            'up' => true,
                            'color' => '#1b5e20',
                            'pts' => [10, 15, 12, 18, 14, 20, 22],
                        ],
                        [
                            'label' => 'Projets en cours',
                            'val' => '18',
                            'trend' => '+2 ce mois',
                            'up' => true,
                            'color' => '#1565c0',
                            'pts' => [8, 9, 10, 12, 13, 15, 18],
                        ],
                        [
                            'label' => 'Membres',
                            'val' => '520',
                            'trend' => '+15 ce mois',
                            'up' => true,
                            'color' => '#e65100',
                            'pts' => [460, 470, 480, 490, 500, 510, 520],
                        ],
                        [
                            'label' => 'Taux d\'engagement',
                            'val' => '68%',
                            'trend' => '+5% ce mois',
                            'up' => true,
                            'color' => '#6a1b9a',
                            'pts' => [50, 55, 58, 60, 62, 65, 68],
                        ],
                        [
                            'label' => 'Messages non lus',
                            'val' => '46',
                            'trend' => '-3 ce mois',
                            'up' => false,
                            'color' => '#e53935',
                            'pts' => [60, 55, 52, 50, 48, 49, 46],
                        ],
                    ];
                @endphp
                @foreach ($ministats as $s)
                    <div class="mini-stat">
                        <div class="mini-stat-label">{{ $s['label'] }}</div>
                        <div class="mini-stat-number">{{ $s['val'] }}</div>
                        <div class="mini-stat-trend {{ $s['up'] ? 'mini-stat-trend--up' : 'mini-stat-trend--down' }}">
                            {{ $s['trend'] }}
                        </div>
                        <div class="mini-sparkline">
                            @php
                                $pts = $s['pts'];
                                $min = min($pts);
                                $max = max($pts);
                                $range = $max - $min ?: 1;
                                $w = 100 / (count($pts) - 1);
                                $path = '';
                                foreach ($pts as $i => $v) {
                                    $x = $i * $w;
                                    $y = 28 - (($v - $min) / $range) * 24;
                                    $path .= $i === 0 ? "M $x,$y" : " L $x,$y";
                                }
                            @endphp
                            <svg viewBox="0 0 100 32" preserveAspectRatio="none">
                                <path d="{{ $path }}" fill="none" stroke="{{ $s['color'] }}" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Side col --}}
        <div class="side-col">

            {{-- Dernières activités --}}
            <div class="info-card">
                <div class="info-card-title">Dernières activités</div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon activity-icon--green"><i class="fas fa-newspaper"></i></div>
                        <div class="activity-body">
                            <div class="activity-title">Nouvelle actualité publiée</div>
                            <div class="activity-sub">Festival des Mangues d'Essa 2024</div>
                        </div>
                        <div class="activity-time">Il y a 1 heure</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-icon--blue"><i class="fas fa-folder-open"></i></div>
                        <div class="activity-body">
                            <div class="activity-title">Nouveau projet créé</div>
                            <div class="activity-sub">Construction du Centre de Santé</div>
                        </div>
                        <div class="activity-time">Il y a 3 heures</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-icon--gold"><i class="fas fa-envelope"></i></div>
                        <div class="activity-body">
                            <div class="activity-title">Nouveau message reçu</div>
                            <div class="activity-sub">Demande d'information sur l'adhésion</div>
                        </div>
                        <div class="activity-time">Il y a 7 heures</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-icon--purple"><i class="fas fa-comment-dots"></i></div>
                        <div class="activity-body">
                            <div class="activity-title">Nouveau témoignage publié</div>
                            <div class="activity-sub">Témoignage de M. J. D. Amon</div>
                        </div>
                        <div class="activity-time">Il y a 1 jour</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon activity-icon--teal"><i class="fas fa-user-plus"></i></div>
                        <div class="activity-body">
                            <div class="activity-title">Nouvel utilisateur inscrit</div>
                            <div class="activity-sub">Awo Toure (membre)</div>
                        </div>
                        <div class="activity-time">Il y a 2 jours</div>
                    </div>
                </div>
                <a href="#" class="see-all-link">Voir toutes les activités &rarr;</a>
            </div>

            {{-- Tâches --}}
            <div class="info-card">
                <div class="info-card-title">Tâches du jour</div>
                <div class="tasks-list">
                    <div class="task-item">
                        <div class="task-left">
                            <div class="task-check"><i class="fas fa-check"></i></div>
                            <div class="task-name">Site en ligne</div>
                        </div>
                        <div class="task-status task-status--green">Actif</div>
                    </div>
                    <div class="task-item">
                        <div class="task-left">
                            <div class="task-check"><i class="fas fa-check"></i></div>
                            <div class="task-name">Sauvegarde</div>
                        </div>
                        <div class="task-status task-status--blue">À jour</div>
                    </div>
                    <div class="task-item">
                        <div class="task-left">
                            <div class="task-check"><i class="fas fa-check"></i></div>
                            <div class="task-name">Mises de données</div>
                        </div>
                        <div class="task-status task-status--teal">Connectée</div>
                    </div>
                    <div class="task-item">
                        <div class="task-left">
                            <div class="task-check"><i class="fas fa-check"></i></div>
                            <div class="task-name">Espace disque</div>
                        </div>
                        <div class="task-status task-status--orange">72% utilisé</div>
                    </div>
                </div>
                <a href="{{ route('admin.statistiques') }}" class="btn-stats">
                    <i class="fas fa-chart-bar"></i> Voir les statistiques détaillées
                </a>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        (function() {
            const ctx = document.getElementById('visitesChart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Visites',
                        data: [2450, 3100, 4230, 5180, 4750, 5680],
                        borderColor: '#1b5e20',
                        backgroundColor: 'rgba(27,94,32,.08)',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#1b5e20',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.35,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: 'Nunito',
                                    size: 12
                                },
                                boxWidth: 14,
                                padding: 16
                            }
                        },
                        tooltip: {
                            bodyFont: {
                                family: 'Nunito'
                            },
                            titleFont: {
                                family: 'Nunito'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Nunito',
                                    size: 11
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(0,0,0,.05)'
                            },
                            ticks: {
                                font: {
                                    family: 'Nunito',
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endpush
