<?php

/**
 * Componente Toast Notification
 * 
 * Exibe mensagens de sucesso ou erro de forma não intrusiva
 * 
 * IMPORTANTE: Este componente deve ser incluído APÓS functions.php
 * que já inicia a sessão.
 * 
 * Uso:
 *   - Sucesso: setToast('success', 'Mensagem enviada!');
 *   - Erro: setToast('error', 'Erro ao enviar!');
 */

// Verifica se há toast na sessão
$toast = $_SESSION['toast'] ?? null;

// Limpa o toast da sessão após ler (para não mostrar novamente)
if (isset($_SESSION['toast'])) {
    unset($_SESSION['toast']);
}
?>

<!-- Toast Container -->
<div id="toastContainer" aria-live="polite" aria-atomic="true">
    <?php if ($toast): ?>
        <?php
        // Usa título traduzido se disponível, senão usa padrão traduzido
        $title = $toast['title'] ?? (function_exists('t') ? ($toast['type'] === 'success' ? t('toast.success.title') : t('toast.error.title')) : ($toast['type'] === 'success' ? 'Sucesso!' : 'Erro!'));
        ?>
        <div class="toast toast-<?php echo htmlspecialchars($toast['type'], ENT_QUOTES, 'UTF-8'); ?>" role="alert">
            <div class="toast-wrapper">
                <div class="toast-content">
                    <span class="toast-icon-wrapper">
                        <span class="toast-icon">
                            <?php if ($toast['type'] === 'success'): ?>
                                <i class="ph ph-check-circle"></i>
                            <?php else: ?>
                                <i class="ph ph-x-circle"></i>
                            <?php endif; ?>
                        </span>
                    </span>
                    <div class="toast-text">
                        <h3 class="toast-title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="toast-message"><?php echo htmlspecialchars($toast['message'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <button class="toast-close" aria-label="Fechar notificação" title="Fechar">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <div class="toast-progress-bar">
                <div class="toast-progress-fill"></div>
            </div>
        </div>
    <?php endif; ?>
</div>