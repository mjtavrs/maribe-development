<?php

require_once __DIR__ . '/functions.php';

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação e sanitização do nome
    if (empty($_POST["name"])) {
        $erros[] = "Por favor, digite seu nome.";
    } else {
        $nome = sanitizeForEmail($_POST["name"]);

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
    $telefoneFormatado = '';
    if (!empty($_POST["phone"])) {
        if (!validatePhone($_POST["phone"])) {
            $erros[] = "Formato de telefone inválido. Por favor, insira um número de telefone válido.";
        } else {
            $telefone = preg_replace('/\D/', '', $_POST["phone"]);
            $telefoneFormatado = sanitizeForEmail($_POST["phone"]);
        }
    }

    // Validação de como chegou até nós
    if (empty($_POST["howYouFoundUs"])) {
        $erros[] = "Por favor, selecione de onde você veio.";
    } else {
        $de_onde_veio = sanitizeForEmail($_POST["howYouFoundUs"]);
    }

    // Validação do que será projetado
    if (empty($_POST["whatAreWeWorkingOn"])) {
        $erros[] = "Por favor, selecione o que será projetado.";
    } else {
        $o_que_projetar = sanitizeForEmail($_POST["whatAreWeWorkingOn"]);
    }

    // Validação de quando iniciar o projeto
    if (empty($_POST["whenToBeginTheProject"])) {
        $erros[] = "Por favor, indique quando pretende iniciar o projeto.";
    } else {
        $quando_comecar_projeto = sanitizeForEmail($_POST["whenToBeginTheProject"]);
    }

    // Validação do objetivo
    if (empty($_POST["objective"])) {
        $erros[] = "Por favor, descreva o objetivo do projeto.";
    } else {
        $objetivo = sanitizeForEmail($_POST["objective"]);

        if (strlen(trim($_POST["objective"])) < 10) {
            $erros[] = "O objetivo deve ter pelo menos 10 caracteres.";
        }
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($erros)) {
        redirectWithStatus('error', $erros);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Novo pedido inicial de orçamento";

    $mensagem_email = "
    <html>
    <head>
        <title>Novo pedido inicial de orçamento</title>
    </head>
    <body>
        <img src='https://i.ibb.co/YbBWgmy/formulario-Inicial-De-Orcamento.png' alt='Formulário inicial de orçamento'>
        <br />
        <p><strong>nome:</strong> $nome</p>
        <p><strong>e-mail:</strong> $email</p>
        <p><strong>telefone:</strong> " . (!empty($telefoneFormatado) ? $telefoneFormatado : 'Não informado') . "</p>
        <p><strong>de onde veio:</strong> $de_onde_veio</p>
        <p><strong>o que será projetado:</strong> $o_que_projetar</p>
        <p><strong>quando começar projeto:</strong> $quando_comecar_projeto</p>
        <p><strong>objetivo com o projeto:</strong> $objetivo</p>
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
    redirectWithStatus('error');
}