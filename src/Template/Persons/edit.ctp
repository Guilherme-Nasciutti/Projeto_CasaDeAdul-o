<?php

use App\Controller\CivilStatusENUM;
use App\Controller\EducationENUM;

?>
<header>
    <h2>Pessoas <small>editar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Persons', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->Form->create($person); ?>

    <div class="container_fields">
        <?= $this->Form->control('first_name', ['label' => 'Nome']); ?>
        <?= $this->Form->control('last_name', ['label' => 'Sobrenome']); ?>
    </div>

    <div class="container_fields">
        <div class="row">
            <?= $this->Form->control('birthday', ['label' => 'Data de nascimento', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date']); ?>

            <?= $this->Form->control('phone', ['label' => 'Telefone p/ contato', 'placeholder' => '(99) 99999-9999', 'class' => 'mask_phone']); ?>
        </div>

        <div class="row">
            <?= $this->Form->control('civil_status', ['label' => 'Estado civil', 'options' => CivilStatusENUM::findConstants()]); ?>

            <?= $this->Form->control('role_id', ['label' => 'Perfil', 'options' => $roles]); ?>
        </div>
    </div>

    <?= $this->Form->control('education', ['label' => 'Formação escolar', 'options' => EducationENUM::findConstants()]); ?>

    <?= $this->Form->button('Editar', ['class' => 'btn_sumit btn_edit']); ?>
    <?= $this->Form->end(); ?>
</main>
