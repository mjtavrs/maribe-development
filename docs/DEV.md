# 🛠️ Guia de Desenvolvimento Local

## ⚠️ IMPORTANTE: Live Server NÃO Funciona com PHP!

O **Live Server** (extensão do VS Code) serve apenas arquivos estáticos (HTML, CSS, JS) e **NÃO processa PHP**. Por isso, ao tentar acessar um arquivo `.php`, o navegador faz download do arquivo ao invés de executá-lo.

## 📋 Pré-requisitos: Instalar PHP

**Sim, você precisa ter PHP instalado no seu computador!**

### Como Verificar se PHP está Instalado

#### Windows:

```bash
# Execute no CMD ou PowerShell
php --version

# Ou execute o script
.\verificar-php.bat
```

#### Linux/Mac:

```bash
# Execute no terminal
php --version

# Ou execute o script
chmod +x verificar-php.sh
./verificar-php.sh
```

Se aparecer a versão do PHP (ex: `PHP 8.1.0`), está instalado! ✅

### Como Instalar PHP

#### Windows:

**Opção 1: XAMPP (Mais Fácil - Recomendado)**

1. Baixe: https://www.apachefriends.org/
2. Instale o XAMPP
3. O PHP já vem incluído em `C:\xampp\php\`
4. Adicione ao PATH ou use o caminho completo

**Opção 2: PHP Standalone**

1. Baixe em: https://windows.php.net/download/
2. Extraia em uma pasta (ex: `C:\php`)
3. Adicione `C:\php` ao PATH do sistema
4. Reinicie o terminal

**Opção 3: Chocolatey**

```bash
choco install php
```

#### Linux (Ubuntu/Debian):

```bash
sudo apt update
sudo apt install php php-cli php-common
```

#### macOS:

```bash
# Com Homebrew
brew install php

# Ou baixe em: https://www.php.net/downloads.php
```

### Verificar Extensão Session

A extensão `session` é essencial (para CSRF tokens). Verifique:

```bash
php -m | grep session
```

Se não aparecer `session`, ative no `php.ini`:

```ini
extension=session
```

### ❌ O que NÃO funciona:

- ❌ Live Server (extensão VS Code) - Não processa PHP
- ❌ `localhost:5500` com Live Server - Apenas arquivos estáticos
- ❌ Abrir `.php` diretamente no navegador (file://) - Não funciona

### ✅ O que funciona:

- ✅ Servidor PHP Built-in (`php -S localhost:8000`)
- ✅ Apache/XAMPP/WAMP/MAMP - Processa PHP
- ✅ Docker com PHP - Processa PHP

## 🚀 Iniciando o Servidor de Desenvolvimento

### Método 1: Servidor PHP Built-in (Recomendado - Mais Simples)

#### Windows:

```bash
# Opção 1: Usando PowerShell (recomendado)
.\start-server.ps1

# Opção 2: Usando CMD
start-server.bat

# Opção 3: Comando direto
php -S localhost:8000 router.php
```

#### Linux/Mac:

```bash
# Opção 1: Usando o script
chmod +x start-server.sh
./start-server.sh

# Opção 2: Comando direto
php -S localhost:8000 router.php
```

#### Depois, acesse no navegador:

- `http://localhost:8000` - Página inicial
- `http://localhost:8000/contato.php` - Página de contato
- `http://localhost:8000/contato.html` - Redireciona automaticamente para contato.php

### Método 2: VS Code Tasks (Mais Conveniente)

1. **Pressione** `Ctrl+Shift+P` (ou `Cmd+Shift+P` no Mac)
2. **Digite**: `Tasks: Run Task`
3. **Selecione**: `Iniciar Servidor PHP`
4. **Acesse**: `http://localhost:8000`

Ou use o atalho: `Ctrl+Shift+B` (Build Task)

### Método 3: VS Code Launch (Debug)

1. **Pressione** `F5` ou clique em "Run and Debug"
2. **Selecione**: "PHP Server (localhost:8000)"
3. **O navegador abrirá automaticamente** em `http://localhost:8000`

### Método 4: Apache Local (XAMPP/WAMP/MAMP)

Se você usa Apache local (XAMPP, WAMP, MAMP):

