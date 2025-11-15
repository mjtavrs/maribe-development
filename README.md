# Maribe Arquitetura's Repository

Maribe Arquitetura is an architecture and urbanism firm founded in 2022 in the city of Recife, Brazil. In order to increase the SEO levels of the firm, the owners decided to create a website for the company.

## ⚙️ Technologies used

- **Markup & Styling:** HTML, CSS
- **Programming Languages:** JavaScript, PHP
- **Libraries:** Lightbox2

## ✏️ Author

- [@mjtavrs](https://www.github.com/mjtavrs)

## ⚖️ License & Copyright

This repository is licensed under the [MIT](https://choosealicense.com/licenses/mit/) License, which allows commercial use, distribution, modification, and private use.

**Important:** The assets (fonts and images) in this repository are exclusive to Maribe Arquitetura and may **not be reused** in any other projects outside of the company.

## 🚀 Desenvolvimento Local

### ⚠️ IMPORTANTE: Live Server NÃO Funciona com PHP!

O **Live Server** (extensão do VS Code) serve apenas arquivos estáticos (HTML, CSS, JS) e **NÃO processa PHP**. Por isso, ao tentar acessar um arquivo `.php`, o navegador faz download do arquivo ao invés de executá-lo.

### Pré-requisitos

- PHP 7.4 ou superior
- Extensão PHP `session` habilitada

### Iniciando o Servidor

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

#### VS Code:

- **Task**: `Ctrl+Shift+B` → Inicia servidor PHP
- **Launch**: `F5` → Inicia servidor e abre navegador

Acesse: `http://127.0.0.1:8000`

**Nota**: Usamos `127.0.0.1` ao invés de `localhost` para evitar problemas de cookies no navegador (Tracking Prevention).

O arquivo `router.php` faz o redirecionamento de `.html` para `.php` automaticamente, simulando o comportamento do `.htaccess` em produção.

**Nota**: Para mais detalhes sobre desenvolvimento local, consulte [DEV.md](./DEV.md).

## 🌐 Deployment

This project was deployed using GitHub Pages with a CI/CD approach, allowing the team to preview real-time changes before pushing them to production.

The live production version of the website is available at [maribe.arq.br](https://maribe.arq.br).

**Importante**: Em produção (Hostinger), o `.htaccess` faz o redirecionamento automático de `.html` para `.php`.
