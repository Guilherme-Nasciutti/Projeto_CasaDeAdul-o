<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Guest $guest
 */

use App\Controller\CivilStatusENUM;
use App\Controller\StatusENUM;

?>

<header>
    <h2>Hóspedes <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Guests', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome:</dt>
            <dd><?= $guest->person->first_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Sobrenome:</dt>
            <dd><?= $guest->person->last_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de nascimento:</dt>
            <dd><?= $guest->person->birthday->format('d/m/Y'); ?></dd>
        </div>

        <div class="view_row">
            <dt>Estado civil:</dt>
            <dd><?= CivilStatusENUM::findConstants($guest->person->civil_status); ?></dd>
        </div>

        <div class="view_row">
            <dt>Situação:</dt>
            <dd><?= StatusENUM::findConstants($guest->person->status); ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de cadastro:</dt>
            <dd><?= $guest->created->format('d/m/Y H:i:s'); ?></dd>
        </div>
    </dl>
</main>