1. **Habilite mod_rewrite** no Apache
2. **Configure AllowOverride** no `httpd.conf`:
   ```apache
   <Directory "C:/xampp/htdocs/maribe-development">
       AllowOverride All
   </Directory>
   ```
3. **Coloque o projeto** na pasta `htdocs` (ou equivalente)
4. **Acesse**: `http://localhost/maribe-development`

## 📊 Comparação: Live Server vs Servidor PHP

| Feature           | Live Server | Servidor PHP |
| ----------------- | ----------- | ------------ |
| Processa PHP      | ❌ Não      | ✅ Sim       |
| Serve HTML        | ✅ Sim      | ✅ Sim       |
| Serve CSS/JS      | ✅ Sim      | ✅ Sim       |
| Serve Imagens     | ✅ Sim      | ✅ Sim       |
| Sessões PHP       | ❌ Não      | ✅ Sim       |
| CSRF Tokens       | ❌ Não      | ✅ Sim       |
| Formulários PHP   | ❌ Não      | ✅ Sim       |
| Redirecionamentos | ❌ Limitado | ✅ Completo  |
| Porta padrão      | 5500        | 8000         |

## 🎯 Por que usar Servidor PHP?

### Live Server (❌ Não funciona):

```
localhost:5500/contato.php
  ↓
Browser: "Este é um arquivo PHP, vou baixar"
  ↓
Download do arquivo contato.php
```

### Servidor PHP (✅ Funciona):

```
localhost:8000/contato.php
  ↓
Servidor PHP: "Vou executar este arquivo PHP"
  ↓
Processa PHP, gera HTML
  ↓
Browser: "Aqui está a página renderizada!"
```

## 📁 Estrutura do Projeto

```
maribe-development/
├── index.php                 # Página inicial
├── contato.php              # Página de contato
├── sobre.php                # Página sobre
├── projetos.php             # Lista de projetos
├── projeto.php              # Detalhe do projeto
├── orcamento.php            # Formulário de orçamento
├── contrato.php             # Formulário de contrato
├── proposta.php             # Formulário de proposta
├── politica-de-privacidade.php
├── sucesso.php              # Página de sucesso
├── router.php               # Router para desenvolvimento local
├── start-server.ps1         # Script PowerShell (Windows)
├── start-server.sh          # Script Bash (Linux/Mac)
├── start-server.bat         # Script Batch (Windows)
├── .htaccess                # Configuração Apache (produção)
├── includes/                # Componentes PHP reutilizáveis
│   ├── header.php
│   ├── footer.php
│   └── cookiePopup.php
├── src/
│   ├── js/                  # JavaScript
│   └── php/                 # Backend PHP
│       ├── functions.php    # Funções auxiliares
│       ├── contactForm.php  # Processamento de contato
│       ├── budgetForm.php   # Processamento de orçamento
│       ├── contractForm.php # Processamento de contrato
│       └── finalBudgetForm.php
└── styles/                  # CSS
```

## 🔧 Configuração do VS Code

### Arquivos de Configuração Criados:

1. **`.vscode/settings.json`** - Configurações do projeto

   - Desabilita Live Server para arquivos PHP
   - Configura validação PHP
   - Configura Emmet para PHP

2. **`.vscode/tasks.json`** - Tarefas do projeto

   - Tarefa para iniciar servidor PHP
   - Atalho: `Ctrl+Shift+B`

3. **`.vscode/launch.json`** - Configuração de Debug
   - Launch configuration para PHP Server
   - Atalho: `F5`

### Como Usar:

#### Opção 1: Task (Recomendado)

- `Ctrl+Shift+B` → Inicia servidor PHP
- `Ctrl+Shift+B` novamente → Para o servidor

#### Opção 2: Launch (Debug)

- `F5` → Inicia servidor e abre navegador
- `Shift+F5` → Para o servidor

#### Opção 3: Terminal

```bash
# PowerShell (Windows)
.\start-server.ps1

# Bash (Linux/Mac)
./start-server.sh

# CMD (Windows)
start-server.bat
```

## ✅ Funcionalidades Implementadas

### Componentes PHP Reutilizáveis

- Header com menu dinâmico
- Footer com informações legais
- Cookie popup

### Proteção CSRF

