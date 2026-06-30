{{-- resources/views/layouts/footer.blade.php --}}
<footer class="mudea-footer">
    <div class="footer-inner">
        <div class="footer-col footer-col--brand">
            <a href="{{ route('home') }}" class="footer-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo MUDEA" class="footer-logo-img">
                <div class="footer-logo-text">
                    <span class="footer-logo-name">MUDEA</span>
                    <span class="footer-logo-sub">Mutuelle de D&eacute;veloppement<br>d'And&eacute;</span>
                </div>
            </a>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-title">Liens Rapides</h4>
            <ul class="footer-links">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('mutuelle') }}">La Mutuelle</a></li>
                <li><a href="{{ route('gouvernance') }}">Gouvernance</a></li>
                <li><a href="{{ route('chefferie') }}">Vie &amp; Coutumes</a></li>
                <li><a href="{{ route('education') }}">Adh&eacute;rer</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-title">Pages</h4>
            <ul class="footer-links">
                <li><a href="{{ route('projets') }}">Projets</a></li>
                <li><a href="{{ route('jeunesse') }}">Espace Communautaire</a></li>
                <li><a href="{{ route('actualites') }}">Actualit&eacute;s</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div class="footer-col footer-col--contact">
            <h4 class="footer-col-title">Nous Contacter</h4>
            <ul class="footer-contact-list">
                <li>
                    <svg class="footer-icon" viewBox="0 0 24 24" fill="currentColor" width="14" height="14">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"></path>
                    </svg>
                    <span>And&eacute;, C&ocirc;te d'Ivoire</span>
                </li>
                <li>
                    <svg class="footer-icon" viewBox="0 0 24 24" fill="currentColor" width="14" height="14">
                        <path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.27 11.36 11.36 0 003.55.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1 11.36 11.36 0 00.57 3.55 1 1 0 01-.27 1.11z"></path>
                    </svg>
                    <span>+225 07 00 00 00 00</span>
                </li>
                <li>
                    <svg class="footer-icon" viewBox="0 0 24 24" fill="currentColor" width="14" height="14">
                        <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                    </svg>
                    <span>contact@mudea-ande.ci</span>
                </li>
            </ul>
        </div>

        <div class="footer-col footer-col--social">
            <h4 class="footer-col-title">Suivez-Nous</h4>
            <div class="footer-social">
                <a href="#" class="social-icon social-icon--facebook" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a href="#" class="social-icon social-icon--whatsapp" aria-label="WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"></path>
                        <path d="M12 2C6.48 2 2 6.48 2 12c0 1.85.5 3.58 1.37 5.07L2 22l5.09-1.34A9.94 9.94 0 0012 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"></path>
                    </svg>
                </a>
                <a href="#" class="social-icon social-icon--youtube" aria-label="YouTube">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"></path>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#fff"></polygon>
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-col footer-col--newsletter">
            <h4 class="footer-col-title">Newsletter</h4>
            <p class="footer-newsletter-text">Abonnez-vous pour recevoir nos actualit&eacute;s et annonces.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="footer-newsletter-form">
                @csrf
                <input type="email" name="email" class="footer-newsletter-input" placeholder="Votre email" required>
                <button type="submit" class="footer-newsletter-btn" aria-label="S'abonner">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                        <path d="M2 21l21-9L2 3v7l15 2-15 2z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} MUDEA - Mutuelle de D&eacute;veloppement d'And&eacute;. Tous droits r&eacute;serv&eacute;s.
    </div>

    <style>
        .footer-col--newsletter .footer-newsletter-text {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .footer-newsletter-form {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .footer-newsletter-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 0.7rem 1rem;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
        }

        .footer-newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-newsletter-btn {
            background: #C9A227;
            border: none;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1B5E3C;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .footer-newsletter-btn:hover {
            background: #b8901f;
        }
    </style>
</footer>
