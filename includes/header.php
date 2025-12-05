<?php

/**
 * Header Component
 * 
 * @param string $currentPage - Página atual ('home', 'sobre', 'projetos', 'orcamento', 'contato')
 *                              Se não fornecido, tenta identificar pelo nome do arquivo
 */

// Detecta idioma atual (se i18n estiver disponível)
$currentLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : 'pt';

// Define a página atual se não foi fornecida
if (!isset($currentPage)) {
    // Tenta identificar a página atual pelo nome do arquivo
    $scriptName = basename($_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? 'index.php');
    $pageMap = [
        'index.php' => 'home',
        'sobre.php' => 'sobre',
        'projetos.php' => 'projetos',
        'orcamento.php' => 'orcamento',
        'contato.php' => 'contato',
        'contrato.php' => 'contrato',
        'proposta.php' => 'proposta',
        'politica-de-privacidade.php' => 'politica',
        'sucesso.php' => 'sucesso'
    ];
    $currentPage = $pageMap[$scriptName] ?? 'home';
}

// Mapeia páginas internas para nomes de rotas
$pageRouteMap = [
    'home' => 'index',
    'sobre' => 'sobre',
    'projetos' => 'projetos',
    'projeto' => 'projeto',
    'orcamento' => 'orcamento',
    'contato' => 'contato',
    'contrato' => 'contrato',
    'proposta' => 'proposta',
    'sucesso' => 'sucesso',
    'politica' => 'politica-de-privacidade',
    '404' => '404'
];

// Define quais páginas devem ter o menu destacado
$menuItems = [
    'sobre' => [
        'url' => function_exists('url') ? url($pageRouteMap['sobre'], $currentLang) : 'sobre.php',
        'label' => function_exists('t') ? t('menu.about') : 'sobre'
    ],
    'projetos' => [
        'url' => function_exists('url') ? url($pageRouteMap['projetos'], $currentLang) : 'projetos.php',
        'label' => function_exists('t') ? t('menu.projects') : 'projetos'
    ],
    'orcamento' => [
        'url' => function_exists('url') ? url($pageRouteMap['orcamento'], $currentLang) : 'orcamento.php',
        'label' => function_exists('t') ? t('menu.budget') : 'orçamento'
    ],
    'contato' => [
        'url' => function_exists('url') ? url($pageRouteMap['contato'], $currentLang) : 'contato.php',
        'label' => function_exists('t') ? t('menu.contact') : 'contato'
    ]
];
?>

