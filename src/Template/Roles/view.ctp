<?php

use App\Controller\TypeRolesENUM;
?>

<header>
    <h2>Perfis <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Roles', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome:</dt>
            <dd><?= $role->name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Tipo do perfil:</dt>
            <dd><?= TypeRolesENUM::findConstants($role->type); ?></dd>
        </div>

        <div class="view_row">
            <dt>Descrição:</dt>
            <dd><?= __overrideEmpty($role->description); ?></dd>
        </div>
    </dl>
</main>
