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
            input.addEventListener('blur', () => {
                // Corrige telefone no blur (para autocomplete)
                if (input.type === 'tel') {
                    const masked = maskPhone(input.value);
                    if (input.value !== masked) {
                        input.value = masked;
                    }
                }
                validateField(input);
            });
            // Limpa erro quando o usuário começa a digitar
            input.addEventListener('input', () => {
                // Máscara dinâmica para telefone
                if (input.type === 'tel') {
                    const masked = maskPhone(input.value);
                    input.value = masked;
                }
                // Máscara para CPF
                if (input.name === 'cpf') {
                    input.value = maskCPF(input.value);
                }
                // Máscara para RG
                if (input.name === 'rg') {
                    input.value = maskRG(input.value);
                }
                // Validação numérica para metros quadrados
                if (input.name === 'tamanhoEmMetrosQuadrados') {
                    // Permite apenas números, vírgula e ponto
                    input.value = input.value.replace(/[^\d,.]/g, '');
                    // Se houver múltiplas vírgulas ou pontos, mantém apenas o primeiro
                    const parts = input.value.split(/[,.]/);
                    if (parts.length > 2) {
                        input.value = parts[0] + (parts.length > 1 ? '.' + parts.slice(1).join('') : '');
                    }
                }
                clearFieldError(input);
                // Para CPF, valida após 11 dígitos
                if (input.name === 'cpf') {
                    const cpfNumbers = input.value.replace(/\D/g, '');
                    if (cpfNumbers.length === 11) {
                        validateField(input);
                    }
                }
            });
            // Garante aplicação da máscara ao colar
            if (input.type === 'tel') {
                // Função auxiliar para corrigir o telefone
                const correctPhone = () => {
                    const originalValue = input.value;
                    const masked = maskPhone(originalValue);
                    if (originalValue !== masked) {
                        input.value = masked;
                        // Dispara evento input para garantir que outros listeners sejam notificados
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                };
                
                input.addEventListener('paste', (e) => {
                    requestAnimationFrame(() => {
                        correctPhone();
                    });
                });
                
                // Corrige telefone quando o valor muda (para autocomplete)
                input.addEventListener('change', correctPhone);
                
                // Verifica quando o campo recebe foco (autocomplete pode ter preenchido antes)
                input.addEventListener('focus', () => {
                    // Verifica imediatamente
                    correctPhone();
                    // Verifica novamente após um pequeno delay (autocomplete pode ser assíncrono)
                    setTimeout(correctPhone, 100);
                    setTimeout(correctPhone, 300);
                });
                
                // Verifica quando o campo é clicado (autocomplete pode preencher ao clicar)
                input.addEventListener('click', () => {
                    setTimeout(correctPhone, 50);
                });
            }
            if (input.name === 'cpf' || input.name === 'rg') {
                input.addEventListener('paste', () => {
                    requestAnimationFrame(() => {
                        if (input.name === 'cpf') input.value = maskCPF(input.value);
                        if (input.name === 'rg') input.value = maskRG(input.value);
                    });
                });
            }
        });
        
        // Validação em tempo real para checkbox de privacidade
        const privacyCheckbox = form.querySelector('input[name="privacy"][type="checkbox"]');
        if (privacyCheckbox) {
            privacyCheckbox.addEventListener('change', () => {
                clearFieldError(privacyCheckbox);
                if (privacyCheckbox.checked) {
                    // Se marcou, valida para garantir que está ok
                    validateField(privacyCheckbox);
                }
            });
        }

        // Controle do campo "Outros" no select de assunto (formulário de contato)
        const subjectSelect = form.querySelector('select[name="subject"]');
        const subjectOtherWrapper = form.querySelector('#subjectOtherWrapper');
        const subjectOtherInput = form.querySelector('input[name="subjectOther"]');
        
        if (subjectSelect && subjectOtherWrapper && subjectOtherInput) {
            // Função para mostrar/esconder campo "Outros"
            const toggleSubjectOther = () => {
                const currentLang = document.documentElement.lang || 'pt-br';
                let outrosText = 'Outros';
                
                // Detecta o texto "Outros" baseado no idioma
                if (currentLang.includes('en')) {
                    outrosText = 'Other';
                } else if (currentLang.includes('es')) {
                    outrosText = 'Otros';
                }
                
                if (subjectSelect.value === outrosText) {
                    subjectOtherWrapper.style.display = 'block';
                    subjectOtherInput.setAttribute('required', 'true');
                    subjectOtherInput.setAttribute('aria-required', 'true');
                } else {
                    subjectOtherWrapper.style.display = 'none';
                    subjectOtherInput.removeAttribute('required');
                    subjectOtherInput.removeAttribute('aria-required');
                    subjectOtherInput.value = '';
                    clearFieldError(subjectOtherInput);
                }
            };

            // Verifica estado inicial
            toggleSubjectOther();

            // Monitora mudanças no select
            subjectSelect.addEventListener('change', () => {
                clearFieldError(subjectSelect);
                toggleSubjectOther();
            });

            // Validação em tempo real do campo "Outros"
            subjectOtherInput.addEventListener('blur', () => validateField(subjectOtherInput));
            subjectOtherInput.addEventListener('input', () => clearFieldError(subjectOtherInput));
        }

        // Validação em tempo real para selects
        const selects = form.querySelectorAll('select[required]');
        selects.forEach(select => {
            select.addEventListener('change', () => {
                clearFieldError(select);
                validateField(select);
            });
        });
    });
}

