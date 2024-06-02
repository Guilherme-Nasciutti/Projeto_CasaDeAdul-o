<?php

use App\Controller\TimesDayENUM;
?>

<header>
    <h2>Atividades <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Activities', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($activity); ?>

    <?= $this->Form->control('person_id', ['label' => 'Responsável <span class="field_required">*</span>', 'options' => $persons, 'escape' => false]); ?>
    <?= $this->Form->control('name', ['label' => 'Nome <span class="field_required">*</span>', 'placeholder' => 'Identificação da atividade', 'escape' => false]); ?>

    <div class="container_fields">
        <div class="row">
            <?= $this->Form->control('initial_date', ['label' => 'Data de início <span class="field_required">*</span>', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date', 'escape' => false]); ?>

            <?= $this->Form->control('final_date', ['label' => 'Data prevista p/ término <span class="field_required">*</span>', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date', 'escape' => false]); ?>
        </div>

        <div class="row">
            <?= $this->Form->control('start_time', ['label' => 'Horário de início <span class="field_required">*</span>', 'options' => TimesDayENUM::findConstants(), 'escape' => false]); ?>

            <?= $this->Form->control('duration', ['label' => 'Duração prevista <span class="field_required">*</span>', 'placeholder' => '999', 'placeholder' => 'Tempo estimado em horas', 'title' => 'Somente números', 'escape' => false]); ?>
        </div>
    </div>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
