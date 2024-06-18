<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="container_message message_warning">
    <strong>Alerta!</strong> <?= $message ?>
</div>