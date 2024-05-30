<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        Casa de Adulão | <?= $this->fetch('title'); ?>
    </title>

    <?= $this->Html->meta('icon'); ?>

    <?= $this->Html->css(['style', 'login']); ?>

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
    <?= $this->fetch('script'); ?>
</head>
<body>
    <main>
        <?= $this->fetch('content'); ?>
    </main>

    <?= $this->element('footer'); ?>
</body>
</html>

