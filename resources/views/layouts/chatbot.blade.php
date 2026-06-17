{{--
    Widget Chatbox Flottant - MUDEA
    Comportement : bulle flottante (bas-droite) -> clic -> ouverture directe
    d'une fenêtre de chat (style messagerie) qui pose quelques questions
    (nom, contact, sujet, message) puis envoie la demande au contrôleur de
    contact existant, exactement comme l'ancien formulaire modal.

    A inclure UNE SEULE FOIS dans resources/views/layouts/app.blade.php,
    juste avant la fermeture de </body> :

        @include('partials.chatbox-widget')

    Le CSS et le JS sont injectés directement ici (pas de @push/@stack) car
    ce partial est inclus directement dans le layout et non via une vue
    enfant : un @push('styles') déclenché ici arriverait après le rendu de
    @stack('styles') placé dans le <head>, et serait donc ignoré. Aucune
    autre modification du layout n'est nécessaire.
--}}

<div id="mudea-chatbox" class="mudea-chatbox">

    {{-- Bulle flottante (état fermé) --}}
    <button type="button" id="mudea-chatbox-bubble" class="mudea-chatbox-bubble" aria-label="Ouvrir le chat MUDEA">
        <i class="fa-solid fa-comments"></i>
        <span class="mudea-chatbox-bubble-ping"></span>
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

        {{-- Adapte la route ci-dessous à ton contrôleur de contact --}}
        <form id="mudea-chat-form" class="mudea-chatbox-input-area" action="" method="POST">
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
        z-index: 999;
    }

    /* ---------- Bulle flottante ---------- */
    .mudea-chatbox-bubble {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--chat-green);
        color: var(--chat-white);
        border: none;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        transition: transform 0.2s ease, background 0.2s ease;
    }
    .mudea-chatbox-bubble:hover {
        transform: scale(1.07);
        background: var(--chat-green-dark);
    }
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
        top: -4px;
        right: -4px;
        min-width: 20px;
        height: 20px;
        padding: 0 5px;
        background: #c0392b;
        color: #fff;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        animation: mudea-badge-pulse 1.8s infinite;
    }
    @keyframes mudea-badge-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }
    .mudea-chatbox.is-open .mudea-chatbox-bubble {
        display: none;
    }

    /* ---------- Fenêtre de chat ---------- */
    .mudea-chatbox-window {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 350px;
        height: 530px;
        max-height: calc(100vh - 110px);
        background: var(--chat-white);
        border-radius: var(--chat-radius);
        box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: translateY(16px) scale(0.96);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: all 0.25s ease;
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
        background: linear-gradient(135deg, var(--chat-green), var(--chat-green-dark));
        color: var(--chat-white);
        padding: 16px 16px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .mudea-chatbox-header-left { display: flex; align-items: center; gap: 12px; }
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
        font-size: 1rem;
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
        background: none;
        border: none;
        color: var(--chat-white);
        font-size: 1rem;
        cursor: pointer;
        opacity: 0.85;
        padding: 4px;
    }
    .mudea-chatbox-header-close:hover { opacity: 1; }

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

    /* Réponses rapides (choix du sujet, réessayer...) */
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
        transition: background 0.2s ease, color 0.2s ease;
    }
    .mudea-chatbox-quickreply:hover {
        background: var(--chat-green);
        color: var(--chat-white);
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
        transition: background 0.2s ease;
    }
    .mudea-chatbox-send:hover { background: var(--chat-green-dark); }
    .mudea-chatbox-send:disabled { background: #bbb; cursor: not-allowed; }

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

        const CONTACT_URL = ''; // Adapte cette route à ton contrôleur de contact
        const csrfMeta     = document.querySelector('meta[name="csrf-token"]');
        const CSRF_TOKEN   = csrfMeta
            ? csrfMeta.getAttribute('content')
            : form.querySelector('input[name="_token"]').value;

        const SUBJECTS = [
            { value: 'general',  label: 'Question générale' },
            { value: 'adhesion', label: 'Adhésion à la mutuelle' },
            { value: 'projet',   label: 'Un projet en cours' },
            { value: 'autre',    label: 'Autre' },
        ];

        let started = false;
        let step = 0; // 0 = nom, 1 = contact, 2 = sujet (quick reply), 3 = message, 4 = terminé
        const answers = { name: '', contact: '', subject: '', message: '' };

        bubble.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && chatbox.classList.contains('is-open')) closeChat();
        });

        function openChat() {
            chatbox.classList.add('is-open');
            win.setAttribute('aria-hidden', 'false');
            badge.style.display = 'none';

            if (!started) {
                started = true;
                setTimeout(() => {
                    botSay("Bonjour 👋 Bienvenue chez MUDEA !");
                    botSay("Je suis votre assistant virtuel. Comment puis-je vous appeler ?", () => enableInput('Votre nom...'));
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

        function showQuickReplies() {
            disableInput('Choisissez une option ci-dessus...');
            quickBox.innerHTML = '';
            SUBJECTS.forEach(opt => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'mudea-chatbox-quickreply';
                btn.textContent = opt.label;
                btn.addEventListener('click', () => {
                    quickBox.innerHTML = '';
                    answers.subject = opt.value;
                    addMessage(opt.label, 'user');
                    step = 3;
                    botSay('Je vous écoute, décrivez votre besoin en quelques mots :', () => enableInput('Votre message...'));
                });
                quickBox.appendChild(btn);
            });
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const value = input.value.trim();
            if (!value || input.disabled) return;
            addMessage(value, 'user');
            input.value = '';
            handleAnswer(value);
        });

        function handleAnswer(value) {
            if (step === 0) {
                answers.name = value;
                step = 1;
                disableInput();
                botSay(`Merci ${value} ! Quel est votre email ou numéro de téléphone pour vous recontacter ?`, () => enableInput('Email ou téléphone...'));
            } else if (step === 1) {
                answers.contact = value;
                step = 2;
                disableInput();
                botSay('Parfait. De quoi souhaitez-vous parler ?', showQuickReplies);
            } else if (step === 3) {
                answers.message = value;
                step = 4;
                disableInput();
                sendToServer();
            }
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
                botSay('Merci ! Votre message a bien été envoyé ✅. Notre équipe vous répondra rapidement.');
            })
            .catch(() => {
                botSay("Une erreur s'est produite lors de l'envoi. Voulez-vous réessayer ?", showRetry);
            });
        }

        function showRetry() {
            quickBox.innerHTML = '';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'mudea-chatbox-quickreply';
            btn.textContent = 'Réessayer';
            btn.addEventListener('click', () => {
                quickBox.innerHTML = '';
                sendToServer();
            });
            quickBox.appendChild(btn);
        }
    })();
</script>