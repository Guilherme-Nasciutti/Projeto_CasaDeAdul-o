<header class="toolbar">
    <nav>
      <i class="bi bi-list" id="expand"></i>

      <ul>
        <li><?= strtok($this->request->getSession()->read('Auth.User.full_name'), ' '); ?></li>

        <li>
        <?= $this->Html->link('<i class="bi bi-box-arrow-left"></i> Sair', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
        </li>
      </ul>
    </nav>
</header>
