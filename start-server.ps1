# Servidor PHP para desenvolvimento local
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Maribe Arquitetura - Servidor Local" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Iniciando servidor PHP..." -ForegroundColor Yellow
Write-Host ""
Write-Host "Acesse: http://127.0.0.1:8000" -ForegroundColor Green
Write-Host "(Usando 127.0.0.1 para evitar problemas de cookies no navegador)" -ForegroundColor Yellow
Write-Host ""
Write-Host "Pressione Ctrl+C para parar o servidor" -ForegroundColor Yellow
Write-Host ""

# Inicia servidor PHP
# Use 127.0.0.1 para evitar problemas de cookies (Tracking Prevention)
php -S 127.0.0.1:8000 router.php

