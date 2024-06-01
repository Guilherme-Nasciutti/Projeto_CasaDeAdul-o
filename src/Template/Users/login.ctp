<?= $this->Form->create(); ?>
<?= $this->Flash->render(); ?>
<h2>Login</h2>

<?= $this->Form->control('email', ['label' => 'E-mail']); ?>
<?= $this->Form->control('password', ['label' => 'Senha']); ?>

<p class="link_password">
    <?= $this->Html->link('Esqueceu a senha?', ['controller' => 'Users', 'action' => 'rescuePassword']); ?>
</p>

<?= $this->Form->button('Acessar'); ?>
<?= $this->Form->end(); ?>
