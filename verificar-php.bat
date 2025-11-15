@echo off
echo ========================================
echo   Verificando Instalacao do PHP
echo ========================================
echo.

php --version >nul 2>&1
if %errorlevel% == 0 (
    echo [OK] PHP esta instalado!
    echo.
    php --version
    echo.
    echo Verificando extensoes...
    php -m | findstr /i "session"
    if %errorlevel% == 0 (
        echo [OK] Extensao session esta habilitada
    ) else (
        echo [AVISO] Extensao session nao encontrada
    )
) else (
    echo [ERRO] PHP nao esta instalado!
    echo.
    echo Para instalar PHP no Windows:
    echo 1. Baixe em: https://windows.php.net/download/
    echo 2. Ou use XAMPP: https://www.apachefriends.org/
    echo 3. Ou use Chocolatey: choco install php
    echo.
)

echo.
pause

