<?php use Kanboard\Core\Security\Role;

?>
<div class="page-header">
    <h2><?= t('Add a comment') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('CommentListController', 'save', ['task_id' => $task['id']]) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->textEditor('comment', ['project_id' => $task['project_id']], [], ['required' => true, 'aria-label' => t('New comment')]) ?>

    <?php
        $formName = 'visibility';
$visibilityOptions['app-user'] = t('Standard users');
$attribute[] = ('hidden');
?>

    <?php if ($this->user->getRole() !== Role::APP_USER) {
        echo $this->form->label(t('Visibility:'), $formName);
        $attribute = [];
        $visibilityOptions['app-user'] = t('Standard users');
        $visibilityOptions['app-manager'] = t('Application managers or more');
    }
?>

    <?php if ($this->user->getRole() === Role::APP_ADMIN) {
        $visibilityOptions['app-admin'] = t('Administrators');
    }
?>

    <?= $this->form->select($formName, $visibilityOptions, [], [], $attribute) ?>
    <?= $this->modal->submitButtons() ?>
</form>
