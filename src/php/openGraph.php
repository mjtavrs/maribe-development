<?php

/**
 * Funções para gerar meta tags Open Graph
 * Usadas para compartilhamento em redes sociais (WhatsApp, Facebook, Twitter, etc.)
 */

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
    if (mb_strlen($text) > $maxLength) {
        $text = mb_substr($text, 0, $maxLength);
        $text = mb_substr($text, 0, mb_strrpos($text, ' ')) . '...';
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
    
    $text = mb_strtolower($text, 'UTF-8');
    
    // Remove acentos usando transliteração
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    
    // Substitui caracteres não alfanuméricos por hífen
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    
    // Remove hífens no início e fim
    $text = trim($text, '-');
    
    return $text;
}

