<section id="main">
    <?= $this->projectHeader->render($project, 'ProjectOverviewController', 'show') ?>
    <?= $this->render('project_overview/columns', ['project' => $project, 'columns' => $columns]) ?>
    <?= $this->hook->render('template:project-overview:before-description', ['project' => $project]) ?>
    <?= $this->render('project_overview/description', ['project' => $project]) ?>
    <?= $this->render('project_overview/attachments', ['project' => $project, 'images' => $images, 'files' => $files]) ?>
    <?= $this->render('project_overview/information', ['project' => $project, 'users' => $users, 'roles' => $roles]) ?>
    <?= $this->render('project_overview/activity', ['project' => $project, 'events' => $events]) ?>
</section>
