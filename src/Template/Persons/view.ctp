<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Person'), ['action' => 'edit', $person->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Person'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Persons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="persons view large-9 medium-8 columns content">
    <h3><?= h($person->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($person->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($person->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($person->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $person->has('role') ? $this->Html->link($person->role->name, ['controller' => 'Roles', 'action' => 'view', $person->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($person->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Civil Status') ?></th>
            <td><?= $this->Number->format($person->civil_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Education') ?></th>
            <td><?= $this->Number->format($person->education) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthday') ?></th>
            <td><?= h($person->birthday) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activities') ?></h4>
        <?php if (!empty($person->activities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Initial Date') ?></th>
                <th scope="col"><?= __('Final Date') ?></th>
                <th scope="col"><?= __('Start Time') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Person Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($person->activities as $activities): ?>
            <tr>
                <td><?= h($activities->id) ?></td>
                <td><?= h($activities->name) ?></td>
                <td><?= h($activities->initial_date) ?></td>
                <td><?= h($activities->final_date) ?></td>
                <td><?= h($activities->start_time) ?></td>
                <td><?= h($activities->duration) ?></td>
                <td><?= h($activities->created) ?></td>
                <td><?= h($activities->person_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activities', 'action' => 'view', $activities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activities', 'action' => 'edit', $activities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activities', 'action' => 'delete', $activities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