- Tokens CSRF em todos os formulários
- Validação no backend
- Regeneração após uso

### Validação de Dados

- Validação de CPF completa (backend + frontend)
- Validação de email
- Validação de telefone
- Feedback visual de erros

### Redirecionamento

- `.htaccess` para produção (Apache)
- `router.php` para desenvolvimento local (PHP built-in)

## 🧪 Testando Formulários Localmente

### Problema: Emails não são enviados

O PHP `mail()` pode não funcionar em localhost. Você tem algumas opções:

1. **Usar uma biblioteca de email** (PHPMailer, SwiftMailer)
2. **Configurar SMTP local** (MailHog, Mailtrap)
3. **Logar os dados** em arquivo para testar:

```php
// Em src/php/functions.php, modifique sendEmail() temporariamente:
function sendEmail($to, $subject, $message, $fromEmail) {
    // Para desenvolvimento local, apenas loga
    if ($_SERVER['HTTP_HOST'] === 'localhost:8000') {
        error_log("EMAIL: $to | $subject | $message");
        return true; // Simula sucesso
    }
    // Código normal para produção...
}
```

## 🐛 Debugging

### Verificar Sessões PHP

Adicione temporariamente em qualquer arquivo PHP:

```php
<?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>
```

### Verificar Token CSRF

```php
<?php
require_once 'src/php/functions.php';
echo 'CSRF Token: ' . generateCSRFToken();
?>
```

### Ver Erros PHP

No `php.ini` ou no início dos arquivos PHP:

```php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

## 📝 Comandos Úteis

```bash
# Iniciar servidor
php -S localhost:8000 router.php

# Verificar versão PHP
php -v

# Verificar extensões PHP
php -m

# Verificar se session está habilitada
php -r "echo extension_loaded('session') ? 'Session OK' : 'Session FAIL';"
```

## ❓ Troubleshooting

### Problema: Página em branco

- Verifique erros PHP: `error_reporting(E_ALL);`
- Verifique se `session_start()` está sendo chamado
- Verifique permissões de arquivos

### Problema: Redirecionamento não funciona

- Se usar PHP built-in: use `router.php`
- Se usar Apache: verifique `mod_rewrite` e `AllowOverride`

### Problema: Formulários não funcionam

- Verifique se sessões estão funcionando
- Verifique se token CSRF está sendo gerado
- Verifique console do navegador para erros JavaScript

### Problema: Includes não funcionam

- Verifique caminhos relativos
- Use `__DIR__` para caminhos absolutos
- Verifique permissões de arquivos

### Problema: Live Server faz download de arquivos PHP

- **Solução**: Use o servidor PHP built-in ao invés do Live Server
- Execute: `php -S localhost:8000 router.php`
- Acesse: `http://localhost:8000`

### Problema: Warning "Session cannot be started after headers have already been sent"

- **Causa**: `session_start()` está sendo chamado depois que o HTML já começou a ser renderizado
- **Solução**: O `require_once` de `functions.php` deve estar no **topo** do arquivo, antes de qualquer HTML
- **Verificação**: Certifique-se de que não há espaços ou caracteres antes do `<?php` no início do arquivo

### Problema: "Tracking Prevention blocked access to storage" no console

- **Causa**: Navegador (Edge/Chrome) bloqueia cookies de terceiros em localhost por padrão
- **Impacto**: Sessões PHP podem não funcionar corretamente em alguns navegadores
- **Solução**:
  - Use `127.0.0.1` ao invés de `localhost`: `http://127.0.0.1:8000`
  - Ou configure o navegador para permitir cookies em localhost
  - Em produção (domínio real), este problema não ocorre

## 🎯 Resumo Rápido

1. **NÃO use Live Server** para arquivos PHP
2. **Use servidor PHP built-in**: `php -S 127.0.0.1:8000 router.php`
3. **Acesse**: `http://127.0.0.1:8000` (use 127.0.0.1 para evitar problemas de cookies)
4. **Ou use VS Code Tasks**: `Ctrl+Shift+B`

## 📚 Próximos Passos

- [ ] Configurar SMTP para envio de emails em desenvolvimento
- [ ] Adicionar testes automatizados
- [ ] Implementar cache de sessão
- [ ] Adicionar logging de erros
