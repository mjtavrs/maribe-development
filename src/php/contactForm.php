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

    if (empty($_POST["subject"])) {
        $erros[] = "Por favor, escreva o assunto.";
    } else {
        $assunto = $_POST["subject"];
    }

    if (empty($_POST["message"])) {
        $erros[] = "Por favor, escreva a mensagem do projeto.";
    } else {
        $mensagem = $_POST["message"];
    }

    $hora_envio = date("d/m/Y \à\s H:i:s");

    $to = "formulariomaribe@gmail.com";
    $subject = "Novo contato";

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
        <p><strong>telefone:</strong> $telefone</p>
        <p><strong>assunto:</strong> $assunto</p>
        <p><strong>mensagem:</strong> $mensagem</p>
        <br />
        <small><p id='data_envio'>este formulário foi enviado no dia $hora_envio</p></small>
        </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "De: $email\r\nReply-To: $email\r\n";

    if (mail($to, $subject, $mensagem_email, $headers)) {
        header("Location: http://maribe.arq.br/sucesso");
        exit;
    } else {
        $erros[] = 'Erro ao enviar a mensagem.';
    }
}