<?php

use App\Controller\TypeRolesENUM;
?>

<header>
    <h2>Perfis <small>listagem</small></h2>
    <?= $this->Html->link('Novo perfil', ['controller' => 'Roles', 'action' => 'add']); ?>
</header>

<main>
    <table class="table_list">
        <thead>
            <tr>
                <th>#</th>
                <th><?= $this->Paginator->sort('name', 'Nome'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th><?= $this->Paginator->sort('type', 'Tipo do perfil'); ?><i class="bi bi-arrow-down-up"></i></th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= $this->Number->format($role->id); ?></td>
                    <td><?= h($role->name); ?></td>
                    <td><?= TypeRolesENUM::findConstants($role->type); ?></td>

                    <td class="actions">
                        <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_roles', 'id' => $role->id], ['escape' => false]); ?>

                        <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_roles', 'id' => $role->id], ['escape' => false]); ?>

                        <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $role->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o perfil {0}?', $role->name)]); ?>
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
