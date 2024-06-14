<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instructor $instructor
 */

use App\Controller\CivilStatusENUM;
use App\Controller\EducationENUM;
?>

<header>
    <h2>Instrutores <small>visualizar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Instructors', 'action' => 'index']); ?>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome:</dt>
            <dd><?= $instructor->person->first_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Sobrenome:</dt>
            <dd><?= $instructor->person->last_name; ?></dd>
        </div>

        <div class="view_row">
            <dt>Telefone p/ contato:</dt>
            <dd><?= $instructor->phone; ?></dd>
        </div>

        <div class="view_row">
            <dt>Outro telefone:</dt>
            <dd><?= __overrideEmpty($instructor->other_phone); ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de nascimento:</dt>
            <dd><?= $instructor->person->birthday->format('d/m/Y'); ?></dd>
        </div>

        <div class="view_row">
            <dt>Estado civil:</dt>
            <dd><?= CivilStatusENUM::findConstants($instructor->person->civil_status); ?></dd>
        </div>

        <div class="view_row">
            <dt>Formação:</dt>
            <dd><?= EducationENUM::findConstants($instructor->education); ?></dd>
        </div>

        <div class="view_row">
            <dt>Data de cadastro:</dt>
            <dd><?= $instructor->created->format('d/m/Y H:i:s'); ?></dd>
        </div>
    </dl>
</main>
