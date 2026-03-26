<?php

/**
 * Endpoint para obter erros da sessão em formato JSON
 * Usado pelo JavaScript para exibir erros nos formulários
 */

require_once __DIR__ . '/functions.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// Obtém erros da sessão (remove automaticamente após ler)
$errors = getFormErrors();

// Retorna erros em formato JSON
echo json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;
