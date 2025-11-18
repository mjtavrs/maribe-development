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
    'orcamento' => 'orcamento',
    'contato' => 'contato'
];

// Define quais páginas devem ter o menu destacado
$menuItems = [
    'home' => [
        'url' => function_exists('url') ? url($pageRouteMap['home'], $currentLang) : 'index.php',
        'label' => function_exists('t') ? t('menu.home') : 'início'
    ],
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
<header>
    <!-- Seletor de Idioma (Topo Direito) -->
    <?php if (function_exists('getCurrentLanguage') && function_exists('url')): ?>
        <?php
        // Mapeia página atual para rota
        $currentRoute = $pageRouteMap[$currentPage] ?? 'index';

        // Nomes dos idiomas
        $languageNames = [
            'pt' => 'português',
            'en' => 'english',
            'es' => 'español'
        ];
        ?>
        <div id="languageSelectorContainer">
            <div id="languageSelector" class="language-dropdown">
                <button id="languageButton" class="language-button" aria-label="Selecionar idioma" aria-expanded="false">
                    <span class="language-current"><?php echo htmlspecialchars($languageNames[$currentLang], ENT_QUOTES, 'UTF-8'); ?></span>
                    <i class="ph ph-caret-down language-arrow"></i>
                </button>
                <ul id="languageDropdown" class="language-dropdown-menu" role="menu">
                    <?php if ($currentLang !== 'pt'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'pt'); ?>" class="language-option">
                                português
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($currentLang !== 'en'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'en'); ?>" class="language-option">
                                english
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($currentLang !== 'es'): ?>
                        <li role="menuitem">
                            <a href="<?php echo url($currentRoute, 'es'); ?>" class="language-option">
                                español
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <a href="<?php echo function_exists('url') ? url('index', $currentLang) : 'index.php'; ?>" id="indexReferrer">
        <img src="/assets/images/public/logo_menu.webp" title="Logo da Maribe Arquitetura" alt="Logo da Maribe Arquitetura">
    </a>
    <div>
        <nav>
            <ul>
                <?php foreach ($menuItems as $pageKey => $item): ?>
                    <li <?php echo ($currentPage === $pageKey) ? 'id="selected"' : ''; ?>>
                        <a href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <!-- Botões de teste para Toast (apenas em desenvolvimento) -->
        <div id="toastTestButtons" style="display: flex; gap: 10px; margin-top: 10px; justify-content: center;">
            <button id="testToastSuccess" style="background: #4caf50; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 0.875rem;">
                <?php echo function_exists('t') ? htmlspecialchars(t('toast.test.success'), ENT_QUOTES, 'UTF-8') : 'Testar Toast Sucesso'; ?>
            </button>
            <button id="testToastError" style="background: #f44336; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-size: 0.875rem;">
                <?php echo function_exists('t') ? htmlspecialchars(t('toast.test.error'), ENT_QUOTES, 'UTF-8') : 'Testar Toast Erro'; ?>
            </button>
        </div>
    </div>
</header>