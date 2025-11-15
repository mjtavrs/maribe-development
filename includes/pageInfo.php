<?php

/**
 * Componente PageInfo (Hero Section)
 * 
 * Exibe o título e descrição da página de forma consistente
 * 
 * Uso:
 *   <?php
 *   $pageTitle = 'nossos projetos';
 *   $pageDescription = 'Aqui você encontra alguns dos nossos projetos...';
 *   include 'includes/pageInfo.php';
 *   ?>
 * 
 * Ou com múltiplos parágrafos:
 *   <?php
 *   $pageTitle = 'título';
 *   $pageDescription = [
 *       'Primeiro parágrafo',
 *       'Segundo parágrafo com <strong>formatação</strong>'
 *   ];
 *   include 'includes/pageInfo.php';
 *   ?>
 */

// Valores padrão
$pageTitle = $pageTitle ?? '';
$pageDescription = $pageDescription ?? '';
?>

<div id="pageInfo">
    <?php if (!empty($pageTitle)): ?>
        <h1 role="heading"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
    <?php endif; ?>

    <?php if (!empty($pageDescription)): ?>
        <?php if (is_array($pageDescription)): ?>
            <?php foreach ($pageDescription as $paragraph): ?>
                <?php
                // Se o parágrafo contém HTML, renderiza diretamente
                // Caso contrário, escapa para segurança
                if (strip_tags($paragraph) !== $paragraph) {
                    echo '<p>' . $paragraph . '</p>';
                } else {
                    echo '<p>' . htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8') . '</p>';
                }
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php
            // Se a descrição contém HTML (tags), renderiza como HTML
            // Caso contrário, escapa para segurança
            if (strip_tags($pageDescription) !== $pageDescription) {
                echo '<p>' . $pageDescription . '</p>';
            } else {
                echo '<p>' . htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') . '</p>';
            }
            ?>
        <?php endif; ?>
    <?php endif; ?>
</div>