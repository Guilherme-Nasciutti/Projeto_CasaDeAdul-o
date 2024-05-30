<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $person->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Persons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="persons form large-9 medium-8 columns content">
    <?= $this->Form->create($person) ?>
    <fieldset>
        <legend><?= __('Edit Person') ?></legend>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('birthday');
            echo $this->Form->control('civil_status');
            echo $this->Form->control('phone');
            echo $this->Form->control('education');
            echo $this->Form->control('role_id', ['options' => $roles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
