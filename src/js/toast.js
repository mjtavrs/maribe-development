/**
 * Sistema de Toast Notifications
 * 
 * Gerencia a exibição de toasts de sucesso e erro
 */

class ToastManager {
    constructor() {
        this.container = document.getElementById('toastContainer');
        this.activeToasts = []; // Array para gerenciar múltiplos toasts
        this.autoCloseTimeouts = new Map(); // Map para gerenciar timeouts de cada toast
        
        // Inicializa toasts existentes no DOM (vindos do PHP)
        this.initExistingToasts();
        
        // Escuta eventos de toast customizados
        document.addEventListener('showToast', (e) => {
            this.show(e.detail.type, e.detail.message, e.detail.duration);
        });
    }
    
    /**
     * Inicializa toasts que já estão no DOM (vindos do PHP)
     */
    initExistingToasts() {
        const existingToasts = this.container.querySelectorAll('.toast');
        existingToasts.forEach(toast => {
            this.activeToasts.push(toast);
            // Configura com duração padrão de 6 segundos
            this.setupToast(toast, 6000);
        });
    }
    
    /**
     * Mostra um toast
     * @param {string} type - 'success' ou 'error'
     * @param {string} message - Mensagem a ser exibida
     * @param {number} duration - Duração em milissegundos (padrão: 6000)
     * @param {string} title - Título do toast (opcional)
     */
    show(type, message, duration = 6000, title = null) {
        // Título padrão se não fornecido
        if (!title) {
            title = type === 'success' ? 'Sucesso!' : 'Erro!';
        }
        
        // Cria novo toast
        const toast = this.createToast(type, message, title);
        
        // Adiciona ao container (no início, já que usamos column-reverse)
        this.container.insertBefore(toast, this.container.firstChild);
        this.activeToasts.push(toast);
        
        // Configura o toast
        this.setupToast(toast, duration);
        
        // Anima entrada
        requestAnimationFrame(() => {
            toast.classList.add('toast-show');
        });
    }
    
    /**
     * Cria elemento de toast
     */
    createToast(type, message, title) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.setAttribute('role', 'alert');
        toast.draggable = true;
        
        const icon = type === 'success' 
            ? '<i class="ph ph-check-circle"></i>'
            : '<i class="ph ph-x-circle"></i>';
        
        toast.innerHTML = `
            <div class="toast-wrapper">
                <div class="toast-content">
                    <span class="toast-icon-wrapper">
                        <span class="toast-icon">${icon}</span>
                    </span>
                    <div class="toast-text">
                        <h3 class="toast-title">${this.escapeHtml(title)}</h3>
                        <p class="toast-message">${this.escapeHtml(message)}</p>
                    </div>
                </div>
                <button class="toast-close" aria-label="Fechar notificação" title="Fechar">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <div class="toast-progress-bar">
                <div class="toast-progress-fill"></div>
            </div>
        `;
        
