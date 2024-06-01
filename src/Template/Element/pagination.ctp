<div class="container_paginaton">
    <ul class="pagination">
        <?= $this->Paginator->first('&laquo; ' . __('Primeira'), ['escape' => false]) ?>
        <?= $this->Paginator->numbers(['escape' => false]) ?>
        <?= $this->Paginator->last(__('Último') . ' &raquo;', ['escape' => false]) ?>
    </ul>

    <p>
        <?= $this->Paginator->counter(__('Página {{page}} de {{pages}} <br>Exibindo {{current}} de
        {{count}} registros.')) ?>
    </p>
</div>
