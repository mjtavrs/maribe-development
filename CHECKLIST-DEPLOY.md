# ✅ Checklist de Deploy para Hostinger

## 📦 ARQUIVOS QUE DEVEM SER ENVIADOS

### 📄 Arquivos PHP (Raiz do projeto)
```
✓ 404.php
✓ contato.php
✓ contrato.php
✓ index.php
✓ orcamento.php
✓ politica-de-privacidade.php
✓ projeto.php
✓ projetos.php
✓ proposta.php
✓ sobre.php
✓ sucesso.php
```

### 📁 Diretórios Completos
```
✓ assets/                    (TODOS os arquivos: fonts, images, videos)
✓ includes/                  (TODOS os arquivos PHP)
✓ src/
  ✓ js/                      (TODOS os arquivos JavaScript)
  ✓ php/                     (TODOS os arquivos PHP - incluindo formulários)
✓ styles/                    (TODOS os arquivos CSS)
```

### ⚙️ Arquivos de Configuração
```
✓ .htaccess                 (IMPORTANTE: Configuração do Apache para rotas i18n)
✓ favicon.png
```

### 📝 Documentação (Opcional)
```
✓ README.md
✓ LICENSE
```

---

## ❌ ARQUIVOS QUE NÃO DEVEM SER ENVIADOS

### 🛠️ Scripts e Configurações de Desenvolvimento Local
```
✗ router.php                 (Apenas para servidor PHP built-in local)
✗ php.ini.development        (Configuração local)
✗ start-server.bat           (Script Windows)
✗ start-server.ps1           (Script PowerShell)
✗ start-server.sh            (Script Linux/Mac)
✗ verificar-php.bat          (Script de verificação)
✗ verificar-php.sh           (Script de verificação)
```

### 📚 Documentação de Desenvolvimento
```
✗ DEV.md
✗ DEPLOY.md
✗ REFACTORING_PLAN.md
✗ SOLUCAO-ERROS.md
✗ docs/                      (Pasta inteira de documentação)
```

### 🔒 Arquivos Sensíveis (verificar se existem)
```
✗ .env
✗ .env.local
✗ *.key
✗ *.pem
✗ config.php (se tiver dados sensíveis)
```

### 🗑️ Arquivos Temporários e de Sistema
```
✗ .DS_Store
✗ Thumbs.db
✗ *.log
✗ *.tmp
✗ *.bak
✗ node_modules/ (se existir)
✗ vendor/ (se existir)
```

---

## ⚠️ IMPORTANTE ANTES DO DEPLOY

### 1. Verificar E-mail de Destino
✅ Verifique se o e-mail nos formulários está correto:
- `src/php/contactForm.php` → linha com `$to = `
- `src/php/budgetForm.php` → linha com `$to = `
- `src/php/contractForm.php` → linha com `$to = `
- `src/php/finalBudgetForm.php` → linha com `$to = `

**Atualmente configurado para testes:** `mjtdes.md@gmail.com`

### 2. Verificar .htaccess
✅ Certifique-se de que o arquivo `.htaccess` está na raiz do projeto

### 3. Estrutura Final no Servidor
```
public_html/
├── .htaccess
├── favicon.png
├── 404.php
├── contato.php
├── contrato.php
├── index.php
├── orcamento.php
├── politica-de-privacidade.php
├── projeto.php
├── projetos.php
├── proposta.php
├── sobre.php
├── sucesso.php
├── assets/
│   ├── fonts/
│   ├── images/
│   └── videos/
├── includes/
│   ├── cookiePopup.php
│   ├── footer.php
│   ├── header.php
│   ├── pageInfo.php
│   ├── scrollToTop.php
│   └── toast.php
├── src/
│   ├── js/
│   │   ├── cookiePopup.js
│   │   ├── floatingLabel.js
│   │   ├── formValidation.js
│   │   ├── homeScroll.js
│   │   ├── languageSelector.js
│   │   ├── lightbox-plus-jquery.js
│   │   ├── mobileMenu.js
│   │   ├── projectsData.js
│   │   ├── projectsFilters.js
│   │   ├── projectsInjector.js
│   │   ├── projectsSearch.js
│   │   ├── scrollToTop.js
│   │   ├── selectedProject.js
│   │   └── toast.js
│   └── php/
│       ├── budgetForm.php
│       ├── contactForm.php
│       ├── contractForm.php
│       ├── finalBudgetForm.php
│       ├── functions.php
│       ├── get-csrf-token.php
│       ├── get-errors.php
│       ├── i18n.php
│       └── translations.php
└── styles/
    ├── pages/
    │   ├── 404/
    │   ├── about/
    │   ├── contact/
    │   ├── home/
    │   ├── privacyPolicies/
    │   ├── project/
    │   └── projects/
    └── shared/
```

---

## 📋 Checklist Pré-Deploy

- [ ] Todos os arquivos PHP estão na raiz
- [ ] `.htaccess` está na raiz
- [ ] Todos os diretórios `assets/`, `includes/`, `src/`, `styles/` estão completos
- [ ] E-mail de destino nos formulários está configurado corretamente
- [ ] Nenhum arquivo de desenvolvimento local está incluído (router.php, scripts .bat/.ps1/.sh)
- [ ] Nenhum arquivo de documentação local está incluído (DEV.md, SOLUCAO-ERROS.md, etc.)
- [ ] Arquivo `404.php` existe (não `404.shtml`)

---

## 🚀 Após o Deploy - Testes Obrigatórios

1. **Página inicial**: `https://seudominio.com/pt/` ou `https://seudominio.com/`
2. **Rotas i18n**: 
   - `/pt/sobre`
   - `/en/about`
   - `/es/sobre`
3. **Página 404**: Acesse uma URL inexistente
4. **Formulários**: Teste envio de mensagens (verificar se chegam no e-mail configurado)
5. **Seletor de idioma**: Mude entre PT, EN, ES
6. **Assets**: Verifique se imagens, fontes e CSS carregam
7. **Projetos**: Teste a página de projetos e visualização individual

---

## ⚙️ Configurações na Hostinger

1. **Versão PHP**: Configure para PHP 7.4+ (recomendado: PHP 8.0+)
2. **Extensões PHP**: Certifique-se de que estão habilitadas:
   - `session` (essencial)
   - `mbstring` (recomendado)
   - `json` (geralmente já vem)
3. **mod_rewrite**: Deve estar habilitado (geralmente já está na Hostinger)
4. **Permissões**:
   - Arquivos: `644`
   - Diretórios: `755`

---

**Última atualização**: Janeiro 2025

