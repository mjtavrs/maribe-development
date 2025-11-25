# 🚀 Guia de Deploy para Hostinger

Este documento lista todos os arquivos que devem ser enviados para a Hostinger e quais devem ser **excluídos**.

## ✅ ARQUIVOS QUE DEVEM SER ENVIADOS

### 📄 Arquivos PHP (Raiz)
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

### 📁 Diretórios Essenciais
```
✓ assets/                    (TODOS os arquivos: fonts, images, videos)
✓ includes/                  (TODOS os arquivos PHP)
✓ src/
  ✓ js/                      (TODOS os arquivos JavaScript)
  ✓ php/                     (TODOS os arquivos PHP)
✓ styles/                    (TODOS os arquivos CSS)
```

### ⚙️ Arquivos de Configuração
```
✓ .htaccess                 (IMPORTANTE: Configuração do Apache)
✓ favicon.png
```

### 📝 Documentação (Opcional, mas recomendado)
```
✓ README.md                  (Documentação do projeto)
✓ LICENSE                    (Licença MIT)
```

---

## ❌ ARQUIVOS QUE NÃO DEVEM SER ENVIADOS

### 🛠️ Arquivos de Desenvolvimento Local
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
✗ DEV.md                     (Guia de desenvolvimento local)
✗ SOLUCAO-ERROS.md           (Solução de problemas locais)
✗ DEPLOY.md                  (Este arquivo - não precisa)
```

### 🗑️ Arquivos Antigos/Desnecessários
```
✗ 404.shtml                  (Substituído por 404.php)
```

### 🔒 Arquivos Sensíveis (se existirem)
```
✗ .env
✗ .env.local
✗ *.key
✗ *.pem
✗ config.php (se tiver dados sensíveis)
```

### 📦 Arquivos de Build (se existirem no futuro)
```
✗ node_modules/
✗ vendor/
✗ package-lock.json
✗ composer.lock
```

---

## 📋 Checklist de Deploy

### Antes de Enviar:
- [ ] Verificar se `.htaccess` está na raiz
- [ ] Confirmar que `404.php` existe (não `404.shtml`)
- [ ] Verificar se todos os arquivos PHP estão na raiz
- [ ] Confirmar que `src/php/` contém todos os endpoints
- [ ] Verificar se `assets/` contém todas as imagens, fontes e vídeos
- [ ] Confirmar que `styles/` contém todos os CSS

### Estrutura Final no Servidor:
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
│   └── toast.php
├── src/
│   ├── js/
│   └── php/
└── styles/
    ├── pages/
    └── shared/
```

---

## ⚙️ Configurações na Hostinger

### 1. Verificar Versão PHP
- Acesse o painel da Hostinger
- Vá em **Configurações PHP** ou **PHP Settings**
- Configure para **PHP 7.4 ou superior** (recomendado: PHP 8.0+)

### 2. Verificar Extensões PHP
Certifique-se de que estas extensões estão habilitadas:
- ✅ `session` (essencial para CSRF tokens)
- ✅ `mbstring` (para funções de string multibyte)
- ✅ `json` (geralmente já vem habilitado)

### 3. Verificar mod_rewrite
- O `.htaccess` usa `mod_rewrite` para rotas i18n
- Na Hostinger, geralmente já está habilitado
- Se não funcionar, entre em contato com o suporte

### 4. Configurar Email (Opcional)
- Se os formulários enviarem emails, configure SMTP no painel
- Ou use a função `mail()` do PHP (pode ter limitações)

### 5. Verificar Permissões
- Arquivos: `644` (rw-r--r--)
- Diretórios: `755` (rwxr-xr-x)
- `.htaccess`: `644`

---

## 🔍 Verificações Pós-Deploy

Após enviar os arquivos, teste:

1. **Página inicial**: `https://seudominio.com/pt/` ou `https://seudominio.com/`
2. **Rotas i18n**: 
   - `/pt/sobre`
   - `/en/about`
   - `/es/sobre`
3. **Página 404**: Acesse uma URL inexistente
4. **Formulários**: Teste envio de mensagens
5. **Seletor de idioma**: Mude entre PT, EN, ES
6. **Assets**: Verifique se imagens, fontes e CSS carregam

---

## 🚨 Problemas Comuns

### Erro 500 (Internal Server Error)
- Verifique se `.htaccess` está na raiz
- Verifique se `mod_rewrite` está habilitado
- Verifique logs de erro no painel da Hostinger

### Páginas não encontram traduções
- Verifique se `src/php/translations.php` foi enviado
- Verifique se `src/php/i18n.php` foi enviado
- Verifique se `src/php/functions.php` foi enviado

### Formulários não funcionam
- Verifique se `src/php/` contém todos os arquivos de formulário
- Verifique se sessões PHP estão funcionando
- Verifique logs de erro no painel

### CSS/JS não carregam
- Verifique caminhos (devem começar com `/`)
- Verifique se arquivos foram enviados corretamente
- Limpe cache do navegador (Ctrl+F5)

---

## 📞 Suporte

Se encontrar problemas:
1. Verifique os logs de erro no painel da Hostinger
2. Consulte `SOLUCAO-ERROS.md` (localmente)
3. Entre em contato com o suporte da Hostinger

---

**Última atualização**: Janeiro 2025