<!-- Header -->
<header<?php echo (isset($headerId) && !empty($headerId)) ? ' id="' . htmlspecialchars($headerId, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
    <?php if (function_exists('getCurrentLanguage') && function_exists('url')): ?>
        <?php
        // Mapeia página atual para rota
        $currentRoute = $pageRouteMap[$currentPage] ?? 'index';
        
        // Se estiver na página de projeto, preserva os parâmetros da query string
        $queryParams = [];
        if ($currentPage === 'projeto' || (isset($_GET['name']) || isset($_GET['id']))) {
            // Preserva parâmetros do projeto (name ou id)
            if (isset($_GET['name'])) {
                $queryParams['name'] = $_GET['name'];
            }
            if (isset($_GET['id'])) {
                $queryParams['id'] = $_GET['id'];
            }
            // Garante que a rota seja 'projeto' se houver parâmetros
            if (!empty($queryParams)) {
                $currentRoute = 'projeto';
            }
        }
        
        // Constrói query string se houver parâmetros
        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';

        // Nomes dos idiomas
        $languageNames = [
            'pt' => 'português',
            'en' => 'english',
            'es' => 'español'
        ];
        ?>
        <!-- Seletor de Idioma - Desktop (Topo Direito) -->
        <div id="languageSelectorContainer" class="language-selector-desktop">
            <div id="languageSelector" class="language-dropdown">
                <button id="languageButton" class="language-button" aria-label="<?php echo htmlspecialchars(function_exists('t') ? t('menu.selectLanguage') : 'Selecionar idioma', ENT_QUOTES, 'UTF-8'); ?>" aria-expanded="false">
                    <span class="language-current"><?php echo htmlspecialchars($languageNames[$currentLang], ENT_QUOTES, 'UTF-8'); ?></span>
                    <i class="ph ph-caret-down language-arrow"></i>
                </button>
                <ul id="languageDropdown" class="language-dropdown-menu" role="menu">
                    <?php if ($currentLang !== 'pt'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'pt') . $queryString; ?>" class="language-option">
                                português
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($currentLang !== 'en'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'en') . $queryString; ?>" class="language-option">
                                english
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($currentLang !== 'es'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'es') . $queryString; ?>" class="language-option">
                                español
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Topo: Logo + Botão Hambúrguer -->
    <div id="headerTop">
        <a href="<?php echo function_exists('url') ? url('index', $currentLang) : '/'; ?>" id="indexReferrer">
            <img src="/assets/images/public/logos/logo_horizontal_com_assinatura.webp" class="logo-mobile" title="Logo da Maribe Arquitetura" alt="Logo da Maribe Arquitetura">
            <img src="/assets/images/public/logo_menu.webp" class="logo-desktop" title="Logo da Maribe Arquitetura" alt="Logo da Maribe Arquitetura">
        </a>
        <button id="mobileMenuToggle" class="mobile-menu-toggle" aria-label="<?php echo htmlspecialchars(function_exists('t') ? t('menu.openMenu') : 'Abrir menu de navegação', ENT_QUOTES, 'UTF-8'); ?>" aria-expanded="false">
            <i class="ph ph-bold ph-list"></i>
        </button>
    </div>

    <!-- Menu de Navegação -->
    <nav id="mainNav">
        <!-- Título de Navegação -->
        <h3 class="menu-section-title"><?php echo htmlspecialchars(function_exists('t') ? t('menu.navigation') : 'Navegação', ENT_QUOTES, 'UTF-8'); ?></h3>
        
        <!-- Links de Navegação (primeiro) -->
        <ul>
            <?php foreach ($menuItems as $pageKey => $item): ?>
                <li <?php echo ($currentPage === $pageKey) ? 'id="selected"' : ''; ?>>
                    <a href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <?php if (function_exists('getCurrentLanguage') && function_exists('url')): ?>
            <!-- Separator -->
            <div class="menu-separator"></div>
            
            <!-- Título do Seletor de Idioma -->
            <h3 class="language-selector-title"><?php echo htmlspecialchars(function_exists('t') ? t('menu.selectLanguage') : 'Selecionar idioma', ENT_QUOTES, 'UTF-8'); ?></h3>
            
            <!-- Seletor de Idioma - Mobile (dentro do menu) -->
            <div id="languageSelectorContainer" class="language-selector-mobile">
                <div class="language-dropdown">
                    <button class="language-button language-button-mobile" aria-label="<?php echo htmlspecialchars(function_exists('t') ? t('menu.selectLanguage') : 'Selecionar idioma', ENT_QUOTES, 'UTF-8'); ?>" aria-expanded="false">
                        <span class="language-current"><?php echo htmlspecialchars($languageNames[$currentLang], ENT_QUOTES, 'UTF-8'); ?></span>
                        <i class="ph ph-caret-down language-arrow"></i>
                    </button>
                    <ul class="language-dropdown-menu language-dropdown-menu-mobile" role="menu">
                        <?php if ($currentLang !== 'pt'): ?>
                            <li role="menuitem">
                                <a href="<?php echo url($currentRoute, 'pt') . $queryString; ?>" class="language-option">
                                    português
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($currentLang !== 'en'): ?>
                            <li role="menuitem">
                                <a href="<?php echo url($currentRoute, 'en') . $queryString; ?>" class="language-option">
                                    english
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($currentLang !== 'es'): ?>
                            <li role="menuitem">
                                <a href="<?php echo url($currentRoute, 'es') . $queryString; ?>" class="language-option">
                                    español
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </nav>
    <script src="/src/js/mobileMenu.js"></script>
</header>