<header>
    <h2>Administradores <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Users', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome completo:</dt>
            <dd><?= $user->full_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>E-mail:</dt>
            <dd><?= $user->email; ?></dd>
        </div>
    </dl>
</main>
