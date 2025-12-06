<?php

/**
 * Funções auxiliares para formulários
 */

// Inicia output buffering para evitar problemas com session_start()
// Isso permite que session_start() seja chamado mesmo se houver algum output anterior
if (!ob_get_level()) {
    ob_start();
}

// Inicia sessão se ainda não foi iniciada
// IMPORTANTE: Este arquivo deve ser incluído ANTES de qualquer output HTML
// Se você ver um warning de "headers already sent", verifique se há espaços ou caracteres antes do <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrega sistema de internacionalização
require_once __DIR__ . '/i18n.php';

/**
 * Sanitiza uma string para uso seguro em HTML
 * 
 * @param string $data Dados a serem sanitizados
 * @return string Dados sanitizados
 */
function sanitizeInput($data)
{
    if (empty($data)) {
        return '';
    }

    // Remove espaços no início e fim
    $data = trim($data);

    // Remove barras invertidas
    $data = stripslashes($data);

    // Converte caracteres especiais para entidades HTML
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    return $data;
}

/**
 * Sanitiza dados para uso em email HTML
 * 
 * @param string $data Dados a serem sanitizados
 * @return string Dados sanitizados
 */
function sanitizeForEmail($data)
{
    if (empty($data)) {
        return '';
    }

    // Remove espaços no início e fim
    $data = trim($data);

    // Remove barras invertidas
    $data = stripslashes($data);

    // Converte quebras de linha para <br>
    $data = nl2br(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));

    return $data;
}

/**
 * Valida formato de email
 * 
 * @param string $email Email a ser validado
 * @return bool True se válido, False caso contrário
 */
function validateEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Valida formato de telefone brasileiro
 * 
 * @param string $phone Telefone a ser validado
 * @return bool True se válido, False caso contrário
 */
function validatePhone($phone)
{
    if (empty($phone)) {
        return false;
    }

    // Verifica se começa com "+" (formato internacional do autocomplete)
    $hasPlusSign = strpos(trim($phone), '+') === 0;

    // Remove caracteres não numéricos
    $phoneDigits = preg_replace('/\D/', '', $phone);

    // Remove código do país do Brasil (55) se presente no início
    // Isso corrige o problema do autocomplete do navegador
    // Regras:
    // 1. Se começa com "+55" (formato internacional), remove "+55"
    // 2. Se tem mais de 11 dígitos e começa com "55", remove "55"
    // 3. Se tem exatamente 10-11 dígitos, mantém (pode ser DDD 55 válido)
    if ($hasPlusSign && substr($phoneDigits, 0, 2) === '55') {
        // Formato internacional: +55...
        $phoneDigits = substr($phoneDigits, 2);
    } else if (strlen($phoneDigits) > 11 && substr($phoneDigits, 0, 2) === '55') {
        // Mais de 11 dígitos começando com 55 = código do país
        $phoneDigits = substr($phoneDigits, 2);
    }
    // Se tem 10-11 dígitos e começa com 55, mantém (pode ser DDD 55)

    // Valida se tem 10 ou 11 dígitos (com DDD)
    return preg_match('/^\d{10,11}$/', $phoneDigits);
}

/**
 * Valida CPF brasileiro
 * 
 * @param string $cpf CPF a ser validado (pode conter pontos e traços)
 * @return bool True se válido, False caso contrário
 */
function validateCPF($cpf)
{
    if (empty($cpf)) {
        return false;
    }

    // Remove caracteres não numéricos
    $cpf = preg_replace('/\D/', '', $cpf);

    // Verifica se tem 11 dígitos
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (CPFs inválidos conhecidos)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Valida primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    if (intval($cpf[9]) !== $digito1) {
        return false;
    }

    // Valida segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += intval($cpf[$i]) * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    if (intval($cpf[10]) !== $digito2) {
        return false;
    }

    return true;
}

/**
 * Gera um token CSRF e o armazena na sessão
 * 
 * @return string Token CSRF
 */
