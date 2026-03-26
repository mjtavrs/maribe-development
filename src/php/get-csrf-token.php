<?php

/**
 * Endpoint para obter token CSRF
 * Retorna o token CSRF em formato JSON
 */

require_once __DIR__ . '/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Gera ou retorna o token CSRF existente
$token = generateCSRFToken();

echo json_encode([
    'csrf_token' => $token
]);
