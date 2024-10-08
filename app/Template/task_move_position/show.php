<div class="page-header">
    <h2><?= t('Move task to another position on the board') ?></h2>
</div>

<form>

    <?= $this->app->component('task-move-position', [
        'saveUrl'       => $this->url->href('TaskMovePositionController', 'save', ['task_id' => $task['id'], 'csrf_token' => $this->app->getToken()->getReusableCSRFToken()]),
        'board'         => $board,
        'task'          => $task,
        'swimlaneLabel' => t('Swimlane'),
        'columnLabel'   => t('Column'),
        'positionLabel' => t('Position'),
        'beforeLabel'   => t('Insert before this task'),
        'afterLabel'    => t('Insert after this task'),
    ]) ?>

    <?= $this->modal->submitButtons() ?>

</form>
