<?php

/**
 * Endpoint para obter token CSRF
 * Retorna o token CSRF em formato JSON
 */

require_once __DIR__ . '/functions.php';

header('Content-Type: application/json');

// Gera ou retorna o token CSRF existente
$token = generateCSRFToken();

echo json_encode([
    'csrf_token' => $token
]);
