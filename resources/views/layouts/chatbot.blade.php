{{--
    Widget Chatbox Flottant - MUDEA
    Comportement : bulle flottante (bas-droite) -> clic -> ouverture d'une
    fenêtre de chat façon messagerie. L'assistant propose d'abord un menu
    de réponses rapides (Adhésion, Contribution, Projet, Éducation,
    Information générale, Assistance), puis collecte nom / contact / sujet /
    message si l'utilisateur souhaite écrire à l'équipe, et transmet la
    demande au contrôleur de contact.

    A inclure UNE SEULE FOIS dans resources/views/layouts/app.blade.php,
    juste avant la fermeture de </body> :

        @include('partials.chatbox-widget')

    Le CSS et le JS sont injectés directement ici (pas de @push/@stack) car
    ce partial est inclus directement dans le layout et non via une vue
    enfant : un @push('styles') déclenché ici arriverait après le rendu de
    @stack('styles') placé dans le <head>, et serait donc ignoré.

    ⚠️ A adapter à ton projet :
    - route('contact.store') ci-dessous : remplace par le nom réel de ta
      route de contact si elle s'appelle différemment.
    - Les textes FAQ (Adhésion, Contribution, Projet, Éducation,
      Information générale) sont des exemples : remplace-les par tes
      informations officielles exactes.
--}}

<div id="mudea-chatbox" class="mudea-chatbox">

    {{-- Bulle flottante (état fermé) --}}
    <button type="button" id="mudea-chatbox-bubble" class="mudea-chatbox-bubble" aria-label="Ouvrir le chat MUDEA">
        <i class="fa-solid fa-comments"></i>
        <span class="mudea-chatbox-bubble-ping" aria-hidden="true"></span>
        <span id="mudea-chatbox-badge" class="mudea-chatbox-bubble-badge" aria-hidden="true"></span>
    </button>

    {{-- Fenêtre de chat (état ouvert) --}}
    <div id="mudea-chatbox-window" class="mudea-chatbox-window" role="dialog" aria-modal="false" aria-labelledby="mudea-chatbox-title" aria-hidden="true">

        <div class="mudea-chatbox-header">
            <div class="mudea-chatbox-header-left">
                <div class="mudea-chatbox-header-avatar">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <p id="mudea-chatbox-title" class="mudea-chatbox-header-title">Assistant MUDEA</p>
                    <p class="mudea-chatbox-header-status"><span class="mudea-chatbox-status-dot"></span>En ligne</p>
                </div>
            </div>
            <button type="button" id="mudea-chatbox-close" class="mudea-chatbox-header-close" aria-label="Fermer le chat">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div id="mudea-chatbox-messages" class="mudea-chatbox-messages" aria-live="polite"></div>

        <div id="mudea-chatbox-quickreplies" class="mudea-chatbox-quickreplies"></div>

        <form id="mudea-chat-form" class="mudea-chatbox-input-area" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input type="text" id="mudea-chat-input" class="mudea-chatbox-input" placeholder="L'assistant arrive..." autocomplete="off" disabled>
            <button type="submit" class="mudea-chatbox-send" aria-label="Envoyer">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>
    </div>

</div>

