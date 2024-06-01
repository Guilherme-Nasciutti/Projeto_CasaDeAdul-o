<header>
    <h2>Meu perfil <small>dados</small></h2>
</header>

<main class="container_view">
    <dl>
        <div class="view_row">
            <dt>Nome completo:</dt>
            <dd><?= $user['full_name']; ?></dd>
        </div>

        <div class="view_row">
            <dt>E-mail:</dt>
            <dd><?= $user['email']; ?></dd>
        </div>
    </dl>
</main>
