<header>
    <h2>Administradores <small>cadastrar</small></h2>
    <?= $this->Html->link('Voltar', ['controller' => 'Users', 'action' => 'index']); ?>
</header>

<main>
    <?= $this->element('field_required'); ?>

    <?= $this->Form->create($user); ?>

    <?= $this->Form->control('full_name', ['label' => 'Nome completo <span class="field_required">*</span>', 'escape' => false]); ?>
    <?= $this->Form->control('email', ['label' => 'E-mail <span class="field_required">*</span>', 'placeholder' => 'exemplo@email.com', 'escape' => false]); ?>

    <div class="container_fields">
        <?= $this->Form->control('password', ['label' => 'Senha <span class="field_required">*</span>', 'placeholder' => 'No mínimo 06 caracteres', 'escape' => false]); ?>
        <?= $this->Form->control('confirm_password', ['label' => 'Confimar senha <span class="field_required">*</span>', 'placeholder' => 'Repita a senha', 'type' => 'password', 'escape' => false]); ?>
    </div>

    <?= $this->Form->button('Cadastrar', ['class' => 'btn_sumit']); ?>
    <?= $this->Form->end(); ?>
</main>
