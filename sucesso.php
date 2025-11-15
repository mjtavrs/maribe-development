<?php
// Define a página atual para o header (sucesso não aparece no menu, mas definimos para consistência)
$currentPage = 'sucesso';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />

    <title>mensagem enviada • maribe arquitetura</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="styles/shared/variables.css" />
    <link rel="stylesheet" href="styles/shared/base.css" />
    <link rel="stylesheet" href="styles/shared/animations.css" />
    <link rel="stylesheet" href="styles/shared/components.css" />
    <link rel="stylesheet" href="styles/pages/404/404.css" />

    <!-- Scripts -->
</head>

<body>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main>
            <div>
                <i class="ph-fill ph-seal-check"></i>
                <div id="notFoundText">
                    <h1>
                        agradecemos o seu contato!
                    </h1>
                    <p>
                        Sua mensagem foi enviada e nos iremos respondê-la o mais breve possível. Enquanto isso, <a href="projetos.php">clique aqui</a> para ver alguns dos nossos projetos.
                    </p>
                </div>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>