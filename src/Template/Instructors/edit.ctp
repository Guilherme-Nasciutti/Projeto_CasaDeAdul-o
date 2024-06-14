<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instructor $instructor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $instructor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $instructor->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Instructors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Persons'), ['controller' => 'Persons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'Persons', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="instructors form large-9 medium-8 columns content">
    <?= $this->Form->create($instructor) ?>
    <fieldset>
        <legend><?= __('Edit Instructor') ?></legend>
        <?php
            echo $this->Form->control('phone');
            echo $this->Form->control('other_phone');
            echo $this->Form->control('education');
            echo $this->Form->control('person_id', ['options' => $persons]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
