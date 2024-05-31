<header>
    <h2>Administradores <small>listagem</small></h2>
    <?= $this->Html->link('Novo administrador', ['controller' => 'Users', 'action' => 'add']); ?>
</header>

<main>
    <table class="table_list">
        <thead>
            <tr>
                <th>#</th>
                <th><?= $this->Paginator->sort('full_name', 'Nome completo'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th><?= $this->Paginator->sort('email', 'E-mail'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id); ?></td>
                    <td><?= h($user->full_name); ?></td>
                    <td><?= h($user->email); ?></td>

                    <td class="actions">
                        <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_users', 'id' => $user->id], ['escape' => false]); ?>

                        <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_users', 'id' => $user->id], ['escape' => false]); ?>

                        <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o administrador {0}?', $user->full_name)]); ?>
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
