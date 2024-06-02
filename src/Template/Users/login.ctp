<?= $this->Form->create(); ?>
<?= $this->Flash->render(); ?>
<h2>Login</h2>

<?= $this->Form->control('email', ['label' => 'E-mail <span class="field_required">*</span>', 'escape' => false]); ?>
<?= $this->Form->control('password', ['label' => 'Senha <span class="field_required">*</span>', 'escape' => false]); ?>

<p class="link_password">
    <?= $this->Html->link('Esqueceu a senha?', ['controller' => 'Users', 'action' => 'rescuePassword']); ?>
</p>

<?= $this->Form->button('Acessar'); ?>
<?= $this->Form->end(); ?>
