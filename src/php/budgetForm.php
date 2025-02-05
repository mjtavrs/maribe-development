<?php

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $erros[] = "Por favor, digite seu nome.";
    } else {
        $nome = $_POST["name"];
    }

    if (empty($_POST["email"])) {
        $erros[] = "Por favor, digite seu e-mail.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Formato de e-mail inválido.";
    } else {
        $email = $_POST["email"];
    }

    $telefone = $_POST["phone"];
    if (!empty($telefone)) {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (!preg_match('/^\d{10,11}$/', $telefone)) {
            $erros[] = "Formato de telefone inválido. Por favor, insira um número de telefone válido.";
        }
    }

    if (empty($_POST["howYouFoundUs"])) {
        $erros[] = "Por favor, selecione de onde você veio.";
    } else {
        $de_onde_veio = $_POST["howYouFoundUs"];
    }

    if (empty($_POST["whatAreWeWorkingOn"])) {
        $erros[] = "Por favor, selecione o que será projetado.";
    } else {
        $o_que_projetar = $_POST["whatAreWeWorkingOn"];
    }

    if (empty($_POST["whenToBeginTheProject"])) {
        $erros[] = "Por favor, indique quando pretende iniciar o projeto.";
    } else {
        $quando_comecar_projeto = $_POST["whenToBeginTheProject"];
    }

    if (empty($_POST["objective"])) {
        $erros[] = "Por favor, descreva o objetivo do projeto.";
    } else {
        $objetivo = $_POST["objective"];
    }

    $hora_envio = date("d/m/Y \à\s H:i:s");

    $to = "contato@maribe.arq.br";
    $assunto = "Novo pedido inicial de orçamento";

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
        <p><strong>telefone:</strong> $telefone</p>
        <p><strong>de onde veio:</strong> $de_onde_veio</p>
        <p><strong>o que será projetado:</strong> $o_que_projetar</p>
        <p><strong>quando começar projeto:</strong> $quando_comecar_projeto</p>
        <p><strong>objetivo com o projeto:</strong> $objetivo</p>
        <br />
        <small><p id='data_envio'>este formulário foi enviado no dia $hora_envio</p></small>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "De: $email\r\nReply-To: $email\r\n";

    if (mail($to, $assunto, $mensagem_email, $headers)) {
        header("Location: http://maribe.arq.br/sucesso");
        exit;
    } else {
        $erros[] = 'Erro ao enviar a mensagem.';
    }
}