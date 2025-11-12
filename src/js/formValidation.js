/**
 * Validação de formulários no frontend
 * Fornece feedback visual e validação antes do envio
 */

/**
 * Inicializa a validação de formulários na página
 */
export function initFormValidation() {
    const forms = document.querySelectorAll('form[action*="php"]');
    
    forms.forEach(form => {
        form.addEventListener('submit', handleFormSubmit);
        
        // Validação em tempo real para campos de texto
        const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('input', () => clearFieldError(input));
        });
    });
}

/**
 * Manipula o envio do formulário
 * @param {Event} event - Evento de submit
 */
function handleFormSubmit(event) {
    const form = event.target;
    const isValid = validateForm(form);
    
    if (!isValid) {
        event.preventDefault();
        showFormError(form, 'Por favor, corrija os erros no formulário antes de enviar.');
    }
}

/**
 * Valida um formulário completo
 * @param {HTMLFormElement} form - Formulário a ser validado
 * @returns {boolean} True se válido, False caso contrário
 */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    // Validação específica por tipo de campo
    const emailInputs = form.querySelectorAll('input[type="email"]');
    emailInputs.forEach(input => {
        if (input.value && !validateEmail(input.value)) {
            showFieldError(input, 'Por favor, insira um e-mail válido.');
            isValid = false;
        }
    });
    
    const phoneInputs = form.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        if (input.value && !validatePhone(input.value)) {
            showFieldError(input, 'Por favor, insira um telefone válido.');
            isValid = false;
        }
    });
    
    return isValid;
}

/**
 * Valida um campo individual
 * @param {HTMLElement} field - Campo a ser validado
 * @returns {boolean} True se válido, False caso contrário
 */
function validateField(field) {
    // Remove erros anteriores
    clearFieldError(field);
    
    // Validação de campo obrigatório
    if (field.hasAttribute('required') && !field.value.trim()) {
        showFieldError(field, 'Este campo é obrigatório.');
        return false;
    }
    
    // Validação de tamanho mínimo
    if (field.hasAttribute('minlength')) {
        const minLength = parseInt(field.getAttribute('minlength'));
        if (field.value.trim().length < minLength) {
            showFieldError(field, `Este campo deve ter pelo menos ${minLength} caracteres.`);
            return false;
        }
    }
    
    // Validação de tamanho máximo
    if (field.hasAttribute('maxlength')) {
        const maxLength = parseInt(field.getAttribute('maxlength'));
        if (field.value.trim().length > maxLength) {
            showFieldError(field, `Este campo deve ter no máximo ${maxLength} caracteres.`);
            return false;
        }
    }
    
    // Validação de email
    if (field.type === 'email' && field.value && !validateEmail(field.value)) {
        showFieldError(field, 'Por favor, insira um e-mail válido.');
        return false;
    }
    
    // Validação de telefone
    if (field.type === 'tel' && field.value && !validatePhone(field.value)) {
        showFieldError(field, 'Por favor, insira um telefone válido.');
        return false;
    }
    
    return true;
}

/**
 * Valida formato de email
 * @param {string} email - Email a ser validado
 * @returns {boolean} True se válido, False caso contrário
 */
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Valida formato de telefone brasileiro
 * @param {string} phone - Telefone a ser validado
 * @returns {boolean} True se válido, False caso contrário
 */
function validatePhone(phone) {
    // Remove caracteres não numéricos
    const phoneNumbers = phone.replace(/\D/g, '');
    // Valida se tem 10 ou 11 dígitos (com DDD)
    return phoneNumbers.length >= 10 && phoneNumbers.length <= 11;
}

/**
 * Exibe erro em um campo
 * @param {HTMLElement} field - Campo que possui erro
 * @param {string} message - Mensagem de erro
 */
function showFieldError(field, message) {
    // Adiciona classe de erro ao campo
    field.classList.add('error');
    
    // Remove mensagem de erro anterior, se existir
    const label = field.closest('label');
    const existingError = label?.querySelector('.field-error') || 
                          field.parentElement?.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Cria elemento de erro
    const errorElement = document.createElement('span');
    errorElement.className = 'field-error';
    errorElement.textContent = message;
    errorElement.setAttribute('role', 'alert');
    errorElement.setAttribute('aria-live', 'polite');
    
    // Insere a mensagem de erro
    if (label) {
        // Se o campo está dentro de um label, insere após o campo ou no final do label
        if (field.type === 'checkbox' || field.type === 'radio') {
            // Para checkboxes/radios, insere após o span que contém o texto
            const span = label.querySelector('span');
            if (span) {
                span.parentNode.insertBefore(errorElement, span.nextSibling);
            } else {
                label.appendChild(errorElement);
            }
        } else {
            // Para outros campos, insere após o campo
            field.parentNode.insertBefore(errorElement, field.nextSibling);
        }
    } else {
        // Se não houver label, insere após o campo
        if (field.parentNode) {
            field.parentNode.insertBefore(errorElement, field.nextSibling);
        }
    }
}

