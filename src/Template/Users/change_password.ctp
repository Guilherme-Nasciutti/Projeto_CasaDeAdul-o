<?= $this->Form->create($user); ?>
<?= $this->Flash->render(); ?>
<h2>Nova senha</h2>

<?= $this->Form->control('password', ['label' => 'Nova senha <span class="field_required">*</span>', 'placeholder' => 'No mínimo 06 caracteres', 'value' => '', 'escape' => false, 'required']); ?>
<?= $this->Form->control('confirm_password', ['label' => 'Confirmar nova senha <span class="field_required">*</span>', 'placeholder' => 'Repita a nova senha', 'type' => 'password', 'escape' => false, 'required']); ?>

<p class="link_password">
    <?= $this->Html->link('Lembrou a senha?', ['controller' => 'Users', 'action' => 'login']); ?>
</p>

<?= $this->Form->button(__('Cadastrar nova senha')); ?>
<?= $this->Form->end(); ?>
