/**
 * Floating Label Component
 * 
 * Transforma labels tradicionais em floating labels
 * O label sobe quando o input tem foco ou está preenchido
 */

document.addEventListener('DOMContentLoaded', () => {
    initFloatingLabels();
});

function initFloatingLabels() {
    // Seleciona todos os labels com classe floating-label-wrapper
    const floatingWrappers = document.querySelectorAll('.floating-label-wrapper');
    
    floatingWrappers.forEach(wrapper => {
        const input = wrapper.querySelector('input, textarea');
        const label = wrapper.querySelector('.floating-label');
        
        if (!input || !label) return;
        
        // Verifica se o input já tem valor ao carregar a página
        if (input.value && input.value.trim() !== '') {
            input.classList.add('has-value');
        }
        
        // Atualiza o estado quando o input muda
        input.addEventListener('input', () => {
            if (input.value && input.value.trim() !== '') {
                input.classList.add('has-value');
            } else {
                input.classList.remove('has-value');
            }
        });
        
        // Atualiza o estado quando perde o foco (caso tenha autocomplete)
        input.addEventListener('blur', () => {
            if (input.value && input.value.trim() !== '') {
                input.classList.add('has-value');
            } else {
                input.classList.remove('has-value');
            }
        });
    });
}


