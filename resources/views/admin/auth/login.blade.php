<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion MUDEA</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green: #146B3A;
            --green-dark: #0d4a28;
            --green-light: #1e8a4a;
            --gold: #d4880a;
            --gold-light: #f5c518;
            --bg: #f0f4f1;
            --text: #1a1a1a;
            --muted: #6b7280;
            --border: #e5e7eb;
            --input-bg: #f5f7fa;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: var(--bg);
            position: relative;
            overflow-x: hidden;
        }

        /* ── Fond décoratif ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 600px 400px at 0% 0%, rgba(20, 107, 58, .13) 0%, transparent 70%),
                radial-gradient(ellipse 500px 350px at 100% 100%, rgba(212, 136, 10, .10) 0%, transparent 70%),
                radial-gradient(ellipse 400px 300px at 60% 20%, rgba(20, 107, 58, .06) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ══ CARD ══════════════════════════════════════ */
        .login-card {
            width: 1100px;
            max-width: 100%;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 420px 1fr;
            box-shadow: 0 32px 80px rgba(0, 0, 0, .13), 0 2px 8px rgba(0, 0, 0, .06);
            position: relative;
            z-index: 2;
        }

        /* ══ COLONNE GAUCHE : Formulaire ════════════════ */
        .login-form {
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        /* Logo */
        .logo-box {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 40px;
        }

        .logo-img-wrap {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(20, 107, 58, .28);
        }

        .logo-img-wrap img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .logo-img-wrap svg {
            color: #fff;
        }

        .logo-text h3 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--green);
            line-height: 1.1;
        }

        .logo-text p {
            font-size: .72rem;
            color: var(--muted);
            line-height: 1.3;
        }

        /* Titre */
        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--green-dark);
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .form-heading p {
            font-size: .86rem;
            color: var(--muted);
            line-height: 1.5;
        }

        /* Champs */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: .8rem;
            font-weight: 700;
            color: var(--text);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
            transition: color .2s;
        }

        .input-wrap input {
            width: 100%;
            height: 50px;
            border: 1.5px solid var(--border);
            background: var(--input-bg);
            border-radius: 11px;
            padding: 0 16px 0 44px;
            font-size: .9rem;
            color: var(--text);
            transition: border-color .2s, box-shadow .2s, background .2s;
            outline: none;
        }

        .input-wrap input:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(20, 107, 58, .12);
        }

        .input-wrap input:focus+svg,
        .input-wrap:focus-within svg {
            color: var(--green);
        }

        /* Bouton afficher MDP */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 4px;
            line-height: 0;
            transition: color .2s;
        }

        .toggle-pw:hover {
            color: var(--green);
        }

        /* Options */
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 14px 0 22px;
            gap: 10px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .82rem;
            color: var(--muted);
            cursor: pointer;
            user-select: none;
        }

        .remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--green);
            cursor: pointer;
        }

        .options a {
            font-size: .82rem;
            color: var(--gold);
            font-weight: 700;
            text-decoration: none;
            transition: color .2s;
        }

        .options a:hover {
            color: var(--gold-light);
        }

        /* Bouton connexion */
        .btn-login {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--green-light) 0%, var(--green-dark) 100%);
            color: #fff;
            font-size: .92rem;
            font-weight: 800;
            letter-spacing: .4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(20, 107, 58, .3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(20, 107, 58, .38);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            color: var(--muted);
            font-size: .78rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Pied de formulaire */
        .form-footer {
            text-align: center;
            font-size: .78rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .form-footer a {
            color: var(--green);
            font-weight: 700;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* ══ COLONNE DROITE : Image/Contenu ═════════════ */
        .login-image {
            position: relative;
            background:
                linear-gradient(160deg, rgba(13, 74, 40, .25) 0%, rgba(13, 74, 40, .88) 100%),
                url('{{ asset('images/hero-ande.png') }}') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* Motif géométrique décoratif */
        .login-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 75% 20%, rgba(245, 197, 24, .18) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(20, 107, 58, .3) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Pastilles décoratives */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .12);
            pointer-events: none;
        }

        .deco-circle.c1 {
            width: 200px;
            height: 200px;
            top: -60px;
            right: -60px;
        }

        .deco-circle.c2 {
            width: 120px;
            height: 120px;
            top: 30px;
            right: 30px;
            border-color: rgba(245, 197, 24, .25);
        }

        .deco-circle.c3 {
            width: 80px;
            height: 80px;
            top: 70px;
            right: 70px;
        }

        .image-content {
            position: relative;
            z-index: 2;
            padding: 44px 44px 48px;
            color: #fff;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 18px;
            border-radius: 50px;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .22);
            font-size: .76rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 22px;
            letter-spacing: .05em;
        }

        .badge-pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold-light);
            box-shadow: 0 0 6px var(--gold-light);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .6;
                transform: scale(.75);
            }
        }

        .image-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 16px;
            text-shadow: 0 2px 12px rgba(0, 0, 0, .25);
        }

        .image-content h2 span {
            color: var(--gold-light);
        }

        .image-content p {
            font-size: .88rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, .82);
            margin-bottom: 28px;
            max-width: 380px;
        }

        .features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .84rem;
            color: rgba(255, 255, 255, .9);
        }

        .feat-icon {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feat-icon svg {
            color: var(--gold-light);
        }

        /* Stats rapides */
        .stats-row {
            display: flex;
            gap: 20px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, .15);
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .stat-item strong {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--gold-light);
            line-height: 1;
        }

        .stat-item span {
            font-size: .7rem;
            color: rgba(255, 255, 255, .65);
        }

        /* ══ RESPONSIVE ══════════════════════════════════ */
        @media (max-width: 900px) {
            .login-card {
                grid-template-columns: 1fr;
                border-radius: 20px;
            }

            .login-image {
                min-height: 360px;
                order: -1;
                /* image en haut sur mobile */
            }

            .image-content {
                padding: 32px 32px 36px;
            }

            .image-content h2 {
                font-size: 1.7rem;
            }

            .stats-row {
                display: none;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 14px;
            }

            .login-form {
                padding: 32px 24px 36px;
            }

            .form-heading h1 {
                font-size: 2rem;
            }

            .options {
                flex-direction: column;
                align-items: flex-start;
            }

            .image-content {
                padding: 24px 24px 28px;
            }

            .image-content h2 {
                font-size: 1.45rem;
            }

            .image-content p {
                font-size: .82rem;
            }

            .login-card {
                border-radius: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">

        {{-- ── Colonne gauche : Formulaire ── --}}
        <div class="login-form">

            <div class="logo-box">
                <div class="logo-img-wrap">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo MUDEA"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                    <svg style="display:none" width="28" height="28" fill="none" stroke="currentColor"
                        stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
                <div class="logo-text">
                    <h3>MUDEA</h3>
                    <p>Mutuelle de Développement d'Andé</p>
                </div>
            </div>

            <div class="form-heading">
                <h1>Connexion</h1>
                <p>Connectez-vous à votre espace sécurisé.</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- AFFICHAGE DES ERREURS GLOBALES --}}
                @if ($errors->has('login'))
                    <div
                        style="background:#ffebee;border:1px solid #ef9a9a;color:#c62828;padding:10px 14px;border-radius:8px;font-size:.8rem;margin-bottom:14px;font-weight:600;">
                        <ul style="margin:0;padding-left:20px;">
                            <li>{{ $errors->first('login') }}</li>
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <div class="input-wrap">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M4 4h16v16H4z" />
                            <polyline points="22 6 12 13 2 6" />
                        </svg>
                        <input type="email" id="email" name="email" placeholder="votre@email.com"
                            value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <p style="color:#e53935;font-size:.75rem;margin-top:5px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()" title="Afficher/Masquer">
                            <svg id="eye-icon" width="17" height="17" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p style="color:#e53935;font-size:.75rem;margin-top:5px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Se souvenir de moi
                    </label>
                    {{-- @if (Route::has('password.request')) --}}
                        <a href="#">Mot de passe oublié ?</a>
                    {{-- @endif --}}
                </div>

                @if (session('status'))
                    <div
                        style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:10px 14px;border-radius:8px;font-size:.8rem;margin-bottom:14px;font-weight:600;">
                        {{ session('status') }}
                    </div>
                @endif

                <button type="submit" class="btn-login">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Se connecter
                </button>
            </form>

            <div class="divider">ou</div>

            <p class="form-footer">
                Pas encore membre ?
                <a href="">Créer un compte</a>
            </p>

        </div>

        {{-- ── Colonne droite : Image ── --}}
        <div class="login-image">

            <div class="deco-circle c1"></div>
            <div class="deco-circle c2"></div>
            <div class="deco-circle c3"></div>

            <div class="image-content">

                <span class="badge-pill">
                    <span class="badge-pill-dot"></span>
                    Portail Institutionnel
                </span>

                <h2>Bienvenue sur<br>l'espace <span>MUDEA</span></h2>

                <p>Gérez vos informations, consultez les actualités et accédez facilement aux services de la Mutuelle de
                    Développement d'Andé.</p>

                <ul class="features">
                    <li>
                        <div class="feat-icon">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="3" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                        </div>
                        Connexion sécurisée et protégée
                    </li>
                    <li>
                        <div class="feat-icon">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                            </svg>
                        </div>
                        Accès rapide à tous vos services
                    </li>
                    <li>
                        <div class="feat-icon">
                            <svg width="13" height="13" fill="none" stroke="currentColor"
                                stroke-width="3" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <path d="M3 9h18M9 21V9" />
                            </svg>
                        </div>
                        Interface moderne et intuitive
                    </li>
                </ul>

                <div class="stats-row">
                    <div class="stat-item">
                        <strong>850+</strong>
                        <span>Membres actifs</span>
                    </div>
                    <div class="stat-item">
                        <strong>12+</strong>
                        <span>Projets réalisés</span>
                    </div>
                    <div class="stat-item">
                        <strong>2 500+</strong>
                        <span>Bénéficiaires</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>`;
            }
        }
    </script>

</body>

</html>
