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
        'style', 'main', 'sidebar', 'toolbar', 'list', 'view'
    ]); ?>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- JQuery -->
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <?= $this->fetch('meta'); ?>
    <?= $this->fetch('css'); ?>
    <?= $this->fetch('script'); ?>
</head>
<body>
    <?= $this->element('sidebar'); ?>
    <?= $this->element('toolbar'); ?>

    <main class="container_main">
        <?= $this->Flash->render(); ?><br/>
        <?= $this->fetch('content'); ?>
    </main>

    <?= $this->Html->script('sidebar'); ?>
    <?= $this->Html->script('mask.js'); ?>
    <?= $this->Html->script('datepicker.js'); ?>
</body>
</html>

