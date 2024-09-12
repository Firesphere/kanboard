<ul class="views">
    
    <?= $this->hook->render('template:project-header:view-switcher-before-project-overview', ['project' => $project, 'filters' => $filters]) ?>

    <li <?= $this->app->checkMenuSelection('ProjectOverviewController') ?>>
        <?= $this->url->icon('eye', t('Overview'), 'ProjectOverviewController', 'show', ['project_id' => $project['id'], 'search' => $filters['search']], false, 'view-overview', t('Keyboard shortcut: "%s"', 'v o')) ?>
    </li>

    <?= $this->hook->render('template:project-header:view-switcher-before-board-view', ['project' => $project, 'filters' => $filters]) ?>

    <li <?= $this->app->checkMenuSelection('BoardViewController') ?>>
        <?= $this->url->icon('th', t('Board'), 'BoardViewController', 'show', ['project_id' => $project['id'], 'search' => $filters['search']], false, 'view-board', t('Keyboard shortcut: "%s"', 'v b')) ?>
    </li>

    <?= $this->hook->render('template:project-header:view-switcher-before-task-list', ['project' => $project, 'filters' => $filters]) ?>

    <li <?= $this->app->checkMenuSelection('TaskListController') ?>>
        <?= $this->url->icon('list', t('List'), 'TaskListController', 'show', ['project_id' => $project['id'], 'search' => $filters['search']], false, 'view-listing', t('Keyboard shortcut: "%s"', 'v l')) ?>
    </li>

    <?= $this->hook->render('template:project-header:view-switcher', ['project' => $project, 'filters' => $filters]) ?>
</ul>