/**
 * Remove erro de um campo
 * @param {HTMLElement} field - Campo a ter erro removido
 */
function clearFieldError(field) {
    field.classList.remove('error');
    const label = field.closest('label');
    const errorElement = label?.querySelector('.field-error') || 
                        field.parentElement.querySelector('.field-error');
    if (errorElement) {
        errorElement.remove();
    }
}

/**
 * Exibe erro geral no formulário
 * @param {HTMLFormElement} form - Formulário que possui erro
 * @param {string} message - Mensagem de erro
 */
function showFormError(form, message) {
    // Remove erro anterior, se existir
    const existingError = form.querySelector('.form-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Cria elemento de erro
    const errorElement = document.createElement('div');
    errorElement.className = 'form-error';
    errorElement.textContent = message;
    errorElement.setAttribute('role', 'alert');
    errorElement.setAttribute('aria-live', 'polite');
    
    // Insere no início do formulário
    form.insertBefore(errorElement, form.firstChild);
    
    // Rola até o erro
    errorElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

/**
 * Verifica se há erro na URL (query string ?error=1) e busca erros do backend
 */
export async function checkUrlError() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === '1') {
        const form = document.querySelector('form[action*="php"]');
        if (!form) {
            return;
        }

        try {
            // Busca erros do backend
            const response = await fetch('src/php/get-errors.php');
            if (!response.ok) {
                throw new Error('Erro ao buscar erros');
            }

            const errors = await response.json();

            // Exibe erros gerais
            if (errors.general && errors.general.length > 0) {
                errors.general.forEach(error => {
                    showFormError(form, error);
                });
            }

            // Exibe erros de campos específicos
            if (errors.fields && Object.keys(errors.fields).length > 0) {
                Object.keys(errors.fields).forEach(fieldName => {
                    const field = form.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        const fieldErrors = errors.fields[fieldName];
                        const errorMessage = Array.isArray(fieldErrors) && fieldErrors.length > 0 
                            ? fieldErrors[0] 
                            : (typeof fieldErrors === 'string' ? fieldErrors : '');
                        
                        if (errorMessage) {
                            // Se o campo é radio ou checkbox dentro de um fieldset, exibe o erro no fieldset
                            if ((field.type === 'radio' || field.type === 'checkbox') && field.closest('fieldset')) {
                                const fieldset = field.closest('fieldset');
                                const existingError = fieldset.querySelector('.field-error');
                                if (existingError) {
                                    existingError.remove();
                                }
                                
                                const errorElement = document.createElement('span');
                                errorElement.className = 'field-error';
                                errorElement.textContent = errorMessage;
                                errorElement.setAttribute('role', 'alert');
                                errorElement.setAttribute('aria-live', 'polite');
                                
                                // Insere após a legend
                                const legend = fieldset.querySelector('legend');
                                if (legend) {
                                    legend.parentNode.insertBefore(errorElement, legend.nextSibling);
                                } else {
                                    fieldset.insertBefore(errorElement, fieldset.firstChild);
                                }
                                
                                // Adiciona classe de erro aos campos do fieldset
                                fieldset.querySelectorAll(`[name="${fieldName}"]`).forEach(f => {
                                    f.classList.add('error');
                                });
                            } else {
                                // Para outros campos, usa a função showFieldError
                                showFieldError(field, errorMessage);
                            }
                        }
                    }
                });
            }

            // Se não houver erros específicos, exibe mensagem genérica
            if ((!errors.general || errors.general.length === 0) &&
                (!errors.fields || Object.keys(errors.fields).length === 0)) {
                showFormError(form, 'Houve um erro ao enviar o formulário. Por favor, tente novamente.');
            }
        } catch (error) {
            console.error('Erro ao buscar erros do backend:', error);
            // Em caso de erro, exibe mensagem genérica
            const form = document.querySelector('form[action*="php"]');
            if (form) {
                showFormError(form, 'Houve um erro ao enviar o formulário. Por favor, tente novamente.');
            }
        }
    }
}

// Inicializa quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => {
    initFormValidation();
    checkUrlError();
});

