# 🔧 Solução de Erros Comuns

## ⚠️ Warning: "Session cannot be started after headers have already been sent"

### Problema:

```
Warning: session_start(): Session cannot be started after headers have already been sent in
C:\Users\...\src\php\functions.php on line 9
```

### Causa:

O PHP não pode iniciar uma sessão depois que já começou a enviar dados para o navegador (headers HTTP). Isso acontece quando:

- Há espaços ou caracteres antes do `<?php` no início do arquivo
- Há algum `echo`, `print`, ou HTML antes de chamar `session_start()`
- O arquivo tem BOM (Byte Order Mark) no início

### Solução Aplicada:

✅ **1. Movemos o `require_once` de `functions.php` para o TOPO de cada arquivo PHP**, antes de qualquer HTML

✅ **2. Adicionamos Output Buffering** em `functions.php` para evitar problemas se houver algum output inesperado

**Antes (❌ Errado):**

```php
<!DOCTYPE html>
<html>
...
<form>
    <?php
    require_once __DIR__ . '/src/php/functions.php'; // ❌ Muito tarde!
    ?>
</form>
```

**Depois (✅ Correto):**

```php
<?php
// ✅ PRIMEIRO: Inicia sessão (com output buffering)
require_once __DIR__ . '/src/php/functions.php';

// DEPOIS: Define variáveis
$currentPage = 'orcamento';
?>
<!DOCTYPE html>
<html>
...
```

### O que foi feito:

1. ✅ `orcamento.php` - `require_once` movido para o topo
2. ✅ `contato.php` - `require_once` movido para o topo
3. ✅ `contrato.php` - `require_once` movido para o topo
4. ✅ `proposta.php` - `require_once` movido para o topo
5. ✅ `src/php/functions.php` - Adicionado output buffering

### Arquivos Corrigidos:

- ✅ `orcamento.php`
- ✅ `contato.php`
- ✅ `contrato.php`
- ✅ `proposta.php`

### Verificação:

1. Abra qualquer arquivo PHP
2. Verifique se a primeira linha é `<?php` (sem espaços antes)
3. Verifique se `require_once __DIR__ . '/src/php/functions.php';` está logo após o `<?php`
4. Não deve haver nenhum caractere (nem espaços) antes do `<?php`

---

## ⚠️ Console: "Tracking Prevention blocked access to storage"

### Problema:

No console do navegador aparecem múltiplas mensagens:

```
Tracking Prevention blocked access to storage for <URL>
```

### Causa:

Navegadores modernos (Edge, Chrome) bloqueiam cookies de terceiros por padrão quando você usa `localhost`. Isso pode afetar:

- Sessões PHP
- Cookies
- localStorage
- sessionStorage

### Impacto:

- ⚠️ Sessões PHP podem não funcionar corretamente
- ⚠️ Tokens CSRF podem não ser salvos
- ⚠️ Formulários podem não funcionar corretamente

### Soluções:

#### Solução 1: Usar 127.0.0.1 (Recomendado)

Ao invés de `localhost`, use `127.0.0.1`:

```bash
# Inicie o servidor normalmente
php -S localhost:8000 router.php

# Mas acesse usando:
http://127.0.0.1:8000
```

#### Solução 2: Configurar o Navegador

**Edge/Chrome:**

1. Vá em `edge://settings/content/cookies` (Edge) ou `chrome://settings/cookies` (Chrome)
2. Adicione `localhost` e `127.0.0.1` na lista de sites permitidos
3. Desabilite "Bloquear cookies de terceiros" temporariamente para desenvolvimento

#### Solução 3: Usar um Domínio Local

Configure um domínio local no `hosts`:

- Windows: `C:\Windows\System32\drivers\etc\hosts`
- Linux/Mac: `/etc/hosts`

Adicione:

```
127.0.0.1 maribe.local
```

Depois acesse: `http://maribe.local:8000`

### Nota Importante:

⚠️ Este problema **NÃO ocorre em produção** (domínio real), apenas em desenvolvimento local com `localhost`.

---

## ✅ Verificação Rápida

### 1. Verificar se PHP está instalado:

```bash
php --version
```

### 2. Verificar se sessões estão funcionando:

```bash
php -r "echo extension_loaded('session') ? 'Session OK' : 'Session FAIL';"
```

### 3. Verificar se não há espaços antes do <?php:

```bash
# Windows PowerShell
Get-Content orcamento.php -First 1 | Format-Hex

# Linux/Mac
head -c 10 orcamento.php | od -An -tx1
```

O arquivo deve começar exatamente com `<?php` (3C 3F 70 68 70 em hexadecimal).

### 4. Testar sessão:

Crie um arquivo `test-session.php`:

```php
<?php
session_start();
$_SESSION['test'] = 'OK';
echo 'Session: ' . $_SESSION['test'];
?>
```

Se funcionar, a sessão está OK! ✅

---

## 🎯 Checklist de Correção

- [ ] `require_once __DIR__ . '/src/php/functions.php';` está no topo do arquivo
- [ ] Não há espaços ou caracteres antes do `<?php`
- [ ] Não há HTML antes do `require_once`
- [ ] Está usando `127.0.0.1:8000` ao invés de `localhost:8000`
- [ ] PHP está instalado e funcionando
- [ ] Extensão `session` está habilitada

---

## 📞 Se o Problema Persistir

1. **Limpe o cache do navegador**
2. **Reinicie o servidor PHP**
3. **Verifique os logs de erro do PHP**: `php -d display_errors=1 -S localhost:8000 router.php`
4. **Teste em outro navegador** (Firefox geralmente não tem esse problema)
5. **Verifique permissões de arquivos** (especialmente em Linux/Mac)
