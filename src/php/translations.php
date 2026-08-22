<?php

/**
 * Arquivo de Traduções
 * 
 * Contém todas as traduções do site organizadas por idioma
 * 
 * Estrutura:
 * $allTranslations['pt'] = [...]
 * $allTranslations['en'] = [...]
 * $allTranslations['es'] = [...]
 */

$allTranslations = [
    'pt' => [
        // Menu de navegação
        'menu' => [
            'home' => 'início',
            'about' => 'sobre',
            'projects' => 'projetos',
            'budget' => 'orçamento',
            'contact' => 'contato',
            'navigation' => 'Navegação',
            'selectLanguage' => 'Selecionar idioma',
            'openMenu' => 'Abrir menu de navegação'
        ],

        // Página Home
        'home' => [
            'title' => 'home',
            'metaDescription' => 'Maribe Arquitetura é um escritório de arquitetura e urbanismo baseado em Recife, Pernambuco, com foco em arquitetura residencial, comercial e consultorias.'
        ],

        // Popup de Cookies
        'cookiePopup' => [
            'title' => 'Gerenciar Cookies 🍪',
            'description' => 'Utilizamos cookies e tecnologias similares para melhorar sua experiência de navegação. Você pode escolher quais tipos de cookies deseja aceitar.',
            'essential' => [
                'title' => 'Cookies Essenciais',
                'required' => '(Obrigatório)',
                'description' => 'Necessários para o funcionamento básico do site. Incluem segurança (tokens CSRF) e sessões.'
            ],
            'functional' => [
                'title' => 'Cookies de Funcionalidade',
                'description' => 'Permitem que o site lembre suas preferências, como idioma escolhido, para melhorar sua experiência.'
            ],
            'privacyPolicy' => 'Política de Privacidade',
            'acceptAll' => 'Aceitar todos',
            'savePreferences' => 'Salvar preferências'
        ],

        // Página de Contato
        'contact' => [
            'title' => 'contato',
            'metaDescription' => 'Gostaria de conversar? Nos envie uma mensagem nessa página.',
            'description' => [
                'Estamos aqui para conversar com você.',
                'Seja para dúvidas gerais, mensagens, parceria ou algum assunto específico, este canal é o mais adequado.<br><br>Se a sua intenção for solicitar um projeto, orçamento ou proposta, recomendamos acessar as páginas dedicadas — assim conseguimos te atender com ainda mais cuidado.'
            ],
            'form' => [
                'name' => 'Nome completo',
                'namePlaceholder' => 'Digite seu nome aqui',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Telefone',
                'phoneHint' => 'Apenas números, tá? Lembre de colocar o seu DDD!',
                'phonePlaceholder' => '00 123456789',
                'subject' => 'Assunto',
                'subjectPlaceholder' => 'Selecione o assunto',
                'subjectOptions' => [
                    'duvidasProjetos' => 'Dúvidas sobre projetos',
                    'consultoria' => 'Consultoria',
                    'parcerias' => 'Parcerias e colaborações',
                    'informacoes' => 'Informações gerais',
                    'outros' => 'Outros'
                ],
                'subjectOtherPlaceholder' => 'Descreva o assunto',
                'message' => 'Mensagem',
                'messagePlaceholder' => 'Digite sua mensagem aqui',
                'privacy' => 'Eu concordo com o envio dos dados segundo a <a href=":privacyUrl">política de privacidade</a> da Maribe Arquitetura.',
                'submit' => 'Enviar mensagem'
            ],
            'contactInfo' => [
                'preferOtherContact' => 'prefere nos contatar por outro lugar?',
                'businessHours' => 'horários de funcionamento'
            ]
        ],

        // Toast Messages
        'toast' => [
            'test' => [
                'success' => 'Testar Toast Sucesso',
                'error' => 'Testar Toast Erro'
            ],
            'success' => [
                'title' => 'Sucesso!',
                'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
            ],
            'error' => [
                'title' => 'Erro!',
                'message' => 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.'
            ]
        ],

        // Validações
        'validation' => [
            'required' => 'Este campo é obrigatório.',
            'email' => 'Por favor, insira um e-mail válido.',
            'phone' => 'Por favor, insira um telefone válido.',
            'cpf' => 'CPF inválido. Por favor, verifique os dígitos informados.',
            'rg' => 'RG inválido. Verifique os dígitos informados.',
            'privacy' => 'Você deve concordar com a política de privacidade.',
            'formError' => 'Por favor, corrija os erros no formulário antes de enviar.',
            'subjectOther' => 'Por favor, descreva o assunto (mínimo 3 caracteres).',
            'minLength' => 'Este campo deve ter pelo menos :min caracteres.',
            'maxLength' => 'Este campo deve ter no máximo :max caracteres.',
            'numericGreaterThanZero' => 'Por favor, insira um valor numérico válido maior que zero.',
            'selectOption' => 'Por favor, selecione uma opção.',
            'submitGenericError' => 'Houve um erro ao enviar o formulário. Por favor, tente novamente.'
        ],

        // Página de Orçamento
        'budget' => [
            'title' => 'vamos começar o seu projeto juntos!',
            'metaDescription' => 'Nessa página você poderá solicitar o orçamento inicial do seu projeto com a Maribe Arquitetura.',
            'description' => [
                '<strong>Vamos começar o seu projeto com cuidado e atenção.</strong>',
                'Na Maribe, cada espaço é pensado a partir da sua história, rotina e personalidade — <strong>porque acreditamos que um lar precisa refletir quem você é</strong>. Para preparar um orçamento alinhado às suas necessidades, pedimos que preencha o formulário abaixo com algumas informações importantes.',
                'Estamos aqui para orientar cada etapa com carinho e profissionalismo. Será um prazer criar com você. 🧡'
            ],
            'form' => [
                'name' => 'Nome completo',
                'namePlaceholder' => 'Digite seu nome aqui',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Telefone',
                'phoneHint' => 'Apenas números, tá? Lembre de colocar o seu DDD!',
                'phonePlaceholder' => '00 123456789',
                'howYouFoundUs' => 'Como chegou até nós?',
                'howYouFoundUsOptions' => [
                    'instagram' => 'Instagram',
                    'indicacao' => 'Indicação de conhecidos',
                    'visitaAProjetado' => 'Visitei um espaço projetado por vocês'
                ],
                'whatAreWeWorkingOn' => 'O que estaremos projetando?',
                'whatAreWeWorkingOnOptions' => [
                    'interioresResidencialCompleto' => 'Projeto de interiores residencial completo',
                    'interioresAlgunsAmbientes' => 'Projeto de interiores para alguns ambientes',
                    'interioresComercialCompleto' => 'Projeto de interiores comercial completo',
                    'projetoDeArquitetura' => 'Projeto de arquitetura'
                ],
                'whenToBeginTheProject' => 'Quando você prevê iniciar o projeto?',
                'whenToBeginTheProjectOptions' => [
                    'escolhendoMeuNovoLar' => 'Estou no projeto de escolher meu novo lar',
                    'aguardandoAsChaves' => 'Estou aguardando as chaves, mal posso esperar!',
                    'estouSemPressa' => 'Não estou com pressa. Vamos seguir o ritmo natural',
                    'estouApressado' => 'Estou um pouquinho apressado(a) e gostaria de agilizar as coisas'
                ],
                'objective' => 'Qual é o seu objetivo com este projeto?',
                'objectivePlaceholder' => 'Nos conte aqui...',
                'objectiveHint' => 'Descreva as mudanças que pretende fazer em seu espaço, o que planeja construir e o nível de intervenção necessário, caso haja reformas.',
                'privacy' => 'Eu concordo com o envio dos dados segundo a <a href=":privacyUrl">política de privacidade</a> da Maribe Arquitetura.',
                'submit' => 'Solicitar orçamento'
            ]
        ],

        // Página Sobre
        'about' => [
            'title' => 'quem somos',
            'metaDescription' => 'Conheça a Maribe Arquitetura, sua história, seu olhar e Nathalia Ribeiro, arquiteta à frente do escritório.',
            'about' => [
                'title' => 'sobre a Maribe',
                'paragraphs' => [
                    'A Maribe é um escritório de arquitetura que <span>acredita que bons espaços começam pela escuta</span>.',
                    'Cada projeto nasce da compreensão de quem vai vivê-lo: sua rotina, suas necessidades, suas referências e a forma particular como deseja se sentir naquele lugar.',
                    'A Maribe nasceu em Recife e, ao longo de sua trajetória, construiu uma forma sensível e próxima de enxergar a arquitetura.',
                    'Hoje, a Maribe inicia um novo capítulo sob a direção de Nathalia Ribeiro, preservando sua essência enquanto constrói novos caminhos, referências e possibilidades.',
                    'Mais do que um nome, <span>Maribe tornou-se uma identidade</span>.'
                ]
            ],
            'leadership' => [
                'title' => 'à frente da Maribe',
                'name' => 'Nathalia Ribeiro',
                'paragraphs' => [
                    'Arquiteta e urbanista pela UNICAP, Nathalia possui trajetória em arquitetura de interiores, projetos comerciais e design gráfico.',
                    'Apaixonada por marcenaria e por soluções práticas e bem detalhadas, <span>enxerga o projeto como um exercício de equilíbrio entre estética, funcionalidade e a maneira como cada pessoa vive seus espaços</span>.',
                    'À frente da Maribe, acompanha de perto todas as etapas do processo, transformando necessidades, referências e histórias em ambientes com personalidade e propósito.'
                ],
                'imageAlt' => 'Nathalia Ribeiro, arquiteta à frente da Maribe'
            ],
            'perspective' => [
                'title' => 'nosso olhar',
                'paragraphs' => [
                    'Para nós, arquitetura não é apenas sobre criar ambientes bonitos.',
                    'É entender rotinas, perceber detalhes e encontrar soluções que façam sentido para quem vive cada espaço.',
                    'Gostamos de projetos que tenham identidade sem perder funcionalidade; que sejam contemporâneos sem se tornarem impessoais; e que possam ser vividos de verdade.',
                    'Cada projeto da Maribe nasce de uma história diferente — <span>e é justamente isso que faz cada resultado ser único</span>.'
                ]
            ],
            'brand' => [
                'title' => 'nossa marca',
                'paragraphs' => [
                    'A identidade visual da Maribe reflete aquilo em que acreditamos: uma arquitetura que acolhe, valoriza histórias e se conecta ao lugar onde nasce.',
                    'Nosso símbolo reúne referências da força cultural de Recife, da sensibilidade das artes brasileiras e do encontro entre passado e presente.',
                    'A marca utiliza <span>recortes do desenho do Marco Zero</span> para formar a paisagem da <span>Rua do Bom Jesus</span>, uma das ruas mais emblemáticas da cidade. As formas azuis representam os paralelepípedos; as formas coloridas, os prédios históricos. O <span>círculo vermelho</span> simboliza o próprio Marco, ponto de onde as ruas se expandem e referência ao urbanismo do Recife.',
                    'Os dois tons de azul fazem alusão ao <span>encontro das águas</span> do Capibaribe e do Beberibe antes de chegarem ao mar. Essa união representa também a essência da Maribe: o encontro entre diferentes referências, histórias e formas de viver — do mar com o rio, do salgado com o doce, da memória com o novo.',
                    'A composição em mosaico encontra inspiração em artistas como <span>Hélio Oiticica</span> e <span>Tarsila do Amaral</span> e na riqueza das cores, formas e referências brasileiras. A paleta nasce de Recife, enquanto a tipografia arredondada e orgânica reforça suavidade, proximidade e contemporaneidade.',
                    'O resultado é uma marca que carrega aquilo que também buscamos em nossos projetos: <span>leveza, personalidade e uma beleza que acolhe</span>.'
                ],
                'videoLabel' => 'História da evolução do logo Maribe Arquitetura'
            ]
        ],

        // Página Projetos
        'projects' => [
            'title' => 'nossos projetos',
            'metaDescription' => 'Confira os nossos projetos, temos certeza que você irá amar!',
            'description' => 'Aqui você encontra uma seleção dos nossos projetos, cada um pensado para transformar casas em lares cheios de significado e aconchego. Esperamos que se inspire e que possamos, em breve, incluir o seu espaço aqui também! 🧡',
            'searchPlaceholder' => 'Procurando um projeto ou cidade específicos?',
            'searchPlaceholderMobile' => 'Procure um projeto ou cidade...',
            'noResultsMessage' => 'Ainda não foram encontrados projetos com esses termos...<br>Mas, o que você pensa de incluirmos o seu aqui?',
            'requestBudget' => 'Solicitar orçamento',
            'filtersLabel' => 'Filtros de projetos',
            'filterAll' => 'todos',
            'filterResidential' => 'residencial',
            'filterCommercial' => 'comercial',
            'layoutLabel' => 'Visualização dos projetos',
            'layoutTwoColumns' => 'Visualização em duas colunas',
            'layoutThreeColumns' => 'Visualização em três colunas',
            'detail' => [
                'location' => 'Localização',
                'year' => 'Ano',
                'type' => 'Tipo',
                'photosBy' => 'Fotos por',
                'backToProjects' => 'Voltar aos projetos',
                'shareTitle' => 'Compartilhar projeto',
                'shareWhatsApp' => 'Compartilhar no WhatsApp',
                'shareEmail' => 'Compartilhar por e-mail',
                'shareNative' => 'Compartilhar no dispositivo',
                'shareNativeText' => 'Confira este projeto da maribe arquitetura.',
                'shareWhatsAppMessage' => 'Confira este projeto: :title - :url',
                'shareEmailSubject' => 'Projeto: :title',
                'shareEmailBody' => 'Confira este projeto da maribe arquitetura:\n\n:title\n:description\n\n:url'
            ],
            'altText' => [
                'projectCover' => 'Capa do projeto :title',
                'projectCoverWithCity' => 'Capa do projeto :title em :city',
                'projectImage' => 'Imagem do projeto :title',
                'projectImageNumber' => 'Imagem :number de :total do projeto :title',
                'logo' => 'Logo da Maribe Arquitetura',
                'logoHome' => 'Logo da Maribe Arquitetura - Página inicial'
            ],
            'lightbox' => [
                'imageCount' => 'Imagem %1 de %2',
                'previousImage' => 'Imagem anterior',
                'nextImage' => 'Próxima imagem'
            ],
            'ariaLabels' => [
                'viewProjectDetails' => 'Ver detalhes do projeto :title',
                'viewProjectDetailsWithCity' => 'Ver detalhes do projeto :title em :city'
            ]
        ],

        // Scroll to Top
        'scrollToTop' => [
            'label' => 'Voltar ao topo',
            'title' => 'Voltar ao topo'
        ],

        // Accessibility Widget
        'accessibilityWidget' => [
            'dialogLabel' => 'Configurações de acessibilidade',
            'title' => 'Acessibilidade',
            'description' => 'Ajuste a página em tempo real do jeito que ficar mais confortável para você.',
            'openLabel' => 'Abrir menu de acessibilidade',
            'openTitle' => 'Acessibilidade',
            'close' => 'Fechar menu de acessibilidade',
            'reset' => 'Restaurar configuração original',
            'helpOpen' => 'Entender opções de acessibilidade',
            'helpDialogLabel' => 'Ajuda de acessibilidade',
            'helpTitle' => 'Como cada opção funciona',
            'helpDescription' => 'Veja o que cada recurso muda na página.',
            'helpClose' => 'Fechar ajuda',
            'sections' => [
                'textSize' => 'Tamanho do texto',
                'contrast' => 'Contraste',
                'links' => 'Links',
                'focus' => 'Foco por teclado',
                'motion' => 'Reduzir animações',
                'letterSpacing' => 'Espaçamento das letras',
                'lineHeight' => 'Espaçamento das linhas'
            ],
            'options' => [
                'textSizeLarge' => 'Maior',
                'textSizeLarger' => 'Ainda maior',
                'contrastHigh' => 'Alto',
                'contrastSoft' => 'Suave',
                'linksHighlighted' => 'Destacados',
                'focusStrong' => 'Reforçado',
                'motionReduced' => 'Reduzidas',
                'letterSpacingWide' => 'Maior',
                'letterSpacingWider' => 'Ainda maior',
                'lineHeightRelaxed' => 'Maior',
                'lineHeightSpacious' => 'Ainda maior'
            ],
            'help' => [
                'helpClose' => 'Fechar ajuda',
                'items' => [
                    'textSize' => [
                        'description' => 'Aumenta o tamanho do texto para deixar a leitura mais confortável.',
                        'levels' => [
                            'large' => 'Aplica o primeiro nível de aumento no texto.',
                            'larger' => 'Aplica um segundo nível, deixando o texto ainda maior.'
                        ]
                    ],
                    'contrast' => [
                        'description' => 'Muda o contraste da página para melhorar o conforto visual.',
                        'levels' => [
                            'high' => 'Deixa a separação entre fundo e conteúdo mais forte.',
                            'soft' => 'Cria um contraste mais suave, com leitura mais leve.'
                        ]
                    ],
                    'links' => [
                        'description' => 'Destaca os links para ajudar a identificar pontos clicáveis.',
                        'levels' => [
                            'highlighted' => 'Sublinha e reforça visualmente os links da página.'
                        ]
                    ],
                    'focus' => [
                        'description' => 'Deixa o foco do teclado mais visível durante a navegação.',
                        'levels' => [
                            'strong' => 'Mostra um contorno mais forte no elemento selecionado.'
                        ]
                    ],
                    'motion' => [
                        'description' => 'Reduz transições e animações da interface.',
                        'levels' => [
                            'reduced' => 'Diminui movimentos que possam causar desconforto.'
                        ]
                    ],
                    'letterSpacing' => [
                        'description' => 'Aumenta o espaço entre as letras para facilitar a leitura.',
                        'levels' => [
                            'wide' => 'Aplica um aumento moderado no espaçamento entre letras.',
                            'wider' => 'Aplica um aumento mais forte no espaçamento entre letras.'
                        ]
                    ],
                    'lineHeight' => [
                        'description' => 'Aumenta o espaço entre as linhas do texto.',
                        'levels' => [
                            'relaxed' => 'Aplica um aumento moderado no espaçamento entre linhas.',
                            'spacious' => 'Aplica um aumento mais forte no espaçamento entre linhas.'
                        ]
                    ]
                ]
            ],
            'announcements' => [
                'preferencesUpdated' => 'As preferências de acessibilidade foram atualizadas.',
                'preferencesReset' => 'As preferências de acessibilidade voltaram ao padrão.'
            ]
        ],

        // Footer
        'footer' => [
            'socialMedia' => 'redes sociais',
            'contactEmail' => 'contato@maribearquitetura.com.br',
            'businessHours' => 'Segunda a Sexta das 8h às 19h<br>Sábado das 8h às 12h',
            'rights' => 'todos os direitos reservados',
            'madeBy' => 'feito com 🧡 por marcos tavares',
            'privacyPolicy' => 'política de privacidade'
        ],

        // Página 404
        'notFound' => [
            'title' => 'página não encontrada',
            'metaDescription' => 'A página que você está procurando não foi encontrada.',
            'heading' => 'página não encontrada',
            'description' => 'A página que você buscou pode não existir ou estar em manutenção. Você pode tentar novamente ou ver nossos projetos no botão abaixo.',
            'viewProjects' => 'Ver projetos'
        ],

        // Página Política de Privacidade
        'privacy' => [
            'title' => 'política de privacidade',
            'metaDescription' => 'Política de privacidade da Maribe Arquitetura. Saiba como coletamos, usamos e protegemos suas informações pessoais.',
            'description' => 'Nós valorizamos a confiança que você deposita em nós e estamos comprometidos em proteger sua privacidade e seus dados pessoais. Esta Política de Privacidade descreve como coletamos, usamos e protegemos suas informações enquanto você navega pelo nosso site.',
            'lastUpdate' => 'Última atualização',
            'sections' => [
                'collection' => [
                    'title' => 'Coleta de Informações',
                    'intro' => 'A Maribe Arquitetura utiliza cookies e tecnologias similares para melhorar sua experiência de navegação. Você pode escolher quais tipos de cookies deseja aceitar através do nosso gerenciador de cookies.',
                    'cookieTypes' => 'Tipos de Cookies Utilizados:',
                    'essential' => [
                        'title' => 'Cookies Essenciais (Obrigatórios)',
                        'description' => 'Necessários para o funcionamento básico do site. Incluem tokens de segurança (CSRF) para proteção de formulários e sessões temporárias. Estes cookies não podem ser desativados, pois são essenciais para a segurança e funcionamento do site.'
                    ],
                    'functional' => [
                        'title' => 'Cookies de Funcionalidade',
                        'description' => 'Permitem que o site lembre suas preferências, como o idioma escolhido (português, inglês ou espanhol), por um período de 1 semana. Estes cookies melhoram sua experiência ao evitar que você precise escolher o idioma novamente em cada visita.'
                    ],
                    'important' => 'Importante:',
                    'importantText' => 'Não coletamos seu endereço de IP, informações sobre seu navegador ou dados pessoais identificáveis através de cookies. Os dados coletados são utilizados exclusivamente para melhorar a funcionalidade do site e sua experiência de navegação.',
                    'management' => 'Você pode gerenciar suas preferências de cookies a qualquer momento através do nosso gerenciador de cookies, disponível na parte inferior da página. Também é possível desativar os cookies através das configurações do seu navegador, porém, isso pode afetar o desempenho e algumas funcionalidades do nosso site.'
                ],
                'usage' => [
                    'title' => 'Uso das Informações',
                    'intro' => 'As informações coletadas são utilizadas para:',
                    'items' => [
                        'Garantir a segurança e o bom funcionamento da plataforma (tokens CSRF, sessões);',
                        'Lembrar suas preferências de idioma para melhorar sua experiência de navegação;',
                        'Melhorar a usabilidade e funcionalidade do site;',
                        'Cumprir obrigações legais e proteger a Maribe Arquitetura em caso de atividade maliciosa.'
                    ],
                    'sharing' => 'Nós não compartilhamos suas informações pessoais com terceiros, exceto em casos obrigatórios por lei ou para proteção de nossos direitos.'
                ],
                'security' => [
                    'title' => 'Segurança dos Dados',
                    'paragraph1' => 'A proteção dos seus dados é uma prioridade para a Maribe Arquitetura. Implementamos medidas de segurança apropriadas para garantir que suas informações estejam seguras e protegidas contra acessos não autorizados, alteração, divulgação ou destruição.',
                    'paragraph2' => 'O acesso aos dados pessoais fornecidos é restrito a funcionários autorizados e todos eles estão comprometidos em manter a confidencialidade dessas informações.'
                ],
                'externalLinks' => [
                    'title' => 'Links para Sites Externos',
                    'description' => 'Nosso site pode conter links para sites externos que não são operados por nós. Esses links são disponibilizados para sua conveniência, mas não temos controle sobre o conteúdo ou as práticas de privacidade desses sites. Recomendamos que você leia as políticas de privacidade de qualquer site externo que visitar, já que não nos responsabilizamos por eventuais danos ou perdas decorrentes do uso desses links.'
                ],
                'responsibility' => [
                    'title' => 'Responsabilidade e Crimes Digitais',
                    'description' => 'A Maribe Arquitetura reserva-se o direito de monitorar e registrar atividades suspeitas que possam indicar o cometimento de crimes digitais, como fraudes, invasões e outros atos ilícitos. Em caso de atividades ilegais, poderemos compartilhar informações com as autoridades competentes para a devida investigação.'
                ],
                'intellectual' => [
                    'title' => 'Propriedade Intelectual',
                    'description' => 'Todo o conteúdo do nosso site, incluindo textos, imagens, gráficos e outros materiais, é protegido por leis de propriedade intelectual. O uso não autorizado de qualquer parte deste conteúdo pode resultar em ação legal. A reprodução de qualquer material sem autorização prévia é expressamente proibida.'
                ],
                'changes' => [
                    'title' => 'Alterações nesta Política',
                    'description' => 'A Maribe Arquitetura pode atualizar esta Política de Privacidade periodicamente, de modo a refletir melhorias no nosso site ou mudanças nas regulamentações aplicáveis. Sempre que houver modificações significativas, você será informado através do nosso site ou de outros canais de comunicação.'
                ]
            ]
        ],

        // Página Proposta
        'proposal' => [
            'title' => 'formulário de proposta',
            'metaDescription' => 'Formulário de proposta detalhada para orçamento de projeto com a Maribe Arquitetura.',
            'description' => [
                'Ficamos muito felizes com o seu contato, <strong>vai ser um prazer fazer essa parceria contigo</strong>!',
                'Para que possamos te ajudar a tirar esse sonho do papel, precisamos que você responda a algumas perguntas para entendermos melhor do que você precisa.'
            ],
            'form' => [
                'name' => 'Nome completo',
                'namePlaceholder' => 'Digite seu nome aqui',
                'address' => 'Endereço do imóvel',
                'addressPlaceholder' => 'Ex.: Rua/Av. X, 123, Bairro, Cidade/Estado',
                'mostImportant' => 'O que é mais importante para você nesse processo de orçamento de projeto?',
                'mostImportantPlaceholder' => 'Nos diga aqui',
                'hasBlueprint' => 'No caso de projeto de interiores, o imóvel tem planta-baixa?',
                'yes' => 'Sim',
                'no' => 'Não',
                'apartmentComplete' => 'Apartamento completo? Se não, quantos e quais são os ambientes?',
                'apartmentCompletePlaceholder' => 'Ex.: 2, sala e quarto de casal',
                'residents' => 'Quantas pessoas residem no imóvel e quais as idades?',
                'residentsPlaceholder' => 'Ex.: 3 pessoas, 30 e 28 anos',
                'size' => 'Qual o tamanho (em m²)?',
                'sizePlaceholder' => 'Ex.: 60m²',
                'demolition' => 'Vai ter demolição/construção de paredes?',
                'electrical' => 'Vai modificar elétrica?',
                'plaster' => 'Vai modificar gesso?',
                'finishing' => 'Vai modificar revestimento ou bancadas?',
                'furniture' => 'Vai aproveitar e/ou modificar algum móvel existente?',
                'carpentry' => 'Pensa em fazer móveis com marcenaria ou planejados?',
                'additionalInfo' => 'Se houver alguma dúvida ou informação a acrescentar, comente aqui!',
                'additionalInfoPlaceholder' => 'Suas dúvidas e outras informações vêm aqui :)',
                'privacy' => 'Eu concordo com o envio dos dados segundo a <a href=":privacyUrl">política de privacidade</a> da Maribe Arquitetura.',
                'submit' => 'Enviar mensagem',
            ]
        ],

        // Página Contrato
        'contract' => [
            'title' => 'formulário de contrato',
            'metaDescription' => 'Preencha os dados necessários para o preenchimento do contrato e organização da gestão interna do escritório.',
            'description' => 'Esses dados são necessários para preenchimento do contrato e organização da gestão interna do escritório.',
            'form' => [
                'name' => 'Nome completo',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'cpf' => 'CPF',
                'cpfPlaceholder' => 'Apenas números. Ex.: 12345678900',
                'rg' => 'RG',
                'rgPlaceholder' => 'Apenas números. Ex.: 1234567',
                'projectAddress' => 'Endereço completo do projeto',
                'projectAddressPlaceholder' => 'Ex.: Rua/Av. X, 123, Bairro, Cidade/Estado',
                'clientAddress' => 'Endereço de onde reside',
                'clientAddressPlaceholder' => 'Ex.: Rua/Av. X, 123, Bairro, Cidade/Estado',
                'birthDate' => 'Data de nascimento',
                'paymentMethod' => 'Qual a forma de pagamento escolhida?',
                'paymentMethodPlaceholder' => 'À vista; Sinal + \'x\' parcelas...',
                'paymentMethodExamples' => 'Exemplos: "Entrada de R$ 3.000 e o restante parcelado no cartão" ou "Parcelado no cartão".',
                'submit' => 'Enviar mensagem',
                'dataExplanation' => 'Por que precisamos desses dados?',
                'dataExplanationText' => 'Os dados de CPF, RG e endereço são necessários para o preenchimento correto do contrato e para a organização da gestão interna do escritório. Essas informações são essenciais para garantir a formalização adequada do acordo entre as partes.',
            ]
        ],

        // Página Sucesso
        'success' => [
            'title' => 'mensagem enviada',
            'metaDescription' => 'Sua mensagem foi enviada com sucesso! Agradecemos o seu contato e responderemos o mais breve possível.',
            'heading' => 'agradecemos o seu contato!',
            'message' => 'Sua mensagem foi enviada e nos iremos respondê-la o mais breve possível. Enquanto isso, <a href=":projectsUrl">clique aqui</a> para ver alguns dos nossos projetos.'
        ]
    ],

    'en' => [
        // Menu de navegação
        'menu' => [
            'home' => 'home',
            'about' => 'about',
            'projects' => 'projects',
            'budget' => 'budget',
            'contact' => 'contact',
            'navigation' => 'Navigation',
            'selectLanguage' => 'Select language',
            'openMenu' => 'Open navigation menu'
        ],

        // Página Home
        'home' => [
            'title' => 'home',
            'metaDescription' => 'Maribe Arquitetura is an architecture and urban planning firm based in Recife, Pernambuco, focused on residential architecture, commercial architecture, and consulting.'
        ],

        // Cookie Popup
        'cookiePopup' => [
            'title' => 'Manage Cookies 🍪',
            'description' => 'We use cookies and similar technologies to improve your browsing experience. You can choose which types of cookies you wish to accept.',
            'essential' => [
                'title' => 'Essential Cookies',
                'required' => '(Required)',
                'description' => 'Necessary for the basic functioning of the website. Include security (CSRF tokens) and sessions.'
            ],
            'functional' => [
                'title' => 'Functionality Cookies',
                'description' => 'Allow the website to remember your preferences, such as chosen language, to improve your experience.'
            ],
            'privacyPolicy' => 'Privacy Policy',
            'acceptAll' => 'Accept all',
            'savePreferences' => 'Save preferences'
        ],

        // Página de Contato
        'contact' => [
            'title' => 'contact',
            'metaDescription' => 'Would you like to chat? Send us a message on this page.',
            'description' => [
                'We are here to talk to you.',
                'Whether for general questions, messages, partnerships, or any specific subject, this channel is the most appropriate.<br><br>If your intention is to request a project, budget, or proposal, we recommend accessing the dedicated pages — this way we can serve you with even more care.'
            ],
            'form' => [
                'name' => 'Full name',
                'namePlaceholder' => 'Enter your name here',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Phone',
                'phoneHint' => 'Numbers only, okay? Remember to include your area code!',
                'phonePlaceholder' => '00 123456789',
                'subject' => 'Subject',
                'subjectPlaceholder' => 'Select the subject',
                'subjectOptions' => [
                    'duvidasProjetos' => 'Questions about projects',
                    'consultoria' => 'Consulting',
                    'parcerias' => 'Partnerships and collaborations',
                    'informacoes' => 'General information',
                    'outros' => 'Other'
                ],
                'subjectOtherPlaceholder' => 'Describe the subject',
                'message' => 'Message',
                'messagePlaceholder' => 'Type your message here',
                'privacy' => 'I agree to the submission of data according to the <a href=":privacyUrl">privacy policy</a> of Maribe Arquitetura.',
                'submit' => 'Send message'
            ],
            'contactInfo' => [
                'preferOtherContact' => 'prefer to contact us another way?',
                'businessHours' => 'business hours'
            ]
        ],

        // Toast Messages
        'toast' => [
            'test' => [
                'success' => 'Test Success Toast',
                'error' => 'Test Error Toast'
            ],
            'success' => [
                'title' => 'Success!',
                'message' => 'Message sent successfully! We will contact you soon.'
            ],
            'error' => [
                'title' => 'Error!',
                'message' => 'An error occurred while sending your message. Please try again.'
            ]
        ],

        // Validações
        'validation' => [
            'required' => 'This field is required.',
            'email' => 'Please enter a valid email address.',
            'phone' => 'Please enter a valid phone number.',
            'cpf' => 'Invalid CPF. Please check the digits provided.',
            'rg' => 'Invalid RG. Please check the digits provided.',
            'privacy' => 'You must agree to the privacy policy.',
            'formError' => 'Please correct the errors in the form before submitting.',
            'subjectOther' => 'Please describe the subject (minimum 3 characters).',
            'minLength' => 'This field must have at least :min characters.',
            'maxLength' => 'This field must have at most :max characters.',
            'numericGreaterThanZero' => 'Please enter a valid numeric value greater than zero.',
            'selectOption' => 'Please select an option.',
            'submitGenericError' => 'There was an error submitting the form. Please try again.'
        ],

        // Página de Orçamento
        'budget' => [
            'title' => "let's start your project together!",
            'metaDescription' => 'On this page you can request the initial quote for your project with Maribe Arquitetura.',
            'description' => [
                '<strong>Let\'s start your project with care and attention.</strong>',
                'At Maribe, each space is designed based on your story, routine, and personality — <strong>because we believe a home needs to reflect who you are</strong>. To prepare a quote aligned with your needs, we ask that you fill out the form below with some important information.',
                'We are here to guide each step with warmth and professionalism. It will be a pleasure to create with you. 🧡'
            ],
            'form' => [
                'name' => 'Full name',
                'namePlaceholder' => 'Enter your name here',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Phone',
                'phoneHint' => 'Numbers only, okay? Remember to include your area code!',
                'phonePlaceholder' => '00 123456789',
                'howYouFoundUs' => 'How did you find us?',
                'howYouFoundUsOptions' => [
                    'instagram' => 'Instagram',
                    'indicacao' => 'Referral from acquaintances',
                    'visitaAProjetado' => 'I visited a space designed by you'
                ],
                'whatAreWeWorkingOn' => 'What will we be designing?',
                'whatAreWeWorkingOnOptions' => [
                    'interioresResidencialCompleto' => 'Complete residential interior design project',
                    'interioresAlgunsAmbientes' => 'Interior design for some rooms',
                    'interioresComercialCompleto' => 'Complete commercial interior design project',
                    'projetoDeArquitetura' => 'Architecture project'
                ],
                'whenToBeginTheProject' => 'When do you plan to start the project?',
                'whenToBeginTheProjectOptions' => [
                    'escolhendoMeuNovoLar' => 'I am in the process of choosing my new home',
                    'aguardandoAsChaves' => 'I am waiting for the keys, I can\'t wait!',
                    'estouSemPressa' => 'I am not in a hurry. Let\'s follow the natural pace',
                    'estouApressado' => 'I am a little rushed and would like to speed things up'
                ],
                'objective' => 'What is your goal with this project?',
                'objectivePlaceholder' => 'Tell us here...',
                'objectiveHint' => 'Describe the changes you plan to make in your space, what you plan to build, and the level of intervention needed, if there are renovations.',
                'privacy' => 'I agree to the submission of data according to the <a href=":privacyUrl">privacy policy</a> of Maribe Arquitetura.',
                'submit' => 'Send message'
            ]
        ],

        // Página Sobre
        'about' => [
            'title' => 'who we are',
            'metaDescription' => 'Discover Maribe Arquitetura, its story, its perspective, and Nathalia Ribeiro, the architect leading the studio.',
            'about' => [
                'title' => 'about Maribe',
                'paragraphs' => [
                    'Maribe is an architecture studio that <span>believes good spaces begin with listening</span>.',
                    'Every project begins with understanding the people who will live in it: their routines, needs, references, and the particular way they want to feel in that place.',
                    'Maribe was founded in Recife and, throughout its journey, has developed a sensitive and approachable way of seeing architecture.',
                    'Today, Maribe begins a new chapter under the direction of Nathalia Ribeiro, preserving its essence while building new paths, references, and possibilities.',
                    'More than a name, <span>Maribe has become an identity</span>.'
                ]
            ],
            'leadership' => [
                'title' => 'leading Maribe',
                'name' => 'Nathalia Ribeiro',
                'paragraphs' => [
                    'An architect and urban planner from UNICAP, Nathalia has a background in interior architecture, commercial projects, and graphic design.',
                    'Passionate about woodworking and practical, carefully detailed solutions, she <span>sees design as an exercise in balancing aesthetics, functionality, and the way each person lives in their spaces</span>.',
                    'Leading Maribe, she closely follows every stage of the process, transforming needs, references, and stories into spaces with personality and purpose.'
                ],
                'imageAlt' => 'Nathalia Ribeiro, the architect leading Maribe'
            ],
            'perspective' => [
                'title' => 'our perspective',
                'paragraphs' => [
                    'For us, architecture is not only about creating beautiful spaces.',
                    'It is about understanding routines, noticing details, and finding solutions that make sense for the people who live in each space.',
                    'We value projects with identity that do not sacrifice functionality; that are contemporary without becoming impersonal; and that can truly be lived in.',
                    'Every Maribe project begins with a different story — <span>and that is precisely what makes each result unique</span>.'
                ]
            ],
            'brand' => [
                'title' => 'our brand',
                'paragraphs' => [
                    'Maribe\'s visual identity reflects what we believe in: architecture that welcomes, values stories, and connects with the place where it is born.',
                    'Our symbol brings together references to Recife\'s cultural strength, the sensitivity of Brazilian art, and the meeting of past and present.',
                    'The brand uses <span>fragments of the Marco Zero design</span> to form the landscape of <span>Rua do Bom Jesus</span>, one of the city\'s most emblematic streets. The blue shapes represent the cobblestones, while the colorful shapes represent the historic buildings. The <span>red circle</span> symbolizes Marco Zero itself, the point from which the streets expand and a reference to Recife\'s urban design.',
                    'The two shades of blue refer to the <span>meeting of the Capibaribe and Beberibe rivers</span> before they reach the sea. This union also represents Maribe\'s essence: the meeting of different references, stories, and ways of living — sea and river, saltwater and freshwater, memory and the new.',
                    'The mosaic composition draws inspiration from artists such as <span>Hélio Oiticica</span> and <span>Tarsila do Amaral</span>, and from the richness of Brazilian colors, forms, and references. The palette comes from Recife, while the rounded, organic typography reinforces softness, closeness, and a contemporary character.',
                    'The result is a brand that carries what we also seek in our projects: <span>lightness, personality, and a beauty that welcomes</span>.'
                ],
                'videoLabel' => 'The evolution of the Maribe Arquitetura logo'
            ]
        ],

        // Página Projetos
        'projects' => [
            'title' => 'our projects',
            'metaDescription' => 'Check out our projects, we are sure you will love them!',
            'description' => 'Here you will find a selection of our projects, each one designed to transform houses into homes full of meaning and warmth. We hope you find inspiration and that we can, soon, include your space here too! 🧡',
            'searchPlaceholder' => 'Looking for a specific project or city?',
            'searchPlaceholderMobile' => 'Search a project or city...',
            'noResultsMessage' => 'No projects found with these terms yet...<br>But, what do you think about including yours here?',
            'requestBudget' => 'Request a quote',
            'filtersLabel' => 'Project filters',
            'filterAll' => 'all',
            'filterResidential' => 'residential',
            'filterCommercial' => 'commercial',
            'layoutLabel' => 'Project view',
            'layoutTwoColumns' => 'Two-column view',
            'layoutThreeColumns' => 'Three-column view',
            'detail' => [
                'location' => 'Location',
                'year' => 'Year',
                'type' => 'Type',
                'photosBy' => 'Photos by',
                'backToProjects' => 'Back to projects',
                'shareTitle' => 'Share project',
                'shareWhatsApp' => 'Share on WhatsApp',
                'shareEmail' => 'Share by email',
                'shareNative' => 'Share on device',
                'shareNativeText' => 'Check out this project from maribe arquitetura.',
                'shareWhatsAppMessage' => 'Check out this project: :title - :url',
                'shareEmailSubject' => 'Project: :title',
                'shareEmailBody' => 'Check out this project from maribe arquitetura:\n\n:title\n:description\n\n:url'
            ]
        ],

        // Accessibility Widget
        'accessibilityWidget' => [
            'dialogLabel' => 'Accessibility settings',
            'title' => 'Accessibility',
            'description' => 'Adjust the page in real time so it feels more comfortable for you.',
            'openLabel' => 'Open accessibility menu',
            'openTitle' => 'Accessibility',
            'close' => 'Close accessibility menu',
            'reset' => 'Restore default settings',
            'helpOpen' => 'Understand accessibility options',
            'helpDialogLabel' => 'Accessibility help',
            'helpTitle' => 'How each option works',
            'helpDescription' => 'See what each feature changes on the page.',
            'helpClose' => 'Close help',
            'sections' => [
                'textSize' => 'Text size',
                'contrast' => 'Contrast',
                'links' => 'Links',
                'focus' => 'Keyboard focus',
                'motion' => 'Reduce animations',
                'letterSpacing' => 'Letter spacing',
                'lineHeight' => 'Line spacing'
            ],
            'options' => [
                'textSizeLarge' => 'Larger',
                'textSizeLarger' => 'Largest',
                'contrastHigh' => 'High',
                'contrastSoft' => 'Soft',
                'linksHighlighted' => 'Highlighted',
                'focusStrong' => 'Strong',
                'motionReduced' => 'Reduced',
                'letterSpacingWide' => 'Wider',
                'letterSpacingWider' => 'Widest',
                'lineHeightRelaxed' => 'Relaxed',
                'lineHeightSpacious' => 'Spacious'
            ],
            'help' => [
                'helpClose' => 'Close help',
                'items' => [
                    'textSize' => [
                        'description' => 'Increases text size to make reading more comfortable.',
                        'levels' => [
                            'large' => 'Applies the first level of text increase.',
                            'larger' => 'Applies a second level with even larger text.'
                        ]
                    ],
                    'contrast' => [
                        'description' => 'Changes page contrast to improve visual comfort.',
                        'levels' => [
                            'high' => 'Creates stronger separation between background and content.',
                            'soft' => 'Creates a softer contrast for a lighter visual effect.'
                        ]
                    ],
                    'links' => [
                        'description' => 'Highlights links so clickable points are easier to notice.',
                        'levels' => [
                            'highlighted' => 'Underlines and visually reinforces links on the page.'
                        ]
                    ],
                    'focus' => [
                        'description' => 'Makes keyboard focus more visible during navigation.',
                        'levels' => [
                            'strong' => 'Shows a stronger outline on the selected element.'
                        ]
                    ],
                    'motion' => [
                        'description' => 'Reduces transitions and interface animations.',
                        'levels' => [
                            'reduced' => 'Decreases movement effects that may cause discomfort.'
                        ]
                    ],
                    'letterSpacing' => [
                        'description' => 'Adds more space between letters to improve reading.',
                        'levels' => [
                            'wide' => 'Applies a moderate increase in letter spacing.',
                            'wider' => 'Applies a stronger increase in letter spacing.'
                        ]
                    ],
                    'lineHeight' => [
                        'description' => 'Adds more space between lines of text.',
                        'levels' => [
                            'relaxed' => 'Applies a moderate increase in line spacing.',
                            'spacious' => 'Applies a stronger increase in line spacing.'
                        ]
                    ]
                ]
            ],
            'announcements' => [
                'preferencesUpdated' => 'Accessibility preferences were updated.',
                'preferencesReset' => 'Accessibility preferences were restored.'
            ]
        ],

        // Footer
        'footer' => [
            'socialMedia' => 'social media',
            'contactEmail' => 'contact@maribearquitetura.com.br',
            'businessHours' => 'Monday to Friday 8am to 7pm<br>Saturday 8am to 12pm',
            'rights' => 'all rights reserved',
            'madeBy' => 'made with 🧡 by marcos tavares',
            'privacyPolicy' => 'privacy policy'
        ],

        // 404 Page
        'notFound' => [
            'title' => 'page not found',
            'metaDescription' => 'The page you are looking for was not found.',
            'heading' => 'page not found',
            'description' => 'The page you searched for may not exist or be under maintenance. You can try again or see our projects in the button below.',
            'viewProjects' => 'View projects'
        ],

        // Privacy Policy Page
        'privacy' => [
            'title' => 'privacy policy',
            'metaDescription' => 'Maribe Arquitetura privacy policy. Learn how we collect, use, and protect your personal information.',
            'description' => 'We value the trust you place in us and are committed to protecting your privacy and personal data. This Privacy Policy describes how we collect, use, and protect your information while you browse our website.',
            'lastUpdate' => 'Last updated',
            'sections' => [
                'collection' => [
                    'title' => 'Information Collection',
                    'intro' => 'Maribe Arquitetura uses cookies and similar technologies to improve your browsing experience. You can choose which types of cookies you wish to accept through our cookie manager.',
                    'cookieTypes' => 'Types of Cookies Used:',
                    'essential' => [
                        'title' => 'Essential Cookies (Required)',
                        'description' => 'Necessary for the basic functioning of the website. Include security tokens (CSRF) for form protection and temporary sessions. These cookies cannot be disabled, as they are essential for the security and functioning of the website.'
                    ],
                    'functional' => [
                        'title' => 'Functionality Cookies',
                        'description' => 'Allow the website to remember your preferences, such as the chosen language (Portuguese, English, or Spanish), for a period of 1 week. These cookies improve your experience by avoiding the need to choose the language again on each visit.'
                    ],
                    'important' => 'Important:',
                    'importantText' => 'We do not collect your IP address, information about your browser, or personally identifiable data through cookies. The data collected is used exclusively to improve the website functionality and your browsing experience.',
                    'management' => 'You can manage your cookie preferences at any time through our cookie manager, available at the bottom of the page. It is also possible to disable cookies through your browser settings, however, this may affect the performance and some functionalities of our website.'
                ],
                'usage' => [
                    'title' => 'Use of Information',
                    'intro' => 'The information collected is used to:',
                    'items' => [
                        'Ensure the security and proper functioning of the platform (CSRF tokens, sessions);',
                        'Remember your language preferences to improve your browsing experience;',
                        'Improve the usability and functionality of the website;',
                        'Comply with legal obligations and protect Maribe Arquitetura in case of malicious activity.'
                    ],
                    'sharing' => 'We do not share your personal information with third parties, except in cases required by law or to protect our rights.'
                ],
                'security' => [
                    'title' => 'Data Security',
                    'paragraph1' => 'The protection of your data is a priority for Maribe Arquitetura. We implement appropriate security measures to ensure that your information is secure and protected against unauthorized access, alteration, disclosure, or destruction.',
                    'paragraph2' => 'Access to the personal data provided is restricted to authorized employees and all of them are committed to maintaining the confidentiality of this information.'
                ],
                'externalLinks' => [
                    'title' => 'Links to External Sites',
                    'description' => 'Our website may contain links to external sites that are not operated by us. These links are provided for your convenience, but we have no control over the content or privacy practices of these sites. We recommend that you read the privacy policies of any external site you visit, as we are not responsible for any damages or losses resulting from the use of these links.'
                ],
                'responsibility' => [
                    'title' => 'Responsibility and Digital Crimes',
                    'description' => 'Maribe Arquitetura reserves the right to monitor and record suspicious activities that may indicate the commission of digital crimes, such as fraud, intrusions, and other illegal acts. In case of illegal activities, we may share information with the competent authorities for proper investigation.'
                ],
                'intellectual' => [
                    'title' => 'Intellectual Property',
                    'description' => 'All content on our website, including texts, images, graphics, and other materials, is protected by intellectual property laws. Unauthorized use of any part of this content may result in legal action. Reproduction of any material without prior authorization is expressly prohibited.'
                ],
                'changes' => [
                    'title' => 'Changes to this Policy',
                    'description' => 'Maribe Arquitetura may update this Privacy Policy periodically to reflect improvements on our website or changes in applicable regulations. Whenever there are significant modifications, you will be informed through our website or other communication channels.'
                ]
            ]
        ],

        // Página Proposta
        'proposal' => [
            'title' => 'proposal form',
            'description' => [
                'We are very happy with your contact, <strong>it will be a pleasure to make this partnership with you</strong>!',
                'So that we can help you make this dream come true, we need you to answer some questions so we can better understand what you need.'
            ],
            'form' => [
                'name' => 'Full name',
                'namePlaceholder' => 'Enter your name here',
                'address' => 'Property address',
                'addressPlaceholder' => 'E.g.: Street/Av. X, 123, Neighborhood, City/State',
                'mostImportant' => 'What is most important to you in this project budget process?',
                'mostImportantPlaceholder' => 'Tell us here',
                'hasBlueprint' => 'In the case of interior design projects, does the property have a floor plan?',
                'yes' => 'Yes',
                'no' => 'No',
                'apartmentComplete' => 'Complete apartment? If not, how many and which rooms?',
                'apartmentCompletePlaceholder' => 'E.g.: 2, living room and master bedroom',
                'residents' => 'How many people live in the property and what are their ages?',
                'residentsPlaceholder' => 'E.g.: 3 people, 30 and 28 years old',
                'size' => 'What is the size (in m²)?',
                'sizePlaceholder' => 'E.g.: 60m²',
                'demolition' => 'Will there be demolition/construction of walls?',
                'electrical' => 'Will you modify electrical?',
                'plaster' => 'Will you modify plaster?',
                'finishing' => 'Will you modify finishing or countertops?',
                'furniture' => 'Will you reuse and/or modify any existing furniture?',
                'carpentry' => 'Do you plan to make furniture with carpentry or custom-made?',
                'additionalInfo' => 'If you have any questions or additional information, comment here!',
                'additionalInfoPlaceholder' => 'Your questions and other information go here :)',
                'privacy' => 'I agree to the submission of data according to the <a href=":privacyUrl">privacy policy</a> of Maribe Arquitetura.',
                'submit' => 'Request a quote'
            ]
        ],

        // Página Contrato
        'contract' => [
            'title' => 'contract form',
            'metaDescription' => 'Fill in the necessary data for contract completion and organization of the office internal management.',
            'description' => 'This data is necessary for filling out the contract and organizing the internal management of the office.',
            'form' => [
                'name' => 'Full name',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'cpf' => 'CPF',
                'cpfPlaceholder' => 'Numbers only. E.g.: 12345678900',
                'rg' => 'RG',
                'rgPlaceholder' => 'Numbers only. E.g.: 1234567',
                'projectAddress' => 'Complete project address',
                'projectAddressPlaceholder' => 'E.g.: Street/Av. X, 123, Neighborhood, City/State',
                'clientAddress' => 'Address where you reside',
                'clientAddressPlaceholder' => 'E.g.: Street/Av. X, 123, Neighborhood, City/State',
                'birthDate' => 'Date of birth',
                'paymentMethod' => 'What is the chosen payment method?',
                'paymentMethodPlaceholder' => 'Cash; Down payment + \'x\' installments...',
                'paymentMethodExamples' => 'Examples: "Down payment of BRL 3,000 and the rest on card" or "Paid in installments on the card".',
                'submit' => 'Send message',
                'dataExplanation' => 'Why do we need this data?',
                'dataExplanationText' => 'CPF, RG, and address data are necessary for the correct completion of the contract and for organizing the internal management of the office. This information is essential to ensure the proper formalization of the agreement between the parties.'
            ]
        ],

        // Página Sucesso
        'success' => [
            'title' => 'message sent',
            'metaDescription' => 'Your message has been sent successfully! We thank you for your contact and will respond as soon as possible.',
            'heading' => 'thank you for your contact!',
            'message' => 'Your message has been sent and we will respond as soon as possible. Meanwhile, <a href=":projectsUrl">click here</a> to see some of our projects.'
        ]
    ],

    'es' => [
        // Menú de navegación
        'menu' => [
            'home' => 'inicio',
            'about' => 'sobre',
            'projects' => 'proyectos',
            'budget' => 'presupuesto',
            'contact' => 'contacto',
            'navigation' => 'Navegación',
            'selectLanguage' => 'Seleccionar idioma',
            'openMenu' => 'Abrir menú de navegación'
        ],

        // Página Home
        'home' => [
            'title' => 'inicio',
            'metaDescription' => 'Maribe Arquitetura es un estudio de arquitectura y urbanismo con sede en Recife, Pernambuco, enfocado en arquitectura residencial, arquitectura comercial y consultorías.'
        ],

        // Popup de Cookies
        'cookiePopup' => [
            'title' => 'Gestionar Cookies 🍪',
            'description' => 'Utilizamos cookies y tecnologías similares para mejorar tu experiencia de navegación. Puedes elegir qué tipos de cookies deseas aceptar.',
            'essential' => [
                'title' => 'Cookies Esenciales',
                'required' => '(Obligatorio)',
                'description' => 'Necesarios para el funcionamiento básico del sitio web. Incluyen seguridad (tokens CSRF) y sesiones.'
            ],
            'functional' => [
                'title' => 'Cookies de Funcionalidad',
                'description' => 'Permiten que el sitio web recuerde tus preferencias, como el idioma elegido, para mejorar tu experiencia.'
            ],
            'privacyPolicy' => 'Política de Privacidad',
            'acceptAll' => 'Aceptar todos',
            'savePreferences' => 'Guardar preferencias'
        ],

        // Página de Contacto
        'contact' => [
            'title' => 'contacto',
            'metaDescription' => '¿Te gustaría conversar? Envíanos un mensaje en esta página.',
            'description' => [
                'Estamos aquí para conversar contigo.',
                'Ya sea para dudas generales, mensajes, alianzas o algún asunto específico, este canal es el más adecuado.<br><br>Si tu intención es solicitar un proyecto, presupuesto o propuesta, recomendamos acceder a las páginas dedicadas — así podremos atenderte con aún más cuidado.'
            ],
            'form' => [
                'name' => 'Nombre completo',
                'namePlaceholder' => 'Escribe tu nombre aquí',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Teléfono',
                'phoneHint' => 'Solo números, ¿de acuerdo? ¡No olvides incluir el código de área!',
                'phonePlaceholder' => '00 123456789',
                'subject' => 'Asunto',
                'subjectPlaceholder' => 'Seleccione el asunto',
                'subjectOptions' => [
                    'duvidasProjetos' => 'Dudas sobre proyectos',
                    'consultoria' => 'Consultoría',
                    'parcerias' => 'Alianzas y colaboraciones',
                    'informacoes' => 'Información general',
                    'outros' => 'Otros'
                ],
                'subjectOtherPlaceholder' => 'Describa el asunto',
                'message' => 'Mensaje',
                'messagePlaceholder' => 'Escribe tu mensaje aquí',
                'privacy' => 'Acepto el envío de datos de acuerdo con la <a href=":privacyUrl">política de privacidad</a> de Maribe Arquitetura.',
                'submit' => 'Enviar mensaje'
            ],
            'contactInfo' => [
                'preferOtherContact' => '¿prefieres contactarnos de otra manera?',
                'businessHours' => 'horarios de atención'
            ]
        ],

        // Toast
        'toast' => [
            'test' => [
                'success' => 'Probar Toast de Éxito',
                'error' => 'Probar Toast de Error'
            ],
            'success' => [
                'title' => '¡Éxito!',
                'message' => '¡Mensaje enviado con éxito! Nos pondremos en contacto pronto.'
            ],
            'error' => [
                'title' => '¡Error!',
                'message' => 'Ocurrió un error al enviar tu mensaje. Por favor, inténtalo de nuevo.'
            ]
        ],

        // Validaciones
        'validation' => [
            'required' => 'Este campo es obligatorio.',
            'email' => 'Por favor, introduce un e-mail válido.',
            'phone' => 'Por favor, introduce un número de teléfono válido.',
            'cpf' => 'CPF inválido. Por favor, revisa los dígitos informados.',
            'rg' => 'RG inválido. Revisa los dígitos informados.',
            'privacy' => 'Debes aceptar la política de privacidad.',
            'formError' => 'Por favor, corrige los errores del formulario antes de enviar.',
            'subjectOther' => 'Por favor, describe el asunto (mínimo 3 caracteres).',
            'minLength' => 'Este campo debe tener al menos :min caracteres.',
            'maxLength' => 'Este campo debe tener como máximo :max caracteres.',
            'numericGreaterThanZero' => 'Por favor, introduce un valor numérico válido mayor que cero.',
            'selectOption' => 'Por favor, selecciona una opción.',
            'submitGenericError' => 'Hubo un error al enviar el formulario. Por favor, inténtalo de nuevo.'
        ],

        // Página de Presupuesto
        'budget' => [
            'title' => '¡vamos a empezar tu proyecto juntos!',
            'metaDescription' => 'En esta página podrás solicitar el presupuesto inicial de tu proyecto con Maribe Arquitetura.',
            'description' => [
                '<strong>Vamos a empezar tu proyecto con cuidado y atención.</strong>',
                'En Maribe, cada espacio se piensa a partir de tu historia, rutina y personalidad — <strong>porque creemos que un hogar necesita reflejar quién eres</strong>. Para preparar un presupuesto alineado con tus necesidades, te pedimos que completes el formulario a continuación con algunas informaciones importantes.',
                'Estamos aquí para orientar cada etapa con cariño y profesionalismo. Será un placer crear contigo. 🧡'
            ],
            'form' => [
                'name' => 'Nombre completo',
                'namePlaceholder' => 'Escribe tu nombre aquí',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'phone' => 'Teléfono',
                'phoneHint' => 'Solo números, ¿de acuerdo? ¡No olvides incluir el código de área!',
                'phonePlaceholder' => '00 123456789',
                'howYouFoundUs' => '¿Cómo nos encontraste?',
                'howYouFoundUsOptions' => [
                    'instagram' => 'Instagram',
                    'indicacao' => 'Recomendación de conocidos',
                    'visitaAProjetado' => 'Visité un espacio diseñado por ustedes'
                ],
                'whatAreWeWorkingOn' => '¿Qué vamos a diseñar?',
                'whatAreWeWorkingOnOptions' => [
                    'interioresResidencialCompleto' => 'Proyecto de interiores residenciales completo',
                    'interioresAlgunsAmbientes' => 'Interiores para algunos ambientes',
                    'interioresComercialCompleto' => 'Proyecto de interiores comerciales completo',
                    'projetoDeArquitetura' => 'Proyecto de arquitectura'
                ],
                'whenToBeginTheProject' => '¿Cuándo prevés iniciar el proyecto?',
                'whenToBeginTheProjectOptions' => [
                    'escolhendoMeuNovoLar' => 'Estoy en el proceso de elegir mi nuevo hogar',
                    'aguardandoAsChaves' => 'Estoy esperando las llaves, ¡no veo la hora!',
                    'estouSemPressa' => 'No tengo prisa. Sigamos el ritmo natural',
                    'estouApressado' => 'Tengo un poco de prisa y me gustaría agilizar las cosas'
                ],
                'objective' => '¿Cuál es tu objetivo con este proyecto?',
                'objectivePlaceholder' => 'Cuéntanos aquí...',
                'objectiveHint' => 'Describe los cambios que pretendes hacer en tu espacio, lo que planeas construir y el nivel de intervención necesario, en caso de reformas.',
                'privacy' => 'Acepto el envío de datos de acuerdo con la <a href=":privacyUrl">política de privacidad</a> de Maribe Arquitetura.',
                'submit' => 'Enviar mensaje'
            ]
        ],

        // Página Sobre
        'about' => [
            'title' => 'quiénes somos',
            'metaDescription' => 'Conoce Maribe Arquitetura, su historia, su mirada y a Nathalia Ribeiro, la arquitecta al frente del estudio.',
            'about' => [
                'title' => 'sobre Maribe',
                'paragraphs' => [
                    'Maribe es un estudio de arquitectura que <span>cree que los buenos espacios comienzan con la escucha</span>.',
                    'Cada proyecto nace de comprender a quienes lo vivirán: su rutina, sus necesidades, sus referencias y la manera particular en que desean sentirse en ese lugar.',
                    'Maribe nació en Recife y, a lo largo de su trayectoria, construyó una forma sensible y cercana de entender la arquitectura.',
                    'Hoy, Maribe inicia un nuevo capítulo bajo la dirección de Nathalia Ribeiro, preservando su esencia mientras construye nuevos caminos, referencias y posibilidades.',
                    'Más que un nombre, <span>Maribe se convirtió en una identidad</span>.'
                ]
            ],
            'leadership' => [
                'title' => 'al frente de Maribe',
                'name' => 'Nathalia Ribeiro',
                'paragraphs' => [
                    'Arquitecta y urbanista por la UNICAP, Nathalia cuenta con experiencia en arquitectura de interiores, proyectos comerciales y diseño gráfico.',
                    'Apasionada por la carpintería y por las soluciones prácticas y bien detalladas, <span>entiende el proyecto como un ejercicio de equilibrio entre estética, funcionalidad y la manera en que cada persona vive sus espacios</span>.',
                    'Al frente de Maribe, acompaña de cerca todas las etapas del proceso, transformando necesidades, referencias e historias en ambientes con personalidad y propósito.'
                ],
                'imageAlt' => 'Nathalia Ribeiro, arquitecta al frente de Maribe'
            ],
            'perspective' => [
                'title' => 'nuestra mirada',
                'paragraphs' => [
                    'Para nosotras, la arquitectura no consiste únicamente en crear ambientes bonitos.',
                    'Es comprender rutinas, percibir detalles y encontrar soluciones que tengan sentido para quienes viven cada espacio.',
                    'Nos gustan los proyectos con identidad sin perder funcionalidad; contemporáneos sin volverse impersonales; y pensados para ser vividos de verdad.',
                    'Cada proyecto de Maribe nace de una historia diferente — <span>y es precisamente eso lo que hace único cada resultado</span>.'
                ]
            ],
            'brand' => [
                'title' => 'nuestra marca',
                'paragraphs' => [
                    'La identidad visual de Maribe refleja aquello en lo que creemos: una arquitectura que acoge, valora historias y se conecta con el lugar donde nace.',
                    'Nuestro símbolo reúne referencias de la fuerza cultural de Recife, la sensibilidad de las artes brasileñas y el encuentro entre pasado y presente.',
                    'La marca utiliza <span>recortes del diseño del Marco Zero</span> para formar el paisaje de la <span>Rua do Bom Jesus</span>, una de las calles más emblemáticas de la ciudad. Las formas azules representan los adoquines; las formas coloridas, los edificios históricos. El <span>círculo rojo</span> simboliza el propio Marco, punto desde el que se expanden las calles y referencia al urbanismo de Recife.',
                    'Los dos tonos de azul aluden al <span>encuentro de las aguas del Capibaribe y el Beberibe</span> antes de llegar al mar. Esta unión también representa la esencia de Maribe: el encuentro entre diferentes referencias, historias y formas de vivir — del mar con el río, de lo salado con lo dulce, de la memoria con lo nuevo.',
                    'La composición en mosaico encuentra inspiración en artistas como <span>Hélio Oiticica</span> y <span>Tarsila do Amaral</span> y en la riqueza de los colores, formas y referencias brasileñas. La paleta nace de Recife, mientras que la tipografía redondeada y orgánica refuerza suavidad, cercanía y contemporaneidad.',
                    'El resultado es una marca que lleva aquello que también buscamos en nuestros proyectos: <span>ligereza, personalidad y una belleza que acoge</span>.'
                ],
                'videoLabel' => 'Historia de la evolución del logo de Maribe Arquitetura'
            ]
        ],

        // Página Proyectos
        'projects' => [
            'title' => 'nuestros proyectos',
            'metaDescription' => '¡Consulta nuestros proyectos, estamos seguros de que te encantarán!',
            'description' => 'Aquí encontrarás una selección de nuestros proyectos, cada uno pensado para transformar casas en hogares llenos de significado y calidez. ¡Esperamos que te inspires y que pronto podamos incluir tu espacio aquí también! 🧡',
            'searchPlaceholder' => '¿Buscas un proyecto o ciudad específicos?',
            'searchPlaceholderMobile' => 'Busca un proyecto o ciudad...',
            'noResultsMessage' => 'Aún no se encontraron proyectos con estos términos...<br>Pero, ¿qué piensas de incluir el tuyo aquí?',
            'requestBudget' => 'Solicitar presupuesto',
            'filtersLabel' => 'Filtros de proyectos',
            'filterAll' => 'todos',
            'filterResidential' => 'residencial',
            'filterCommercial' => 'comercial',
            'layoutLabel' => 'Visualización de proyectos',
            'layoutTwoColumns' => 'Visualización en dos columnas',
            'layoutThreeColumns' => 'Visualización en tres columnas',
            'detail' => [
                'location' => 'Ubicación',
                'year' => 'Año',
                'type' => 'Tipo',
                'photosBy' => 'Fotos por',
                'backToProjects' => 'Volver a los proyectos',
                'shareTitle' => 'Compartir proyecto',
                'shareWhatsApp' => 'Compartir en WhatsApp',
                'shareEmail' => 'Compartir por correo',
                'shareNative' => 'Compartir en el dispositivo',
                'shareNativeText' => 'Mira este proyecto de maribe arquitetura.',
                'shareWhatsAppMessage' => 'Mira este proyecto: :title - :url',
                'shareEmailSubject' => 'Proyecto: :title',
                'shareEmailBody' => 'Mira este proyecto de maribe arquitetura:\n\n:title\n:description\n\n:url'
            ],
            'altText' => [
                'projectCover' => 'Portada del proyecto :title',
                'projectCoverWithCity' => 'Portada del proyecto :title en :city',
                'projectImage' => 'Imagen del proyecto :title',
                'projectImageNumber' => 'Imagen :number de :total del proyecto :title',
                'logo' => 'Logo de Maribe Arquitetura',
                'logoHome' => 'Logo de Maribe Arquitetura - Página de inicio'
            ],
            'lightbox' => [
                'imageCount' => 'Imagen %1 de %2',
                'previousImage' => 'Imagen anterior',
                'nextImage' => 'Siguiente imagen'
            ],
            'ariaLabels' => [
                'viewProjectDetails' => 'Ver detalles del proyecto :title',
                'viewProjectDetailsWithCity' => 'Ver detalles del proyecto :title en :city',
                'projectArticle' => 'Proyecto :title'
            ]
        ],

        // Scroll to Top
        'scrollToTop' => [
            'label' => 'Volver arriba',
            'title' => 'Volver arriba'
        ],

        // Accessibility Widget
        'accessibilityWidget' => [
            'dialogLabel' => 'Configuraciones de accesibilidad',
            'title' => 'Accesibilidad',
            'description' => 'Ajusta la página en tiempo real para que te resulte más cómoda.',
            'openLabel' => 'Abrir menú de accesibilidad',
            'openTitle' => 'Accesibilidad',
            'close' => 'Cerrar menú de accesibilidad',
            'reset' => 'Restaurar configuración original',
            'helpOpen' => 'Entender las opciones de accesibilidad',
            'helpDialogLabel' => 'Ayuda de accesibilidad',
            'helpTitle' => 'Cómo funciona cada opción',
            'helpDescription' => 'Mira qué cambia cada recurso en la página.',
            'helpClose' => 'Cerrar ayuda',
            'sections' => [
                'textSize' => 'Tamaño del texto',
                'contrast' => 'Contraste',
                'links' => 'Enlaces',
                'focus' => 'Foco con teclado',
                'motion' => 'Reducir animaciones',
                'letterSpacing' => 'Espaciado de letras',
                'lineHeight' => 'Espaciado de líneas'
            ],
            'options' => [
                'textSizeLarge' => 'Mayor',
                'textSizeLarger' => 'Aún mayor',
                'contrastHigh' => 'Alto',
                'contrastSoft' => 'Suave',
                'linksHighlighted' => 'Destacados',
                'focusStrong' => 'Reforzado',
                'motionReduced' => 'Reducidas',
                'letterSpacingWide' => 'Mayor',
                'letterSpacingWider' => 'Aún mayor',
                'lineHeightRelaxed' => 'Mayor',
                'lineHeightSpacious' => 'Aún mayor'
            ],
            'help' => [
                'helpClose' => 'Cerrar ayuda',
                'items' => [
                    'textSize' => [
                        'description' => 'Aumenta el tamaño del texto para que la lectura sea más cómoda.',
                        'levels' => [
                            'large' => 'Aplica el primer nivel de aumento del texto.',
                            'larger' => 'Aplica un segundo nivel con texto aún mayor.'
                        ]
                    ],
                    'contrast' => [
                        'description' => 'Cambia el contraste de la página para mejorar la comodidad visual.',
                        'levels' => [
                            'high' => 'Crea una separación más fuerte entre el fondo y el contenido.',
                            'soft' => 'Crea un contraste más suave y liviano.'
                        ]
                    ],
                    'links' => [
                        'description' => 'Destaca los enlaces para identificar mejor los puntos clicables.',
                        'levels' => [
                            'highlighted' => 'Subraya y refuerza visualmente los enlaces de la página.'
                        ]
                    ],
                    'focus' => [
                        'description' => 'Hace más visible el foco del teclado durante la navegación.',
                        'levels' => [
                            'strong' => 'Muestra un contorno más fuerte en el elemento seleccionado.'
                        ]
                    ],
                    'motion' => [
                        'description' => 'Reduce transiciones y animaciones de la interfaz.',
                        'levels' => [
                            'reduced' => 'Disminuye movimientos que puedan causar incomodidad.'
                        ]
                    ],
                    'letterSpacing' => [
                        'description' => 'Añade más espacio entre letras para facilitar la lectura.',
                        'levels' => [
                            'wide' => 'Aplica un aumento moderado del espaciado entre letras.',
                            'wider' => 'Aplica un aumento más fuerte del espaciado entre letras.'
                        ]
                    ],
                    'lineHeight' => [
                        'description' => 'Añade más espacio entre las líneas del texto.',
                        'levels' => [
                            'relaxed' => 'Aplica un aumento moderado del espaciado entre líneas.',
                            'spacious' => 'Aplica un aumento más fuerte del espaciado entre líneas.'
                        ]
                    ]
                ]
            ],
            'announcements' => [
                'preferencesUpdated' => 'Las preferencias de accesibilidad fueron actualizadas.',
                'preferencesReset' => 'Las preferencias de accesibilidad volvieron al valor original.'
            ]
        ],

        // Footer
        'footer' => [
            'socialMedia' => 'redes sociales',
            'contactEmail' => 'contacto@maribearquitetura.com.br',
            'businessHours' => 'Lunes a Viernes de 8h a 19h<br>Sábado de 8h a 12h',
            'rights' => 'todos los derechos reservados',
            'madeBy' => 'hecho con 🧡 por marcos tavares',
            'privacyPolicy' => 'política de privacidad'
        ],

        // Página 404
        'notFound' => [
            'title' => 'página no encontrada',
            'metaDescription' => 'La página que estás buscando no fue encontrada.',
            'heading' => 'página no encontrada',
            'description' => 'La página que buscaste puede no existir o estar en mantenimiento. Puedes intentar de nuevo o ver nuestros proyectos en el botón de abajo.',
            'viewProjects' => 'Ver proyectos'
        ],

        // Página Política de Privacidad
        'privacy' => [
            'title' => 'política de privacidad',
            'metaDescription' => 'Política de privacidad de Maribe Arquitetura. Conoce cómo recopilamos, usamos y protegemos tu información personal.',
            'description' => 'Valoramos la confianza que depositas en nosotros y estamos comprometidos a proteger tu privacidad y datos personales. Esta Política de Privacidad describe cómo recopilamos, usamos y protegemos tu información mientras navegas por nuestro sitio web.',
            'lastUpdate' => 'Última actualización',
            'sections' => [
                'collection' => [
                    'title' => 'Recopilación de Información',
                    'intro' => 'Maribe Arquitetura utiliza cookies y tecnologías similares para mejorar tu experiencia de navegación. Puedes elegir qué tipos de cookies deseas aceptar a través de nuestro gestor de cookies.',
                    'cookieTypes' => 'Tipos de Cookies Utilizados:',
                    'essential' => [
                        'title' => 'Cookies Esenciales (Obligatorios)',
                        'description' => 'Necesarios para el funcionamiento básico del sitio web. Incluyen tokens de seguridad (CSRF) para protección de formularios y sesiones temporales. Estas cookies no pueden desactivarse, ya que son esenciales para la seguridad y funcionamiento del sitio web.'
                    ],
                    'functional' => [
                        'title' => 'Cookies de Funcionalidad',
                        'description' => 'Permiten que el sitio web recuerde tus preferencias, como el idioma elegido (portugués, inglés o español), por un período de 1 semana. Estas cookies mejoran tu experiencia al evitar que necesites elegir el idioma nuevamente en cada visita.'
                    ],
                    'important' => 'Importante:',
                    'importantText' => 'No recopilamos tu dirección IP, información sobre tu navegador o datos personales identificables a través de cookies. Los datos recopilados se utilizan exclusivamente para mejorar la funcionalidad del sitio web y tu experiencia de navegación.',
                    'management' => 'Puedes gestionar tus preferencias de cookies en cualquier momento a través de nuestro gestor de cookies, disponible en la parte inferior de la página. También es posible desactivar las cookies a través de la configuración de tu navegador, sin embargo, esto puede afectar el rendimiento y algunas funcionalidades de nuestro sitio web.'
                ],
                'usage' => [
                    'title' => 'Uso de la Información',
                    'intro' => 'La información recopilada se utiliza para:',
                    'items' => [
                        'Garantizar la seguridad y el buen funcionamiento de la plataforma (tokens CSRF, sesiones);',
                        'Recordar tus preferencias de idioma para mejorar tu experiencia de navegación;',
                        'Mejorar la usabilidad y funcionalidad del sitio web;',
                        'Cumplir con obligaciones legales y proteger a Maribe Arquitetura en caso de actividad maliciosa.'
                    ],
                    'sharing' => 'No compartimos tu información personal con terceros, excepto en casos obligatorios por ley o para protección de nuestros derechos.'
                ],
                'security' => [
                    'title' => 'Seguridad de los Datos',
                    'paragraph1' => 'La protección de tus datos es una prioridad para Maribe Arquitetura. Implementamos medidas de seguridad apropiadas para garantizar que tu información esté segura y protegida contra accesos no autorizados, alteración, divulgación o destrucción.',
                    'paragraph2' => 'El acceso a los datos personales proporcionados está restringido a empleados autorizados y todos ellos están comprometidos a mantener la confidencialidad de esta información.'
                ],
                'externalLinks' => [
                    'title' => 'Enlaces a Sitios Externos',
                    'description' => 'Nuestro sitio web puede contener enlaces a sitios externos que no son operados por nosotros. Estos enlaces se proporcionan para tu conveniencia, pero no tenemos control sobre el contenido o las prácticas de privacidad de estos sitios. Recomendamos que leas las políticas de privacidad de cualquier sitio externo que visites, ya que no nos responsabilizamos por daños o pérdidas derivados del uso de estos enlaces.'
                ],
                'responsibility' => [
                    'title' => 'Responsabilidad y Delitos Digitales',
                    'description' => 'Maribe Arquitetura se reserva el derecho de monitorear y registrar actividades sospechosas que puedan indicar la comisión de delitos digitales, como fraudes, intrusiones y otros actos ilícitos. En caso de actividades ilegales, podemos compartir información con las autoridades competentes para la debida investigación.'
                ],
                'intellectual' => [
                    'title' => 'Propiedad Intelectual',
                    'description' => 'Todo el contenido de nuestro sitio web, incluidos textos, imágenes, gráficos y otros materiales, está protegido por leyes de propiedad intelectual. El uso no autorizado de cualquier parte de este contenido puede resultar en acción legal. La reproducción de cualquier material sin autorización previa está expresamente prohibida.'
                ],
                'changes' => [
                    'title' => 'Cambios en esta Política',
                    'description' => 'Maribe Arquitetura puede actualizar esta Política de Privacidad periódicamente para reflejar mejoras en nuestro sitio web o cambios en las regulaciones aplicables. Siempre que haya modificaciones significativas, serás informado a través de nuestro sitio web u otros canales de comunicación.'
                ]
            ]
        ],

        // Página Propuesta
        'proposal' => [
            'title' => 'formulario de propuesta',
            'metaDescription' => 'Formulario de propuesta detallada para presupuesto de proyecto con Maribe Arquitetura.',
            'description' => [
                'Estamos muy felices con tu contacto, <strong>¡será un placer hacer esta alianza contigo</strong>!',
                'Para ayudarte a hacer realidad este sueño, necesitamos que respondas algunas preguntas para entender mejor lo que necesitas.'
            ],
            'form' => [
                'name' => 'Nombre completo',
                'namePlaceholder' => 'Escribe tu nombre aquí',
                'address' => 'Dirección de la propiedad',
                'addressPlaceholder' => 'Ej.: Calle/Av. X, 123, Barrio, Ciudad/Estado',
                'mostImportant' => '¿Qué es lo más importante para ti en este proceso de presupuesto del proyecto?',
                'mostImportantPlaceholder' => 'Cuéntanos aquí',
                'hasBlueprint' => 'En caso de proyecto de interiores, ¿la propiedad tiene plano?',
                'yes' => 'Sí',
                'no' => 'No',
                'apartmentComplete' => '¿Apartamento completo? Si no, ¿cuántos y cuáles ambientes?',
                'apartmentCompletePlaceholder' => 'Ej.: 2, sala y dormitorio principal',
                'residents' => '¿Cuántas personas viven en la propiedad y qué edades tienen?',
                'residentsPlaceholder' => 'Ej.: 3 personas, 30 y 28 años',
                'size' => '¿Cuál es el tamaño (en m²)?',
                'sizePlaceholder' => 'Ej.: 60m²',
                'demolition' => '¿Habrá demolición/construcción de paredes?',
                'electrical' => '¿Modificarás la instalación eléctrica?',
                'plaster' => '¿Modificarás el yeso?',
                'finishing' => '¿Modificarás revestimientos o encimeras?',
                'furniture' => '¿Aprovecharás y/o modificarás algún mueble existente?',
                'carpentry' => '¿Piensas hacer muebles con carpintería o a medida?',
                'additionalInfo' => 'Si tienes alguna duda o información adicional, coméntala aquí.',
                'additionalInfoPlaceholder' => 'Tus dudas e información adicional van aquí :)',
                'privacy' => 'Acepto el envío de datos de acuerdo con la <a href=":privacyUrl">política de privacidad</a> de Maribe Arquitetura.',
                'submit' => 'Enviar mensaje'
            ]
        ],

        // Página Contrato
        'contract' => [
            'title' => 'formulario de contrato',
            'metaDescription' => 'Completa los datos necesarios para el cumplimiento del contrato y la organización de la gestión interna del estudio.',
            'description' => 'Estos datos son necesarios para completar el contrato y organizar la gestión interna del estudio.',
            'form' => [
                'name' => 'Nombre completo',
                'email' => 'E-mail',
                'emailPlaceholder' => 'email@email.com',
                'cpf' => 'CPF',
                'cpfPlaceholder' => 'Solo números. Ej.: 12345678900',
                'rg' => 'RG',
                'rgPlaceholder' => 'Solo números. Ej.: 1234567',
                'projectAddress' => 'Dirección completa del proyecto',
                'projectAddressPlaceholder' => 'Ej.: Calle/Av. X, 123, Barrio, Ciudad/Estado',
                'clientAddress' => 'Dirección donde reside',
                'clientAddressPlaceholder' => 'Ej.: Calle/Av. X, 123, Barrio, Ciudad/Estado',
                'birthDate' => 'Fecha de nacimiento',
                'paymentMethod' => '¿Cuál es la forma de pago elegida?',
                'paymentMethodPlaceholder' => 'Al contado; Anticipo + “x” cuotas...',
                'paymentMethodExamples' => 'Por ejemplo: "Pago inicial de R$ 3.000 y el resto en tarjeta" o "En cuotas con tarjeta".',
                'submit' => 'Enviar mensaje',
                'dataExplanation' => '¿Por qué necesitamos estos datos?',
                'dataExplanationText' => 'Los datos de CPF, RG y dirección son necesarios para el correcto cumplimiento del contrato y para organizar la gestión interna del estudio. Esta información es esencial para garantizar la formalización adecuada del acuerdo entre las partes.'
            ]
        ],

        // Página Sucesso
        'success' => [
            'title' => 'mensaje enviado',
            'metaDescription' => '¡Tu mensaje ha sido enviado con éxito! Agradecemos tu contacto y responderemos lo antes posible.',
            'heading' => '¡agradecemos tu contacto!',
            'message' => 'Tu mensaje ha sido enviado y lo responderemos lo antes posible. Mientras tanto, <a href=":projectsUrl">haz clic aquí</a> para ver algunos de nuestros proyectos.'
        ]
    ]
];
