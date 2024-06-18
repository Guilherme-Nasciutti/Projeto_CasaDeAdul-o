<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Guest[]|\Cake\Collection\CollectionInterface $guests
 */

use App\Controller\CivilStatusENUM;
use App\Controller\StatusENUM;

?>

<header>
    <h2>Hóspedes <small>listagem</small></h2>
    <?= $this->Html->link('Novo hóspede', ['controller' => 'Guests', 'action' => 'add']); ?>
</header>

<main>
    <?php if (count($guests) > 0) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th class="list_phone">Data de nascimento</th>
                    <th class="list_table">Estado civil</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($guests as $guest) : ?>
                    <tr>
                        <td><?= h($guest->person->first_name); ?></td>
                        <td class="list_phone"><?= h($guest->person->birthday->format('d/m/Y')); ?></td>
                        <td class="list_table"><?= CivilStatusENUM::findConstants($guest->person->civil_status); ?></td>
                        <td><?= StatusENUM::findConstants($guest->person->status); ?></td>

                        <td class="actions">
                            <?= $this->Form->postLink('<i class="bi bi-repeat"></i>', ['action' => 'changeStatus', $guest->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja alterar a situação do hóspede {0}?', $guest->person->first_name), 'title' => 'Altera a situação atual!']); ?>

                            <?= $this->Html->link('<i class="bi bi-eye"></i>', ['_name' => 'visualizar_guests', 'id' => $guest->id], ['escape' => false]); ?>

                            <?= $this->Html->link('<i class="bi bi-pencil-square"></i>', ['_name' => 'editar_guests', 'id' => $guest->id], ['escape' => false]); ?>

                            <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>'), ['action' => 'delete', $guest->id], ['escape' => false, 'confirm' => __('Tem certeza que deseja apagar o hóspede {0}?', $guest->person->first_name)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="list_empty">Nenhum hóspede cadastrado!</p>
    <?php endif; ?>

    <?php if (count($guests) > 0) : ?>
        <?= $this->element('pagination'); ?>
    <?php endif; ?>
</main>