/**
 * Manipula o envio do formulário
 * @param {Event} event - Evento de submit
 */
function handleFormSubmit(event) {
    const form = event.target;
    
    // Corrige telefones antes de validar (última linha de defesa contra autocomplete)
    const phoneInputs = form.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        if (input.value) {
            const masked = maskPhone(input.value);
            if (input.value !== masked) {
                input.value = masked;
            }
        }
    });
    
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
    // Seleciona todos os campos obrigatórios, incluindo checkboxes
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    // Validação específica para checkbox de privacidade
    const privacyCheckbox = form.querySelector('input[name="privacy"][type="checkbox"]');
    if (privacyCheckbox && !privacyCheckbox.checked) {
        showFieldError(privacyCheckbox, 'Você deve concordar com a política de privacidade.');
        isValid = false;
    }
    
    // Validação específica para campo "Outros" do assunto (quando "Outros" está selecionado)
    const subjectSelect = form.querySelector('select[name="subject"]');
    const subjectOtherInput = form.querySelector('input[name="subjectOther"]');
    if (subjectSelect && subjectOtherInput) {
        const currentLang = document.documentElement.lang || 'pt-br';
        let outrosText = 'Outros';
        if (currentLang.includes('en')) {
            outrosText = 'Other';
        } else if (currentLang.includes('es')) {
            outrosText = 'Otros';
        }
        
        if (subjectSelect.value === outrosText) {
            if (!subjectOtherInput.value || subjectOtherInput.value.trim().length < 3) {
                showFieldError(subjectOtherInput, 'Por favor, descreva o assunto (mínimo 3 caracteres).');
                isValid = false;
            }
        }
    }

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
    
    // Validação de CPF
    const cpfInputs = form.querySelectorAll('input[name="cpf"]');
    cpfInputs.forEach(input => {
        if (input.value && !validateCPF(input.value)) {
            showFieldError(input, 'CPF inválido. Por favor, verifique os dígitos informados.');
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
    if (field.hasAttribute('required')) {
        // Para checkboxes, verifica se está marcado
        if (field.type === 'checkbox') {
            if (!field.checked) {
                showFieldError(field, 'Você deve concordar com a política de privacidade.');
                return false;
            }
        } 
        // Para outros campos, verifica se tem valor
        else if (!field.value.trim()) {
            showFieldError(field, 'Este campo é obrigatório.');
            return false;
        }
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
    
    // Validação de CPF
    if (field.name === 'cpf' && field.value && !validateCPF(field.value)) {
        showFieldError(field, 'CPF inválido. Por favor, verifique os dígitos informados.');
        return false;
    }

    // Validação de RG simples: pelo menos 7 dígitos numéricos
    if (field.name === 'rg' && field.value) {
        const rgDigits = field.value.replace(/\D/g, '');
        if (rgDigits.length < 7) {
            showFieldError(field, 'RG inválido. Verifique os dígitos informados.');
            return false;
        }
    }

    // Validação de metros quadrados (número com ou sem decimais)
    if (field.name === 'tamanhoEmMetrosQuadrados' && field.value) {
        // Permite números com vírgula ou ponto como separador decimal
        const cleanValue = field.value.replace(',', '.');
        const numValue = parseFloat(cleanValue);
        if (isNaN(numValue) || numValue <= 0) {
            showFieldError(field, 'Por favor, insira um valor numérico válido maior que zero.');
            return false;
        }
    }

    // Validação para select
    if (field.tagName === 'SELECT' && field.hasAttribute('required')) {
        if (!field.value || field.value.trim() === '') {
            showFieldError(field, 'Por favor, selecione uma opção.');
            return false;
        }
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
    // Verifica se começa com "+" (formato internacional do autocomplete)
    const hasPlusSign = phone.trim().startsWith('+');
    
    // Remove caracteres não numéricos
    let phoneNumbers = phone.replace(/\D/g, '');
    
    // Remove código do país do Brasil (55) se presente no início
    // Isso corrige o problema do autocomplete do navegador
    // Regras:
    // 1. Se começa com "+55" (formato internacional), remove "+55"
    // 2. Se tem mais de 11 dígitos e começa com "55", remove "55"
    // 3. Se tem exatamente 10-11 dígitos, mantém (pode ser DDD 55 válido)
    if (hasPlusSign && phoneNumbers.startsWith('55')) {
        // Formato internacional: +55...
        phoneNumbers = phoneNumbers.slice(2);
    } else if (phoneNumbers.length > 11 && phoneNumbers.startsWith('55')) {
        // Mais de 11 dígitos começando com 55 = código do país
        phoneNumbers = phoneNumbers.slice(2);
    }
    // Se tem 10-11 dígitos e começa com 55, mantém (pode ser DDD 55)
    
    // Valida se tem 10 ou 11 dígitos (com DDD)
    return phoneNumbers.length >= 10 && phoneNumbers.length <= 11;
}

/**
 * Aplica máscara brasileira de telefone
 * (DD) NNNN-NNNN para 10 dígitos
 * (DD) NNNNN-NNNN para 11 dígitos
 * Remove código do país (55) se presente
 * @param {string} value
 * @returns {string}
 */
function maskPhone(value) {
    if (!value) return '';
    
    // Verifica se começa com "+" (formato internacional do autocomplete)
    const hasPlusSign = value.trim().startsWith('+');
    
    let digits = value.replace(/\D/g, '');
    
    // Remove código do país do Brasil (55) se presente no início
    // Isso corrige o problema do autocomplete do navegador
    // Regras:
    // 1. Se começa com "+55" (formato internacional), remove "+55"
    // 2. Se tem mais de 11 dígitos e começa com "55", remove "55"
    // 3. Se tem exatamente 10-11 dígitos, mantém (pode ser DDD 55 válido)
    if (hasPlusSign && digits.startsWith('55')) {
        // Formato internacional: +55...
        digits = digits.slice(2);
    } else if (digits.length > 11 && digits.startsWith('55')) {
        // Mais de 11 dígitos começando com 55 = código do país
        digits = digits.slice(2);
    }
    // Se tem 10-11 dígitos e começa com 55, mantém (pode ser DDD 55)
    
    // Limita a 11 dígitos (DDD + número)
    digits = digits.slice(0, 11);

    // Sem dígitos, não mostra nada (evita exibir "(" sozinho)
    if (digits.length === 0) {
        return '';
    }

    // DDD
    if (digits.length <= 2) {
        return `(${digits}`;
    }

    const ddd = digits.slice(0, 2);
    const rest = digits.slice(2);

    // 10 dígitos total: (DD) NNNN-NNNN
    if (digits.length <= 10) {
        const part1 = rest.slice(0, 4);
        const part2 = rest.slice(4, 8);
        return `(${ddd}) ${part1}${part2 ? '-' + part2 : ''}`.trim();
    }

    // 11 dígitos total: (DD) NNNNN-NNNN
    const part1 = rest.slice(0, 5);
    const part2 = rest.slice(5, 9);
    return `(${ddd}) ${part1}${part2 ? '-' + part2 : ''}`.trim();
}

/**
 * Valida CPF brasileiro
 * @param {string} cpf - CPF a ser validado (pode conter pontos e traços)
 * @returns {boolean} True se válido, False caso contrário
 */
function validateCPF(cpf) {
    if (!cpf) {
        return false;
    }

    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');

    // Verifica se tem 11 dígitos
    if (cpf.length !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (CPFs inválidos conhecidos)
    if (/^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    // Valida primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf[i]) * (10 - i);
    }
    let resto = soma % 11;
    let digito1 = resto < 2 ? 0 : 11 - resto;

    if (parseInt(cpf[9]) !== digito1) {
        return false;
    }

    // Valida segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf[i]) * (11 - i);
    }
    resto = soma % 11;
    let digito2 = resto < 2 ? 0 : 11 - resto;

    if (parseInt(cpf[10]) !== digito2) {
        return false;
    }

    return true;
}

/**
 * Máscara de CPF: 000.000.000-00
 */
function maskCPF(value) {
    if (!value) return '';
    const digits = value.replace(/\D/g, '').slice(0, 11);
    if (digits.length <= 3) return digits;
    if (digits.length <= 6) return `${digits.slice(0, 3)}.${digits.slice(3)}`;
    if (digits.length <= 9) return `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6)}`;
    return `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6, 9)}-${digits.slice(9)}`;
}

/**
 * Máscara de RG comum (variável por estado): 00.000.000-0
 * Mantém até 9 dígitos, com pontos e hífen quando possível
 */
function maskRG(value) {
    if (!value) return '';
    const digits = value.replace(/\D/g, '').slice(0, 9);
    if (digits.length <= 2) return digits;
    if (digits.length <= 5) return `${digits.slice(0, 2)}.${digits.slice(2)}`;
    if (digits.length <= 8) return `${digits.slice(0, 2)}.${digits.slice(2, 5)}.${digits.slice(5)}`;
    return `${digits.slice(0, 2)}.${digits.slice(2, 5)}.${digits.slice(5, 8)}-${digits.slice(8)}`;
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
    const floatingWrapper = field.closest('.floating-label-wrapper');
    const fieldContainer = field.closest('.form-field') || (floatingWrapper ? floatingWrapper.parentElement : null);
    const existingError = label?.querySelector('.field-error') || 
                          (fieldContainer && fieldContainer.querySelector('.field-error'));
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
    if (label && !fieldContainer) {
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
    } else if (fieldContainer) {
        // Se usa container, insere a mensagem dentro do container (após o wrapper)
        fieldContainer.appendChild(errorElement);
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
    const fieldContainer = field.closest('.form-field') || field.closest('.floating-label-wrapper')?.parentElement;
    let errorElement = label?.querySelector('.field-error') || (fieldContainer ? fieldContainer.querySelector('.field-error') : null) || field.parentElement.querySelector('.field-error');
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

