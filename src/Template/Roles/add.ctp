<?php

use App\Controller\TypeRolesENUM;
?>

<header>
    <h2>Perfis <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Roles', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($role); ?>

    <div class="container_fields">
        <?= $this->Form->control('name', ['label' => 'Nome <span class="field_required">*</span>', 'escape' => false]); ?>
        <?= $this->Form->control('type', ['label' => 'Tipo do perfil <span class="field_required">*</span>', 'escape' => false, 'options' => array_diff_key(TypeRolesENUM::findConstants(), array_flip($roles_in_use))]); ?>
    </div>

    <?= $this->Form->control('description', ['label' => 'Descrição']); ?>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
