<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        Casa de Adulão | <?= $this->fetch('title'); ?>
    </title>

    <?= $this->Html->meta('icon'); ?>

    <?= $this->Html->css([
        'style', 'main', 'sidebar', 'toolbar'
    ]); ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
    <?= $this->fetch('script'); ?>
</head>
<body>
    <?= $this->element('sidebar'); ?>
    <?= $this->element('toolbar'); ?>

    <main class="container_main">
        <?= $this->fetch('content'); ?>
    </main>

    <?= $this->Html->script('sidebar'); ?>
</body>
</html>

