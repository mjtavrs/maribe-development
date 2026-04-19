```markdown
# Technical Specification: Center-Radial Button Hover Animation

## 1. Objetivo
Implementar uma transição de hover no botão principal do projeto Maribe. O efeito deve consistir em um círculo que se expande a partir do centro geométrico do botão até preencher todo o background, alterando simultaneamente a cor do texto.

## 2. Stack Tecnológica
* HTML5 (Vanilla)
* CSS3 (Transitions, Pseudo-elements, Flexbox)

## 3. Especificações Visuais e de Comportamento

### 3.1. Estado Inicial (Default)
* **Background:** Cor Alaranjada (Terracota).
* **Texto:** Cor Branca.
* **Bordas:** Arredondadas (conforme o design atual).
* **Comportamento:** O conteúdo deve ter `overflow: hidden` para que o círculo de expansão não ultrapasse os limites do botão.

### 3.2. Estado de Hover (Expand)
* **Origem:** O círculo de preenchimento deve iniciar exatamente no centro `(top: 50%, left: 50%)`.
* **Cor de Destino:** Amarelo (conforme `image_5376c9.png`).
* **Duração:** `0.5s`.
* **Timing Function:** `ease-in-out` ou `cubic-bezier(0.4, 0, 0.2, 1)` para uma sensação orgânica similar à do WhatsApp.
* **Texto:** Deve mudar para uma cor de contraste (ex: preto ou cinza escuro) conforme o círculo preenche o espaço.

## 4. Implementação Sugerida (Snippet CSS)

```css
/* Estilos base do botão */
.btn-whatsapp-style {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background-color: #C16E53; /* Exemplo da cor alaranjada */
    color: #FFFFFF;
    border: none;
    border-radius: 50px; /* Estilo pílula */
    font-weight: 600;
    text-decoration: none;
    overflow: hidden;
    z-index: 1;
    transition: color 0.4s ease;
}

/* O elemento circular que expande */
.btn-whatsapp-style::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background-color: #E2AD5F; /* Exemplo da cor amarela */
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease-out, height 0.6s ease-out;
    z-index: -1;
}

/* Estado de Hover */
.btn-whatsapp-style:hover::before {
    width: 350px; /* Valor suficiente para cobrir toda a área */
    height: 350px;
}

.btn-whatsapp-style:hover {
    color: #1c1c1c; /* Cor do texto no hover */
}
```

## 5. Critérios de Aceite
1.  A animação deve ser disparada ao passar o mouse e revertida suavemente ao retirá-lo.
2.  O texto deve estar sempre acima da animação (garantido pelo `z-index`).
3.  O círculo deve crescer de forma perfeitamente centralizada, independente do comprimento do texto no botão.
4.  A performance deve ser fluida, sem causar "layout shifts".

## 6. Instruções para o Cursor/Codex
* Aplique esta lógica aos botões que utilizam as classes de ação no projeto Maribe.
* Substitua os valores hexadecimais `#C16E53` e `#E2AD5F` pelas variáveis CSS ou valores exatos já definidos no `style.css` do projeto.
```