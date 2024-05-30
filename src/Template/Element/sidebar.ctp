<aside class="sidebar">
    <h3>Casa de Adulão</h3>

    <nav>
      <ul class="container_links">
        <li>
            <?= $this->Html->link('<i class="bi bi-house-door"></i> Início', ['controller' => 'Users', 'action' => 'home'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-people-fill"></i> Pessoas', ['controller' => 'Persons', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-columns-gap"></i> Atividades', ['controller' => 'Activities', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-person-fill-gear"></i> Administradores', ['controller' => 'Users', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-gear-wide-connected"></i> Perfis', ['controller' => 'Roles', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-person-vcard-fill"></i> Meus dados', ['controller' => 'Users', 'action' => 'profile'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-box-arrow-left"></i> Sair', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
        </li>
      </ul>
    </nav>
  </aside>
