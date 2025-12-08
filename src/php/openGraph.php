<?php

/**
 * Funções para gerar meta tags Open Graph
 * Usadas para compartilhamento em redes sociais (WhatsApp, Facebook, Twitter, etc.)
 */

/**
 * Verifica se a extensão mbstring está disponível
 */
function hasMbstring() {
    return extension_loaded('mbstring') && function_exists('mb_strlen');
}

/**
 * Helper para mb_strlen com fallback para strlen
 */
function safe_strlen($str, $encoding = 'UTF-8') {
    if (hasMbstring()) {
        return mb_strlen($str, $encoding);
    }
    return strlen($str);
}

/**
 * Helper para mb_substr com fallback para substr
 */
function safe_substr($str, $start, $length = null, $encoding = 'UTF-8') {
    if (hasMbstring()) {
        return $length !== null ? mb_substr($str, $start, $length, $encoding) : mb_substr($str, $start, null, $encoding);
    }
    return $length !== null ? substr($str, $start, $length) : substr($str, $start);
}

/**
 * Helper para mb_strrpos com fallback para strrpos
 */
function safe_strrpos($haystack, $needle, $offset = 0, $encoding = 'UTF-8') {
    if (hasMbstring()) {
        return mb_strrpos($haystack, $needle, $offset, $encoding);
    }
    return strrpos($haystack, $needle, $offset);
}

/**
 * Helper para mb_strtolower com fallback para strtolower
 */
function safe_strtolower($str, $encoding = 'UTF-8') {
    if (hasMbstring()) {
        return mb_strtolower($str, $encoding);
    }
    return strtolower($str);
}

/**
 * Normaliza um caminho de asset para URL absoluta
 */
function getAbsoluteImageUrl($path) {
    if (empty($path)) {
        return '';
    }
    
    // Se já começa com http, retorna como está
    if (preg_match('/^https?:\/\//', $path)) {
        return $path;
    }
    
    // Remove barra inicial se houver
    $path = ltrim($path, '/');
    
    // Constrói URL completa
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    
    return $protocol . $host . '/' . $path;
}

/**
 * Normaliza um texto removendo HTML e limitando tamanho
 */
function cleanDescription($text, $maxLength = 200) {
    if (empty($text)) {
        return '';
    }
    
    // Remove HTML tags
    $text = strip_tags($text);
    
    // Remove quebras de linha excessivas
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    
    // Limita tamanho
    if (safe_strlen($text) > $maxLength) {
        $text = safe_substr($text, 0, $maxLength);
        $lastSpace = safe_strrpos($text, ' ');
        if ($lastSpace !== false) {
            $text = safe_substr($text, 0, $lastSpace) . '...';
        } else {
            $text = safe_substr($text, 0, $maxLength) . '...';
        }
    }
    
    return $text;
}

/**
 * Gera meta tags Open Graph genéricas para o site
 */
function generateOpenGraphTags($title = '', $description = '', $image = '', $url = '', $type = 'website') {
    // Se não foi fornecida URL, usa a URL atual
    if (empty($url)) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $url = $protocol . $host . $path;
    }
    
    // Se não foi fornecida imagem, usa a logo padrão
    if (empty($image)) {
        $image = getAbsoluteImageUrl('assets/images/public/logo_home.webp');
    } else {
        $image = getAbsoluteImageUrl($image);
    }
    
    // Título padrão
    if (empty($title)) {
        $title = 'maribe arquitetura';
    }
    
    // Descrição padrão
    if (empty($description)) {
        $description = 'Maribe Arquitetura é um escritório de arquitetura e urbanismo baseado em Recife, Pernambuco, com foco em arquitetura residencial, comercial e consultorias.';
    } else {
        $description = cleanDescription($description, 200);
    }
    
    $html = '';
    
    // Open Graph Tags
    $html .= '<meta property="og:type" content="' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta property="og:title" content="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta property="og:description" content="' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta property="og:image" content="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta property="og:url" content="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta property="og:site_name" content="maribe arquitetura">' . "\n";
    $html .= '<meta property="og:locale" content="pt_BR">' . "\n";
    
    // Twitter Card Tags
    $html .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    $html .= '<meta name="twitter:title" content="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta name="twitter:description" content="' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    $html .= '<meta name="twitter:image" content="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '">' . "\n";
    
    return $html;
}

/**
 * Obtém dados do projeto baseado no slug ou ID
 * Lê o arquivo JavaScript e extrai os dados necessários usando regex mais robusto
 * Retorna array com dados do projeto ou null se não encontrado
 */
