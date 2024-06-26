<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */

use App\Controller\TimesDayENUM;
?>

<header>
    <h2>Atividades <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Activities', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($activity); ?>

    <div class="container_fields">
        <?= $this->Form->control('instructor_id', ['label' => 'Responsável <span class="field_required">*</span>', 'options' => $instructors, 'escape' => false]); ?>
        <?= $this->Form->control('title', ['label' => 'Título <span class="field_required">*</span>', 'placeholder' => 'Identificação da atividade', 'escape' => false]); ?>
    </div>

    <?= $this->Form->control('description', ['label' => 'Observação', 'placeholder' => 'Descreva de forma mais detalhada a atividade']); ?>

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

    <section>
        <h3>Hóspedes <span class="field_required">*</span></h3>
        <p><small>Selecione os hóspedes que estaram vinculados a esta atividade, ou clique na opção abaixo para para marcar/desmarcar todos os hóspedes.</small></p>
        <p><small>** A listagem abaixo é somente de hóspedes que se encontram com a situação 'ATIVA'.</small></p>

        <p class="check_all inactive">
            <i class="bi bi-check-square"></i>
            <i class="bi bi-square"></i>
            Marcar / Desmarcar todos
        </p>

        <?php $cont = 0; ?>

        <div class="guests">
            <?php foreach ($guests as $guest) : ?>
                <?= $this->Form->control('guests.' . $cont . '.id', ['hiddenField' => false, 'type' => 'checkbox', 'label' => '<span>' . $guest->person->first_name . ' ' . $guest->person->last_name . '</span>', 'value' => $guest->id, 'escape' => false]); ?>
                <?php $cont++; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>

<?= $this->Html->script('checks'); ?>