function generateCSRFToken()
{
    if (!isset($_SESSION['csrf_token'])) {
        // Gera um token aleatório seguro
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Valida um token CSRF
 * 
 * @param string $token Token a ser validado
 * @return bool True se válido, False caso contrário
 */
function validateCSRFToken($token)
{
    if (empty($token)) {
        return false;
    }

    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }

    // Compara os tokens de forma segura (timing-safe comparison)
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Gera um novo token CSRF (útil após uso para regenerar)
 * 
 * @return string Novo token CSRF
 */
function regenerateCSRFToken()
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

/**
 * Retorna a URL base do site
 * 
 * @return string URL base
 */
function getBaseUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . '://' . $host;
}

/**
 * Armazena erros na sessão
 * 
 * @param array $errors Array de erros
 * @param string $field Campo específico (opcional, para erros de campo específico)
 */
function setFormErrors($errors, $field = null)
{
    if (!is_array($errors)) {
        $errors = [$errors];
    }

    if (!isset($_SESSION['form_errors'])) {
        $_SESSION['form_errors'] = [
            'general' => [],
            'fields' => []
        ];
    }

    if ($field !== null) {
        // Erro de campo específico
        if (!isset($_SESSION['form_errors']['fields'][$field])) {
            $_SESSION['form_errors']['fields'][$field] = [];
        }
        $_SESSION['form_errors']['fields'][$field] = array_merge(
            $_SESSION['form_errors']['fields'][$field],
            $errors
        );
    } else {
        // Erros gerais
        $_SESSION['form_errors']['general'] = array_merge(
            $_SESSION['form_errors']['general'],
            $errors
        );
    }
}

/**
 * Obtém erros da sessão e os remove
 * 
 * @return array Array com 'general' (erros gerais) e 'fields' (erros por campo)
 */
function getFormErrors()
{
    $errors = [
        'general' => [],
        'fields' => []
    ];

    if (isset($_SESSION['form_errors'])) {
        $errors = $_SESSION['form_errors'];
        // Remove erros após ler (apenas uma vez)
        unset($_SESSION['form_errors']);
    }

    return $errors;
}

/**
 * Verifica se há erros na sessão
 * 
 * @return bool True se houver erros, False caso contrário
 */
function hasFormErrors()
{
    return isset($_SESSION['form_errors']) &&
        (!empty($_SESSION['form_errors']['general']) ||
            !empty($_SESSION['form_errors']['fields']));
}

/**
 * Limpa erros da sessão
 */
function clearFormErrors()
{
    if (isset($_SESSION['form_errors'])) {
        unset($_SESSION['form_errors']);
    }
}

/**
 * Define toast na sessão
 * 
 * @param string $type Tipo do toast ('success' ou 'error')
 * @param string $message Mensagem a ser exibida
 * @param string $title Título do toast (opcional)
 */
function setToast($type, $message, $title = null)
{
    // Títulos padrão se não fornecidos (usa traduções se disponível)
    if ($title === null) {
        if (function_exists('t')) {
            $title = $type === 'success' ? t('toast.success.title') : t('toast.error.title');
        } else {
            $title = $type === 'success' ? 'Sucesso!' : 'Erro!';
        }
    }

    $_SESSION['toast'] = [
        'type' => $type,
        'title' => $title,
        'message' => $message
    ];
}

/**
 * Limpa toast da sessão
 */
function clearToast()
{
    if (isset($_SESSION['toast'])) {
        unset($_SESSION['toast']);
    }
}

/**
 * Redireciona para uma página de sucesso ou erro
 * 
 * @param string $status 'success' ou 'error'
 * @param array $errors Array de erros (opcional)
 * @param array $fieldErrors Array de erros por campo (opcional, chave = nome do campo)
 */
function redirectWithStatus($status = 'success', $errors = [], $fieldErrors = [])
{
    // Garante que a sessão está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $baseUrl = getBaseUrl();
    
    // Detecta o idioma atual para preservar no redirect
    $currentLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';

    if ($status === 'success') {
        // Limpa qualquer erro anterior
        clearFormErrors();

        // Regenera o token CSRF após uso bem-sucedido
        regenerateCSRFToken();

        // Define toast de sucesso na sessão (usa traduções se disponível)
        $successTitle = function_exists('t') ? t('toast.success.title') : 'Sucesso!';
        $successMessage = function_exists('t') ? t('toast.success.message') : 'Mensagem enviada com sucesso! Entraremos em contato em breve.';
        setToast('success', $successMessage, $successTitle);

        // Redireciona de volta para a página do formulário preservando o idioma
        $referer = $_SERVER['HTTP_REFERER'] ?? null;
        
        // Tenta extrair o idioma do referer ou usa o idioma atual
        $lang = $currentLang;
        if ($referer) {
            // Remove parâmetros de erro da URL se existirem
            $referer = preg_replace('/[?&]error=\d+/', '', $referer);
            
            // Tenta extrair o idioma do referer
            if (preg_match('/\/(pt|en|es)\//', $referer, $matches)) {
                $lang = $matches[1];
            }
        }
        
        if (!$referer) {
            $scriptName = basename($_SERVER['PHP_SELF']);
            $pageMap = [
                'contactForm.php' => 'contato',
                'budgetForm.php' => 'orcamento',
                'contractForm.php' => 'contrato',
                'finalBudgetForm.php' => 'proposta'
            ];
            $page = $pageMap[$scriptName] ?? 'contato';
            
            // Usa a função url() se disponível para preservar o idioma
            if (function_exists('url')) {
                $referer = url($page, $lang);
            } else {
                $referer = $baseUrl . '/' . $lang . '/' . $page;
            }
        } else {
            // Garante que o referer tem o idioma correto na URL
            if (!preg_match('/\/(pt|en|es)\//', $referer)) {
                // Se não tem idioma no referer, usa a função url() para construir corretamente
                $scriptName = basename($_SERVER['PHP_SELF']);
                $pageMap = [
                    'contactForm.php' => 'contato',
                    'budgetForm.php' => 'orcamento',
                    'contractForm.php' => 'contrato',
                    'finalBudgetForm.php' => 'proposta'
                ];
                $page = $pageMap[$scriptName] ?? 'contato';
                
                if (function_exists('url')) {
                    $referer = url($page, $lang);
                } else {
                    $referer = $baseUrl . '/' . $lang . '/' . $page;
                }
            }
        }

        header("Location: $referer");
        exit;
    } else {
        // Em caso de erro, armazena erros na sessão
        if (!empty($errors)) {
            setFormErrors($errors);
        }

        // Armazena erros de campos específicos
        if (!empty($fieldErrors)) {
            foreach ($fieldErrors as $field => $fieldError) {
                // Se for string, converte para array
                if (is_string($fieldError)) {
                    setFormErrors([$fieldError], $field);
                } else if (is_array($fieldError)) {
                    setFormErrors($fieldError, $field);
                }
            }
        }

        // Em caso de erro, redireciona de volta ao formulário
        // Tenta identificar a página de origem baseado no script atual
        $referer = $_SERVER['HTTP_REFERER'] ?? null;

        // Se não houver referer, tenta identificar a página baseado no script
        if (!$referer) {
            $scriptName = basename($_SERVER['PHP_SELF']);
            $pageMap = [
                'contactForm.php' => 'contato.php',
                'budgetForm.php' => 'orcamento.php',
                'contractForm.php' => 'contrato.php',
                'finalBudgetForm.php' => 'proposta.php'
            ];

            $page = $pageMap[$scriptName] ?? 'contato.php';
            $referer = $baseUrl . '/' . $page;
        } else {
            // Remove query string de erro anterior se existir
            $referer = preg_replace('/[?&]error=\d+/', '', $referer);
        }

        // Define toast de erro na sessão (usa traduções se disponível)
        $errorTitle = function_exists('t') ? t('toast.error.title') : 'Erro!';
        $errorMessage = !empty($errors) ? $errors[0] : (function_exists('t') ? t('toast.error.message') : 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.');
        setToast('error', $errorMessage, $errorTitle);

        $separator = strpos($referer, '?') !== false ? '&' : '?';
        header("Location: $referer{$separator}error=1");
        exit;
    }
}

/**
 * Envia email de formulário
 * 
 * @param string $to Email destinatário
 * @param string $subject Assunto do email
 * @param string $message Mensagem HTML do email
 * @param string $fromEmail Email do remetente
 * @return bool True se enviado com sucesso, False caso contrário
 */
function sendEmail($to, $subject, $message, $fromEmail)
{
    // Valida o e-mail de destino
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        error_log("Email inválido: $to");
        return false;
    }

    // Valida o e-mail do remetente
    if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
        error_log("Email do remetente inválido: $fromEmail");
        return false;
    }

    // Prepara o assunto com encoding correto para caracteres especiais
    $subjectEncoded = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    // Prepara headers otimizados
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: Maribe Arquitetura <noreply@maribe.arq.br>" . "\r\n";
    $headers .= "Reply-To: $fromEmail" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Tenta enviar o email
    $result = @mail($to, $subjectEncoded, $message, $headers);

    // Log para debug (visível nos logs do servidor)
    if (!$result) {
        $error = error_get_last();
        error_log("Erro ao enviar email para $to: " . ($error ? $error['message'] : 'Erro desconhecido'));
    }

    return $result;
}

