<!DOCTYPE html>
<html>
<head>
    <style>
        * { padding: 0; margin: 0; box-sizing: border-box; }

        h1 { margin-bottom: 20px; color: #0364A9; }

        .links { margin: 30px 0 40px 0; }

        span { font-weight: bold; color: #0364A9; }

        .button {
            background: #0364A9; text-decoration: none;
            color: white !important;
            padding: 10px; border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>ESQUECEU SUA SENHA?</h1>

    <p>Olá, <?= $name; ?></p>
    <p>Houve uma solicitação para alterar sua senha!</p>
    <p>Se não fez este pedido, simplesmente ignore este email. Caso contrário, para continuar o processo clique no botão ou link abaixo para alterar sua senha:</p>

    <?php $link = $host . 'nova-senha/' . $token; ?>

    <div class="links">
        <p><?= $link; ?></p>
        <br/><p>ou</p><br/>
        <p><a href="<?= $link; ?>" class="button">Trocar senha</a></p>
    </div>

    <p>Atenciosamente.</p>
</body>
</html>
