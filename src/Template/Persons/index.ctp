<header>
    <h2>Pessoas <small>listagem</small></h2>
    <?= $this->Html->link('Nova pessoa', ['controller' => 'Persons', 'action' => 'add']); ?>
</header>

<main>
    <table class="table_list">
        <thead>
            <tr>
                <th>#</th>
                <th><?= $this->Paginator->sort('first_name', 'Nome'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th><?= $this->Paginator->sort('last_name', 'Sobrenome'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th><?= $this->Paginator->sort('phone', 'Telefone'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($persons as $person): ?>
                <tr>
                    <td><?= $this->Number->format($person->id); ?></td>
                    <td><?= h($person->first_name); ?></td>
                    <td><?= h($person->last_name); ?></td>
                    <td><?= h($person->phone); ?></td>
                    <td><?= h($person->role->name); ?></td>

                    <td class="actions">
                        <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_persons', 'id' => $person->id], ['escape' => false]); ?>

                        <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_persons', 'id' => $person->id], ['escape' => false]); ?>

                        <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $person->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o {0} {1}?', $person->role->name, $person->first_name)]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</main>
