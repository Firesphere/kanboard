<div class="dropdown">
    <a href="#" class="dropdown-menu dropdown-menu-link-icon"><strong>#<?= $group['id'] ?> <i
                    class="fa fa-caret-down"></i></strong></a>
    <ul>
        <li><?= $this->modal->medium('plus', t('Add group member'), 'GroupListController', 'associate', ['group_id' => $group['id']]) ?></li>
        <li><?= $this->url->icon('users', t('Members'), 'GroupListController', 'users', ['group_id' => $group['id']]) ?></li>
        <li><?= $this->modal->medium('edit', t('Edit'), 'GroupModificationController', 'show', ['group_id' => $group['id']]) ?></li>
        <li><?= $this->modal->confirm('trash-o', t('Remove'), 'GroupListController', 'confirm', ['group_id' => $group['id']]) ?></li>
    </ul>
</div>
