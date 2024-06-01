<?php

use App\Controller\TimesDayENUM;
?>

<header>
    <h2>Atividades <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Activities', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->Form->create($activity); ?>

    <?= $this->Form->control('person_id', ['label' => 'Responsável', 'options' => $persons]); ?>
    <?= $this->Form->control('name', ['label' => 'Nome', 'placeholder' => 'Identificação da atividade']); ?>

    <div class="container_fields">
        <?= $this->Form->control('initial_date', ['label' => 'Data de início', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date']); ?>

        <?= $this->Form->control('final_date', ['label' => 'Data prevista p/ término', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date']); ?>

        <?= $this->Form->control('start_time', ['label' => 'Horário de início', 'options' => TimesDayENUM::findConstants()]); ?>

        <?= $this->Form->control('duration', ['label' => 'Duração prevista', 'placeholder' => '999', 'placeholder' => 'Tempo estimado em horas', 'title' => 'Somente números']); ?>
    </div>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
