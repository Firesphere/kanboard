<hr/>
Kanboard

<?php if ($this->app->config('application_url') != ''): ?>
    <?php if (isset($task['id'])): ?>
        - <?= $this->url->absoluteLink(t('view the task on Kanboard'), 'TaskViewController', 'show', ['task_id' => $task['id']]) ?>
    <?php endif ?>
    - <?= $this->url->absoluteLink(t('view the board on Kanboard'), 'BoardViewController', 'show', ['project_id' => $task['project_id']]) ?>
<?php endif ?>