/**
 * Formata data conforme o idioma
 * 
 * @param string|null $lang Idioma (pt, en, es). Se null, usa o idioma atual
 * @param string|null $date Data no formato Y-m-d ou timestamp. Se null, usa hoje
 * @return string Data formatada
 */
function formatDate($lang = null, $date = null)
{
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }

    if ($date === null) {
        $timestamp = strtotime('today');
    } else {
        $timestamp = is_numeric($date) ? $date : strtotime($date);
    }

    // Nomes dos meses em cada idioma
    $months = [
        'pt' => [
            1 => 'janeiro', 2 => 'fevereiro', 3 => 'março', 4 => 'abril',
            5 => 'maio', 6 => 'junho', 7 => 'julho', 8 => 'agosto',
            9 => 'setembro', 10 => 'outubro', 11 => 'novembro', 12 => 'dezembro'
        ],
        'en' => [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ],
        'es' => [
            1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
        ]
    ];

    $day = date('j', $timestamp);
    $month = (int)date('n', $timestamp);
    $year = date('Y', $timestamp);

    if ($lang === 'pt') {
        return "$day de {$months['pt'][$month]} de $year";
    } elseif ($lang === 'en') {
        return "{$months['en'][$month]} $day, $year";
    } elseif ($lang === 'es') {
        return "$day de {$months['es'][$month]} de $year";
    }

    // Fallback para português
    return "$day de {$months['pt'][$month]} de $year";
}