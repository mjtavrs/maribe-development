<?php

/**
 * Router simples para desenvolvimento local
 * Usado com o servidor PHP built-in: php -S localhost:8000 router.php
 * 
 * Este router simula o comportamento do .htaccess em produção:
 * - Redireciona .html para .php
 * - Serve arquivos PHP corretamente
 * - Permite que arquivos estáticos sejam servidos normalmente
 */

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$queryString = parse_url($requestUri, PHP_URL_QUERY);

// Remove a barra inicial
$requestPath = ltrim($requestPath, '/');

// Se a query string já foi parseada pelo PHP (arquivos PHP diretos),
// garante que está em $_GET
if (!empty($queryString)) {
    parse_str($queryString, $parsedQuery);
    $_GET = array_merge($_GET, $parsedQuery);
}

// Remove duplicatas de lang na query string (evita loops)
if (isset($_GET['lang']) && is_array($_GET['lang'])) {
    $_GET['lang'] = end($_GET['lang']); // Pega o último valor
}

// Mapa de rotas de internacionalização: /pt/pagina, /en/pagina ou /es/pagina
$i18nRoutes = [
    'pt' => [
        'contato' => 'contato.php',
        'orcamento' => 'orcamento.php',
        'sobre' => 'sobre.php',
        'projetos' => 'projetos.php',
        'projeto' => 'projeto.php',
        'contrato' => 'contrato.php',
        'proposta' => 'proposta.php',
        'politica-de-privacidade' => 'politica-de-privacidade.php',
        'sucesso' => 'sucesso.php',
        '404' => '404.php',
        'index' => 'index.php'
    ],
    'en' => [
        'contact' => 'contato.php',
        'budget' => 'orcamento.php',
        'about' => 'sobre.php',
        'projects' => 'projetos.php',
        'project' => 'projeto.php',
        'contract' => 'contrato.php',
        'proposal' => 'proposta.php',
        'privacy-policy' => 'politica-de-privacidade.php',
        'success' => 'sucesso.php',
        '404' => '404.php',
        'home' => 'index.php',
        'index' => 'index.php'
    ],
    'es' => [
        'contacto' => 'contato.php',
        'presupuesto' => 'orcamento.php',
        'sobre' => 'sobre.php',
        'proyectos' => 'projetos.php',
        'proyecto' => 'projeto.php',
        'contrato' => 'contrato.php',
        'propuesta' => 'proposta.php',
        'politica-de-privacidad' => 'politica-de-privacidade.php',
        'exito' => 'sucesso.php',
        '404' => '404.php',
        'inicio' => 'index.php',
        'index' => 'index.php'
    ]
];

// Mapa de páginas em português
$ptRoutes = [
    'contato' => 'contato.php',
    'orcamento' => 'orcamento.php',
    'sobre' => 'sobre.php',
    'projetos' => 'projetos.php',
    'projeto' => 'projeto.php',
    'contrato' => 'contrato.php',
    'proposta' => 'proposta.php',
    'politica-de-privacidade' => 'politica-de-privacidade.php',
    'sucesso' => 'sucesso.php',
    'index' => 'index.php'
];

// Mapa de redirecionamentos .html para .php
$redirectMap = [
    'index.html' => 'index.php',
    'sobre.html' => 'sobre.php',
    'projetos.html' => 'projetos.php',
    'projeto.html' => 'projeto.php',
    'orcamento.html' => 'orcamento.php',
    'contato.html' => 'contato.php',
    'contrato.html' => 'contrato.php',
    'proposta.html' => 'proposta.php',
    'politica-de-privacidade.html' => 'politica-de-privacidade.php',
    'sucesso.html' => 'sucesso.php',
];