        return toast;
    }
    
    /**
     * Configura eventos e auto-fechamento do toast
     */
    setupToast(toast, duration = 6000) {
        // Botão de fechar (precisa prevenir drag)
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.hide(toast);
        });
        
        // Configura barra de progresso primeiro (para ter progressData disponível)
        let progressData = null;
        if (duration > 0) {
            progressData = this.setupProgressBar(toast, duration);
        }
        
        // Configura drag and drop (depois do progresso)
        this.setupDrag(toast, progressData);
    }
    
    /**
     * Configura drag and drop para o toast
     */
    setupDrag(toast, progressData = null) {
        let isDragging = false;
        let startX, startY;
        let dragOffset = { x: 0, y: 0 };
        
        const startDrag = (e) => {
            // Não inicia drag se clicou no botão de fechar
            if (e.target.closest('.toast-close')) {
                return;
            }
            
            isDragging = true;
            toast.style.transition = 'none'; // Remove transição durante drag
            toast.style.cursor = 'grabbing';
            
            // Pausa o progresso
            if (progressData && progressData.pause) {
                progressData.pause();
            }
            
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            
            startX = clientX;
            startY = clientY;
            
            document.addEventListener('mousemove', drag);
            document.addEventListener('touchmove', drag, { passive: false });
            document.addEventListener('mouseup', stopDrag);
            document.addEventListener('touchend', stopDrag);
            
            e.preventDefault();
        };
        
        const drag = (e) => {
            if (!isDragging) return;
            
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            
            // Apenas movimento horizontal (eixo X)
            dragOffset.x = clientX - startX;
            dragOffset.y = 0; // Bloqueia movimento vertical
            
            // Aplica apenas o offset do drag no eixo X
            toast.style.transform = `translateX(${dragOffset.x}px)`;
        };
        
        const stopDrag = () => {
            if (!isDragging) return;
            
            isDragging = false;
            toast.style.cursor = 'grab';
            toast.style.transition = ''; // Restaura transição
            
            // Retoma o progresso
            if (progressData && progressData.resume) {
                progressData.resume();
            }
            
            // Se arrastou muito para fora (apenas no eixo X), remove o toast
            const threshold = 100;
            if (Math.abs(dragOffset.x) > threshold) {
                this.hide(toast);
            } else {
                // Retorna à posição original (remove o transform inline para voltar ao CSS)
                toast.style.transform = '';
                dragOffset = { x: 0, y: 0 };
            }
            
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('touchmove', drag);
            document.removeEventListener('mouseup', stopDrag);
            document.removeEventListener('touchend', stopDrag);
        };
        
        // Adiciona cursor de arrastar
        toast.style.cursor = 'grab';
        toast.addEventListener('mousedown', startDrag);
        toast.addEventListener('touchstart', startDrag, { passive: false });
        
        toast.addEventListener('dragstart', (e) => {
            e.preventDefault(); // Previne drag nativo do HTML5
        });
    }
    
    /**
     * Configura barra de progresso descrescente
     * @returns {Object} Objeto com funções de controle (pause, resume, cancel)
     */
    setupProgressBar(toast, duration) {
        const progressFill = toast.querySelector('.toast-progress-fill');
        if (!progressFill) return null;
        
        let startTime = Date.now();
        let elapsed = 0;
        let isPaused = false;
        let animationFrameId = null;
        
        const updateProgress = () => {
            if (isPaused) {
                animationFrameId = requestAnimationFrame(updateProgress);
                return;
            }
            
            elapsed = Date.now() - startTime;
            const progress = Math.max(0, Math.min(100, (elapsed / duration) * 100));
            
            progressFill.style.width = `${100 - progress}%`;
            
            if (progress >= 100) {
                this.hide(toast);
            } else {
                animationFrameId = requestAnimationFrame(updateProgress);
            }
        };
        
        // Armazena funções de controle
        const progressData = {
            pause: () => {
                isPaused = true;
                elapsed = Date.now() - startTime;
            },
            resume: () => {
                isPaused = false;
                startTime = Date.now() - elapsed;
                if (!animationFrameId) {
                    animationFrameId = requestAnimationFrame(updateProgress);
                }
            },
            cancel: () => {
                if (animationFrameId) {
                    cancelAnimationFrame(animationFrameId);
                }
            }
        };
        
        this.autoCloseTimeouts.set(toast, progressData);
        
        // Inicia a animação
        animationFrameId = requestAnimationFrame(updateProgress);
        
        return progressData;
    }
    
    /**
     * Esconde um toast específico
     * @param {HTMLElement} toast - Elemento do toast a ser escondido (opcional, esconde o primeiro se não fornecido)
     */
    hide(toast = null) {
        // Se não especificado, pega o primeiro toast ativo
        if (!toast && this.activeToasts.length > 0) {
            toast = this.activeToasts[0];
        }
        
        if (toast && this.activeToasts.includes(toast)) {
            // Remove da lista de toasts ativos
            const index = this.activeToasts.indexOf(toast);
            if (index > -1) {
                this.activeToasts.splice(index, 1);
            }
            
            // Limpa timeout/progresso se existir
            if (this.autoCloseTimeouts.has(toast)) {
                const progressData = this.autoCloseTimeouts.get(toast);
                if (progressData && progressData.cancel) {
                    progressData.cancel();
                }
                this.autoCloseTimeouts.delete(toast);
            }
            
            // Anima saída
            toast.classList.remove('toast-show');
            toast.classList.add('toast-hide');
            
            // Remove após animação
            setTimeout(() => {
                if (toast && toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300); // Tempo da animação
        }
    }
    
    /**
     * Escapa HTML para segurança
     */
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Inicializa quando o DOM estiver pronto
let toastManager;
document.addEventListener('DOMContentLoaded', () => {
    toastManager = new ToastManager();
    
    // Expõe globalmente para uso fácil
    window.showToast = (type, message, duration) => {
        toastManager.show(type, message, duration);
    };
    
    // Botões de teste (apenas para desenvolvimento)
    const testSuccessBtn = document.getElementById('testToastSuccess');
    const testErrorBtn = document.getElementById('testToastError');
    
    if (testSuccessBtn) {
        testSuccessBtn.addEventListener('click', () => {
            showToast('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.', 6000, 'Sucesso!');
        });
    }
    
    if (testErrorBtn) {
        testErrorBtn.addEventListener('click', () => {
            showToast('error', 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.', 6000, 'Erro!');
        });
    }
    
    // Fecha todos os toasts com ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && toastManager && toastManager.activeToasts.length > 0) {
            // Fecha o toast mais recente (último da lista)
            const lastToast = toastManager.activeToasts[toastManager.activeToasts.length - 1];
            if (lastToast) {
                toastManager.hide(lastToast);
            }
        }
    });
});

// Exporta para uso em módulos
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ToastManager;
}

