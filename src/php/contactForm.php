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

        // Validação adicional: nome deve ter pelo menos 2 caracteres
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
    if (!empty($_POST["phone"])) {
        if (!validatePhone($_POST["phone"])) {
            $errosPorCampo["phone"] = "Formato de telefone inválido. Por favor, insira um número de telefone válido.";
        } else {
            // Verifica se começa com "+" (formato internacional do autocomplete)
            $hasPlusSign = strpos(trim($_POST["phone"]), '+') === 0;
            
            // Remove caracteres não numéricos para armazenar
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
            
            // Formata para exibição
            $telefoneFormatado = sanitizeForEmail($_POST["phone"]);
        }
    }

    // Validação e sanitização do assunto
    if (empty($_POST["subject"])) {
        $errosPorCampo["subject"] = "Por favor, selecione o assunto.";
    } else {
        $assunto = sanitizeForEmail($_POST["subject"]);

        // Se "Outros" foi selecionado, valida o campo subjectOther
        $outrosTexts = ['Outros', 'Other', 'Otros'];
        if (in_array($assunto, $outrosTexts)) {
            if (empty($_POST["subjectOther"])) {
                $errosPorCampo["subjectOther"] = "Por favor, descreva o assunto.";
            } else {
                $assuntoOther = sanitizeForEmail($_POST["subjectOther"]);
                if (strlen(trim($_POST["subjectOther"])) < 3) {
                    $errosPorCampo["subjectOther"] = "O assunto deve ter pelo menos 3 caracteres.";
                } else {
                    // Usa o valor de subjectOther como assunto final
                    $assunto = $assuntoOther;
                }
            }
        }
    }

    // Validação e sanitização da mensagem
    if (empty($_POST["message"])) {
        $errosPorCampo["message"] = "Por favor, escreva a mensagem.";
    } else {
        $mensagem = sanitizeForEmail($_POST["message"]);

        // Validação adicional: mensagem deve ter pelo menos 10 caracteres
        if (strlen(trim($_POST["message"])) < 10) {
            $errosPorCampo["message"] = "A mensagem deve ter pelo menos 10 caracteres.";
        }
    }

    // Validação de privacidade (checkbox)
    if (empty($_POST["privacy"])) {
        $errosPorCampo["privacy"] = "Você deve concordar com a política de privacidade.";
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($errosPorCampo)) {
        redirectWithStatus('error', $erros, $errosPorCampo);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Formulário de Contato preenchido";

    $mensagem_email = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Novo contato</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;'>
        <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='background-color: #f5f5f5; padding: 20px 0;'>
            <tr>
                <td align='center'>
                    <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='600' style='background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                        <!-- Header Image -->
                        <tr>
                            <td align='center' style='padding: 20px 0;'>
                                <img src='https://i.ibb.co/dmx7wnv/formulario-De-Contato.png' alt='Formulário de Contato' style='max-width: 100%; height: auto; display: block;'>
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
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>assunto:</strong> <span style='color: #3c3c3b;'>$assunto</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0;'>
                                            <p style='margin: 0 0 10px 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>mensagem:</strong></p>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b; line-height: 1.6;'>$mensagem</p>
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
    // Se não for POST, redireciona para a página de contato
    $erros[] = 'Método de requisição inválido.';
    redirectWithStatus('error', $erros);
}
