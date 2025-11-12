<?php

require_once __DIR__ . '/functions.php';

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação e sanitização do nome
    if (empty($_POST["name"])) {
        $erros[] = "Por favor, digite seu nome.";
    } else {
        $nome = sanitizeForEmail($_POST["name"]);

        // Validação adicional: nome deve ter pelo menos 2 caracteres
        if (strlen(trim($_POST["name"])) < 2) {
            $erros[] = "O nome deve ter pelo menos 2 caracteres.";
        }
    }

    // Validação e sanitização do email
    if (empty($_POST["email"])) {
        $erros[] = "Por favor, digite seu e-mail.";
    } elseif (!validateEmail($_POST["email"])) {
        $erros[] = "Formato de e-mail inválido.";
    } else {
        $email = sanitizeInput($_POST["email"]);
    }

    // Validação e sanitização do telefone
    $telefone = '';
    if (!empty($_POST["phone"])) {
        if (!validatePhone($_POST["phone"])) {
            $erros[] = "Formato de telefone inválido. Por favor, insira um número de telefone válido.";
        } else {
            // Remove caracteres não numéricos para armazenar
            $telefone = preg_replace('/\D/', '', $_POST["phone"]);
            // Formata para exibição
            $telefoneFormatado = sanitizeForEmail($_POST["phone"]);
        }
    }

    // Validação e sanitização do assunto
    if (empty($_POST["subject"])) {
        $erros[] = "Por favor, escreva o assunto.";
    } else {
        $assunto = sanitizeForEmail($_POST["subject"]);

        // Validação adicional: assunto deve ter pelo menos 3 caracteres
        if (strlen(trim($_POST["subject"])) < 3) {
            $erros[] = "O assunto deve ter pelo menos 3 caracteres.";
        }
    }

    // Validação e sanitização da mensagem
    if (empty($_POST["message"])) {
        $erros[] = "Por favor, escreva a mensagem.";
    } else {
        $mensagem = sanitizeForEmail($_POST["message"]);

        // Validação adicional: mensagem deve ter pelo menos 10 caracteres
        if (strlen(trim($_POST["message"])) < 10) {
            $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
        }
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($erros)) {
        redirectWithStatus('error', $erros);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Formulário de Contato preenchido";

    $mensagem_email = "
    <html>
    <head>
        <title>Novo contato</title>
    </head>
    <body>
        <img src='https://i.ibb.co/dmx7wnv/formulario-De-Contato.png' alt='Formulário de Contato'>
        <br />
        <p><strong>nome:</strong> $nome</p>
        <p><strong>e-mail:</strong> $email</p>
        <p><strong>telefone:</strong> " . (!empty($telefoneFormatado) ? $telefoneFormatado : 'Não informado') . "</p>
        <p><strong>assunto:</strong> $assunto</p>
        <p><strong>mensagem:</strong> $mensagem</p>
        <br />
        <small><p id='data_envio'>este formulário foi enviado no dia $hora_envio</p></small>
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
    redirectWithStatus('error');
}
