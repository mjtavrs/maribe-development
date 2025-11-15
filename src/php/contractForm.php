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
    <html>
    <head>
        <title>Novo contrato</title>
    </head>
    <body>
        <img src='https://i.ibb.co/MshF9WF/formulario-De-Contrato.png' alt='Formulário de Contrato'>
        <br />
        <p><strong>nome:</strong> $nome</p>
        " . (!empty($email) ? "<p><strong>e-mail:</strong> $email</p>" : "") . "
        <p><strong>cpf:</strong> $cpf</p>
        <p><strong>rg:</strong> $rg</p>
        <p><strong>endereço do projeto:</strong> $projectAddress</p>
        <p><strong>endereço do cliente:</strong> $clientAddress</p>
        <p><strong>data de nascimento:</strong> $clientBirthDate</p>
        <p><strong>forma de pagamento escolhida:</strong> $paymentMethod</p>
        <br />
        <small><p id='data_envio'>este formulário foi enviado no dia $hora_envio</p></small>
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
