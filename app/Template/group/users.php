<section id="main">
    <div class="page-header">
        <ul>
            <li><?= $this->url->icon('user', t('All users'), 'UserListController', 'show') ?></li>
            <li><?= $this->url->icon('users', t('View all groups'), 'GroupListController', 'index') ?></li>
            <li><?= $this->modal->medium('plus', t('Add group member'), 'GroupListController', 'associate', ['group_id' => $group['id']]) ?></li>
        </ul>
    </div>
    <?php if ($paginator->isEmpty()): ?>
        <p class="alert"><?= t('There is no user in this group.') ?></p>
    <?php else: ?>
        <div class="table-list">
            <?= $this->render('user_list/header', ['paginator' => $paginator]) ?>
            <?php foreach ($paginator->getCollection() as $user): ?>
                <div class="table-list-row table-border-left">
                    <div>
                        <?= $this->render('group/user_dropdown', ['user' => $user]) ?>
                        <span class="table-list-title <?= $user['is_active'] == 0 ? 'status-closed' : '' ?>">
                            <?= $this->avatar->small(
                                $user['id'],
                                $user['username'],
                                $user['name'],
                                $user['email'],
                                $user['avatar_path'],
                                'avatar-inline',
                            ) ?>
                            <?= $this->url->link($this->text->e($user['name'] ?: $user['username']), 'UserViewController', 'show', ['user_id' => $user['id']]) ?>
                        </span>
                    </div>

                    <?= $this->render('user_list/user_details', [
                                                    'user' => $user,
                                                ]) ?>

                    <?= $this->render('user_list/user_icons', [
                                                    'user' => $user,
                                                ]) ?>
                </div>
            <?php endforeach ?>
        </div>

        <?= $paginator ?>
    <?php endif ?>
</section>
