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
    $email = '';
    if (!empty($_POST["email"])) {
        if (!validateEmail($_POST["email"])) {
            $errosPorCampo["email"] = "Formato de e-mail inválido.";
        } else {
            $email = sanitizeInput($_POST["email"]);
        }
    }

    // Validação e sanitização do CPF
    if (empty($_POST["cpf"])) {
        $errosPorCampo["cpf"] = "Por favor, digite seu CPF.";
    } else {
        // Validação completa de CPF
        if (!validateCPF($_POST["cpf"])) {
            $errosPorCampo["cpf"] = "CPF inválido. Por favor, verifique os dígitos informados.";
        } else {
            // Remove caracteres não numéricos para armazenar
            $cpf = preg_replace('/\D/', '', $_POST["cpf"]);
            // Formata para exibição (XXX.XXX.XXX-XX)
            $cpfFormatado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
            $cpf = sanitizeForEmail($cpfFormatado);
        }
    }

    // Validação e sanitização do RG
    if (empty($_POST["rg"])) {
        $errosPorCampo["rg"] = "Por favor, digite seu RG.";
    } else {
        $rg = sanitizeForEmail($_POST["rg"]);
    }

    // Validação e sanitização do endereço do projeto
    if (empty($_POST["projectAddress"])) {
        $errosPorCampo["projectAddress"] = "Por favor, digite o endereço do projeto.";
    } else {
        $projectAddress = sanitizeForEmail($_POST["projectAddress"]);
    }

    // Validação e sanitização do endereço do cliente
    if (empty($_POST["clientAddress"])) {
        $errosPorCampo["clientAddress"] = "Por favor, digite seu endereço.";
    } else {
        $clientAddress = sanitizeForEmail($_POST["clientAddress"]);
    }

    // Validação da data de nascimento
    if (empty($_POST["clientBirthDate"])) {
        $errosPorCampo["clientBirthDate"] = "Por favor, insira sua data de nascimento.";
    } else {
        $clientBirthDate = sanitizeForEmail($_POST["clientBirthDate"]);
        // Validação básica de data (formato YYYY-MM-DD)
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST["clientBirthDate"])) {
            $errosPorCampo["clientBirthDate"] = "Formato de data inválido. Use o formato YYYY-MM-DD.";
        }
    }

    // Validação da forma de pagamento
    if (empty($_POST["paymentMethod"])) {
        $errosPorCampo["paymentMethod"] = "Por favor, informe a forma de pagamento escolhida.";
    } else {
        $paymentMethod = sanitizeForEmail($_POST["paymentMethod"]);
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($errosPorCampo)) {
        redirectWithStatus('error', $erros, $errosPorCampo);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Formulário de Contrato preenchido";

    // CORRIGIDO: usa email do formulário ou um padrão se não fornecido
    $email_from = !empty($email) ? $email : 'noreply@maribe.arq.br';

    $mensagem_email = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Novo contrato</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;'>
        <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='background-color: #f5f5f5; padding: 20px 0;'>
            <tr>
                <td align='center'>
                    <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='600' style='background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                        <!-- Header Image -->
                        <tr>
                            <td align='center' style='padding: 20px 0;'>
                                <img src='https://i.ibb.co/MshF9WF/formulario-De-Contrato.png' alt='Formulário de Contrato' style='max-width: 100%; height: auto; display: block;'>
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
                                    " . (!empty($email) ? "<tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>e-mail:</strong> <span style='color: #3c3c3b;'>$email</span></p>
                                        </td>
                                    </tr>" : "") . "
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>cpf:</strong> <span style='color: #3c3c3b;'>$cpf</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>rg:</strong> <span style='color: #3c3c3b;'>$rg</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>endereço do projeto:</strong> <span style='color: #3c3c3b;'>$projectAddress</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>endereço do cliente:</strong> <span style='color: #3c3c3b;'>$clientAddress</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>data de nascimento:</strong> <span style='color: #3c3c3b;'>$clientBirthDate</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>forma de pagamento escolhida:</strong> <span style='color: #3c3c3b;'>$paymentMethod</span></p>
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
    if (sendEmail($to, $email_subject, $mensagem_email, $email_from)) {
        redirectWithStatus('success');
    } else {
        $erros[] = 'Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.';
        redirectWithStatus('error', $erros);
    }
} else {
    // Se não for POST, redireciona para a página de contrato
    $erros[] = 'Método de requisição inválido.';
    redirectWithStatus('error', $erros);
}
