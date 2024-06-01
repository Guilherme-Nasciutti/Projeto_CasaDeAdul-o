<?php

use App\Controller\TimesDayENUM;
?>
<header>
    <h2>Atividades <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Activities', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Responsável:</dt>
            <dd><?= $activity->has('person') ? $this->Html->link($activity->person->first_name, ['controller' => 'Persons', 'action' => 'view', $activity->person->id]) : ''; ?></dd>
        </div>

        <div class="view_row">
            <dt>Identificação da atividade:</dt>
            <dd><?= $activity->name; ?></dd>
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
            <dd><?= $activity->duration; ?> hora(s)</dd>
        </div>

        <div class="view_row">
            <dt>Data de cadastro:</dt>
            <dd><?= $activity->created->format('d/m/Y H:m:s'); ?></dd>
        </div>
    </dl>
</main>
