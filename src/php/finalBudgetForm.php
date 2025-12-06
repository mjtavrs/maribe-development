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
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Formulário de Proposta</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5;'>
        <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='background-color: #f5f5f5; padding: 20px 0;'>
            <tr>
                <td align='center'>
                    <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='600' style='background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>
                        <!-- Header Image -->
                        <tr>
                            <td align='center' style='padding: 20px 0;'>
                                <img src='https://i.ibb.co/yVPy89p/formulario-De-Proposta.png' alt='Formulário de Proposta' style='max-width: 100%; height: auto; display: block;'>
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
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>o que é o mais importante para você nesse processo de orçamento de projeto?</strong> <span style='color: #3c3c3b;'>$o_que_e_mais_importante_no_orcamento</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>endereço:</strong> <span style='color: #3c3c3b;'>$endereco</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>no caso de projeto de interiores, o imóvel tem planta?</strong> <span style='color: #3c3c3b;'>$projeto_tem_planta</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>apartamento completo? se não, quantos e quais ambientes?</strong> <span style='color: #3c3c3b;'>$apartamento_completo_ou_ambientes</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>quantas pessoas residem no imóvel e quais as idades?</strong> <span style='color: #3c3c3b;'>$quantas_pessoas_vivem_no_apartamento</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>tamanho do projeto (m²):</strong> <span style='color: #3c3c3b;'>$tamanho_projeto</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>vai ter demolição/construção de paredes?</strong> <span style='color: #3c3c3b;'>$demolicao_ou_construcao_paredes</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>vai modificar elétrica?</strong> <span style='color: #3c3c3b;'>$modificar_eletrica</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>vai modificar gesso?</strong> <span style='color: #3c3c3b;'>$modificar_gesso</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>vai modificar revestimento ou bancadas?</strong> <span style='color: #3c3c3b;'>$modificar_revestimento_ou_bancada</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>vai aproveitar e/ou modificar algum móvel já existente?</strong> <span style='color: #3c3c3b;'>$vai_aproveitar_e_ou_modificar_movel_existente</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0; border-bottom: 1px solid #e0e0e0;'>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>pensa em fazer móveis com marcenaria ou planejados?</strong> <span style='color: #3c3c3b;'>$pensa_em_fazer_moveis_com_marcenaria_ou_planejados</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 0;'>
                                            <p style='margin: 0 0 10px 0; font-size: 14px; color: #3c3c3b;'><strong style='color: #c56e51; font-size: 14px;'>se houver alguma dúvida ou informação a acrescentar, comente:</strong></p>
                                            <p style='margin: 0; font-size: 14px; color: #3c3c3b; line-height: 1.6;'>$outras_duvidas</p>
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
    // Se não for POST, redireciona para a página de proposta
    $erros[] = 'Método de requisição inválido.';
    redirectWithStatus('error', $erros);
}