function getProjectData($slug = null, $id = null) {
    if (!$slug && !$id) {
        return null;
    }
    
    // Caminho para o arquivo JS de projetos
    $jsFile = __DIR__ . '/../js/projectsData.js';
    
    if (!file_exists($jsFile)) {
        return null;
    }
    
    // Lê o conteúdo do arquivo
    $content = file_get_contents($jsFile);
    
    if (!$content) {
        return null;
    }
    
    // Procura cada projeto individualmente usando regex mais flexível
    // Pattern para encontrar cada objeto de projeto
    $projectPattern = '/\{\s*id:\s*(\d+)\s*,\s*cover:\s*"([^"]+)"\s*,\s*titulo:\s*"([^"]+)"\s*,\s*descricao:\s*\{\s*pt:\s*"([^"]+(?:\\.[^"]*)*)"\s*,\s*en:\s*"([^"]+(?:\\.[^"]*)*)"\s*,\s*es:\s*"([^"]+(?:\\.[^"]*)*)"\s*\}/s';
    
    if (preg_match_all($projectPattern, $content, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $projectId = (int)trim($match[1]);
            $cover = str_replace('\\"', '"', trim($match[2]));
            $titulo = str_replace('\\"', '"', trim($match[3]));
            $descPt = str_replace(['\\"', '\\n'], ['"', ' '], trim($match[4]));
            $descEn = str_replace(['\\"', '\\n'], ['"', ' '], trim($match[5]));
            $descEs = str_replace(['\\"', '\\n'], ['"', ' '], trim($match[6]));
            
            // Verifica se é o projeto procurado
            $found = false;
            if ($id && $projectId == $id) {
                $found = true;
            } elseif ($slug && slugify($titulo) === $slug) {
                $found = true;
            }
            
            if ($found) {
                return [
                    'id' => $projectId,
                    'titulo' => $titulo,
                    'cover' => $cover,
                    'descricao' => [
                        'pt' => $descPt,
                        'en' => $descEn,
                        'es' => $descEs
                    ]
                ];
            }
        }
    }
    
    // Fallback: tenta parsear de forma mais simples
    // Procura por id, cover e titulo em qualquer ordem
    $simplePattern = '/id:\s*(\d+).*?cover:\s*"([^"]+)".*?titulo:\s*"([^"]+)"/s';
    if (preg_match_all($simplePattern, $content, $simpleMatches, PREG_SET_ORDER)) {
        foreach ($simpleMatches as $match) {
            $projectId = (int)trim($match[1]);
            $cover = trim($match[2]);
            $titulo = trim($match[3]);
            
            $found = false;
            if ($id && $projectId == $id) {
                $found = true;
            } elseif ($slug && slugify($titulo) === $slug) {
                $found = true;
            }
            
            if ($found) {
                // Busca descrição separadamente
                $descPattern = '/id:\s*' . preg_quote($projectId, '/') . '.*?descricao:\s*\{.*?pt:\s*"([^"]+(?:\\.[^"]*)*)"/s';
                $descPt = '';
                if (preg_match($descPattern, $content, $descMatch)) {
                    $descPt = str_replace(['\\"', '\\n'], ['"', ' '], trim($descMatch[1]));
                }
                
                return [
                    'id' => $projectId,
                    'titulo' => $titulo,
                    'cover' => $cover,
                    'descricao' => [
                        'pt' => $descPt ?: 'Projeto de arquitetura da Maribe Arquitetura',
                        'en' => $descPt ?: 'Architecture project by Maribe Arquitetura',
                        'es' => $descPt ?: 'Proyecto de arquitectura de Maribe Arquitetura'
                    ]
                ];
            }
        }
    }
    
    return null;
}

/**
 * Função helper para slugify (igual ao JavaScript)
 */
function slugify($text) {
    if (empty($text)) {
        return '';
    }
    
    $text = safe_strtolower($text, 'UTF-8');
    
    // Remove acentos usando transliteração
    if (function_exists('iconv')) {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    } else {
        // Fallback básico para remover acentos se iconv não estiver disponível
        $text = strtr($text, [
            'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c', 'ñ' => 'n',
            'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A', 'Ä' => 'A',
            'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ó' => 'O', 'Ò' => 'O', 'Õ' => 'O', 'Ô' => 'O', 'Ö' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'Ç' => 'C', 'Ñ' => 'N'
        ]);
    }
    
    // Substitui caracteres não alfanuméricos por hífen
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    
    // Remove hífens no início e fim
    $text = trim($text, '-');
    
    return $text;
}

/**
 * Gera URL canônica para a página atual
 * 
 * @param string|null $lang Idioma (null = usa idioma atual)
 * @param string|null $path Caminho da página (null = detecta automaticamente)
 * @return string URL canônica
 */
function getCanonicalUrl($lang = null, $path = null) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    
    if ($path === null) {
        // Detecta o path atual
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH);
    }
    
    if ($lang === null) {
        $lang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';
    }
    
    // Se o path já contém o idioma, usa como está
    if (preg_match('/^\/(pt|en|es)\//', $path)) {
        return $protocol . $host . $path;
    }
    
    // Se não tem idioma no path, adiciona
    $path = ltrim($path, '/');
    if (empty($path)) {
        return $protocol . $host . '/' . $lang . '/';
    }
    
    return $protocol . $host . '/' . $lang . '/' . $path;
}

/**
 * Gera meta tag canonical
 * 
 * @param string|null $url URL canônica (null = gera automaticamente)
 * @return string HTML da meta tag canonical
 */
function generateCanonicalTag($url = null) {
    if ($url === null) {
        $url = getCanonicalUrl();
    }
    
    return '<link rel="canonical" href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">' . "\n";
}

