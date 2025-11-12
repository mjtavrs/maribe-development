<?php

/**
 * Funções auxiliares para formulários
 */

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
 * Redireciona para uma página de sucesso ou erro
 * 
 * @param string $status 'success' ou 'error'
 * @param array $errors Array de erros (opcional)
 */
function redirectWithStatus($status = 'success', $errors = [])
{
    $baseUrl = getBaseUrl();

    if ($status === 'success') {
        // Tenta redirecionar para sucesso.html primeiro, depois sucesso sem extensão
        // (compatibilidade com servidores que podem ter rewrite rules)
        if (file_exists(__DIR__ . '/../../sucesso.html')) {
            header("Location: $baseUrl/sucesso.html");
        } else {
            header("Location: $baseUrl/sucesso");
        }
        exit;
    } else {
        // Em caso de erro, redireciona de volta ao formulário
        // Usa o referer ou tenta identificar a página de origem
        $referer = $_SERVER['HTTP_REFERER'] ?? $baseUrl . '/contato.html';

        // Se houver erros, poderia passar via sessão, mas por simplicidade
        // apenas redireciona de volta (o formulário pode exibir mensagem genérica)
        header("Location: $referer?error=1");
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