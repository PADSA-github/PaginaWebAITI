// ==========================================================
// CONTROLADOR JAVASCRIPT DEL EXAMEN TÉCNICO AITI
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
 * 2. Cuestionario de Examen: navegación, temporizador y progreso
 */
function initExamQuestionnaire() {
    const examForm = document.getElementById('examForm');
    if (!examForm) return;

    const questionCards = document.querySelectorAll('.question-card');
    const totalQuestions = questionCards.length;
    const answeredCountEl = document.getElementById('answeredCount');
    const progressFill = document.getElementById('examProgressFill');
    const gridButtons = document.querySelectorAll('.grid-q-btn');
    const timerDisplay = document.getElementById('timerText');
    const timerContainer = document.getElementById('timerPill');

    // Manejo de selección de opciones
    const radioInputs = examForm.querySelectorAll('.option-input');
    radioInputs.forEach(input => {
        input.addEventListener('change', () => {
            updateProgress();
        });
    });

    // Clic en los botones de la cuadrícula de preguntas para saltar directamente
    gridButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetIdx = btn.getAttribute('data-target');
            const targetCard = document.getElementById(`pregunta_${targetIdx}`);
            if (targetCard) {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                highlightCard(targetCard);
            }
        });
    });

    function highlightCard(card) {
        card.style.transform = 'scale(1.01)';
        card.style.borderColor = 'var(--aiti-secondary)';
        setTimeout(() => {
            card.style.transform = '';
            card.style.borderColor = '';
        }, 800);
    }

    function updateProgress() {
        let answered = 0;
        
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

        if (answeredCountEl) answeredCountEl.textContent = answered;
        
        if (progressFill && totalQuestions > 0) {
            const pct = Math.round((answered / totalQuestions) * 100);
            progressFill.style.width = `${pct}%`;
        }
    }

    // 3. Temporizador regresivo (30 minutos)
    let totalSeconds = 30 * 60;
    const timerInterval = setInterval(() => {
        totalSeconds--;
        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            alert('¡El tiempo límite de 30 minutos ha concluido! Tu examen se enviará automáticamente.');
            examForm.submit();
            return;
        }

        const mins = Math.floor(totalSeconds / 60);
        const secs = totalSeconds % 60;
        const timeFormatted = `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
        
        if (timerDisplay) timerDisplay.textContent = timeFormatted;

        if (totalSeconds <= 300 && timerContainer) { // Menos de 5 minutos
            timerContainer.classList.add('urgent');
        }
    }, 1000);

    // 4. Confirmación antes de enviar si faltan preguntas
    examForm.addEventListener('submit', (e) => {
        let unanswered = 0;
        questionCards.forEach(card => {
            const qId = card.getAttribute('data-qid');
            if (!examForm.querySelector(`input[name="respuestas[${qId}]"]:checked`)) {
                unanswered++;
            }
        });

        if (unanswered > 0) {
            const confirmar = confirm(`Tienes ${unanswered} pregunta(s) sin responder de las ${totalQuestions}. ¿Deseas finalizar y calificar el examen ahora?`);
            if (!confirmar) {
                e.preventDefault();
                // Llevar a la primera sin responder
                for (let card of questionCards) {
                    const qId = card.getAttribute('data-qid');
                    if (!examForm.querySelector(`input[name="respuestas[${qId}]"]:checked`)) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        highlightCard(card);
                        break;
                    }
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

                // Si viene vista previa HTML (modo local), permitir verla en modal
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
                    <i class="bi bi-x-circle-fill me-2"></i> Error de conexión al procesar el envío.
                </div>
            `;
        } finally {
            emailBtn.disabled = false;
            emailBtn.innerHTML = originalBtnHtml;
        }
    });
}
