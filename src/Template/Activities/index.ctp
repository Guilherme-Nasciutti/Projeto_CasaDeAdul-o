<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity[]|\Cake\Collection\CollectionInterface $activities
 */
?>

<header>
    <h2>Atividades <small>listagem</small></h2>
    <?= $this->Html->link('Nova atividade', ['controller' => 'Activities', 'action' => 'add']); ?>
</header>

<main>
    <?php if (count($activities) > 0) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th class="list_phone">Instrutor</th>
                    <th><?= $this->Paginator->sort('title', 'Título'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_table"><?= $this->Paginator->sort('initial_date', 'Data de início'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_table"><?= $this->Paginator->sort('final_date', 'Data de término'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activities as $activity) : ?>
                    <tr>
                        <td class="list_phone"><?= $activity->has('instructor') ? $this->Html->link($activity->instructor->person->first_name . ' ' . $activity->instructor->person->last_name, ['controller' => 'Instructors', 'action' => 'view', $activity->instructor->id]) : ''; ?></td>
                        <td><?= h(mb_strimwidth($activity->title, 0, 20, '...')); ?></td>
                        <td class="list_table"><?= h($activity->initial_date->format('d/m/Y')); ?></td>
                        <td class="list_table"><?= h($activity->final_date->format('d/m/Y')); ?></td>

                        <td class="actions">
                            <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $activity->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar a atividade {0}?', $activity->title)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="list_empty">Nenhuma atividade cadastrada!</p>
    <?php endif; ?>

    <?php if (count($activities) > 0) : ?>
        <?= $this->element('pagination'); ?>
    <?php endif; ?>
</main>
