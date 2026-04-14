# Proposta tecnica: implementacao do componente de acessibilidade

## Objetivo desta proposta

Transformar o relatorio de viabilidade em uma trilha pratica de implementacao para a Maribe Arquitetura, incluindo:

- escopo por pagina
- arquitetura sugerida
- recursos da fase 1
- pontos de ajuste paralelos
- ordem de execucao recomendada

## Decisao de escopo

### Paginas onde o componente deve existir

- `sobre.php`
- `projetos.php`
- `projeto.php`
- `orcamento.php`
- `contato.php`
- `proposta.php`
- `contrato.php`
- `politica-de-privacidade.php`

### Paginas onde o componente nao deve existir

- `index.php`
- `404.php`
- `sucesso.php`

### Motivo da exclusao

1. `index.php`

- A home atual tem uma proposta visual mais limpa e imersiva.
- O gesto principal ali ja e o `scrollIndicator`.
- O widget lateral tende a competir com esse primeiro impacto visual.

2. `404.php`

- E uma pagina de excecao, com objetivo rapido e unico.
- O componente adicionaria ruido a uma tela que precisa ser mais direta.

3. `sucesso.php`

- E uma pagina de confirmacao.
- O ideal ali e manter a atencao no retorno de status da acao concluida.

## Ajustes de escopo ja identificados

1. Remover o carregamento de `scrollToTop.css` das paginas excluidas

Isso ja foi alinhado como ajuste correto porque essas paginas nao renderizam o componente.

2. Tratar o futuro widget como substituto do botao atual

- Nao manter dois sistemas separados.
- O novo container deve assumir o lugar do `scrollToTopButton`.

3. Formalizar a regra de aparicao

- Paginas internas: aparece ao rolar
- Home, 404 e sucesso: nao existe

## Arquitetura recomendada

### Arquivos novos

- `includes/accessibilityWidget.php`
- `src/js/accessibilityWidget.js`
- `styles/shared/accessibilityWidget.css`

### Arquivos existentes que devem ser ajustados

- `includes/scrollToTop.php`
- `src/js/scrollToTop.js`
- `styles/shared/scrollToTop.css`
- `src/php/translations.php`
- paginas que hoje incluem `includes/scrollToTop.php`

### Estrategia estrutural

Em vez de manter um `scrollToTopButton` isolado, recomendo criar um unico include compartilhado com esta estrutura conceitual:

- container fixo lateral
- botao de acessibilidade
- divisor vertical
- botao de voltar ao topo
- painel lateral/modal de configuracoes

Na pratica, temos dois caminhos:

1. Evoluir `includes/scrollToTop.php` para virar o include unificado
2. Criar `includes/accessibilityWidget.php` e apos isso remover `includes/scrollToTop.php`

Minha recomendacao e a segunda.

Ela deixa a migracao mais limpa, facilita rollback e evita nome antigo para um componente que deixa de ser apenas "scroll to top".

## Estrategia de estados globais

O CSS deve reagir a atributos no `html` ou `body`.

Exemplo de estados:

- `data-a11y-text-size="default|large|larger"`
- `data-a11y-contrast="default|high|soft"`
- `data-a11y-links="default|highlighted"`
- `data-a11y-motion="default|reduced"`
- `data-a11y-focus="default|strong"`

Isso e preferivel a:

- estilo inline espalhado
- alteracoes diretas elemento por elemento via JS

## Recursos recomendados para a fase 1

### 1. Tamanho do texto

Implementacao sugerida:

- `default`
- `large`
- `larger`

Aplicacao:

- preferencialmente em `html { font-size: ... }`
- com excecoes localizadas se algum bloco sofrer

### 2. Contraste

Implementacao sugerida:

- `default`
- `high`
- `soft`

Aplicacao:

- reatribuir tokens visuais no escopo do `body[data-a11y-contrast="..."]`

### 3. Reducao de movimento

Implementacao sugerida:

- desabilitar `scroll-behavior: smooth`
- reduzir transicoes
- neutralizar animacoes nao essenciais

### 4. Destaque de links

Implementacao sugerida:

