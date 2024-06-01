<?= $this->Form->create($user); ?>
<?= $this->Flash->render(); ?>
<h2>Recuperar senha</h2>

<?= $this->Form->control('email', ['label' => 'E-mail <span class="field_required">*</span>', 'placeholder' => 'Informe o e-mail cadastrado', 'escape' => false]); ?>

<p class="link_password">
    <?= $this->Html->link('Lembrou a senha?', ['controller' => 'Users', 'action' => 'login']); ?>
</p>

<?= $this->Form->button(__('Enviar link')); ?>
<?= $this->Form->end(); ?>
