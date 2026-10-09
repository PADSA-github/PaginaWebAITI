// ==========================================================
// CONTROLADOR JAVASCRIPT DEL EXAMEN TÉCNICO AITI (18 + 1)
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {
    initLanguageSelector();
    initExamQuestionnaire();
    initEmailSubmission();
});

/**
 * 1. Selector de Lenguaje en la página de inicio
 */
function initLanguageSelector() {
    const langCards = document.querySelectorAll('.language-card');
    const inputLenguaje = document.getElementById('selected_lenguaje');
    const btnIniciar = document.getElementById('btnIniciarExamen');

    if (!langCards.length || !inputLenguaje) return;

    langCards.forEach(card => {
        card.addEventListener('click', () => {
            langCards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            
            const langKey = card.getAttribute('data-lang');
            inputLenguaje.value = langKey;
            
            if (btnIniciar) {
                btnIniciar.removeAttribute('disabled');
                const langName = card.querySelector('.lang-title')?.textContent || langKey;
                btnIniciar.innerHTML = `<i class="bi bi-play-circle-fill me-2"></i> Iniciar Examen de ${langName}`;
            }
        });
    });
}

/**
 * 2. Cuestionario de Examen: 18 reactivos + 1 reto de código (Total 19 ítems)
 */
function initExamQuestionnaire() {
    const examForm = document.getElementById('examForm');
    if (!examForm) return;

    const questionCards = document.querySelectorAll('.question-card');
    const codeCard = document.querySelector('.code-challenge-card');
    const totalItems = questionCards.length + (codeCard ? 1 : 0); // 18 + 1 = 19
    const answeredCountEl = document.getElementById('answeredCount');
    const progressFill = document.getElementById('examProgressFill');
    const gridButtons = document.querySelectorAll('.grid-q-btn');
    const timerDisplay = document.getElementById('timerText');
    const timerContainer = document.getElementById('timerPill');
    const codeTextarea = document.getElementById('descripcion_codigo');

    // Manejo de selección de opciones de radio
    const radioInputs = examForm.querySelectorAll('.option-input');
    radioInputs.forEach(input => {
        input.addEventListener('change', () => {
            updateProgress();
        });
    });

    // Manejo del textarea del reto de código
    if (codeTextarea) {
        codeTextarea.addEventListener('input', () => {
            updateProgress();
        });
    }

    // Navegación rápida por mapa de preguntas
    gridButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetIdx = btn.getAttribute('data-target');
            let targetElement = null;
            if (targetIdx === '18') {
                targetElement = document.getElementById('pregunta_18');
            } else {
                targetElement = document.getElementById(`pregunta_${targetIdx}`);
            }

            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                highlightElement(targetElement);
            }
        });
    });

    function highlightElement(el) {
        el.style.transform = 'scale(1.01)';
        el.style.borderColor = 'var(--aiti-accent)';
        setTimeout(() => {
            el.style.transform = '';
            el.style.borderColor = '';
        }, 700);
    }

    function updateProgress() {
        let answered = 0;
        
        // 1. Revisar las 18 preguntas de opción múltiple
        questionCards.forEach((card, idx) => {
            const qId = card.getAttribute('data-qid');
            const selected = examForm.querySelector(`input[name="respuestas[${qId}]"]:checked`);
            const gridBtn = document.querySelector(`.grid-q-btn[data-target="${idx}"]`);

            if (selected) {
                answered++;
                if (gridBtn) gridBtn.classList.add('answered');
            } else {
                if (gridBtn) gridBtn.classList.remove('answered');
            }
        });

        // 2. Revisar el reto de código
        if (codeTextarea) {
            const gridBtnCode = document.querySelector('.grid-q-btn.challenge-btn');
            if (codeTextarea.value.trim().length >= 10) {
                answered++;
                if (gridBtnCode) gridBtnCode.classList.add('answered');
            } else {
                if (gridBtnCode) gridBtnCode.classList.remove('answered');
            }
        }

        if (answeredCountEl) answeredCountEl.textContent = answered;
        
        if (progressFill && totalItems > 0) {
            const pct = Math.round((answered / totalItems) * 100);
            progressFill.style.width = `${pct}%`;
        }
    }

    // 3. Temporizador regresivo de 20 minutos
    let totalSeconds = 20 * 60;
    const timerInterval = setInterval(() => {
        totalSeconds--;
        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            alert('¡El tiempo límite de 20 minutos ha concluido! Tu evaluación se enviará automáticamente.');
            examForm.submit();
            return;
        }

        const mins = Math.floor(totalSeconds / 60);
        const secs = totalSeconds % 60;
        const timeFormatted = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        
        if (timerDisplay) timerDisplay.textContent = timeFormatted;

        if (totalSeconds <= 300 && timerContainer) { // Últimos 5 minutos
            timerContainer.classList.add('urgent');
        }
    }, 1000);

    // 4. Verificación previa al envío
    examForm.addEventListener('submit', (e) => {
        let unanswered = 0;
        questionCards.forEach(card => {
            const qId = card.getAttribute('data-qid');
            if (!examForm.querySelector(`input[name="respuestas[${qId}]"]:checked`)) {
                unanswered++;
            }
        });

        if (codeTextarea && codeTextarea.value.trim().length < 10) {
            unanswered++;
        }

        if (unanswered > 0) {
            const confirmar = confirm(`Tienes ${unanswered} sección(es) o pregunta(s) sin responder de las ${totalItems}. ¿Deseas calificar tu examen ahora?`);
            if (!confirmar) {
                e.preventDefault();
                // Scroll a la primera pendiente
                for (let card of questionCards) {
                    const qId = card.getAttribute('data-qid');
                    if (!examForm.querySelector(`input[name="respuestas[${qId}]"]:checked`)) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        highlightElement(card);
                        return;
                    }
                }
                if (codeCard) {
                    codeCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    highlightElement(codeCard);
                }
            }
        }
    });

    updateProgress();
}

/**
 * 3. Envío de resultados por correo electrónico vía AJAX
 */
function initEmailSubmission() {
    const emailForm = document.getElementById('emailResultsForm');
    if (!emailForm) return;

    const emailBtn = document.getElementById('btnSendEmail');
    const emailFeedback = document.getElementById('emailFeedback');
    const previewModalEl = document.getElementById('emailPreviewModal');

    emailForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(emailForm);
        const originalBtnHtml = emailBtn.innerHTML;

        emailBtn.disabled = true;
        emailBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Enviando...`;
        emailFeedback.innerHTML = '';

        try {
            const response = await fetch('enviar_correo.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.status === 'success') {
                emailFeedback.innerHTML = `
                    <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <div>${result.message}</div>
                    </div>
                `;

                // En entorno local mostrar modal de previsualización
                if (result.preview_html && previewModalEl) {
                    const previewContent = document.getElementById('emailPreviewContent');
                    if (previewContent) {
                        previewContent.innerHTML = result.preview_html;
                    }
                    const modal = new bootstrap.Modal(previewModalEl);
                    modal.show();
                }
            } else {
                emailFeedback.innerHTML = `
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> ${result.message}
                    </div>
                `;
            }
        } catch (err) {
            emailFeedback.innerHTML = `
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-x-circle-fill me-2"></i> Error al conectar con el servidor para despachar el correo.
                </div>
            `;
        } finally {
            emailBtn.disabled = false;
            emailBtn.innerHTML = originalBtnHtml;
        }
    });
}
