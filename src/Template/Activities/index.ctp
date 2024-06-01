<header>
    <h2>Atividades <small>listagem</small></h2>
    <?= $this->Html->link('Nova atividade', ['controller' => 'Activities', 'action' => 'add']); ?>
</header>

<main>
    <?php if (count($activities) > 0) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->Paginator->sort('name', 'Nome'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th><?= $this->Paginator->sort('initial_date', 'Data de início'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th><?= $this->Paginator->sort('final_date', 'Data prevista p/ término'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th><?= $this->Paginator->sort('person_id', 'Responsável'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?= $this->Number->format($activity->id); ?></td>
                        <td><?= h($activity->name); ?></td>
                        <td><?= h($activity->initial_date); ?></td>
                        <td><?= h($activity->final_date); ?></td>
                        <td><?= $activity->has('person') ? $this->Html->link($activity->person->id, ['controller' => 'Persons', 'action' => 'view', $activity->person->id]) : '' ?></td>

                        <td class="actions">
                            <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_activities', 'id' => $activity->id], ['escape' => false]); ?>

                            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $activity->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o {0} {1}?', $activity->role->name, $activity->first_name)]); ?>
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


