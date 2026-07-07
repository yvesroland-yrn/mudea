@extends('admin.layouts.app')
@section('title', 'Paramètres')
@section('page-title', 'Paramètres')
@section('page-subtitle', 'Configuration du site MUDEA')
@push('styles')
    <style>
        :root {
            --green: #1b5e20;
            --green-dark: #0a3d14;
            --green-light: #e8f5e9;
            --green-soft: #c8e6c9;
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

        .params-layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 24px;
        }

        .params-nav {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 12px 0;
            box-shadow: var(--shadow-sm);
            align-self: start;
        }

        .params-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            font-size: .85rem;
            font-weight: 600;
            color: var(--text-mid);
            cursor: pointer;
            text-decoration: none;
            transition: all .18s;
            border-left: 3px solid transparent;
        }

        .params-nav-item:hover {
            background: var(--cream);
            color: var(--text);
        }

        .params-nav-item.active {
            background: var(--green-light);
            color: var(--green);
            border-left-color: var(--green);
            font-weight: 800;
        }

        .params-nav-item i {
            width: 18px;
            text-align: center;
        }

        .params-section {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
        }

        .params-section-title {
            font-size: .95rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 22px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: 1/-1;
        }

        .form-label {
            font-size: .75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--text-light);
        }

        .form-input {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 12px;
            font-size: .88rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            outline: none;
            background: var(--cream);
            transition: border-color .18s;
        }

        .form-input:focus {
            border-color: var(--green);
        }

        .form-textarea {
            min-height: 90px;
            resize: vertical;
        }

        .form-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .form-toggle:last-child {
            border-bottom: none;
        }

        .toggle-info strong {
            display: block;
            font-size: .85rem;
            font-weight: 700;
            color: var(--text);
        }

        .toggle-info span {
            font-size: .75rem;
            color: var(--text-light);
        }

        .switch {
            position: relative;
            width: 44px;
            height: 24px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: #ccc;
            border-radius: 24px;
            transition: .3s;
        }

        .slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            bottom: 3px;
            background: white;
            border-radius: 50%;
            transition: .3s;
        }

        .switch input:checked+.slider {
            background: var(--green);
        }

        .switch input:checked+.slider::before {
            transform: translateX(20px);
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: white;
            padding: 11px 24px;
            border-radius: var(--radius-sm);
            font-size: .82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            border: none;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: background .2s;
            margin-top: 8px;
        }

        .btn-save:hover {
            background: var(--green-dark);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.params-nav-item');
            const sections = document.querySelectorAll('.params-section');

            function showSection(sectionId) {
                // Hide all sections
                sections.forEach(section => {
                    section.style.display = 'none';
                });

                // Show selected section
                const targetSection = document.querySelector(sectionId);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }

                // Update active nav item
                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('href') === sectionId) {
                        item.classList.add('active');
                    }
                });
            }

            // Add click handlers
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('href');
                    showSection(sectionId);
                });
            });

            // Show general section by default
            showSection('#general');
        });
    </script>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert" style="margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="params-layout">
        <nav class="params-nav">
            <a href="#general" class="params-nav-item"><i class="fas fa-globe"></i> Général</a>
            <a href="#security" class="params-nav-item"><i class="fas fa-shield-halved"></i> Sécurité</a>
        </nav>
        <div>
            <div class="params-section" id="general">
                <div class="params-section-title">Informations générales</div>
                <form action="{{ route('admin.parametres.profile.update') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Nom complet</label><input class="form-input"
                                type="text" name="nom_complet" value="{{ Auth::user()->nom_complet }}" required></div>
                        <div class="form-group"><label class="form-label">Email</label><input class="form-input"
                                type="email" name="email" value="{{ Auth::user()->email }}" required></div>
                        <div class="form-group"><label class="form-label">Téléphone</label><input class="form-input"
                                type="text" name="telephone" value="{{ Auth::user()->telephone }}"></div>
                        <div class="form-group"><label class="form-label">Adresse</label><input class="form-input"
                                type="text" name="adresse" value="{{ Auth::user()->adresse }}"></div>
                    </div>
                    <button type="submit" class="btn-save"><i class="fas fa-floppy-disk"></i> Sauvegarder</button>
                </form>
            </div>

            <div class="params-section" id="security">
                <div class="params-section-title">Modification de mot de passe</div>
                <form action="{{ route('admin.parametres.password.update') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group"><label class="form-label">Ancien mot de passe</label><input
                                class="form-input" type="password" name="current_password" required></div>
                        <div class="form-group"><label class="form-label">Nouveau mot de passe</label><input
                                class="form-input" type="password" name="password" required></div>
                        <div class="form-group"><label class="form-label">Confirmation mot de passe</label><input
                                class="form-input" type="password" name="password_confirmation" required></div>
                    </div>
                    <button type="submit" class="btn-save"><i class="fas fa-floppy-disk"></i> Mettre à jour</button>
                </form>
            </div>

        </div>
    </div>
@endsection
