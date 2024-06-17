<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */

use App\Controller\CivilStatusENUM;
use App\Controller\TimesDayENUM;
?>

<header>
    <h2>Atividades <small>visualizar</small></h2>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Responsável:</dt>
            <dd><?= $activity->has('instructor') ? $this->Html->link($activity->instructor->person->first_name . ' ' . $activity->instructor->person->last_name, ['controller' => 'Instructors', 'action' => 'view', $activity->instructor->id]) : ''; ?></dd>
        </div>

        <div class="view_row">
            <dt>Título:</dt>
            <dd><?= $activity->title; ?></dd>
        </div>

        <div class="view_row">
            <dt>Descrição:</dt>
            <dd><?= $activity->description; ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de início:</dt>
            <dd><?= $activity->initial_date->format('d/m/Y'); ?></dd>
        </div>

        <div class="view_row">
            <dt>Data prevista p/ término:</dt>
            <dd><?= $activity->final_date->format('d/m/Y'); ?></dd>
        </div>

        <div class="view_row">
            <dt>Horário de início:</dt>
            <dd><?= TimesDayENUM::findConstants($activity->start_time); ?></dd>
        </div>

        <div class="view_row">
            <dt>Duração prevista:</dt>
            <dd><?= $activity->duration; ?> horas</dd>
        </div>

        <div class="view_row">
            <dt>Data de cadastro:</dt>
            <dd><?= $activity->created->format('d/m/Y H:i:s'); ?> horas</dd>
        </div>
    </dl>

    <?php if (count($activity->guests) > 0) : ?>
        <table class="table_list">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th class="list_phone">Data de nascimento</th>
                    <th class="list_table">Estado civil</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($activity->guests as $guest) : ?>
                    <tr>
                        <td><?= h($guest->person->first_name); ?></td>
                        <td class="list_phone"><?= h($guest->person->birthday->format('d/m/Y')); ?></td>
                        <td class="list_table"><?= CivilStatusENUM::findConstants($guest->person->civil_status); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="list_empty">Nenhum hóspede cadastrado!</p>
    <?php endif; ?>
</main>
