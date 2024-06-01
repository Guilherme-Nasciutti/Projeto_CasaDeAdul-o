<aside class="sidebar">
    <h3>Casa de Adulão</h3>

    <nav>
      <ul class="container_links">
        <li>
            <?= $this->Html->link('<i class="bi bi-house-door"></i> <span>Início</span>', ['controller' => 'Users', 'action' => 'home'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-people-fill"></i> <span>Pessoas</span>', ['controller' => 'Persons', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-columns-gap"></i> <span>Atividades</span>', ['controller' => 'Activities', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-person-fill-gear"></i> <span>Administradores</span>', ['controller' => 'Users', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-gear-wide-connected"></i> <span>Perfis</span>', ['controller' => 'Roles', 'action' => 'index'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-person-vcard-fill"></i> <span>Meus dados</span>', ['controller' => 'Users', 'action' => 'profile'], ['escape' => false]); ?>
        </li>
        <li>
            <?= $this->Html->link('<i class="bi bi-box-arrow-left"></i> <span>Sair</span>', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
        </li>
      </ul>
    </nav>
  </aside>