/**
 * Gera Schema.org JSON-LD para LocalBusiness
 * 
 * @param string $lang Idioma (pt, en, es)
 * @return string JSON-LD script tag
 */
function generateLocalBusinessSchema($lang = 'pt') {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    $baseUrl = $protocol . $host;
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ArchitecturalService',
        'name' => 'maribe arquitetura',
        'alternateName' => 'Maribe Arquitetura',
        'url' => $baseUrl,
        'logo' => $baseUrl . '/assets/images/public/logo_horizontal_estendido.webp',
        'image' => $baseUrl . '/assets/images/public/logo_home.webp',
        'description' => $lang === 'pt' 
            ? 'Escritório de arquitetura e urbanismo baseado em Recife, Pernambuco, com foco em arquitetura residencial, comercial e consultorias.'
            : ($lang === 'en' 
                ? 'Architecture and urban planning firm based in Recife, Pernambuco, focused on residential architecture, commercial architecture, and consulting.'
                : 'Estudio de arquitectura y urbanismo con sede en Recife, Pernambuco, enfocado en arquitectura residencial, arquitectura comercial y consultorías.'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Recife',
            'addressRegion' => 'PE',
            'addressCountry' => 'BR'
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Recife'
        ],
        'sameAs' => [
            'https://www.instagram.com/maribe.arquitetura',
            'https://web.facebook.com/people/Maribe-Arquitetura/100089975852864/',
            'https://www.tiktok.com/@maribe.arquitetura',
            'https://br.pinterest.com/maribearquitetura/',
            'https://www.linkedin.com/company/maribearquitetura/'
        ]
    ];
    
    return '<script type="application/ld+json">' . "\n" . 
           json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n" . 
           '</script>' . "\n";
}

/**
 * Gera Schema.org JSON-LD para WebSite
 * 
 * @param string $lang Idioma (pt, en, es)
 * @return string JSON-LD script tag
 */
function generateWebSiteSchema($lang = 'pt') {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    $baseUrl = $protocol . $host;
    
    // Mapeia rotas de busca por idioma
    $searchActionUrl = [
        'pt' => $baseUrl . '/pt/projetos?search={search_term_string}',
        'en' => $baseUrl . '/en/projects?search={search_term_string}',
        'es' => $baseUrl . '/es/proyectos?search={search_term_string}'
    ];
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'maribe arquitetura',
        'url' => $baseUrl,
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => $searchActionUrl[$lang] ?? $searchActionUrl['pt']
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ];
    
    return '<script type="application/ld+json">' . "\n" . 
           json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n" . 
           '</script>' . "\n";
}

/**
 * Gera Schema.org JSON-LD para BreadcrumbList
 * 
 * @param array $breadcrumbs Array de breadcrumbs [['name' => 'Nome', 'url' => 'url']]
 * @return string JSON-LD script tag
 */
function generateBreadcrumbSchema($breadcrumbs) {
    if (empty($breadcrumbs) || !is_array($breadcrumbs)) {
        return '';
    }
    
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    $baseUrl = $protocol . $host;
    
    $items = [];
    $position = 1;
    
    foreach ($breadcrumbs as $crumb) {
        $url = $crumb['url'];
        // Se a URL é relativa, torna absoluta
        if (!preg_match('/^https?:\/\//', $url)) {
            $url = $baseUrl . '/' . ltrim($url, '/');
        }
        
        $items[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $crumb['name'],
            'item' => $url
        ];
        $position++;
    }
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items
    ];
    
    return '<script type="application/ld+json">' . "\n" . 
           json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n" . 
           '</script>' . "\n";
}

/**
 * Gera Schema.org JSON-LD para Article (projetos)
 * 
 * @param array $project Dados do projeto
 * @param string $lang Idioma (pt, en, es)
 * @return string JSON-LD script tag
 */
function generateArticleSchema($project, $lang = 'pt') {
    if (empty($project) || !is_array($project)) {
        return '';
    }
    
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'maribe.arq.br';
    $baseUrl = $protocol . $host;
    
    $projectTitle = $project['titulo'] ?? '';
    $projectDesc = isset($project['descricao'][$lang]) 
        ? $project['descricao'][$lang] 
        : ($project['descricao']['pt'] ?? '');
    $projectImage = getAbsoluteImageUrl($project['cover'] ?? '');
    $projectUrl = $baseUrl . $_SERVER['REQUEST_URI'];
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $projectTitle,
        'description' => $projectDesc,
        'image' => $projectImage,
        'url' => $projectUrl,
        'author' => [
            '@type' => 'Organization',
            'name' => 'maribe arquitetura',
            'url' => $baseUrl
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'maribe arquitetura',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $baseUrl . '/assets/images/public/logo_horizontal_estendido.webp'
            ]
        ],
        'datePublished' => isset($project['ano']) ? $project['ano'] . '-01-01' : date('Y-m-d'),
        'inLanguage' => $lang === 'pt' ? 'pt-BR' : ($lang === 'en' ? 'en-US' : 'es-ES')
    ];
    
    return '<script type="application/ld+json">' . "\n" . 
           json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . "\n" . 
           '</script>' . "\n";
}

