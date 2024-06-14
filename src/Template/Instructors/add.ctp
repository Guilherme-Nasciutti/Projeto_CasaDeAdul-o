<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instructor $instructor
 */

use App\Controller\CivilStatusENUM;
use App\Controller\EducationENUM;
?>

<header>
    <h2>Instrutores <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Instructors', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($instructor); ?>

    <div class="container_fields">
        <?= $this->Form->control('person.first_name', ['label' => 'Nome <span class="field_required">*</span>', 'escape' => false]); ?>
        <?= $this->Form->control('person.last_name', ['label' => 'Sobrenome <span class="field_required">*</span>', 'escape' => false]); ?>
    </div>

    <div class="container_fields">
        <?= $this->Form->control('person.birthday', ['label' => 'Data de nascimento <span class="field_required">*</span>', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date', 'escape' => false]); ?>
        <?= $this->Form->control('phone', ['label' => 'Telefone p/ contato <span class="field_required">*</span>', 'placeholder' => '(99) 99999-9999', 'class' => 'mask_phone', 'escape' => false]); ?>
        <?= $this->Form->control('other_phone', ['label' => 'Outro telefone', 'placeholder' => '(99) 99999-9999', 'class' => 'mask_phone']); ?>
    </div>

    <div class="container_fields">
        <?= $this->Form->control('person.civil_status', ['label' => 'Estado civil <span class="field_required">*</span>', 'options' => CivilStatusENUM::findConstants(), 'escape' => false]); ?>
        <?= $this->Form->control('education', ['label' => 'Formação <span class="field_required">*</span>', 'options' => EducationENUM::findConstants(), 'escape' => false]); ?>
    </div>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
