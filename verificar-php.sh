#!/bin/bash

echo "========================================"
echo "  Verificando Instalacao do PHP"
echo "========================================"
echo ""

if command -v php &> /dev/null; then
    echo "[OK] PHP esta instalado!"
    echo ""
    php --version
    echo ""
    echo "Verificando extensoes..."
    if php -m | grep -qi "session"; then
        echo "[OK] Extensao session esta habilitada"
    else
        echo "[AVISO] Extensao session nao encontrada"
    fi
else
    echo "[ERRO] PHP nao esta instalado!"
    echo ""
    echo "Para instalar PHP:"
    echo ""
    echo "Ubuntu/Debian:"
    echo "  sudo apt update"
    echo "  sudo apt install php php-cli"
    echo ""
    echo "macOS (Homebrew):"
    echo "  brew install php"
    echo ""
    echo "Ou baixe em: https://www.php.net/downloads.php"
    echo ""
fi

echo ""

