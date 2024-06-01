<?php

use App\Controller\CivilStatusENUM;
use App\Controller\EducationENUM;
use App\Controller\TypeRolesENUM;
?>

<header>
    <h2>Pessoas <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Persons', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome:</dt>
            <dd><?= $person->first_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Sobrenome:</dt>
            <dd><?= $person->last_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de nascimento:</dt>
            <dd><?= $person->birthday->format('d/m/Y'); ?></dd>
        </div>

        <div class="view_row">
            <dt>Telefone p/ contato:</dt>
            <dd><?= __overrideEmpty($person->phone); ?></dd>
        </div>

        <div class="view_row">
            <dt>Estado civil:</dt>
            <dd><?= CivilStatusENUM::findConstants($person->civil_status); ?></dd>
        </div>

        <div class="view_row">
            <dt>Perfil:</dt>
            <dd><?= $person->has('role') ? $this->Html->link($person->role->name, ['controller' => 'Roles', 'action' => 'view', $person->role->id]) : ''; ?></dd>
        </div>

        <div class="view_row">
            <dt>Educação:</dt>
            <dd><?= __overrideEmpty(EducationENUM::findConstants($person->education)); ?></dd>
        </div>
    </dl>

    <?php if (count($person->activities) > 0 && $person->role->id === TypeRolesENUM::INSTRUCTOR) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Data de início</th>
                    <th>Data prevista p/ término</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activities as $activity) : ?>
                    <tr>
                        <td><?= $this->Number->format($activity->id); ?></td>
                        <td><?= h($activity->name); ?></td>
                        <td><?= h($activity->initial_date); ?></td>
                        <td><?= h($activity->final_date); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="list_empty">Nenhuma atividade vinculada!</p>
    <?php endif; ?>
</main>
