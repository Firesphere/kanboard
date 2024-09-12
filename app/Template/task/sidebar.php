<div class="sidebar sidebar-icons">
    <div class="sidebar-title">
        <h2><?= t('Task #%d', $task['id']) ?></h2>
    </div>
    <ul>
        <li <?= $this->app->checkMenuSelection('TaskViewController', 'show') ?>>
            <?= $this->url->icon('newspaper-o', t('Summary'), 'TaskViewController', 'show', ['task_id' => $task['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('ActivityController', 'task') ?>>
            <?= $this->url->icon('dashboard', t('Activity stream'), 'ActivityController', 'task', ['task_id' => $task['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('TaskViewController', 'transitions') ?>>
            <?= $this->url->icon('arrows-h', t('Transitions'), 'TaskViewController', 'transitions', ['task_id' => $task['id']]) ?>
        </li>
        <li <?= $this->app->checkMenuSelection('TaskViewController', 'analytics') ?>>
            <?= $this->url->icon('bar-chart', t('Analytics'), 'TaskViewController', 'analytics', ['task_id' => $task['id']]) ?>
        </li>
        <?php if ($task['time_estimated'] > 0 || $task['time_spent'] > 0): ?>
        <li <?= $this->app->checkMenuSelection('TaskViewController', 'timetracking') ?>>
            <?= $this->url->icon('clock-o', t('Time tracking'), 'TaskViewController', 'timetracking', ['task_id' => $task['id']]) ?>
        </li>
        <?php endif ?>

        <?= $this->hook->render('template:task:sidebar:information', ['task' => $task]) ?>
    </ul>

    <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
    <div class="sidebar-title">
        <h2><?= t('Actions') ?></h2>
    </div>
    <ul>
        <?= $this->hook->render('template:task:sidebar:before-actions', ['task' => $task]) ?>

        <?php if ($this->projectRole->canUpdateTask($task)): ?>
        <li>
            <?= $this->modal->large('edit', t('Edit the task'), 'TaskModificationController', 'edit', ['task_id' => $task['id']]) ?>
        </li>
        <li>
            <?= $this->modal->medium('refresh fa-rotate-90', t('Edit recurrence'), 'TaskRecurrenceController', 'edit', ['task_id' => $task['id']]) ?>
        </li>
        <?php endif ?>
        <li>
            <?= $this->modal->medium('plus', t('Add a sub-task'), 'SubtaskController', 'create', ['task_id' => $task['id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-basic-actions', ['task' => $task]) ?>

        <li>
            <?= $this->modal->medium('code-fork', t('Add internal link'), 'TaskInternalLinkController', 'create', ['task_id' => $task['id']]) ?>
        </li>
        <li>
            <?= $this->modal->medium('external-link', t('Add external link'), 'TaskExternalLinkController', 'find', ['task_id' => $task['id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-add-links', ['task' => $task]) ?>

        <li>
            <?= $this->modal->small('comment-o', t('Add a comment'), 'CommentController', 'create', ['task_id' => $task['id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-add-comment', ['task' => $task]) ?>

        <li>
            <?= $this->modal->medium('file', t('Attach a document'), 'TaskFileController', 'create', ['task_id' => $task['id']]) ?>
        </li>
        <li>
            <?= $this->modal->medium('camera', t('Add a screenshot'), 'TaskFileController', 'screenshot', ['task_id' => $task['id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-add-attachments', ['task' => $task]) ?>

        <li>
            <?= $this->modal->small('files-o', t('Duplicate'), 'TaskDuplicationController', 'duplicate', ['task_id' => $task['id']]) ?>
        </li>
        <li>
            <?= $this->modal->small('clipboard', t('Duplicate to project'), 'TaskDuplicationController', 'copy', ['task_id' => $task['id'], 'project_id' => $task['project_id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-duplicate-task', ['task' => $task]) ?>

        <li>
            <?= $this->modal->small('clone', t('Move to project'), 'TaskDuplicationController', 'move', ['task_id' => $task['id'], 'project_id' => $task['project_id']]) ?>
        </li>
        <li>
            <?= $this->modal->small('paper-plane', t('Send by email'), 'TaskMailController', 'create', ['task_id' => $task['id']]) ?>
        </li>
        <?= $this->hook->render('template:task:sidebar:after-send-mail', ['task' => $task]) ?>

        <?php if ($task['is_active'] == 1 && $this->projectRole->isSortableColumn($task['project_id'], $task['column_id'])): ?>
            <li>
                <?= $this->modal->small('arrows', t('Move position'), 'TaskMovePositionController', 'show', ['task_id' => $task['id']]) ?>
            </li>
        <?php endif ?>
        <?php if ($this->projectRole->canChangeTaskStatusInColumn($task['project_id'], $task['column_id'])): ?>
            <?php if ($task['is_active'] == 1): ?>
                <li>
                    <?= $this->modal->confirm('times', t('Close this task'), 'TaskStatusController', 'close', ['task_id' => $task['id']]) ?>
                </li>
            <?php else: ?>
                <li>
                    <?= $this->modal->confirm('check-square-o', t('Open this task'), 'TaskStatusController', 'open', ['task_id' => $task['id']]) ?>
                </li>
            <?php endif ?>
        <?php endif ?>
        <?php if ($this->projectRole->canRemoveTask($task)): ?>
            <li>
                <?= $this->modal->confirm('trash-o', t('Remove'), 'TaskSuppressionController', 'confirm', ['task_id' => $task['id'], 'redirect' => 'board']) ?>
            </li>
        <?php endif ?>

        <?= $this->hook->render('template:task:sidebar:actions', ['task' => $task]) ?>
    </ul>
    <?php endif ?>
</div>