- sublinhado persistente
- aumento de contraste para links textuais

### 5. Foco reforcado

Implementacao sugerida:

- outline mais forte
- offset mais visivel

### 6. Restaurar padrao

Implementacao sugerida:

- botao claro e permanente no painel

## Regras de UX do painel

### Estrutura

- abrir por clique no botao esquerdo do container
- fechar por:
  - `Esc`
  - clique no backdrop
  - botao de fechar

### Comportamento

- aplicar tudo em tempo real
- sem submit
- sem refresh
- salvar no `localStorage`
- reaplicar ao carregar a pagina

### Acessibilidade tecnica do painel

- `role="dialog"`
- `aria-modal="true"`
- `aria-labelledby`
- foco inicial no titulo ou primeiro controle
- trap de foco
- devolucao de foco ao gatilho

## Persistencia

### Chave sugerida

- `maribeAccessibilityPreferences`

### Estrutura sugerida

```json
{
  "textSize": "large",
  "contrast": "high",
  "links": "highlighted",
  "motion": "reduced",
  "focus": "strong"
}
```

## Integracao visual com o site

### Container flutuante

- posicionado fixo na lateral direita
- visivel apenas apos o threshold de scroll nas paginas internas
- fundo `var(--color-verde-mosaico)`
- icones `var(--color-bege-delicado)`
- divisor vertical central curto
- cantos pequenos arredondados apenas no lado esquerdo do bloco
- lado direito encostado na viewport

### Painel

- fundo claro alinhado ao bege da marca
- titulos e acentos no vermelho da identidade
- controles simples, sem cara de sistema generico
- linguagem textual acolhedora e objetiva

## Riscos tecnicos que pedem tratamento

### 1. Scroll lock concorrente

Hoje o menu mobile ja mexe diretamente em `body.style.overflow`.

Recomendacao:

- criar utilitario central de lock de scroll
- ou ao menos padronizar funcoes de `lockBodyScroll` e `unlockBodyScroll`

### 2. Z-index

Hoje coexistem:

- `cookiePopup`
- `toast`
- `lightbox`
- menu mobile
- elementos fixos

Recomendacao:

- criar mapa simples de camadas para nao decidir isso no improviso

### 3. Aumento de texto

Pontos mais sensiveis:

- cards de projetos com altura fixa
- labels centradas em caixas
- wrappers de formulario com altura fixa
- icones muito pequenos em relacao ao texto aumentado

Recomendacao:

- tratar o aumento de texto como ajuste moderado na fase 1

## Ordem de execucao recomendada

### Etapa 1

- criar o novo include do widget
- mover o comportamento de scroll trigger para ele
- manter o visual ainda proximo do botao atual

### Etapa 2

- desenhar o novo container lateral duplo
- inserir o botao de acessibilidade e o divisor
- manter o botao de topo funcional

### Etapa 3

- implementar o painel lateral
- foco, `Esc`, backdrop, persistencia

### Etapa 4

- ativar tamanho de texto
- ativar contraste
- ativar destaque de links
- ativar foco reforcado
- ativar reducao de movimento

### Etapa 5

- revisar impactos nos cards, formularios e cabecalhos
- validar em mobile e desktop

### Etapa 6

- refinamento de copy e ajustes visuais finais

## Checklist de validacao

- o widget nao aparece em `index.php`, `404.php` e `sucesso.php`
- o widget aparece apenas nas paginas internas definidas
- o botao de topo continua funcionando
- o painel abre e fecha com teclado
- o foco nao escapa do painel aberto
- as preferencias persistem entre paginas
- as preferencias persistem ao recarregar
- o contraste nao quebra a identidade visual
- o texto aumentado nao estoura os componentes mais criticos
- o componente nao conflita com menu mobile, cookie popup e lightbox

## Recomendacao de execucao

Se formos implementar, eu recomendo dividir em dois PRs ou duas entregas internas:

1. Infraestrutura e container flutuante
2. Painel com recursos de acessibilidade

Isso reduz risco, facilita validar o encaixe visual e deixa o segundo passo muito mais seguro.
