# Relatorio de viabilidade: componente de acessibilidade

## Objetivo

Avaliar o quao preparada esta a base atual da Maribe Arquitetura para receber um componente proprio de acessibilidade com:

- gatilho flutuante ao rolar a pagina
- integracao visual com o botao atual de voltar ao topo
- painel/modal com alteracoes em tempo real, sem refresh
- persistencia local das preferencias do visitante

## Conclusao executiva

Sim, a implementacao e viavel.

O projeto esta razoavelmente bem preparado para isso porque ja possui:

- arquitetura multipagina com componentes compartilhados em `includes/`
- comportamento desacoplado em `src/js/`
- estilos compartilhados em `styles/shared/`
- tokens de cor em `styles/shared/variables.css`
- persistencia local ja usada em `cookiePopup.js` e `languageSelector.js`
- traducao centralizada em `src/php/translations.php`

O esforco nao parece ser de reestruturacao pesada. Ele parece ser de uma extensao guiada, com alguns cuidados reais de UX e acessibilidade tecnica.

## Nivel de preparo do projeto

### Pontos fortes

1. Existe um trilho claro de componente global

- Estrutura atual do botao flutuante:
  - `includes/scrollToTop.php`
  - `src/js/scrollToTop.js`
  - `styles/shared/scrollToTop.css`
- Esse mesmo modelo serve muito bem para um futuro `accessibilityWidget`.

2. A base visual ja trabalha com tokens de cor

- O projeto usa variaveis como `--color-bege-delicado`, `--color-verde-mosaico`, `--color-vermelho-recife` e `--color-cinza-elegante`.
- Isso facilita muito modos como:
  - alto contraste
  - contraste suave
  - fundo mais escuro ou mais claro
  - destaque de links e foco

3. Os breakpoints sao consistentes

- O projeto repete com frequencia:
  - `max-width: 767px`
  - `min-width: 768px`
  - `min-width: 1024px`
  - `min-width: 1366px`
- Isso ajuda o componente novo a entrar na mesma logica responsiva do restante do site.

4. Ja existe persistencia local de preferencia

- `src/js/cookiePopup.js` usa `localStorage` para consentimento.
- `src/js/languageSelector.js` usa `localStorage` para idioma.
- O componente de acessibilidade pode seguir exatamente esse padrao.

5. Ja existe cultura de atributos de acessibilidade

- A base usa `aria-label`, `aria-live`, `role`, `aria-pressed`, foco visivel e textos para leitores de tela em varios pontos.
- Isso nao significa que o projeto esteja completo em acessibilidade, mas mostra que a base aceita bem esse tipo de evolucao.

## Principais riscos de UX e implementacao

1. O projeto ainda nao tem um modal global realmente robusto

- Ha componentes flutuantes e overlay, mas nao um dialogo generico de acessibilidade com:
  - foco preso dentro do painel
  - retorno de foco ao botao de origem
  - fechamento confiavel por `Esc`
  - `aria-modal`
  - bloqueio de scroll coordenado
- O lightbox existente nao deve ser reutilizado como base conceitual para isso.

2. O bloqueio de scroll hoje e feito de forma pontual

- `src/js/mobileMenu.js` altera `document.body.style.overflow` diretamente.
- Se o novo modal fizer a mesma coisa sem coordenacao, podem surgir conflitos entre:
  - menu mobile
  - lightbox
  - popup de acessibilidade

3. Aumento de texto pede calibragem, nao apenas um zoom bruto

- A base usa muito `rem`, o que e bom.
- Mas tambem existem caixas com altura fixa, largura fixa e posicionamentos muito fechados, por exemplo:
  - cards de projetos com `height: 360px/400px`
  - campos com `height: 56px`
  - botoes e icones com tamanhos fixos
  - elementos absolutamente posicionados no centro dos cards
- Se o recurso de fonte for agressivo demais, alguns trechos podem sofrer overflow ou aperto visual.

