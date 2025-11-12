<?php

/**
 * Funções auxiliares para formulários
 */

// Inicia sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    // Remove caracteres não numéricos
    $phone = preg_replace('/\D/', '', $phone);

    // Valida se tem 10 ou 11 dígitos (com DDD)
    return preg_match('/^\d{10,11}$/', $phone);
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
 * Redireciona para uma página de sucesso ou erro
 * 
 * @param string $status 'success' ou 'error'
 * @param array $errors Array de erros (opcional)
 * @param array $fieldErrors Array de erros por campo (opcional, chave = nome do campo)
 */
function redirectWithStatus($status = 'success', $errors = [], $fieldErrors = [])
{
    $baseUrl = getBaseUrl();

    if ($status === 'success') {
        // Limpa qualquer erro anterior
        clearFormErrors();

        // Tenta redirecionar para sucesso.html primeiro, depois sucesso sem extensão
        // (compatibilidade com servidores que podem ter rewrite rules)
        if (file_exists(__DIR__ . '/../../sucesso.html')) {
            header("Location: $baseUrl/sucesso.html");
        } else {
            header("Location: $baseUrl/sucesso");
        }
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
                'contactForm.php' => 'contato.html',
                'budgetForm.php' => 'orcamento.html',
                'contractForm.php' => 'contrato.html',
                'finalBudgetForm.php' => 'proposta.html'
            ];

            $page = $pageMap[$scriptName] ?? 'contato.html';
            $referer = $baseUrl . '/' . $page;
        } else {
            // Remove query string de erro anterior se existir
            $referer = preg_replace('/[?&]error=\d+/', '', $referer);
        }

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
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $fromEmail\r\n";
    $headers .= "Reply-To: $fromEmail\r\n";

    return mail($to, $subject, $message, $headers);
}
