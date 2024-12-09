<?php

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $erros[] = "Por favor, digite seu nome.";
    } else {
        $nome = $_POST["name"];
    }

    if (empty($_POST["cpf"])) {
        $erros[] = "Formato de CPF inválido. Por favor, insira um CPF válido.";
    } else {
        $cpf = $_POST["cpf"];
    }

    if (empty($_POST["rg"])) {
        $erros[] = "Formato de RG inválido. Por favor, insira um RG válido.";
    } else {
        $rg = $_POST["rg"];
    }

    if (empty($_POST["projectAddress"])) {
        $erros[] = "Por favor, digite o endereço do projeto.";
    } else {
        $projectAddress = $_POST["projectAddress"];
    }

    if (empty($_POST["clientAddress"])) {
        $erros[] = "Por favor, digite seu endereço.";
    } else {
        $clientAddress = $_POST["clientAddress"];
    }

    if (empty($_POST["clientBirthDate"])) {
        $erros[] = "Por favor, insira sua data de nascimento.";
    } else {
        $clientBirthDate = $_POST["clientBirthDate"];
    }
    
    if (empty($_POST["clientJob"])) {
        $erros[] = "Por favor, digite sua profissão.";
    } else {
        $clientJob = $_POST["clientJob"];
    }

    $hora_envio = date("d/m/Y \à\s H:i:s");

    $to = "formulariomaribe@gmail.com";
    $subject = "Formulário de Contrato preenchido";

    $mensagem_email = "
    <html>
    <head>
        <title>Novo contato</title>
    </head>
    <body>
        <img src='https://i.ibb.co/MshF9WF/formulario-De-Contrato.png' alt='Formulário de Contrato'>
        <br />
        <p><strong>nome:</strong> $nome</p>
        <p><strong>cpf:</strong> $cpf</p>
        <p><strong>rg:</strong> $rg</p>
        <p><strong>endereço do projeto:</strong> $projectAddress</p>
        <p><strong>endereço do cliente:</strong> $clientAddress</p>
        <p><strong>data de nascimento:</strong> $clientBirthDate</p>
        <p><strong>profissão:</strong> $clientJob</p>
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