4. O componente atual de voltar ao topo nao e totalmente global

- O CSS dele e carregado ate em paginas que nao incluem o botao.
- `index.php`, `404.php` e `sucesso.php` fogem do padrao de inclusao do botao.
- Antes da implementacao final, vale decidir se o widget de acessibilidade sera:
  - global em todas as paginas
  - apenas nas paginas internas

5. Ainda nao ha tratamento de reducao de movimento

- Nao encontrei uso de `prefers-reduced-motion`.
- Como o projeto usa transicoes, fades, slide-ins e scroll suave, esse deveria ser um dos primeiros recursos do futuro painel.

## Melhorias especificas de fluxo e interface

1. Unificar acessibilidade + voltar ao topo no mesmo container

Recomendacao:

- criar um container fixo unico encostado na lateral direita
- lado esquerdo: botao de acessibilidade
- divisor vertical curto no meio
- lado direito: voltar ao topo
- fundo igual ao botao atual
- icones em bege
- bordas arredondadas apenas no lado esquerdo do container
- lado direito alinhado com a lateral da viewport

Isso faz sentido de UX porque:

- reduz poluicao visual
- preserva o padrao do site
- transforma dois atalhos flutuantes em um bloco coerente

2. O painel deve ser um drawer/modal lateral, nao um popup pequeno

Para esse contexto, um painel lateral ou modal com boa largura e melhor do que um popover pequeno, porque ele precisa acomodar:

- explicacoes curtas
- toggles
- slider ou stepper de tamanho de texto
- preview em tempo real
- opcao de restaurar padrao

3. Aplicar as alteracoes em tempo real via `data-attributes` no `html` ou `body`

Em vez de manipular estilo inline em muitos elementos, o ideal e:

- aplicar algo como `data-a11y-font="large"`
- `data-a11y-contrast="high"`
- `data-a11y-motion="reduced"`
- `data-a11y-spacing="comfortable"`

E deixar o CSS reagir a esses estados.

4. Priorizar poucos recursos, mas bem executados

Para a Maribe, eu recomendaria comecar com:

- aumentar texto
- diminuir texto
- restaurar padrao
- alto contraste
- contraste suave
- destacar links
- reduzir animacoes
- aumentar foco visivel

Recursos opcionais para fase 2:

- espacamento maior entre linhas
- mascarar imagens decorativas
- leitura guiada ou cursor de leitura
- fonte mais legivel alternativa

## Funcoes que fazem mais sentido para a Maribe

### Fase 1

1. Tamanho do texto

- pequeno ajuste em degraus, nao zoom radical
- exemplo: `100%`, `112.5%`, `125%`

2. Contraste

- modo padrao
- modo alto contraste
- modo contraste suave

3. Reducao de movimento

- desligar scroll suave
- reduzir transicoes e animacoes

4. Destaque de foco e links

- contorno mais evidente em foco via teclado
- sublinhado visivel para links

5. Restaurar configuracao original

- CTA obrigatorio, simples e muito claro

### Fase 2

1. Espacamento de leitura

- aumentar `line-height`
- aumentar espaco entre paragrafos

2. Fonte de leitura

- opcional, desde que validado com o branding

3. Ajuste de largura de texto

- limitar largura de paragrafos em blocos mais longos

## Impacto esperado na usabilidade

- melhora a autonomia de visitantes com baixa visao, sensibilidade a movimento ou dificuldade de leitura
- reforca a percepcao de cuidado e maturidade digital da marca
- reduz abandono em formularios e paginas com bastante texto
- cria uma camada de acessibilidade progressiva sem reescrever o site inteiro

## Tradeoffs introduzidos

- aumento de complexidade nos estados globais da interface
- necessidade de coordenar `z-index`, foco e bloqueio de scroll
- necessidade de testar overflow em componentes mais rigidos
- manutencao adicional nas traducoes para `pt`, `en` e `es`

## Leitura tecnica da base atual

### Estrutura

