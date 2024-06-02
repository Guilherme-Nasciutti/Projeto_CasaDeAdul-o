<header>
    <h2>Pessoas <small>listagem</small></h2>
    <?= $this->Html->link('Nova pessoa', ['controller' => 'Persons', 'action' => 'add']); ?>
</header>

<!-- Filtro de pesquisa  -->
<section class="container_filter">
    <?= $this->Form->create(null, ['type' => 'get', 'autocomplete' => 'off']) ?>

    <div class="filter_row">
        <?= $this->Form->control('filter', ['type' => 'text', 'label' => 'Filtro de pesquisa', 'placeholder' => 'Nome ou sobrenome ou telefone', 'value' => $this->request->getQuery('filter')]); ?>

        <?= $this->Form->button(__('Filtrar'), ['type' => 'submit']); ?>
    </div>
    <?= $this->Form->end(); ?>
</section>

<main>
    <?php if ($persons) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('first_name', 'Nome'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_phone"><?= $this->Paginator->sort('last_name', 'Sobrenome'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_phone"><?= $this->Paginator->sort('phone', 'Telefone'); ?><i class="bi bi-arrow-down-up"></i></th>
                    <th class="list_table">Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($persons as $person) : ?>
                    <tr>
                        <td><?= h($person->first_name); ?></td>
                        <td class="list_phone"><?= h($person->last_name); ?></td>
                        <td class="list_phone"><?= __overrideEmpty($person->phone); ?></td>
                        <td class="list_table"><?= h($person->role->name); ?></td>

                        <td class="actions">
                            <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_persons', 'id' => $person->id], ['escape' => false]); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_persons', 'id' => $person->id], ['escape' => false]); ?>

                            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $person->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o {0} {1}?', $person->role->name, $person->first_name)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="list_empty">Nenhuma pessoa cadastrada!</p>
    <?php endif; ?>

    <?php if ($persons) : ?>
        <?= $this->element('pagination'); ?>
    <?php endif; ?>
</main>
