<header>
    <h2>Atividades <small>listagem</small></h2>
    <?= $this->Html->link('Nova atividade', ['controller' => 'Activities', 'action' => 'add']); ?>
</header>

<main>
    <?php if (count($activities) > 0) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name', 'Nome'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_table"><?= $this->Paginator->sort('initial_date', 'Data de início'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_table"><?= $this->Paginator->sort('final_date', 'Data prevista p/ término'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_phone"><?= $this->Paginator->sort('person_id', 'Responsável'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?= h($activity->name); ?></td>
                        <td class="list_table"><?= h($activity->initial_date->format('d/m/Y')); ?></td>
                        <td class="list_table"><?= h($activity->final_date->format('d/m/Y')); ?></td>
                        <td class="list_phone"><?= $activity->has('person') ? $this->Html->link($activity->person->first_name, ['controller' => 'Persons', 'action' => 'view', $activity->person->id]) : '' ?></td>

                        <td class="actions">
                            <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $activity->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar a atividade {0}?', $activity->name)]); ?>
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


