<?php

$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $erros[] = "Por favor, digite seu nome.";
    } else {
        $nome = $_POST["name"];
    }

    if (empty($_POST["address"])) {
        $erros[] = "Por favor, digite seu endereço.";
    } else {
        $endereco = $_POST["address"];
    }

    if (empty($_POST["maisImportanteNoOrcamento"])) {
        $erros[] = "Por favor, digite o que é mais importante no orçamento.";
    } else {
        $o_que_e_mais_importante_no_orcamento = $_POST["maisImportanteNoOrcamento"];
    }

    if (empty($_POST["imovelTemPlantaOuNao"])) {
        $erros[] = "Por favor, marque se o projeto possui planta.";
    } else {
        $projeto_tem_planta = $_POST["imovelTemPlantaOuNao"];
    }

    if (empty($_POST["apartamentoCompletoOuAlgunsAmbientes"])) {
        $erros[] = "Por favor, informe se é o apartamento completo ou alguns ambientes.";
    } else {
        $apartamento_completo_ou_ambientes = $_POST["apartamentoCompletoOuAlgunsAmbientes"];
    }
    
    if (empty($_POST["quantasPessoasResidemEIdades"])) {
        $erros[] = "Por favor, informe quantas pessoas vivem no apartamento e as idades.";
    } else {
        $quantas_pessoas_vivem_no_apartamento = $_POST["quantasPessoasResidemEIdades"];
    }
    
    if (empty($_POST["tamanhoEmMetrosQuadrados"])) {
        $erros[] = "Por favor, informe qual o tamanho do espaço em m².";
    } else {
        $tamanho_projeto = $_POST["tamanhoEmMetrosQuadrados"];
    }

    if (empty($_POST["haveraDemolicaoOuConstrucaoDeParedes"])) {
        $erros[] = "Por favor, marque se haverá demolição ou construção de paredes.";
    } else {
        $demolicao_ou_construcao_paredes = $_POST["haveraDemolicaoOuConstrucaoDeParedes"];
    }

    if (empty($_POST["vaiModificarEletrica"])) {
        $erros[] = "Por favor, marque se haverá modificação de elétrica.";
    } else {
        $modificar_eletrica = $_POST["vaiModificarEletrica"];
    }

    if (empty($_POST["vaiModificarGesso"])) {
        $erros[] = "Por favor, marque se haverá modificação de gesso.";
    } else {
        $modificar_gesso = $_POST["vaiModificarGesso"];
    }

    if (empty($_POST["vaiModificarRevestimentoOuBancadas"])) {
        $erros[] = "Por favor, marque se haverá modificação de revestimento ou bancada.";
    } else {
        $modificar_revestimento_ou_bancada = $_POST["vaiModificarRevestimentoOuBancadas"];
    }

    if (empty($_POST["vaiAproveitarEOuModificarAlgumMovel"])) {
        $erros[] = "Por favor, marque se vai aproveitar ou modificar algum móvel existente.";
    } else {
        $vai_aproveitar_e_ou_modificar_movel_existente = $_POST["vaiAproveitarEOuModificarAlgumMovel"];
    }

    if (empty($_POST["pensaEmFazerMoveisComMarcenariaOuPlanejados"])) {
        $erros[] = "Por favor, marque se pensa em fazer móveis com marcenaria ou planejados.";
    } else {
        $pensa_em_fazer_moveis_com_marcenaria_ou_planejados = $_POST["pensaEmFazerMoveisComMarcenariaOuPlanejados"];
    }

    if (empty($_POST["duvidasOuInformacoesAAcrescentar"])) {
        $outras_duvidas = "Sem outras dúvidas";
    } else {
        $outras_duvidas = $_POST["duvidasOuInformacoesAAcrescentar"];
    }

    $hora_envio = date("d/m/Y \à\s H:i:s");

    $to = "maribe.arquitetura@gmail.com";
    $assunto = "Formulário de Proposta preenchido";

    $mensagem_email = "
    <html>
    <head>
        <title>Formulário de Proposta</title>
    </head>
    <body>
        <img src='https://i.ibb.co/yVPy89p/formulario-De-Proposta.png' alt='Formulário de Proposta'>
        <br />
        <p><strong>nome:</strong> $nome</p>        
        <p><strong>o que é o mais importante para você nesse processo de orçamento de projeto?</strong> $o_que_e_mais_importante_no_orcamento</p>
        <p><strong>endereço:</strong> $endereco</p>
        <p><strong>no caso de projeto de interiores, o imóvel tem planta?</strong> $projeto_tem_planta</p>
        <p><strong>apartamento completo? se não, quantos e quais ambientes?</strong> $apartamento_completo_ou_ambientes</p>
        <p><strong>quantas pessoas residem no imóvel e quais as idades?</strong> $quantas_pessoas_vivem_no_apartamento</p>
        <p><strong>tamanho do projeto (m²):</strong> $tamanho_projeto</p>
        <p><strong>vai ter demolição/construção de paredes?</strong> $demolicao_ou_construcao_paredes</p>
        <p><strong>vai modificar elétrica?</strong> $modificar_eletrica</p>
        <p><strong>vai modificar gesso?</strong> $modificar_gesso</p>
        <p><strong>vai modificar revestimento ou bancadas?</strong> $modificar_revestimento_ou_bancada</p>
        <p><strong>vai aproveitar e/ou modificar algum móvel já existente?</strong> $vai_aproveitar_e_ou_modificar_movel_existente</p>
        <p><strong>pensa em fazer móveis com marcenaria ou planejados?</strong> $pensa_em_fazer_moveis_com_marcenaria_ou_planejados</p>
        <p><strong>se houver alguma dúvida ou informação a acrescentar, comente:</strong> $outras_duvidas</p>
        <br />
        <small><p id='data_envio'>este formulário foi enviado no dia $hora_envio</p></small>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // $headers .= "De: $email\r\nReply-To: $email\r\n";

    if (mail($to, $assunto, $mensagem_email, $headers)) {
        header("Location: http://maribe.arq.br/sucesso");
        exit;
    } else {
        $erros[] = 'Erro ao enviar a mensagem.';
    }
}