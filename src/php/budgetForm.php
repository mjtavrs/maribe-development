<?php

require_once __DIR__ . '/functions.php';

$erros = [];
$errosPorCampo = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação CSRF
    if (empty($_POST["csrf_token"]) || !validateCSRFToken($_POST["csrf_token"])) {
        $erros[] = 'Token de segurança inválido. Por favor, recarregue a página e tente novamente.';
        redirectWithStatus('error', $erros);
    }

    // Validação e sanitização do nome
    if (empty($_POST["name"])) {
        $errosPorCampo["name"] = "Por favor, digite seu nome.";
    } else {
        $nome = sanitizeForEmail($_POST["name"]);

        if (strlen(trim($_POST["name"])) < 2) {
            $errosPorCampo["name"] = "O nome deve ter pelo menos 2 caracteres.";
        }
    }

    // Validação e sanitização do email
    if (empty($_POST["email"])) {
        $errosPorCampo["email"] = "Por favor, digite seu e-mail.";
    } elseif (!validateEmail($_POST["email"])) {
        $errosPorCampo["email"] = "Formato de e-mail inválido.";
    } else {
        $email = sanitizeInput($_POST["email"]);
    }

    // Validação e sanitização do telefone
    $telefone = '';
    $telefoneFormatado = '';
    if (!empty($_POST["phone"])) {
        if (!validatePhone($_POST["phone"])) {
            $errosPorCampo["phone"] = "Formato de telefone inválido. Por favor, insira um número de telefone válido.";
        } else {
            // Verifica se começa com "+" (formato internacional do autocomplete)
            $hasPlusSign = strpos(trim($_POST["phone"]), '+') === 0;
            
            $telefone = preg_replace('/\D/', '', $_POST["phone"]);
            
            // Remove código do país do Brasil (55) se presente no início
            // Isso corrige o problema do autocomplete do navegador
            // Regras:
            // 1. Se começa com "+55" (formato internacional), remove "+55"
            // 2. Se tem mais de 11 dígitos e começa com "55", remove "55"
            // 3. Se tem exatamente 10-11 dígitos, mantém (pode ser DDD 55 válido)
            if ($hasPlusSign && substr($telefone, 0, 2) === '55') {
                // Formato internacional: +55...
                $telefone = substr($telefone, 2);
            } else if (strlen($telefone) > 11 && substr($telefone, 0, 2) === '55') {
                // Mais de 11 dígitos começando com 55 = código do país
                $telefone = substr($telefone, 2);
            }
            // Se tem 10-11 dígitos e começa com 55, mantém (pode ser DDD 55)
            
            $telefoneFormatado = sanitizeForEmail($_POST["phone"]);
        }
    }

    // Validação de como chegou até nós
    if (empty($_POST["howYouFoundUs"])) {
        $errosPorCampo["howYouFoundUs"] = "Por favor, selecione de onde você veio.";
    } else {
        $de_onde_veio = sanitizeForEmail($_POST["howYouFoundUs"]);
    }

    // Validação do que será projetado
    if (empty($_POST["whatAreWeWorkingOn"])) {
        $errosPorCampo["whatAreWeWorkingOn"] = "Por favor, selecione o que será projetado.";
    } else {
        $o_que_projetar = sanitizeForEmail($_POST["whatAreWeWorkingOn"]);
    }

    // Validação de quando iniciar o projeto
    if (empty($_POST["whenToBeginTheProject"])) {
        $errosPorCampo["whenToBeginTheProject"] = "Por favor, indique quando pretende iniciar o projeto.";
    } else {
        $quando_comecar_projeto = sanitizeForEmail($_POST["whenToBeginTheProject"]);
    }

    // Validação do objetivo
    if (empty($_POST["objective"])) {
        $errosPorCampo["objective"] = "Por favor, descreva o objetivo do projeto.";
    } else {
        $objetivo = sanitizeForEmail($_POST["objective"]);

        if (strlen(trim($_POST["objective"])) < 10) {
            $errosPorCampo["objective"] = "O objetivo deve ter pelo menos 10 caracteres.";
        }
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($errosPorCampo)) {
        redirectWithStatus('error', $erros, $errosPorCampo);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Novo pedido inicial de orçamento";

    $mensagem_email = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Novo pedido inicial de orçamento</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;'>
        <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='background-color: #f5f5f5; padding: 20px 0;'>
            <tr>
                <td align='center'>
                    <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='600' style='background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                        <!-- Header Image -->
                        <tr>
                            <td align='center' style='padding: 20px 0;'>
                                <img src='https://i.ibb.co/YbBWgmy/formulario-Inicial-De-Orcamento.png' alt='Formulário inicial de orçamento' style='max-width: 100%; height: auto; display: block;'>
                            </td>
                        </tr>
                        <!-- Content -->
                        <tr>
                            <td style='padding: 0 30px 30px 30px;'>
                                <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%'>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>nome:</strong> <span style='color: #3c3c3b;'>$nome</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>e-mail:</strong> <span style='color: #3c3c3b;'>$email</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>telefone:</strong> <span style='color: #3c3c3b;'>" . (!empty($telefoneFormatado) ? $telefoneFormatado : 'Não informado') . "</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>de onde veio:</strong> <span style='color: #3c3c3b;'>$de_onde_veio</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>o que será projetado:</strong> <span style='color: #3c3c3b;'>$o_que_projetar</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>quando começar projeto:</strong> <span style='color: #3c3c3b;'>$quando_comecar_projeto</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0;'>
                                            <p style='margin: 0 0 10px 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>objetivo com o projeto:</strong></p>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b; line-height: 1.6;'>$objetivo</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td style='padding: 20px 30px; background-color: #fcfcfa; border-top: 1px solid #e0e0e0; border-radius: 0 0 8px 8px;'>
                                <p style='margin: 0; font-size: 12px; color: #9da882; text-align: center;'>este formulário foi enviado no dia $hora_envio</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
    ";

    // Envia o email
    if (sendEmail($to, $email_subject, $mensagem_email, $email)) {
        redirectWithStatus('success');
    } else {
        $erros[] = 'Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.';
        redirectWithStatus('error', $erros);
    }
} else {
    // Se não for POST, redireciona para a página de orçamento
    $erros[] = 'Método de requisição inválido.';
    redirectWithStatus('error', $erros);
}
