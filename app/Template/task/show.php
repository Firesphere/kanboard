<?= $this->hook->render('template:task:show:top', ['task' => $task, 'project' => $project]) ?>

<?= $this->render('task/details', [
    'task'     => $task,
    'tags'     => $tags,
    'project'  => $project,
    'editable' => $this->user->hasProjectAccess('TaskModificationController', 'edit', $project['id']),
]) ?>

<?= $this->hook->render('template:task:show:before-description', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('task/description', ['task' => $task]) ?>

<?= $this->hook->render('template:task:show:before-subtasks', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('subtask/show', [
    'task'     => $task,
    'subtasks' => $subtasks,
    'project'  => $project,
    'editable' => $this->user->hasProjectAccess('SubtaskController', 'edit', $project['id']),
]) ?>

<?= $this->hook->render('template:task:show:before-internal-links', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('task_internal_link/show', [
    'task'            => $task,
    'links'           => $internal_links,
    'project'         => $project,
    'link_label_list' => $link_label_list,
    'editable'        => $this->user->hasProjectAccess('TaskInternalLinkController', 'edit', $project['id']),
    'is_public'       => false,
]) ?>

<?= $this->hook->render('template:task:show:before-external-links', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('task_external_link/show', [
    'task'    => $task,
    'links'   => $external_links,
    'project' => $project,
]) ?>

<?= $this->hook->render('template:task:show:before-attachments', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('task_file/show', [
    'task'   => $task,
    'files'  => $files,
    'images' => $images,
]) ?>

<?= $this->hook->render('template:task:show:before-comments', ['task' => $task, 'project' => $project]) ?>
<?= $this->render('task_comments/show', [
    'task'     => $task,
    'comments' => $comments,
    'project'  => $project,
    'editable' => $this->user->hasProjectAccess('CommentController', 'edit', $project['id']),
]) ?>

<?= $this->hook->render('template:task:show:bottom', ['task' => $task, 'project' => $project]) ?>
