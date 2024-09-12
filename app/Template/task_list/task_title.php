<div>
    <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
        <?php if (isset($show_items_selection)): ?>
            <input type="checkbox" data-list-item="selectable" name="tasks[]" value="<?= $task['id'] ?>">
        <?php endif ?>
        <?= $this->render('task/dropdown', ['task' => $task, 'redirect' => isset($redirect) ? $redirect : '']) ?>
    <?php else: ?>
        <strong><?= '#' . $task['id'] ?></strong>
    <?php endif ?>

    <span class="table-list-title <?= $task['is_active'] == 0 ? 'status-closed' : '' ?>">
        <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', ['task_id' => $task['id']]) ?>
    </span>
</div>
