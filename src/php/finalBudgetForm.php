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

    // Validação e sanitização do endereço
    if (empty($_POST["address"])) {
        $errosPorCampo["address"] = "Por favor, digite seu endereço.";
    } else {
        $endereco = sanitizeForEmail($_POST["address"]);
    }

    // Validação do que é mais importante no orçamento
    if (empty($_POST["maisImportanteNoOrcamento"])) {
        $errosPorCampo["maisImportanteNoOrcamento"] = "Por favor, digite o que é mais importante no orçamento.";
    } else {
        $o_que_e_mais_importante_no_orcamento = sanitizeForEmail($_POST["maisImportanteNoOrcamento"]);
    }

    // Validação se o imóvel tem planta
    if (empty($_POST["imovelTemPlantaOuNao"])) {
        $errosPorCampo["imovelTemPlantaOuNao"] = "Por favor, marque se o projeto possui planta.";
    } else {
        $projeto_tem_planta = sanitizeForEmail($_POST["imovelTemPlantaOuNao"]);
    }

    // Validação se é apartamento completo ou alguns ambientes
    if (empty($_POST["apartamentoCompletoOuAlgunsAmbientes"])) {
        $errosPorCampo["apartamentoCompletoOuAlgunsAmbientes"] = "Por favor, informe se é o apartamento completo ou alguns ambientes.";
    } else {
        $apartamento_completo_ou_ambientes = sanitizeForEmail($_POST["apartamentoCompletoOuAlgunsAmbientes"]);
    }

    // Validação de quantas pessoas residem e idades
    if (empty($_POST["quantasPessoasResidemEIdades"])) {
        $errosPorCampo["quantasPessoasResidemEIdades"] = "Por favor, informe quantas pessoas vivem no apartamento e as idades.";
    } else {
        $quantas_pessoas_vivem_no_apartamento = sanitizeForEmail($_POST["quantasPessoasResidemEIdades"]);
    }

    // Validação do tamanho em metros quadrados
    if (empty($_POST["tamanhoEmMetrosQuadrados"])) {
        $errosPorCampo["tamanhoEmMetrosQuadrados"] = "Por favor, informe qual o tamanho do espaço em m².";
    } else {
        $tamanho_projeto = sanitizeForEmail($_POST["tamanhoEmMetrosQuadrados"]);
        // Validação básica: deve ser um número
        if (!is_numeric(str_replace(',', '.', $_POST["tamanhoEmMetrosQuadrados"]))) {
            $errosPorCampo["tamanhoEmMetrosQuadrados"] = "O tamanho em m² deve ser um número válido.";
        }
    }

    // Validação de demolição ou construção de paredes
    if (empty($_POST["haveraDemolicaoOuConstrucaoDeParedes"])) {
        $errosPorCampo["haveraDemolicaoOuConstrucaoDeParedes"] = "Por favor, marque se haverá demolição ou construção de paredes.";
    } else {
        $demolicao_ou_construcao_paredes = sanitizeForEmail($_POST["haveraDemolicaoOuConstrucaoDeParedes"]);
    }

    // Validação de modificação elétrica
    if (empty($_POST["vaiModificarEletrica"])) {
        $errosPorCampo["vaiModificarEletrica"] = "Por favor, marque se haverá modificação de elétrica.";
    } else {
        $modificar_eletrica = sanitizeForEmail($_POST["vaiModificarEletrica"]);
    }

    // Validação de modificação de gesso
    if (empty($_POST["vaiModificarGesso"])) {
        $errosPorCampo["vaiModificarGesso"] = "Por favor, marque se haverá modificação de gesso.";
    } else {
        $modificar_gesso = sanitizeForEmail($_POST["vaiModificarGesso"]);
    }

    // Validação de modificação de revestimento ou bancada
    if (empty($_POST["vaiModificarRevestimentoOuBancadas"])) {
        $errosPorCampo["vaiModificarRevestimentoOuBancadas"] = "Por favor, marque se haverá modificação de revestimento ou bancada.";
    } else {
        $modificar_revestimento_ou_bancada = sanitizeForEmail($_POST["vaiModificarRevestimentoOuBancadas"]);
    }

    // Validação de aproveitar ou modificar móvel existente
    if (empty($_POST["vaiAproveitarEOuModificarAlgumMovel"])) {
        $errosPorCampo["vaiAproveitarEOuModificarAlgumMovel"] = "Por favor, marque se vai aproveitar ou modificar algum móvel existente.";
    } else {
        $vai_aproveitar_e_ou_modificar_movel_existente = sanitizeForEmail($_POST["vaiAproveitarEOuModificarAlgumMovel"]);
    }

    // Validação de móveis com marcenaria ou planejados
    if (empty($_POST["pensaEmFazerMoveisComMarcenariaOuPlanejados"])) {
        $errosPorCampo["pensaEmFazerMoveisComMarcenariaOuPlanejados"] = "Por favor, marque se pensa em fazer móveis com marcenaria ou planejados.";
    } else {
        $pensa_em_fazer_moveis_com_marcenaria_ou_planejados = sanitizeForEmail($_POST["pensaEmFazerMoveisComMarcenariaOuPlanejados"]);
    }

    // Dúvidas ou informações adicionais (opcional)
    $outras_duvidas = "Sem outras dúvidas";
    if (!empty($_POST["duvidasOuInformacoesAAcrescentar"])) {
        $outras_duvidas = sanitizeForEmail($_POST["duvidasOuInformacoesAAcrescentar"]);
    }

    // Se houver erros, redireciona de volta ao formulário
    if (!empty($errosPorCampo)) {
        redirectWithStatus('error', $erros, $errosPorCampo);
    }

    // Prepara o email
    $hora_envio = date("d/m/Y \à\s H:i:s");
    $to = "maribe.arquitetura@gmail.com";
    $email_subject = "Formulário de Proposta preenchido";

    // Usa um email padrão já que este formulário não coleta email
    $email_from = 'noreply@maribe.arq.br';

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

    // Envia o email
    if (sendEmail($to, $email_subject, $mensagem_email, $email_from)) {
        redirectWithStatus('success');
    } else {
        $erros[] = 'Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.';
        redirectWithStatus('error', $erros);
    }
} else {
    // Se não for POST, redireciona para a página de proposta
    $erros[] = 'Método de requisição inválido.';
    redirectWithStatus('error', $erros);
}
