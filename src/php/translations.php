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
            'contact' => 'contato'
        ],

        // Página de Contato
        'contact' => [
            'title' => 'contato',
            'description' => [
                'Tem alguma assunto para tratar conosco? É por aqui que podemos conversar!',
                'Caso precise de um orçamento, você pode enviar uma mensagem a partir <a href=":budgetUrl">dessa página</a>.'
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
                'subjectPlaceholder' => 'Sobre o que vamos falar?',
                'message' => 'Mensagem',
                'messagePlaceholder' => 'Digite sua mensagem aqui',
                'privacy' => 'Eu concordo com o envio dos dados segundo a <a href=":privacyUrl">política de privacidade</a> da Maribe Arquitetura.',
                'submit' => 'Enviar mensagem'
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
            'privacy' => 'Você deve concordar com a política de privacidade.',
            'formError' => 'Por favor, corrija os erros no formulário antes de enviar.'
        ],

        // Página de Orçamento
        'budget' => [
            'title' => 'vamos começar o seu projeto juntos!',
            'description' => [
                '<strong>Bem-vindo(a) ao nosso mundo de possibilidades</strong>! Estamos ansiosas para criarmos juntos o seu projeto dos sonhos. Cada detalhe será pensado de acordo com a sua personalidade e memórias afetivas, <strong>transformando casas em lares únicos</strong>, cheios de significado e com muito aconchego.',
                'Para que isso seja possível, precisamos de algumas informações para entender melhor suas necessidades, você pode preencher suas informações no formulário a seguir. Esperamos que você ame a jornada conosco! 🧡'
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
                'objective' => 'Qual é o seu objetivo com este projeto? Como podemos te ajudar?',
                'objectivePlaceholder' => 'Nos conte aqui...',
                'objectiveHint' => 'Descreva as mudanças que pretende fazer em seu espaço, o que planeja construir e o nível de intervenção necessário, caso haja reformas.',
                'privacy' => 'Eu concordo com o envio dos dados segundo a <a href=":privacyUrl">política de privacidade</a> da Maribe Arquitetura.',
                'submit' => 'Enviar mensagem'
            ]
        ],

        // Página Sobre
        'about' => [
            'title' => 'quem somos',
            'description' => '<strong>A arquitetura vai além de construir espaços; ela transforma vidas</strong>. Na Maribe Arquitetura, acreditamos no poder de criar ambientes que refletem histórias e emoções. Nossa missão é proporcionar bem-estar, harmonia e personalidade em cada projeto, sempre unindo o funcional ao belo, o novo ao tradicional. <strong>Cada espaço conta uma história, e estamos aqui para ajudar a contar a sua</strong>.',
            'aboutUs' => 'sobre nós',
            'heloisa' => [
                'name' => 'Heloísa Marletti',
                'description' => '<span>Helô</span> é arquiteta e urbanista formada pela Universidade Católica de Pernambuco (UNICAP) e pós-graduanda em <span>Neuroarquitetura</span>. Possui experiência em <span>arquitetura de interiores</span>, <span>arquitetura social</span> e pesquisa na área acadêmica. Adora trabalhar com modelagens e vídeos, trazendo realismo na apresentação dos projetos. Intensa, adora arte, viagens e bons vinhos.'
            ],
            'nathalia' => [
                'name' => 'Nathalia Ribeiro',
                'description' => '<span>Nath</span> é arquiteta e urbanista formada pela Universidade Católica de Pernambuco (UNICAP), com experiência em <span>arquitetura de interiores</span>, <span>projetos comerciais</span> e <span>design gráfico</span>. Apaixonada por marcenaria, faz tudo para deixar os projetos bem detalhados e executivos completos. Adora yoga, atividades ao ar livre e apreciar bons cafés.'
            ],
            'together' => 'Juntas, gerimos a Maribe Arquitetura, sendo responsáveis por todo criativo dos projetos.',
            'ourSymbol' => 'nosso símbolo',
            'symbolDescription1' => 'O conceito do símbolo <span>une a arquitetura e história de Recife</span> à referências a artistas que nós admiramos. Composição em mosaico, inspirada por obras de <span>Hélio Oiticica</span> e <span>Tarsila do Amaral</span>, remete à união do antigo com o novo, referência à nossa linha de trabalho.',
            'symbolDescription2' => 'O símbolo da Maribe utiliza recortes do desenho do <span>Marco Zero</span> para formar a paisagem da <span>Rua do Bom Jesus</span>, eleita a 3ª rua mais bonita do mundo. E faz referência ao urbanismo da cidade com as ruas partindo do Marco, representado pelo círculo vermelho.',
            'symbolDescription3' => 'Formas divididas por dois tons de azul fazem alusão ao encontro das águas. O <span>Rio Capibaribe</span> que encontra com o <span>Rio Beberibe</span> e desemboca no Oceano Atlântico, unindo a água salgada com a doce, o mar com o rio, Marletti com Ribeiro, Maribe!'
        ],

        // Página Projetos
        'projects' => [
            'title' => 'nossos projetos',
            'description' => 'Aqui você encontra alguns dos nossos projetos, esperamos que você goste e que possamos incluir um espaço aqui para o seu projeto no futuro! 🧡'
        ],

        // Footer
        'footer' => [
            'rights' => 'todos os direitos reservados',
            'madeBy' => 'feito com 🧡 por marcos tavares',
            'privacyPolicy' => 'política de privacidade'
        ],

        // Página Proposta
        'proposal' => [
            'title' => 'formulário de proposta',
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
                'submit' => 'Enviar mensagem'
            ]
        ],

        // Página Contrato
        'contract' => [
            'title' => 'formulário de contrato',
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
                'submit' => 'Enviar mensagem'
            ]
        ]
    ],

    'en' => [
        // Menu de navegação
        'menu' => [
            'home' => 'home',
            'about' => 'about',
            'projects' => 'projects',
            'budget' => 'budget',
            'contact' => 'contact'
        ],

        // Página de Contato
        'contact' => [
            'title' => 'contact',
            'description' => [
                'Do you have something to discuss with us? This is where we can talk!',
                'If you need a quote, you can send a message from <a href=":budgetUrl">this page</a>.'
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
                'subjectPlaceholder' => 'What are we going to talk about?',
                'message' => 'Message',
                'messagePlaceholder' => 'Type your message here',
                'privacy' => 'I agree to the submission of data according to the <a href=":privacyUrl">privacy policy</a> of Maribe Arquitetura.',
                'submit' => 'Send message'
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
            'privacy' => 'You must agree to the privacy policy.',
            'formError' => 'Please correct the errors in the form before submitting.'
        ],

        // Página de Orçamento
        'budget' => [
            'title' => "let's start your project together!",
            'description' => [
                '<strong>Welcome to our world of possibilities</strong>! We are excited to create your dream project together. Every detail will be thought according to your personality and affective memories, <strong>transforming houses into unique homes</strong>, full of meaning and coziness.',
                'For this to be possible, we need some information to better understand your needs. You can fill in your information in the form below. We hope you love the journey with us! 🧡'
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
                'objective' => 'What is your goal with this project? How can we help you?',
                'objectivePlaceholder' => 'Tell us here...',
                'objectiveHint' => 'Describe the changes you plan to make in your space, what you plan to build, and the level of intervention needed, if there are renovations.',
                'privacy' => 'I agree to the submission of data according to the <a href=":privacyUrl">privacy policy</a> of Maribe Arquitetura.',
                'submit' => 'Send message'
            ]
        ],

        // Página Sobre
        'about' => [
            'title' => 'who we are',
            'description' => '<strong>Architecture goes beyond building spaces; it transforms lives</strong>. At Maribe Arquitetura, we believe in the power of creating environments that reflect stories and emotions. Our mission is to provide well-being, harmony, and personality in each project, always combining the functional with the beautiful, the new with the traditional. <strong>Every space tells a story, and we are here to help tell yours</strong>.',
            'aboutUs' => 'about us',
            'heloisa' => [
                'name' => 'Heloísa Marletti',
                'description' => '<span>Helô</span> is an architect and urban planner graduated from the Catholic University of Pernambuco (UNICAP) and a postgraduate student in <span>Neuroarchitecture</span>. She has experience in <span>interior architecture</span>, <span>social architecture</span>, and academic research. She loves working with modeling and videos, bringing realism to project presentations. Intense, she loves art, travel, and good wine.'
            ],
            'nathalia' => [
                'name' => 'Nathalia Ribeiro',
                'description' => '<span>Nath</span> is an architect and urban planner graduated from the Catholic University of Pernambuco (UNICAP), with experience in <span>interior architecture</span>, <span>commercial projects</span>, and <span>graphic design</span>. Passionate about woodworking, she does everything to make projects well-detailed and complete executive plans. She loves yoga, outdoor activities, and enjoying good coffee.'
            ],
            'together' => 'Together, we manage Maribe Arquitetura, being responsible for all the creative aspects of the projects.',
            'ourSymbol' => 'our symbol',
            'symbolDescription1' => 'The symbol concept <span>unites the architecture and history of Recife</span> with references to artists we admire. Mosaic composition, inspired by works by <span>Hélio Oiticica</span> and <span>Tarsila do Amaral</span>, refers to the union of old and new, a reference to our line of work.',
            'symbolDescription2' => 'The Maribe symbol uses cutouts from the <span>Marco Zero</span> drawing to form the landscape of <span>Rua do Bom Jesus</span>, elected the 3rd most beautiful street in the world. And it references the city\'s urbanism with streets starting from the Marco, represented by the red circle.',
            'symbolDescription3' => 'Forms divided by two shades of blue allude to the meeting of waters. The <span>Capibaribe River</span> meets the <span>Beberibe River</span> and flows into the Atlantic Ocean, uniting salt water with fresh water, the sea with the river, Marletti with Ribeiro, Maribe!'
        ],

        // Página Projetos
        'projects' => [
            'title' => 'our projects',
            'description' => 'Here you can find some of our projects. We hope you like them and that we can include a space here for your project in the future! 🧡'
        ],

        // Footer
        'footer' => [
            'rights' => 'all rights reserved',
            'madeBy' => 'made with 🧡 by marcos tavares',
            'privacyPolicy' => 'privacy policy'
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
                'submit' => 'Send message'
            ]
        ],

        // Página Contrato
        'contract' => [
            'title' => 'contract form',
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
                'submit' => 'Send message'
            ]
        ]
    ],

    // Espanhol será adicionado depois
    'es' => [
        // Placeholder - será preenchido depois
    ]
];