- Base PHP multipagina.
- Shared includes em `includes/`.
- JS separado por responsabilidade em `src/js/`.
- CSS compartilhado em `styles/shared/` e especifico por pagina em `styles/pages/`.

### Responsividade

- Os breakpoints sao consistentes e repetidos em toda a base.
- A responsividade e organizada o suficiente para encaixar um widget global.
- O novo container flutuante pode seguir a mesma cadencia do botao atual.

### Estilo

- Identidade visual coesa.
- Paleta centralizada em variaveis.
- Tipografia ja combinando fonte base e fontes de destaque.
- Botonaria com cantos pequenos e linguagem discreta, o que combina com a proposta do container lateral descrito.

### Acessibilidade atual

Ha bons sinais:

- labels e `aria-label`
- `aria-live` em pontos dinamicos
- foco visivel em varios componentes
- `aria-pressed` nos filtros
- classe `visually-hidden`

Mas ainda faltam fundamentos importantes para um painel de acessibilidade robusto:

- modal semantico de verdade
- estrategia unica de scroll lock
- `prefers-reduced-motion`
- camada global de estados de acessibilidade

## Blocos recomendados de execucao

### Bloco 1: fundacao tecnica

- criar `includes/accessibilityWidget.php`
- criar `src/js/accessibilityWidget.js`
- criar `styles/shared/accessibilityWidget.css`
- criar novo grupo de traducoes em `src/php/translations.php`
- definir storage das preferencias no `localStorage`

### Bloco 2: container flutuante integrado

- transformar o atual botao de topo em um container com dois botoes
- preservar o comportamento atual de exibicao por scroll
- ajustar forma, divisor, bordas e alinhamento lateral
- revisar empilhamento com `cookiePopup`, `toast`, `lightbox` e menu mobile

### Bloco 3: painel de acessibilidade

- implementar drawer/modal
- foco inicial no painel
- fechamento por clique externo e `Esc`
- retorno de foco ao gatilho
- bloqueio de scroll sem conflito com outros componentes

### Bloco 4: recursos de acessibilidade em tempo real

- tamanho de texto
- contraste
- destaque de links
- foco reforcado
- reducao de movimento
- restaurar padrao

### Bloco 5: endurecimento da base

- revisar pontos com tamanhos fixos
- validar formularios, cards, busca e titulos
- testar mobile, tablet e desktop
- testar navegacao por teclado
- testar com preferencias salvas e restauracao

### Bloco 6: refinamento de UX

- microcopy clara e acolhedora
- explicacao breve do que cada recurso faz
- nomes simples, sem jargao tecnico
- opcao de fechar e voltar ao site sem friccao

## Recomendacao final

Minha recomendacao e seguir com a implementacao.

Nao parece um projeto arriscado para esta base. O que ele pede nao e reescrever o site, e sim adicionar uma camada global bem pensada.

O ponto de maior cuidado nao e visual. E estrutural:

- fazer um modal acessivel de verdade
- evitar conflito de scroll lock
- dosar o aumento de texto para nao quebrar layouts mais fixos

Se isso for respeitado, a chance de o componente nascer bem integrado ao projeto e alta.

## Resumo em linguagem simples

Sim, da para fazer.

O site ja esta organizado de um jeito que ajuda bastante: ele tem componentes compartilhados, estilos separados, cores padronizadas e scripts pequenos por funcionalidade. Isso significa que o novo botao de acessibilidade pode entrar como mais um componente global, sem precisar desmontar o projeto.

O cuidado maior vai estar em fazer o painel funcionar bem para todo mundo:

- abrir e fechar direito
- funcionar com teclado
- lembrar a preferencia da pessoa
- mudar a pagina na hora
- nao brigar com menu mobile, popup de cookie e outros elementos flutuantes

Se quisermos, o proximo passo natural e eu transformar este relatorio em uma proposta tecnica de implementacao ja quebrada em tarefas executaveis.
