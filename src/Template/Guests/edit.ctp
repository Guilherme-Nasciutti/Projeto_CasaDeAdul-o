<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Guest $guest
 */

use App\Controller\CivilStatusENUM;
use App\Controller\StatusENUM;

?>

<header>
    <h2>Hóspedes <small>editar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Guests', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($guest); ?>

    <div class="container_fields">
        <?= $this->Form->control('person.first_name', ['label' => 'Nome <span class="field_required">*</span>', 'escape' => false]); ?>
        <?= $this->Form->control('person.last_name', ['label' => 'Sobrenome <span class="field_required">*</span>', 'escape' => false]); ?>
    </div>

    <div class="container_fields">
        <?= $this->Form->control('person.birthday', ['label' => 'Data de nascimento <span class="field_required">*</span>', 'type' => 'text', 'placeholder' => '99/99/9999', 'class' => 'datepicker mask_date', 'escape' => false]); ?>
        <?= $this->Form->control('person.civil_status', ['label' => 'Estado civil <span class="field_required">*</span>', 'options' => CivilStatusENUM::findConstants(), 'escape' => false]); ?>
        <?= $this->Form->control('person.status', ['label' => 'Situação <span class="field_required">*</span>', 'options' => StatusENUM::findConstants(), 'escape' => false]); ?>
        </div>
    </div>

    <?= $this->Form->button('Editar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
