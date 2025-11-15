@echo off
echo ========================================
echo   Maribe Arquitetura - Servidor Local
echo ========================================
echo.
echo Iniciando servidor PHP...
echo.
echo Acesse: http://127.0.0.1:8000
echo (Usando 127.0.0.1 para evitar problemas de cookies no navegador)
echo.
echo Pressione Ctrl+C para parar o servidor
echo.
php -S 127.0.0.1:8000 router.php
