<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activity'), ['action' => 'edit', $activity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity'), ['action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Instructors'), ['controller' => 'Instructors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Instructor'), ['controller' => 'Instructors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Guests'), ['controller' => 'Guests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guest'), ['controller' => 'Guests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activities view large-9 medium-8 columns content">
    <h3><?= h($activity->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($activity->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Instructor') ?></th>
            <td><?= $activity->has('instructor') ? $this->Html->link($activity->instructor->id, ['controller' => 'Instructors', 'action' => 'view', $activity->instructor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($activity->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= $this->Number->format($activity->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration') ?></th>
            <td><?= $this->Number->format($activity->duration) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Initial Date') ?></th>
            <td><?= h($activity->initial_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final Date') ?></th>
            <td><?= h($activity->final_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($activity->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Guests') ?></h4>
        <?php if (!empty($activity->guests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Person Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($activity->guests as $guests): ?>
            <tr>
                <td><?= h($guests->id) ?></td>
                <td><?= h($guests->created) ?></td>
                <td><?= h($guests->modified) ?></td>
                <td><?= h($guests->person_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Guests', 'action' => 'view', $guests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Guests', 'action' => 'edit', $guests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Guests', 'action' => 'delete', $guests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
