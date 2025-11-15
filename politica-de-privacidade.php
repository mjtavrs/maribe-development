<?php
// Define a página atual para o header (politica não aparece no menu, mas definimos para consistência)
$currentPage = 'politica';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/light/style.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />

    <!-- SEO Meta Tags -->
    <meta name="author" content="Marcos Tavares" />

    <title>política de privacidade • maribe arquitetura</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="styles/shared/variables.css" />
    <link rel="stylesheet" href="styles/shared/base.css" />
    <link rel="stylesheet" href="styles/shared/animations.css" />
    <link rel="stylesheet" href="styles/shared/components.css" />
    <link rel="stylesheet" href="styles/pages/privacyPolicies/privacyPolicies.css" />

    <!-- Scripts -->
    <script src="./src/js/cookiePopup.js"></script>
</head>

<body>
    <?php include 'includes/cookiePopup.php'; ?>
    <div id="smoothOpening">
        <?php include 'includes/header.php'; ?>
        <main role="main">
            <?php
            $pageTitle = 'política de privacidade';
            $pageDescription = 'Nós valorizamos a confiança que você deposita em nós e estamos comprometidos em proteger sua privacidade e seus dados pessoais. Esta Política de Privacidade descreve como coletamos, usamos e protegemos suas informações enquanto você navega pelo nosso site.';
            include 'includes/pageInfo.php';
            ?>
            <div id="policies">
                <span>
                    Última atualização: 03 de outubro de 2024
                </span>
                <section class="policy">
                    <h2>
                        Coleta de Informações
                    </h2>
                    <div class="policyInfo">
                        <p>
                            A Maribe Arquitetura coleta dados de navegação por meio de cookies, que são pequenos arquivos de texto armazenados no seu dispositivo para melhorar sua experiência no site. Essas informações incluem seu endereço de IP, o navegador utilizado e as páginas visitadas. Elas nos ajudam a entender como o site está sendo usado e a personalizar sua navegação, tornando-a mais eficiente e segura.
                        </p>
                        <p>
                            Você pode optar por desativar os cookies a qualquer momento através das configurações do seu navegador, porém, isso pode afetar o desempenho e algumas funcionalidades do nosso site.
                        </p>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Uso das Informações
                    </h2>
                    <div class="policyInfo">
                        <p>
                            As informações coletadas são utilizadas para:
                        </p>
                        <ul>
                            <li>
                                Melhorar a usabilidade e experiência do usuário em nosso site;
                            </li>
                            <li>
                                Garantir a segurança e o bom funcionamento da plataforma;
                            </li>
                            <li>
                                Monitorar e analisar o tráfego do site para otimizar nossos serviços;
                            </li>
                            <li>
                                Cumprir obrigações legais e proteger a Maribe Arquitetura em caso de atividade maliciosa.
                            </li>
                        </ul>
                        <span>
                            Nós não compartilhamos suas informações pessoais com terceiros, exceto em casos obrigatórios por lei ou para proteção de nossos direitos.
                        </span>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Segurança dos Dados
                    </h2>
                    <div class="policyInfo">
                        <p>
                            A proteção dos seus dados é uma prioridade para a Maribe Arquitetura. Implementamos medidas de segurança apropriadas para garantir que suas informações estejam seguras e protegidas contra acessos não autorizados, alteração, divulgação ou destruição.
                        </p>
                        <p>
                            O acesso aos dados pessoais fornecidos é restrito a funcionários autorizados e todos eles estão comprometidos em manter a confidencialidade dessas informações.
                        </p>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Links para Sites Externos
                    </h2>
                    <div class="policyInfo">
                        <p>
                            Nosso site pode conter links para sites externos que não são operados por nós. Esses links são disponibilizados para sua conveniência, mas não temos controle sobre o conteúdo ou as práticas de privacidade desses sites. Recomendamos que você leia as políticas de privacidade de qualquer site externo que visitar, já que não nos responsabilizamos por eventuais danos ou perdas decorrentes do uso desses links.
                        </p>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Responsabilidade e Crimes Digitais
                    </h2>
                    <div class="policyInfo">
                        <p>
                            A Maribe Arquitetura reserva-se o direito de monitorar e registrar atividades suspeitas que possam indicar o cometimento de crimes digitais, como fraudes, invasões e outros atos ilícitos. Em caso de atividades ilegais, poderemos compartilhar informações com as autoridades competentes para a devida investigação.
                        </p>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Propriedade Intelectual
                    </h2>
                    <div class="policyInfo">
                        <p>
                            Todo o conteúdo do nosso site, incluindo textos, imagens, gráficos e outros materiais, é protegido por leis de propriedade intelectual. O uso não autorizado de qualquer parte deste conteúdo pode resultar em ação legal. A reprodução de qualquer material sem autorização prévia é expressamente proibida.
                        </p>
                    </div>
                </section>
                <section class="policy">
                    <h2>
                        Alterações nesta Política
                    </h2>
                    <div class="policyInfo">
                        <p>
                            A Maribe Arquitetura pode atualizar esta Política de Privacidade periodicamente, de modo a refletir melhorias no nosso site ou mudanças nas regulamentações aplicáveis. Sempre que houver modificações significativas, você será informado através do nosso site ou de outros canais de comunicação.
                        </p>
                    </div>
                </section>
            </div>
            <div id="separatorBox">
                <div id="separator">
                </div>
            </div>
            <div id="contactInformationIfDoubt">
                <h2>
                    Ficou alguma dúvida?
                </h2>
                <p>
                    Você sempre pode nos enviar um e-mail a partir da nossa <a href="contato.php">página de contato</a> e ficaremos felizes em responder o mais breve possível.
                    <!-- Se preferir, pode enviar uma mensagem no nosso WhatsApp clicando <a href="https://api.whatsapp.com/send?phone=5581994083257" target="_blank">aqui</a> para começar uma conversa. -->
                </p>
            </div>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>