// Processa rotas de internacionalização: /pt/pagina, /en/pagina ou /es/pagina
if (preg_match('/^(pt|en|es)(?:\/(.+))?$/', $requestPath, $matches)) {
    $lang = $matches[1];
    $page = isset($matches[2]) && !empty($matches[2]) ? $matches[2] : 'index';

    // Normaliza páginas terminadas em .php para o nome sem extensão
    if (substr($page, -4) === '.php') {
        $page = substr($page, 0, -4);
    }

    // Normaliza nomes de página para index
    if ($page === 'home' || $page === 'inicio') {
        $page = 'index';
    }

    if (isset($i18nRoutes[$lang][$page])) {
        $phpFile = $i18nRoutes[$lang][$page];
        $fullPath = __DIR__ . '/' . $phpFile;

        // Verifica se o arquivo existe
        if (!file_exists($fullPath)) {
            http_response_code(404);
            echo "404 - Arquivo não encontrado: $phpFile (caminho completo: $fullPath)";
            return false;
        }

        // Define lang no $_GET antes de incluir o arquivo
        $_GET['lang'] = $lang;

        // Parse query string para $_GET se houver
        if (!empty($queryString)) {
            parse_str($queryString, $parsedQuery);
            // Remove lang duplicado se existir
            unset($parsedQuery['lang']);
            $parsedQuery['lang'] = $lang;
            $_GET = array_merge($_GET, $parsedQuery);
        }

        // Não redireciona, apenas inclui o arquivo diretamente
        // Usa chdir para garantir que includes relativos funcionem
        $oldDir = getcwd();
        chdir(__DIR__);
        require $phpFile;
        chdir($oldDir);
        return true;
    }

    // Se não encontrou a rota no mapeamento, serve a página 404
    http_response_code(404);
    $_GET['lang'] = $lang;
    $oldDir = getcwd();
    chdir(__DIR__);
    require '404.php';
    chdir($oldDir);
    return true;
}

// Redireciona URLs antigas sem prefixo para /pt/ (português padrão)
if (isset($ptRoutes[$requestPath])) {
    $phpFile = $ptRoutes[$requestPath];
    $phpFileName = basename($phpFile, '.php');
    // Remove lang da query string se já existir
    if (!empty($queryString)) {
        parse_str($queryString, $queryParams);
        unset($queryParams['lang']);
        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
    }
    // Redireciona para /pt/pagina
    header("Location: /pt/$phpFileName$queryString", true, 301);
    exit;
}

// Se for uma requisição .html, redireciona para .php
if (preg_match('/^(.+\.html)(\?.*)?$/', $requestPath, $matches)) {
    $htmlFile = $matches[1];
    $queryString = $matches[2] ?? '';

    if (isset($redirectMap[$htmlFile])) {
        $phpFile = $redirectMap[$htmlFile];
        header("Location: /$phpFile$queryString", true, 301);
        exit;
    }
}

// Se a rota é vazia ou raiz, redireciona para /pt/ (português padrão)
if (empty($requestPath) || $requestPath === '/') {
    // Remove lang da query string se já existir
    if (!empty($queryString)) {
        parse_str($queryString, $queryParams);
        unset($queryParams['lang']);
        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
    }
    header("Location: /pt/index$queryString", true, 301);
    exit;
}

// Verifica se o arquivo existe
$filePath = __DIR__ . '/' . $requestPath;

// Se for um arquivo PHP que existe, redireciona para /pt/pagina (apenas se for uma página conhecida)
if (file_exists($filePath) && !is_dir($filePath)) {
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    if ($extension === 'php') {
        $phpFileName = basename($filePath, '.php');

        // Se for uma página conhecida, redireciona para /pt/pagina
        if (isset($ptRoutes[$phpFileName])) {
            // Remove lang da query string se já existir
            if (!empty($queryString)) {
                parse_str($queryString, $queryParams);
                unset($queryParams['lang']);
                $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
            }
            header("Location: /pt/$phpFileName$queryString", true, 301);
            exit;
        }

        // Se for outro arquivo PHP (como includes, src/php, etc.), executa normalmente
        // Mas não processa arquivos em src/php como páginas (são endpoints)
        if (strpos($requestPath, 'src/php/') === 0) {
            // É um endpoint, executa normalmente
            if (!empty($queryString)) {
                parse_str($queryString, $parsedQuery);
                // Remove duplicatas de lang
                if (isset($parsedQuery['lang']) && is_array($parsedQuery['lang'])) {
                    $parsedQuery['lang'] = end($parsedQuery['lang']);
                }
                $_GET = array_merge($_GET, $parsedQuery);
            }
            require $filePath;
            return true;
        }

        // Para outros arquivos PHP (como includes), também executa
        if (!empty($queryString)) {
            parse_str($queryString, $parsedQuery);
            // Remove duplicatas de lang
            if (isset($parsedQuery['lang']) && is_array($parsedQuery['lang'])) {
                $parsedQuery['lang'] = end($parsedQuery['lang']);
            }
            $_GET = array_merge($_GET, $parsedQuery);
        }
        require $filePath;
        return true;
    }

    // Se for um arquivo estático (CSS, JS, imagens, etc.), deixa o servidor servir normalmente
    return false;
}

// Se não encontrou o arquivo, serve a página 404
http_response_code(404);
$oldDir = getcwd();
chdir(__DIR__);
require '404.php';
chdir($oldDir);
return true;
