<?php

/**
 * Sistema de Internacionalização (i18n)
 * 
 * Gerencia traduções e detecção de idioma
 */

// Idiomas suportados
define('SUPPORTED_LANGUAGES', ['pt', 'en', 'es']);
define('DEFAULT_LANGUAGE', 'pt');

/**
 * Detecta o idioma preferido do usuário
 * 
 * Ordem de prioridade:
 * 1. Parâmetro ?lang= na URL
 * 2. Cookie/localStorage (idioma salvo por 1 semana)
 * 3. Sessão (idioma escolhido anteriormente)
 * 4. Header Accept-Language do navegador
 * 5. Idioma padrão (pt)
 * 
 * @return string Código do idioma (pt, en, es)
 */
function detectLanguage()
{
    // 1. Verifica parâmetro na URL (PRIORIDADE MÁXIMA - sempre verifica primeiro)
    // O router define $_GET['lang'] antes de incluir os arquivos, então isso deve ter prioridade
    if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGUAGES)) {
        $lang = $_GET['lang'];
        // Garante que a sessão está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Salva na sessão para próximas requisições
        $_SESSION['lang'] = $lang;
        // Salva em cookie por 1 semana
        if (function_exists('setLanguageCookie')) {
            setLanguageCookie($lang);
        }
        return $lang;
    }
    
    // 0. Detecta idioma a partir do path da URL (ex: /pt/projeto, /en/project, /es/proyecto)
    // Isso é útil quando o router define o idioma no path mas não no $_GET ainda
    if (isset($_SERVER['REQUEST_URI'])) {
        $requestUri = $_SERVER['REQUEST_URI'];
        // Remove query string para verificar apenas o path
        $pathOnly = parse_url($requestUri, PHP_URL_PATH);
        if ($pathOnly && preg_match('/^\/(pt|en|es)(?:\/|$)/', $pathOnly, $matches)) {
            $lang = $matches[1];
            if (in_array($lang, SUPPORTED_LANGUAGES)) {
                // Garante que a sessão está iniciada
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                // Salva na sessão e cookie
                $_SESSION['lang'] = $lang;
                if (function_exists('setLanguageCookie')) {
                    setLanguageCookie($lang);
                }
                // Também define no $_GET para consistência
                $_GET['lang'] = $lang;
                return $lang;
            }
        }
    }

    // 2. Verifica cookie (persiste por 1 semana)
    if (isset($_COOKIE['preferred_language']) && in_array($_COOKIE['preferred_language'], SUPPORTED_LANGUAGES)) {
        $lang = $_COOKIE['preferred_language'];
        // Sincroniza com sessão
        $_SESSION['lang'] = $lang;
        return $lang;
    }

    // 3. Verifica sessão (mas apenas se não houver parâmetro lang na URL)
    if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], SUPPORTED_LANGUAGES)) {
        // Se não há parâmetro na URL, usa o da sessão
        return $_SESSION['lang'];
    }

    // 4. Detecta idioma do navegador (apenas na primeira visita)
    // Só detecta se não há sessão definida ainda
    if (!isset($_SESSION['lang'])) {
        $browserLang = detectBrowserLanguage();
        if ($browserLang && in_array($browserLang, SUPPORTED_LANGUAGES)) {
            $_SESSION['lang'] = $browserLang;
            return $browserLang;
        }
    }

    // 5. Idioma padrão (português)
    // Sempre retorna português se nada foi definido
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = DEFAULT_LANGUAGE;
    }
    return DEFAULT_LANGUAGE;
}

/**
 * Detecta o idioma preferido do navegador
 * 
 * @return string|null Código do idioma ou null
 */
function detectBrowserLanguage()
{
    if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        return null;
    }

    $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

    // Parse do header Accept-Language
    // Formato: "pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7"
    preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/i', $acceptLanguage, $matches);

    if (empty($matches[1])) {
        return null;
    }

    // Extrai apenas o código principal (pt, en, es)
    foreach ($matches[1] as $lang) {
        $langCode = strtolower(substr($lang, 0, 2)); // Pega apenas os 2 primeiros caracteres

        // Se for um dos idiomas suportados, retorna
        if (in_array($langCode, SUPPORTED_LANGUAGES)) {
            return $langCode;
        }
    }

    // Se não encontrou nenhum idioma suportado, retorna null (usa padrão)
    return null;
}

/**
 * Define o idioma manualmente
 * 
 * @param string $lang Código do idioma (pt, en, es)
 */
function setLanguage($lang)
{
    if (in_array($lang, SUPPORTED_LANGUAGES)) {
        $_SESSION['lang'] = $lang;
        setLanguageCookie($lang);
    }
}

/**
 * Salva o idioma preferido em cookie por 1 semana
 * 
 * @param string $lang Código do idioma (pt, en, es)
 */
function setLanguageCookie($lang)
{
    // Cookie expira em 7 dias (1 semana)
    $expire = time() + (7 * 24 * 60 * 60);
    setcookie('preferred_language', $lang, $expire, '/', '', false, true);
}

/**
 * Obtém o idioma atual
 * 
 * @return string Código do idioma
 */
function getCurrentLanguage()
{
    return detectLanguage();
}

/**
 * Traduz uma chave de tradução
 * 
 * @param string $key Chave da tradução (ex: 'menu.home')
 * @param array $params Parâmetros para substituição (opcional)
 * @return string Texto traduzido
 */
