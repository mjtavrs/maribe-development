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

// Inicia output buffering para evitar problemas com headers e cookies
if (!ob_get_level()) {
    ob_start();
}

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);
$queryString = parse_url($requestUri, PHP_URL_QUERY);

// Remove barras iniciais e finais
$requestPath = trim($requestPath, '/');

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
// Aceita tanto /pt quanto /pt/pagina
if (preg_match('/^(pt|en|es)(?:\/(.*))?$/', $requestPath, $matches)) {
    $lang = $matches[1];
    $page = isset($matches[2]) && !empty(trim($matches[2])) ? trim($matches[2]) : '';
    
    // Se a página for "index", "home" ou "inicio", redireciona para a raiz do idioma (sem /index)
    if ($page === 'index' || $page === 'home' || $page === 'inicio') {
        // Remove lang da query string se já existir
        if (!empty($queryString)) {
            parse_str($queryString, $queryParams);
            unset($queryParams['lang']);
            $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        }
        header("Location: /$lang/$queryString", true, 301);
        exit;
    }
    
    // Se não há página especificada (apenas o idioma), usa index internamente
    if (empty($page)) {
        $page = 'index';
    }

    // Normaliza páginas terminadas em .php para o nome sem extensão
    if (substr($page, -4) === '.php') {
        $page = substr($page, 0, -4);
    }
    
    // Normaliza nomes de página conhecidos para o formato correto do idioma
    // Isso garante que projeto.php, project.php, proyecto.php sejam tratados corretamente
    $pageNormalization = [
        'pt' => [
            'projeto' => 'projeto',
            'projetos' => 'projetos'
        ],
        'en' => [
            'projeto' => 'project',
            'project' => 'project',
            'projetos' => 'projects',
            'projects' => 'projects'
        ],
        'es' => [
            'projeto' => 'proyecto',
            'proyecto' => 'proyecto',
            'projetos' => 'proyectos',
            'proyectos' => 'proyectos'
        ]
    ];
    
    if (isset($pageNormalization[$lang][$page])) {
        $page = $pageNormalization[$lang][$page];
    }

    // Normaliza nomes de página para index
    if ($page === 'home' || $page === 'inicio') {
        $page = 'index';
    }

    // Garante que a página existe no mapeamento
    if (!isset($i18nRoutes[$lang]) || !isset($i18nRoutes[$lang][$page])) {
        // Se não encontrou a rota, serve a página 404
        http_response_code(404);
        $_GET['lang'] = $lang;
        $oldDir = getcwd();
        chdir(__DIR__);
        require '404.php';
        chdir($oldDir);
        if (ob_get_level() > 0) {
            ob_end_flush();
        }
        return true;
    }
    
    $phpFile = $i18nRoutes[$lang][$page];
    $fullPath = __DIR__ . '/' . $phpFile;

    // Verifica se o arquivo existe
    if (!file_exists($fullPath)) {
        http_response_code(404);
        echo "404 - Arquivo não encontrado: $phpFile (caminho completo: $fullPath)";
        if (ob_get_level() > 0) {
            ob_end_flush();
        }
        return false;
    }

    // Define lang no $_GET e na sessão ANTES de incluir o arquivo
    // Isso garante que getCurrentLanguage() detecte o idioma correto
    $_GET['lang'] = $lang;
    
    // Inicia sessão se ainda não foi iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Define o idioma na sessão para garantir que getCurrentLanguage() funcione
    // IMPORTANTE: Isso deve ser feito ANTES de incluir qualquer arquivo que use getCurrentLanguage()
    $_SESSION['lang'] = $lang;
    
    // Salva também no cookie para persistência
    // Carrega funções se necessário para usar setLanguageCookie
    if (!function_exists('setLanguageCookie')) {
        // Tenta carregar o arquivo de funções se ainda não foi carregado
        $functionsPath = __DIR__ . '/src/php/functions.php';
        if (file_exists($functionsPath)) {
            require_once $functionsPath;
        }
    }
    
    if (function_exists('setLanguageCookie')) {
        setLanguageCookie($lang);
    } else {
        // Fallback: define cookie diretamente (apenas se headers ainda não foram enviados)
        if (!headers_sent()) {
            setcookie('preferred_language', $lang, time() + (7 * 24 * 60 * 60), '/');
        }
    }

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
    // Limpa o buffer de saída se ainda estiver ativo
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
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
    header("Location: /pt/$queryString", true, 301);
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
            // Limpa o buffer de saída se ainda estiver ativo
            if (ob_get_level() > 0) {
                ob_end_flush();
            }
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
        // Limpa o buffer de saída se ainda estiver ativo
        if (ob_get_level() > 0) {
            ob_end_flush();
        }
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
// Limpa o buffer de saída se ainda estiver ativo
if (ob_get_level() > 0) {
    ob_end_flush();
}
return true;
