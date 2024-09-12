
<div class="table-list-header">
    <div class="table-list-header-count">
        <?php if ($paginator->getTotal() > 1): ?>
            <?= t('%d users', $paginator->getTotal()) ?>
        <?php else: ?>
            <?= t('%d user', $paginator->getTotal()) ?>
        <?php endif ?>
    </div>
    <div class="table-list-header-menu">
        <?= $this->render('user_list/sort_menu', ['paginator' => $paginator]) ?>
    </div>
</div>