function t($key, $params = [])
{
    global $translations;
    static $loadedLang = null;

    $lang = getCurrentLanguage();

    // Carrega traduções se ainda não foram carregadas OU se o idioma mudou
    if (!isset($translations) || $loadedLang !== $lang) {
        $translations = loadTranslations($lang);
        $loadedLang = $lang;
    }

    // Busca a tradução
    $keys = explode('.', $key);
    $value = $translations;

    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            // Se não encontrar, retorna a chave ou fallback para português
            if ($lang !== DEFAULT_LANGUAGE) {
                $fallbackTranslations = loadTranslations(DEFAULT_LANGUAGE);
                $fallbackValue = $fallbackTranslations;
                foreach ($keys as $fk) {
                    if (isset($fallbackValue[$fk])) {
                        $fallbackValue = $fallbackValue[$fk];
                    } else {
                        return $key; // Retorna a chave se não encontrar nem no fallback
                    }
                }
                $value = $fallbackValue;
            } else {
                return $key; // Retorna a chave se não encontrar
            }
            break;
        }
    }

    // Se for string, substitui parâmetros
    if (is_string($value) && !empty($params)) {
        foreach ($params as $paramKey => $paramValue) {
            $value = str_replace(':' . $paramKey, $paramValue, $value);
        }
    }

    // Retorna o valor encontrado (pode ser string ou array)
    // Se não encontrou e não é string nem array, retorna a chave
    if (is_string($value) || is_array($value)) {
        return $value;
    }
    
    return $key;
}

/**
 * Carrega as traduções de um idioma
 * 
 * @param string $lang Código do idioma
 * @return array Array de traduções
 */
function loadTranslations($lang)
{
    static $loadedTranslations = [];

    // Se já foi carregado, retorna do cache
    if (isset($loadedTranslations[$lang])) {
        return $loadedTranslations[$lang];
    }

    // Carrega do arquivo de traduções
    $translationsFile = __DIR__ . '/translations.php';
    if (file_exists($translationsFile)) {
        require_once $translationsFile;

        if (isset($allTranslations[$lang])) {
            $loadedTranslations[$lang] = $allTranslations[$lang];
            return $loadedTranslations[$lang];
        }
    }

    // Se não encontrar, retorna array vazio
    return [];
}

/**
 * Gera URL com idioma
 * 
 * @param string $path Caminho da página (ex: 'contato', 'orcamento')
 * @param string|null $lang Idioma (null = usa idioma atual)
 * @return string URL completa
 */
function url($path, $lang = null)
{
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }

    $baseUrl = getBaseUrl();

    // Mapeia nomes de páginas para URLs em diferentes idiomas
    $pathMap = [
        'pt' => [
            'contato' => 'contato',
            'orcamento' => 'orcamento',
            'sobre' => 'sobre',
            'projetos' => 'projetos',
            'projeto' => 'projeto',
            'contrato' => 'contrato',
            'proposta' => 'proposta',
            'politica-de-privacidade' => 'politica-de-privacidade',
            'sucesso' => 'sucesso',
            'index' => 'index',
            'home' => 'index'
        ],
        'en' => [
            'contato' => 'contact',
            'orcamento' => 'budget',
            'sobre' => 'about',
            'projetos' => 'projects',
            'projeto' => 'project',
            'contrato' => 'contract',
            'proposta' => 'proposal',
            'politica-de-privacidade' => 'privacy-policy',
            'sucesso' => 'success',
            'index' => 'home',
            'home' => 'home'
        ],
        'es' => [
            'contato' => 'contacto',
            'orcamento' => 'presupuesto',
            'sobre' => 'sobre',
            'projetos' => 'proyectos',
            'projeto' => 'proyecto',
            'contrato' => 'contrato',
            'proposta' => 'propuesta',
            'politica-de-privacidade' => 'politica-de-privacidad',
            'sucesso' => 'exito',
            'index' => 'inicio',
            'home' => 'inicio'
        ]
    ];

    // Para todos os idiomas, usa prefixo /pt/, /en/ ou /es/
    $mappedPath = $pathMap[$lang][$path] ?? $path;
    return $baseUrl . '/' . $lang . '/' . $mappedPath;
}

/**
 * Gera link alternativo (hreflang) para SEO
 * 
 * @param string $path Caminho da página
 * @return array Array com links alternativos
 */
function getAlternateLinks($path)
{
    $baseUrl = getBaseUrl();
    $alternates = [];

    // Mapeia nomes de páginas para URLs em diferentes idiomas
    $pathMap = [
        'pt' => [
            'contato' => 'contato',
            'orcamento' => 'orcamento',
            'sobre' => 'sobre',
            'projetos' => 'projetos',
            'projeto' => 'projeto',
            'contrato' => 'contrato',
            'proposta' => 'proposta',
            'politica-de-privacidade' => 'politica-de-privacidade',
            'sucesso' => 'sucesso',
            'index' => 'index',
            'home' => 'index'
        ],
        'en' => [
            'contato' => 'contact',
            'orcamento' => 'budget',
            'sobre' => 'about',
            'projetos' => 'projects',
            'projeto' => 'project',
            'contrato' => 'contract',
            'proposta' => 'proposal',
            'politica-de-privacidade' => 'privacy-policy',
            'sucesso' => 'success',
            'index' => 'home',
            'home' => 'home'
        ],
        'es' => [
            'contato' => 'contacto',
            'orcamento' => 'presupuesto',
            'sobre' => 'sobre',
            'projetos' => 'proyectos',
            'projeto' => 'proyecto',
            'contrato' => 'contrato',
            'proposta' => 'propuesta',
            'politica-de-privacidade' => 'politica-de-privacidad',
            'sucesso' => 'exito',
            'index' => 'inicio',
            'home' => 'inicio'
        ]
    ];

    foreach (SUPPORTED_LANGUAGES as $lang) {
        $mappedPath = $pathMap[$lang][$path] ?? $path;
        $alternates[$lang] = $baseUrl . '/' . $lang . '/' . $mappedPath;
    }

    return $alternates;
}