<style>
    /* ---------- Variables (reprises de ton design system, avec valeurs de repli) ---------- */
    .mudea-chatbox, .mudea-chatbox-window {
        --chat-green: var(--primary-color, #1B5E3C);
        --chat-green-dark: var(--primary-dark, #123F29);
        --chat-green-light: #E8F3EC;
        --chat-gold: var(--accent-color, #C9A227);
        --chat-white: #FFFFFF;
        --chat-text: #2C2C2C;
        --chat-text-light: #8A958F;
        --chat-bg: #F4F6F5;
        --chat-radius: 18px;
        font-family: 'Nunito', sans-serif;
    }
    .mudea-chatbox *, .mudea-chatbox-window * { box-sizing: border-box; }

    /* ---------- Conteneur fixe sur toutes les pages ---------- */
    .mudea-chatbox {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 5000;
    }

    /* ---------- Bulle flottante ---------- */
    .mudea-chatbox-bubble {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(145deg, var(--chat-green), var(--chat-green-dark));
        color: var(--chat-white);
        border: none;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 8px 22px rgba(18,63,41,0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .mudea-chatbox-bubble:hover {
        transform: scale(1.07) translateY(-1px);
        box-shadow: 0 12px 26px rgba(18,63,41,0.4);
    }
    .mudea-chatbox-bubble:active { transform: scale(0.96); }
    .mudea-chatbox-bubble-ping {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 2px solid var(--chat-green);
        animation: mudea-ping 2.2s ease-out infinite;
    }
    @keyframes mudea-ping {
        0%   { transform: scale(1);   opacity: 0.7; }
        100% { transform: scale(1.6); opacity: 0;   }
    }
    .mudea-chatbox-bubble-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #e74c3c;
        border: 2px solid #fff;
        animation: mudea-badge-pulse 1.8s infinite;
    }
    @keyframes mudea-badge-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    .mudea-chatbox.is-open .mudea-chatbox-bubble { display: none; }

    /* ---------- Fenêtre de chat ---------- */
    .mudea-chatbox-window {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 360px;
        height: 540px;
        max-height: calc(100vh - 110px);
        background: var(--chat-white);
        border-radius: var(--chat-radius);
        box-shadow: 0 20px 50px rgba(18,63,41,0.28);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: translateY(16px) scale(0.96);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: transform 0.28s cubic-bezier(.22,1,.36,1), opacity 0.22s ease;
    }
    .mudea-chatbox.is-open .mudea-chatbox-window {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    /* En-tête */
    .mudea-chatbox-header {
        flex-shrink: 0;
        position: relative;
        background: linear-gradient(135deg, var(--chat-green), var(--chat-green-dark));
        color: var(--chat-white);
        padding: 16px 16px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow: hidden;
    }
    .mudea-chatbox-header::after {
        content: '';
        position: absolute;
        top: -40px; right: -30px;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,162,39,0.22), transparent 70%);
        pointer-events: none;
    }
    .mudea-chatbox-header-left { display: flex; align-items: center; gap: 12px; position: relative; z-index: 1; }
    .mudea-chatbox-header-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        border: 2px solid var(--chat-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .mudea-chatbox-header-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.02rem;
        font-weight: 700;
        margin: 0;
    }
    .mudea-chatbox-header-status {
        font-size: 0.78rem;
        margin: 3px 0 0;
        opacity: 0.92;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .mudea-chatbox-status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #6FCF97;
        animation: mudea-dot-pulse 2s infinite;
    }
    @keyframes mudea-dot-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(111,207,151,0.6); }
        70%  { box-shadow: 0 0 0 6px rgba(111,207,151,0); }
        100% { box-shadow: 0 0 0 0 rgba(111,207,151,0); }
    }
    .mudea-chatbox-header-close {
        position: relative;
        z-index: 1;
        background: rgba(255,255,255,0.08);
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        color: var(--chat-white);
        font-size: 0.95rem;
        cursor: pointer;
        opacity: 0.9;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.18s ease, opacity 0.18s ease;
    }
    .mudea-chatbox-header-close:hover { opacity: 1; background: rgba(255,255,255,0.18); }

    /* Zone des messages */
    .mudea-chatbox-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        background: var(--chat-bg);
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .mudea-msg {
        max-width: 82%;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 0.87rem;
        line-height: 1.45;
        word-wrap: break-word;
        white-space: pre-line;
        animation: mudea-msg-in 0.25s ease both;
    }
    @keyframes mudea-msg-in {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .mudea-msg-bot {
        align-self: flex-start;
        background: var(--chat-white);
        color: var(--chat-text);
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .mudea-msg-user {
        align-self: flex-end;
        background: var(--chat-green);
        color: var(--chat-white);
        border-bottom-right-radius: 4px;
    }

    /* Indicateur "en train d'écrire" */
    .mudea-typing { display: flex; gap: 4px; align-items: center; padding: 13px 16px; }
    .mudea-typing span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #bbb;
        animation: mudea-typing-bounce 1.2s infinite ease-in-out;
    }
    .mudea-typing span:nth-child(2) { animation-delay: 0.15s; }
    .mudea-typing span:nth-child(3) { animation-delay: 0.3s; }
    @keyframes mudea-typing-bounce {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.5; }
        30% { transform: translateY(-4px); opacity: 1; }
    }

    /* Réponses rapides */
    .mudea-chatbox-quickreplies {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 0 16px 12px;
        background: var(--chat-bg);
    }
    .mudea-chatbox-quickreply {
        background: var(--chat-white);
        border: 1.5px solid var(--chat-green);
        color: var(--chat-green);
        border-radius: 999px;
        padding: 7px 14px;
        font-size: 0.8rem;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
        cursor: pointer;
        transition: background 0.18s ease, color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
    }
    .mudea-chatbox-quickreply:hover {
        background: var(--chat-green);
        color: var(--chat-white);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(18,63,41,0.22);
    }
    .mudea-chatbox-quickreply--ghost {
        border-color: var(--border, #d8e0db);
        color: var(--chat-text-light);
    }
    .mudea-chatbox-quickreply--ghost:hover {
        background: var(--chat-text-light);
        color: var(--chat-white);
        box-shadow: none;
    }

    /* Zone de saisie */
    .mudea-chatbox-input-area {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        background: var(--chat-white);
        border-top: 1px solid #eee;
    }
    .mudea-chatbox-input {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 999px;
        padding: 10px 16px;
        font-size: 0.87rem;
        font-family: 'Nunito', sans-serif;
        min-width: 0;
        transition: border-color 0.18s ease;
    }
    .mudea-chatbox-input:focus { outline: none; border-color: var(--chat-green); }
    .mudea-chatbox-input:disabled { background: #f5f5f5; cursor: not-allowed; }
    .mudea-chatbox-send {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--chat-green);
        color: var(--chat-white);
        border: none;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: background 0.18s ease, transform 0.18s ease;
    }
    .mudea-chatbox-send:hover:not(:disabled) { background: var(--chat-green-dark); transform: scale(1.05); }
    .mudea-chatbox-send:disabled { background: #bbb; cursor: not-allowed; }

    /* ---------- Accessibilité : focus clavier visible ---------- */
    .mudea-chatbox-bubble:focus-visible,
    .mudea-chatbox-header-close:focus-visible,
    .mudea-chatbox-quickreply:focus-visible,
    .mudea-chatbox-input:focus-visible,
    .mudea-chatbox-send:focus-visible {
        outline: 2px solid var(--chat-gold);
        outline-offset: 2px;
    }

    /* ---------- Respect du mode "réduire les animations" ---------- */
    @media (prefers-reduced-motion: reduce) {
        .mudea-chatbox-bubble-ping,
        .mudea-chatbox-bubble-badge,
        .mudea-chatbox-status-dot,
        .mudea-msg,
        .mudea-typing span {
            animation: none !important;
        }
        .mudea-chatbox-window,
        .mudea-chatbox-bubble,
        .mudea-chatbox-quickreply,
        .mudea-chatbox-send {
            transition: none !important;
        }
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 480px) {
        .mudea-chatbox { right: 14px; bottom: 14px; }
        .mudea-chatbox-window {
            width: calc(100vw - 28px);
            height: calc(100vh - 100px);
            max-height: none;
        }
    }
</style>

<script>
    (function () {
        const chatbox     = document.getElementById('mudea-chatbox');
        const bubble      = document.getElementById('mudea-chatbox-bubble');
        const badge       = document.getElementById('mudea-chatbox-badge');
        const win         = document.getElementById('mudea-chatbox-window');
        const closeBtn    = document.getElementById('mudea-chatbox-close');
        const messagesBox = document.getElementById('mudea-chatbox-messages');
        const quickBox    = document.getElementById('mudea-chatbox-quickreplies');
        const form        = document.getElementById('mudea-chat-form');
        const input       = document.getElementById('mudea-chat-input');

        const CONTACT_URL = form.getAttribute('action');
        const csrfMeta     = document.querySelector('meta[name="csrf-token"]');
        const tokenInput   = form.querySelector('input[name="_token"]');
        const CSRF_TOKEN   = csrfMeta ? csrfMeta.getAttribute('content') : (tokenInput ? tokenInput.value : '');

        // Réponses informatives du menu principal. A adapter avec tes textes officiels.
        const FAQ = {
            adhesion: "Pour adhérer à la MUDEA, il suffit de retirer un dossier d'adhésion auprès du secrétariat ou via la page \"La Mutuelle\" du site. La cotisation annuelle donne accès aux services de solidarité, d'éducation et d'accompagnement de la communauté d'Andé.",
            contribution: "Les membres de la MUDEA participent par une cotisation annuelle ainsi que des contributions ponctuelles aux projets communautaires. Le montant et les modalités de versement sont précisés dans le règlement intérieur, disponible auprès du secrétariat ou sur la page \"La Mutuelle\".",
            projet: "Plusieurs projets sont en cours : la réhabilitation du château d'eau du village, la construction du complexe scolaire d'excellence et des actions de reboisement communautaire. Le détail de chaque projet est disponible dans la rubrique \"Projets\" du site.",
            education: "La MUDEA accompagne l'éducation des enfants d'Andé à travers des bourses scolaires, du soutien pédagogique et la construction d'infrastructures éducatives. Retrouvez le détail de ces actions dans la rubrique \"Éducation\" du site.",
            general: "La MUDEA (Mutuelle de Développement d'Andé) est une association de solidarité communautaire qui accompagne ses membres dans les domaines de l'entraide, de l'éducation et du développement local. Parcourez les rubriques du site pour en savoir plus, ou posez-moi une question précise."
        };

        const MENU_OPTIONS = [
            { value: 'adhesion',     label: 'Adhésion' },
            { value: 'contribution', label: 'Contribution' },
            { value: 'projet',       label: 'Projet' },
            { value: 'education',    label: 'Éducation' },
            { value: 'general',      label: 'Information générale' },
            { value: 'assistance',   label: 'Assistance' },
        ];

        const SUBJECTS = [
            { value: 'adhesion',     label: 'Adhésion' },
            { value: 'contribution', label: 'Contribution' },
            { value: 'projet',       label: 'Projet' },
            { value: 'education',    label: 'Éducation' },
            { value: 'general',      label: 'Information générale' },
            { value: 'autre',        label: 'Autre' },
        ];

        let started = false;
        let step = 'menu'; // menu -> name -> contact -> subject -> message -> done
        const answers = { name: '', contact: '', subject: '', message: '' };

        bubble.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && chatbox.classList.contains('is-open')) closeChat();
        });

        function openChat() {
            chatbox.classList.add('is-open');
            win.setAttribute('aria-hidden', 'false');
            if (badge) badge.style.display = 'none';

            if (!started) {
                started = true;
                setTimeout(() => {
                    botSay("Bonjour 👋 Bienvenue chez MUDEA !");
                    botSay("Je suis votre assistant virtuel. Que puis-je faire pour vous ?", showMenu);
                }, 400);
            } else {
                input.focus();
            }
        }

        function closeChat() {
            chatbox.classList.remove('is-open');
            win.setAttribute('aria-hidden', 'true');
        }

        function scrollToBottom() {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }

        function addMessage(text, sender) {
            const msg = document.createElement('div');
            msg.className = 'mudea-msg mudea-msg-' + sender;
            msg.textContent = text;
            messagesBox.appendChild(msg);
            scrollToBottom();
        }

        function showTyping() {
            const t = document.createElement('div');
            t.className = 'mudea-msg mudea-msg-bot mudea-typing';
            t.id = 'mudea-typing-indicator';
            t.innerHTML = '<span></span><span></span><span></span>';
            messagesBox.appendChild(t);
            scrollToBottom();
        }

        function hideTyping() {
            const t = document.getElementById('mudea-typing-indicator');
            if (t) t.remove();
        }

        // Affiche un message du bot après un court délai de "frappe", façon vrai chat.
        // Les appels successifs s'enchaînent (chaque botSay attend la fin du précédent).
        let botQueue = Promise.resolve();
        function botSay(text, callback) {
            botQueue = botQueue.then(() => new Promise((resolve) => {
                showTyping();
                setTimeout(() => {
                    hideTyping();
                    addMessage(text, 'bot');
                    if (callback) callback();
                    resolve();
                }, 550 + Math.random() * 350);
            }));
            return botQueue;
        }

        function enableInput(placeholder) {
            input.disabled = false;
            input.placeholder = placeholder || 'Écrivez votre message...';
            input.focus();
        }

        function disableInput(placeholder) {
            input.disabled = true;
            input.placeholder = placeholder || '';
        }

        function clearQuickReplies() {
            quickBox.innerHTML = '';
        }

        function addQuickReply(label, onClick, variant) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'mudea-chatbox-quickreply' + (variant === 'ghost' ? ' mudea-chatbox-quickreply--ghost' : '');
            btn.textContent = label;
            btn.addEventListener('click', onClick);
            quickBox.appendChild(btn);
            return btn;
        }

        /* ── Menu principal ──────────────────────────────────────────── */
        function showMenu() {
            step = 'menu';
            disableInput('Choisissez une option ci-dessus...');
            clearQuickReplies();
            MENU_OPTIONS.forEach(opt => {
                addQuickReply(opt.label, () => handleMenuChoice(opt));
            });
            addQuickReply('Terminer la discussion', endConversation, 'ghost');
        }

        function handleMenuChoice(opt) {
            clearQuickReplies();
            addMessage(opt.label, 'user');

            // "Assistance" ne renvoie pas un texte FAQ : elle ouvre directement
            // le formulaire de prise en charge (nom -> contact -> sujet -> message).
            if (opt.value === 'assistance') {
                step = 'name';
                botSay("Très bien, je vous mets en relation avec notre équipe. Comment puis-je vous appeler ?", () => enableInput('Votre nom...'));
                return;
            }

            botSay(FAQ[opt.value], () => {
                botSay("Souhaitez-vous autre chose ?", () => {
                    clearQuickReplies();
                    addQuickReply('Poser une autre question', showMenu);
                    addQuickReply("Demander de l'assistance", () => handleMenuChoice({ value: 'assistance', label: 'Assistance' }));
                    addQuickReply('Terminer la discussion', endConversation, 'ghost');
                });
            });
        }

        /* ── Fin de discussion ───────────────────────────────────────── */
        function endConversation() {
            clearQuickReplies();
            disableInput('Discussion terminée');
            botSay("Avec plaisir ! Merci d'être passé nous voir, et à très bientôt 🌿", () => {
                addQuickReply('Reprendre la discussion', () => {
                    clearQuickReplies();
                    showMenu();
                });
            });
        }

        /* ── Formulaire de contact (nom / contact / sujet / message) ──── */
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const value = input.value.trim();
            if (!value || input.disabled) return;
            addMessage(value, 'user');
            input.value = '';
            handleTextAnswer(value);
        });

        function handleTextAnswer(value) {
            if (step === 'name') {
                answers.name = value;
                step = 'contact';
                disableInput();
                botSay(`Merci ${value} ! Quel est votre email ou numéro de téléphone pour vous recontacter ?`, () => enableInput('Email ou téléphone...'));
            } else if (step === 'contact') {
                answers.contact = value;
                step = 'subject';
                disableInput();
                botSay('Parfait. De quoi souhaitez-vous parler ?', showSubjectChoices);
            } else if (step === 'message') {
                answers.message = value;
                step = 'done';
                disableInput();
                sendToServer();
            }
        }

        function showSubjectChoices() {
            disableInput('Choisissez une option ci-dessus...');
            clearQuickReplies();
            SUBJECTS.forEach(opt => {
                addQuickReply(opt.label, () => {
                    clearQuickReplies();
                    answers.subject = opt.value;
                    addMessage(opt.label, 'user');
                    step = 'message';
                    botSay('Je vous écoute, décrivez votre besoin en quelques mots :', () => enableInput('Votre message...'));
                });
            });
            addQuickReply('Terminer la discussion', endConversation, 'ghost');
        }

        function sendToServer() {
            botSay("Un instant, j'envoie votre message à notre équipe...");

            const data = new FormData();
            data.append('name', answers.name);
            data.append('contact', answers.contact);
            data.append('subject', answers.subject);
            data.append('message', answers.message);

            fetch(CONTACT_URL, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
                body: data
            })
            .then(res => { if (!res.ok) throw new Error('network'); return res.json(); })
            .then(() => {
                botSay('Merci ! Votre message a bien été envoyé ✅. Notre équipe vous répondra rapidement.', () => {
                    clearQuickReplies();
                    addQuickReply('Poser une autre question', showMenu);
                    addQuickReply('Terminer la discussion', endConversation, 'ghost');
                });
            })
            .catch(() => {
                botSay("Le message n'a pas pu être envoyé. Voulez-vous réessayer ?", showRetry);
            });
        }

        function showRetry() {
            clearQuickReplies();
            addQuickReply('Réessayer', () => { clearQuickReplies(); sendToServer(); });
            addQuickReply('Terminer la discussion', endConversation, 'ghost');
        }
    })();
</script>