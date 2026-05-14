/* Elector -- Chatbot Multilingue (ES/EN/FR) con Filosofia Institucional */
(function () {
    'use strict';

    /* --- DECLARACION INSTITUCIONAL -------------------- */
    var DECLARATION = {
        es: 'Soy LIBRE, AUT\u00D3NOMO Y RESPONSABLE a trav\u00E9s del di\u00E1logo y la construcci\u00F3n, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes.',
        en: 'I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulatory ideal; I lead, control and dictate my own laws.',
        fr: 'Je suis LIBRE, AUTONOME ET RESPONSABLE \u00E0 travers le dialogue et la construction; je me dirige et dicte mes propres lois.'
    };

    /* --- REFLEXIONES DIARIAS (rotan por dia de semana) -- */
    var REFLECTIONS = {
        es: [
            '\uD83C\uDF31 **Desarrollo Humano:** Cada libro que lees es un paso en tu camino de crecimiento. La biblioteca es tu espacio de transformaci\u00F3n.',
            '\u2696\uFE0F **\u00C9tica:** Actuar con honestidad en el uso de los recursos refleja tu compromiso con la comunidad.',
            '\uD83D\uDCA1 **Autonom\u00EDa:** T\u00FA tienes el poder de elegir qu\u00E9 aprender. La biblioteca te da las herramientas, t\u00FA construyes el camino.',
            '\uD83C\uDF1F **Transformaci\u00F3n Positiva:** Cada conocimiento te acerca a una mejor versi\u00F3n de ti mismo y tu entorno.',
            '\uD83E\uDD1D **Responsabilidad Social:** Cuidar los libros es cuidar el patrimonio de toda la comunidad educativa.',
            '\uD83C\uDFAF **Bienestar:** La lectura no solo informa, tambi\u00E9n sana, inspira y transforma.',
            '\uD83D\uDE80 **Evoluci\u00F3n Personal:** No dejes de aprender. Cada d\u00EDa es una oportunidad para ser mejor que ayer.'
        ],
        en: [
            '\uD83C\uDF31 **Human Development:** Every book you read is a step in your growth journey.',
            '\u2696\uFE0F **Ethics:** Acting with honesty and responsibility reflects your commitment to the community.',
            '\uD83D\uDCA1 **Autonomy:** You have the power to choose what to learn. Build your own path.',
            '\uD83C\uDF1F **Positive Transformation:** Every piece of knowledge brings you closer to a better version of yourself.',
            '\uD83E\uDD1D **Social Responsibility:** Taking care of books means taking care of the community\'s heritage.',
            '\uD83C\uDFAF **Wellbeing:** Reading not only informs, it also heals, inspires and transforms.',
            '\uD83D\uDE80 **Personal Evolution:** Never stop learning. Every day is a chance to be better than yesterday.'
        ],
        fr: [
            '\uD83C\uDF31 **D\u00E9veloppement Humain:** Chaque livre que vous lisez est un pas dans votre croissance.',
            '\u2696\uFE0F **\u00C9thique:** Agir avec honn\u00EAtet\u00E9 refl\u00E8te votre engagement envers la communaut\u00E9.',
            '\uD83D\uDCA1 **Autonomie:** Vous avez le pouvoir de choisir ce que vous apprenez.',
            '\uD83C\uDF1F **Transformation Positive:** Chaque connaissance vous rapproche d\'une meilleure version de vous-m\u00EAme.',
            '\uD83E\uDD1D **Responsabilit\u00E9 Sociale:** Prendre soin des livres, c\'est prendre soin du patrimoine commun.',
            '\uD83C\uDFAF **Bien-\u00EAtre:** La lecture informe, gu\u00E9rit, inspire et transforme.',
            '\uD83D\uDE80 **\u00C9volution Personnelle:** N\'arr\u00EAtez jamais d\'apprendre.'
        ]
    };

    /* --- BASE DE CONOCIMIENTO ------------------------- */
    var KB = {
        es: {
            greet: ['\u00A1Hola! \uD83E\uDD16 Soy **Lexi**, asistente virtual de Elector. \u00BFEn qu\u00E9 puedo ayudarte hoy?'],
            fallback: ['No entend\u00ED tu pregunta. Intenta con *pr\u00E9stamo*, *libro*, *horario*, *multa* o *reflexi\u00F3n*.'],
            suggestions: ['\uD83D\uDCD6 Pr\u00E9stamo', '\uD83D\uDD50 Horario', '\uD83D\uDD0D Buscar libro', '\uD83D\uDCB0 Multas', '\u2728 Reflexi\u00F3n'],
            rules: [
                { k: /hola|buenos|buenas|saludos|hey/i, r: ['\u00A1Hola! \uD83D\uDE0A Bienvenido a Elector. Escribe tu consulta o elige una opci\u00F3n.'] },
                { k: /libre|aut[o\u00F3]nom|responsable|leyes|dirijo|controlo|declaraci[o\u00F3]n|filosof[i\u00ED]a/i, r: ['philosophy'] },
                { k: /reflexi[o\u00F3]n|reflexiona|valor|valores|\u00E9tica|etica|desarrollo humano|bienestar|evoluci[o\u00F3]n|transformaci[o\u00F3]n/i, r: ['reflection'] },
                { k: /qu[e\u00E9] es elector|sobre elector|sistema/i, r: ['**Elector** es el Sistema de Gesti\u00F3n de Biblioteca de la Instituci\u00F3n Educativa. Gestiona pr\u00E9stamos, inventario, usuarios y reportes \uD83D\uDCDA.'] },
                { k: /horario|hora|abierto|abren/i, r: ['\uD83D\uDD50 **Horario de atenci\u00F3n:**\n- Lunes a Viernes: 7:00 AM - 6:00 PM\n- S\u00E1bados: 8:00 AM - 12:00 PM\n- Domingos: Cerrado'] },
                { k: /pr[e\u00E9]stamo|pedir|solicitar|prestar/i, r: ['\uD83D\uDCD6 **C\u00F3mo solicitar un pr\u00E9stamo:**\n1. Ingresa al sistema.\n2. Ve a **Pr\u00E9stamos - Nuevo Pr\u00E9stamo**.\n3. Busca el libro.\n4. Confirma la fecha de devoluci\u00F3n.\n\nM\u00E1ximo **3 libros** por usuario.'] },
                { k: /devoluci[o\u00F3]n|devolver|entregar/i, r: ['\uD83D\uDCC5 El plazo est\u00E1ndar de devoluci\u00F3n es **8 d\u00EDas h\u00E1biles**.'] },
                { k: /multa|sanci[o\u00F3]n|cobro|deuda/i, r: ['\uD83D\uDCB0 Las multas son **$500 COP por d\u00EDa** de retraso. Revisa tu estado en *Configuraci\u00F3n - Reportes*.'] },
                { k: /libro|t[i\u00ED]tulo|cat[a\u00E1]logo|buscar/i, r: ['\uD83D\uDD0D Busca libros en el m\u00F3dulo **Libros** del panel. Filtros: t\u00EDtulo, autor, materia y editorial.'] },
                { k: /usuario|cuenta|contrase\u00F1a|clave/i, r: ['\uD83D\uDC64 Para recuperar tu contrase\u00F1a, contacta al administrador o ve a **Administraci\u00F3n - Usuarios**.'] },
                { k: /reporte|informe|pdf/i, r: ['\uD83D\uDCCA Reportes disponibles en **Reportes - Libros Prestados**. Exporta en PDF.'] },
                { k: /gracias|perfecto|excelente/i, r: ['\u00A1Con mucho gusto! \uD83D\uDE0A \u00BFAlgo m\u00E1s en lo que pueda ayudarte?'] },
                { k: /adios|hasta|bye|chao/i, r: ['\u00A1Hasta pronto! \uD83D\uDC4B Recuerda devolver tus libros a tiempo \uD83D\uDCDA'] },
                { k: /ayuda|opciones|menu/i, r: ['\uD83D\uDCCB **Puedo ayudarte con:**\n- Pr\u00E9stamos y devoluciones\n- Horarios\n- B\u00FAsqueda de libros\n- Multas\n- Usuarios\n- Reportes\n- Filosof\u00EDa institucional'] }
            ]
        },
        en: {
            greet: ['Hi! \uD83E\uDD16 I\'m **Lexi**, Elector\'s virtual assistant. How can I help?'],
            fallback: ['I didn\'t understand. Try *loan*, *book*, *schedule*, *fine* or *reflection*.'],
            suggestions: ['\uD83D\uDCD6 Loan', '\uD83D\uDD50 Schedule', '\uD83D\uDD0D Search book', '\uD83D\uDCB0 Fines', '\u2728 Reflection'],
            rules: [
                { k: /hello|hi|hey/i, r: ['Hello! \uD83D\uDE0A Welcome to Elector. Type your query or choose an option.'] },
                { k: /free|autonomous|responsible|laws|philosophy|declaration/i, r: ['philosophy'] },
                { k: /reflection|value|ethics|wellbeing|development|evolution|transformation/i, r: ['reflection'] },
                { k: /what is elector|about elector/i, r: ['**Elector** is the Library Management System. It manages loans, inventory, users and reports \uD83D\uDCDA.'] },
                { k: /schedule|hours|open/i, r: ['\uD83D\uDD50 **Opening hours:**\n- Mon-Fri: 7:00 AM - 6:00 PM\n- Saturday: 8:00 AM - 12:00 PM\n- Sundays: Closed'] },
                { k: /loan|borrow|request/i, r: ['\uD83D\uDCD6 **How to request a loan:**\n1. Log in.\n2. Go to **Loans - New Loan**.\n3. Search the book.\n4. Confirm return date.\n\nMax **3 books** per user.'] },
                { k: /return|due date/i, r: ['\uD83D\uDCC5 Standard return period: **8 business days**.'] },
                { k: /fine|penalty|fee/i, r: ['\uD83D\uDCB0 Fines: **$500 COP per day** of delay.'] },
                { k: /book|title|catalog|search/i, r: ['\uD83D\uDD0D Search books in the **Books** module. Filters: title, author, subject.'] },
                { k: /user|account|password/i, r: ['\uD83D\uDC64 Contact the administrator to recover your password.'] },
                { k: /thank|great|perfect/i, r: ['You\'re welcome! \uD83D\uDE0A Anything else?'] },
                { k: /bye|goodbye/i, r: ['Goodbye! \uD83D\uDC4B Remember to return your books on time \uD83D\uDCDA'] },
                { k: /help|options/i, r: ['\uD83D\uDCCB **I can help with:** Loans, Schedule, Books, Fines, Users, Reports, Philosophy'] }
            ]
        },
        fr: {
            greet: ['Bonjour! \uD83E\uDD16 Je suis **Lexi**, l\'assistant d\'Elector. Comment puis-je vous aider?'],
            fallback: ['Je n\'ai pas compris. Essayez *pr\u00EAt*, *livre*, *horaire*, *amende* ou *r\u00E9flexion*.'],
            suggestions: ['\uD83D\uDCD6 Pr\u00EAt', '\uD83D\uDD50 Horaires', '\uD83D\uDD0D Chercher livre', '\uD83D\uDCB0 Amende', '\u2728 R\u00E9flexion'],
            rules: [
                { k: /bonjour|salut|bonsoir/i, r: ['Bonjour! \uD83D\uDE0A Bienvenue sur Elector. Tapez votre question.'] },
                { k: /libre|autonome|responsable|lois|philosophie|d\u00E9claration/i, r: ['philosophy'] },
                { k: /r\u00E9flexion|valeur|\u00E9thique|bien-\u00EAtre|d\u00E9veloppement|\u00E9volution/i, r: ['reflection'] },
                { k: /qu.est.ce qu.elector|elector/i, r: ['**Elector** est le Syst\u00E8me de Gestion de Biblioth\u00E8que. Il g\u00E8re les pr\u00EAts, l\'inventaire et les rapports \uD83D\uDCDA.'] },
                { k: /horaire|heure|ouvert/i, r: ['\uD83D\uDD50 **Horaires:**\n- Lun-Ven: 7h00 - 18h00\n- Samedi: 8h00 - 12h00\n- Dimanche: Ferm\u00E9'] },
                { k: /pr\u00EAt|emprunter/i, r: ['\uD83D\uDCD6 **Emprunter un livre:**\n1. Connectez-vous.\n2. Allez dans **Pr\u00EAts - Nouveau**.\n3. Confirmez la date de retour.\n\nMax **3 livres**.'] },
                { k: /retour|rendre/i, r: ['\uD83D\uDCC5 D\u00E9lai de retour: **8 jours ouvrables**.'] },
                { k: /amende|p\u00E9nalit\u00E9/i, r: ['\uD83D\uDCB0 Amendes: **500 COP par jour** de retard.'] },
                { k: /livre|titre|chercher/i, r: ['\uD83D\uDD0D Recherchez dans le module **Livres**.'] },
                { k: /merci|parfait/i, r: ['Avec plaisir! \uD83D\uDE0A Autre chose?'] },
                { k: /au revoir|bye/i, r: ['Au revoir! \uD83D\uDC4B N\'oubliez pas de rendre vos livres \uD83D\uDCDA'] },
                { k: /aide|options/i, r: ['\uD83D\uDCCB **Je peux aider avec:** Pr\u00EAts, Horaires, Livres, Amendes, Philosophie'] }
            ]
        }
    };

    /* --- ESTADO --------------------------------------- */
    var lang     = 'es';
    var isOpen   = false;
    var msgCount = 0;

    /* --- HELPERS -------------------------------------- */
    function now() {
        return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    function pick(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
    function renderMd(t) {
        return t.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.+?)\*/g, '<em>$1</em>')
                .replace(/\n/g, '<br>');
    }
    function getDayIndex() { return new Date().getDay(); }

    /* --- RENDERIZADO DE TARJETAS ---------------------- */
    function appendPhilosophyCard() {
        var area = document.getElementById('chatbot-messages');
        var labels = { es: '\u2728 Filosof\u00EDa Institucional', en: '\u2728 Institutional Philosophy', fr: '\u2728 Philosophie Institutionnelle' };
        var authors = { es: '~ Principio Rector de Elector', en: '~ Guiding Principle of Elector', fr: '~ Principe Directeur d\'Elector' };
        var wrap = document.createElement('div');
        wrap.className = 'cb-msg bot';
        wrap.innerHTML =
            '<div class="cb-msg-avatar">\uD83E\uDD16</div>' +
            '<div style="max-width:85%">' +
                '<div class="cb-philosophy-card">' +
                    '<div class="cb-philosophy-label">' + labels[lang] + '</div>' +
                    '<div class="cb-philosophy-text">&ldquo;' + DECLARATION[lang] + '&rdquo;</div>' +
                    '<div class="cb-philosophy-author">' + authors[lang] + '</div>' +
                '</div>' +
                '<div class="cb-msg-time">' + now() + '</div>' +
            '</div>';
        area.appendChild(wrap);
        area.scrollTop = area.scrollHeight;
    }

    function appendReflectionCard() {
        var area = document.getElementById('chatbot-messages');
        var labels = { es: '\uD83C\uDF31 Reflexi\u00F3n del D\u00EDa', en: '\uD83C\uDF31 Daily Reflection', fr: '\uD83C\uDF31 R\u00E9flexion du Jour' };
        var ref = REFLECTIONS[lang][getDayIndex() % REFLECTIONS[lang].length];
        var wrap = document.createElement('div');
        wrap.className = 'cb-msg bot';
        wrap.innerHTML =
            '<div class="cb-msg-avatar">\uD83E\uDD16</div>' +
            '<div style="max-width:85%">' +
                '<div class="cb-reflection-card">' +
                    '<div class="cb-reflection-label">' + labels[lang] + '</div>' +
                    '<div class="cb-reflection-text">' + renderMd(ref) + '</div>' +
                '</div>' +
                '<div class="cb-msg-time">' + now() + '</div>' +
            '</div>';
        area.appendChild(wrap);
        area.scrollTop = area.scrollHeight;
    }

    /* --- MENSAJES NORMALES ---------------------------- */
    function appendMsg(text, role) {
        var area = document.getElementById('chatbot-messages');
        var wrap = document.createElement('div');
        wrap.className = 'cb-msg ' + role;
        if (role === 'bot') {
            wrap.innerHTML =
                '<div class="cb-msg-avatar">\uD83E\uDD16</div>' +
                '<div><div class="cb-bubble">' + renderMd(text) + '</div>' +
                '<div class="cb-msg-time">' + now() + '</div></div>';
        } else {
            wrap.innerHTML =
                '<div><div class="cb-bubble">' + renderMd(text) + '</div>' +
                '<div class="cb-msg-time">' + now() + '</div></div>';
        }
        area.appendChild(wrap);
        area.scrollTop = area.scrollHeight;
    }

    function showTyping() {
        document.getElementById('cb-typing').classList.add('show');
        document.getElementById('chatbot-messages').scrollTop = 9999;
    }
    function hideTyping() { document.getElementById('cb-typing').classList.remove('show'); }

    function botReply(text) {
        showTyping();
        var delay = Math.min(600 + text.length * 8, 1800);
        setTimeout(function () {
            hideTyping();
            if (text === 'philosophy') { appendPhilosophyCard(); }
            else if (text === 'reflection') { appendReflectionCard(); }
            else { appendMsg(text, 'bot'); }
        }, delay);
    }

    function getResponse(text) {
        var rules = KB[lang].rules;
        for (var i = 0; i < rules.length; i++) {
            if (rules[i].k.test(text)) return pick(rules[i].r);
        }
        return pick(KB[lang].fallback);
    }

    /* --- SUGERENCIAS ---------------------------------- */
    function renderSuggestions() {
        var box = document.getElementById('chatbot-suggestions');
        box.innerHTML = '';
        KB[lang].suggestions.forEach(function (s) {
            var chip = document.createElement('span');
            chip.className = 'cb-chip' + (s.indexOf('\u2728') !== -1 ? ' cb-chip-reflect' : '');
            chip.textContent = s;
            chip.addEventListener('click', function () { sendMessage(s); });
            box.appendChild(chip);
        });
    }

    /* --- ENVIO DE MENSAJES ---------------------------- */
    function sendMessage(text) {
        text = (text || document.getElementById('chatbot-input').value).trim();
        if (!text) return;
        document.getElementById('chatbot-input').value = '';
        appendMsg(text, 'user');
        botReply(getResponse(text));
        document.getElementById('chatbot-badge').classList.add('hidden');
    }

    /* --- TOGGLE --------------------------------------- */
    function toggleChat() {
        isOpen = !isOpen;
        document.getElementById('chatbot-toggle').classList.toggle('is-open', isOpen);
        document.getElementById('chatbot-window').classList.toggle('is-visible', isOpen);
        document.getElementById('chatbot-badge').classList.add('hidden');
        if (isOpen && msgCount === 0) {
            msgCount++;
            setTimeout(function () { botReply(pick(KB[lang].greet)); }, 300);
            setTimeout(function () { appendPhilosophyCard(); }, 2200);
        }
    }

    /* --- INICIALIZACION ------------------------------- */
    function init() {
        var placeholders = { es: 'Escribe tu pregunta...', en: 'Type your question...', fr: 'Tapez votre question...' };
        var statusLabels = {
            es: 'En l\u00EDnea \u00B7 Asistente Virtual',
            en: 'Online \u00B7 Virtual Assistant',
            fr: 'En ligne \u00B7 Assistant Virtuel'
        };

        var html =
            '<button id="chatbot-toggle" aria-label="Abrir chatbot" title="Asistente Elector">' +
                '<i class="fa fa-comments cb-icon-open"></i>' +
                '<i class="fa fa-times cb-icon-close"></i>' +
                '<span id="chatbot-badge">1</span>' +
            '</button>' +
            '<div id="chatbot-window" role="dialog" aria-label="Chatbot Elector">' +
                '<div id="chatbot-header">' +
                    '<div class="cb-avatar">\uD83E\uDD16</div>' +
                    '<div class="cb-header-info">' +
                        '<h4>Lexi &mdash; Elector</h4>' +
                        '<span id="cb-status-label"><span class="cb-status-dot"></span> En l\u00EDnea &middot; Asistente Virtual</span>' +
                    '</div>' +
                    '<select id="chatbot-lang-select" aria-label="Idioma">' +
                        '<option value="es">ES</option>' +
                        '<option value="en">EN</option>' +
                        '<option value="fr">FR</option>' +
                    '</select>' +
                '</div>' +
                '<div id="chatbot-messages">' +
                    '<div id="cb-typing">' +
                        '<div class="cb-msg-avatar">\uD83E\uDD16</div>' +
                        '<div class="cb-typing-dots"><span></span><span></span><span></span></div>' +
                    '</div>' +
                '</div>' +
                '<div id="chatbot-suggestions"></div>' +
                '<div id="chatbot-input-area">' +
                    '<textarea id="chatbot-input" rows="1" placeholder="Escribe tu pregunta..." aria-label="Mensaje"></textarea>' +
                    '<button id="chatbot-send" aria-label="Enviar"><i class="fa fa-paper-plane"></i></button>' +
                '</div>' +
            '</div>';

        var container = document.createElement('div');
        container.innerHTML = html;
        document.body.appendChild(container);

        var input = document.getElementById('chatbot-input');
        input.addEventListener('input', function () {
            input.style.height = 'auto';
            input.style.height = Math.min(input.scrollHeight, 100) + 'px';
        });

        document.getElementById('chatbot-toggle').addEventListener('click', toggleChat);
        document.getElementById('chatbot-send').addEventListener('click', function () { sendMessage(); });
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
        });

        document.getElementById('chatbot-lang-select').addEventListener('change', function () {
            lang = this.value;
            renderSuggestions();
            input.placeholder = placeholders[lang];
            document.getElementById('cb-status-label').innerHTML =
                '<span class="cb-status-dot"></span> ' + statusLabels[lang];
            if (isOpen) botReply(pick(KB[lang].greet));
        });

        renderSuggestions();
        setTimeout(function () {
            document.getElementById('chatbot-badge').classList.remove('hidden');
        }, 3000);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
