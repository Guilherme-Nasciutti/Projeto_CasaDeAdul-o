<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instructor $instructor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Instructor'), ['action' => 'edit', $instructor->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Instructor'), ['action' => 'delete', $instructor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $instructor->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Instructors'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Instructor'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Persons'), ['controller' => 'Persons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Person'), ['controller' => 'Persons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['controller' => 'Activities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="instructors view large-9 medium-8 columns content">
    <h3><?= h($instructor->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($instructor->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Phone') ?></th>
            <td><?= h($instructor->other_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Person') ?></th>
            <td><?= $instructor->has('person') ? $this->Html->link($instructor->person->id, ['controller' => 'Persons', 'action' => 'view', $instructor->person->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($instructor->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Education') ?></th>
            <td><?= $this->Number->format($instructor->education) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($instructor->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($instructor->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activities') ?></h4>
        <?php if (!empty($instructor->activities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Initial Date') ?></th>
                <th scope="col"><?= __('Final Date') ?></th>
                <th scope="col"><?= __('Start Time') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Instructor Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($instructor->activities as $activities): ?>
            <tr>
                <td><?= h($activities->id) ?></td>
                <td><?= h($activities->title) ?></td>
                <td><?= h($activities->initial_date) ?></td>
                <td><?= h($activities->final_date) ?></td>
                <td><?= h($activities->start_time) ?></td>
                <td><?= h($activities->duration) ?></td>
                <td><?= h($activities->created) ?></td>
                <td><?= h($activities->instructor_id) ?></td>
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
