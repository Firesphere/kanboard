<?php if (!empty($files)): ?>
    <table class="table-striped table-scrolling">
        <tr>
            <th><?= t('Filename') ?></th>
            <th><?= t('Creator') ?></th>
            <th><?= t('Date') ?></th>
            <th><?= t('Size') ?></th>
        </tr>
        <?php foreach ($files as $file): ?>
            <tr>
                <td>
                    <i class="fa <?= $this->file->icon($file['name']) ?> fa-fw"></i>
                    <div class="dropdown">
                        <a href="#" class="dropdown-menu dropdown-menu-link-text"><?= $this->text->e($file['name']) ?>
                            <i class="fa fa-caret-down"></i></a>
                        <ul>
                            <?php if ($this->file->getPreviewType($file['name']) !== null): ?>
                                <li>
                                    <?= $this->modal->large('eye', t('View file'), 'FileViewerController', 'show', ['project_id' => $project['id'], 'file_id' => $file['id'], 'etag' => $file['etag']]) ?>
                                </li>
                            <?php elseif ($this->file->getBrowserViewType($file['name']) !== null): ?>
                                <li>
                                    <?= $this->url->icon('eye', t('View file'), 'FileViewerController', 'browser', ['project_id' => $project['id'], 'file_id' => $file['id']], false, '', '', true) ?>
                                </li>
                            <?php endif ?>
                            <li>
                                <?= $this->url->icon('download', t('Download'), 'FileViewerController', 'download', ['project_id' => $project['id'], 'file_id' => $file['id'], 'etag' => $file['etag']]) ?>
                            </li>
                            <?php if ($this->user->hasProjectAccess('ProjectFileController', 'remove', $project['id'])): ?>
                                <li>
                                    <?= $this->modal->confirm('trash-o', t('Remove'), 'ProjectFileController', 'confirm', ['project_id' => $project['id'], 'file_id' => $file['id']]) ?>
                                </li>
                            <?php endif ?>
                            <?= $this->hook->render('template:project-overview:documents:dropdown', ['project' => $project, 'file' => $file]) ?>
                        </ul>
                    </div>
                </td>
                <td>
                    <?= $this->text->e($file['user_name'] ?: $file['username']) ?>
                </td>
                <td>
                    <?= $this->dt->date($file['date']) ?>
                </td>
                <td>
                    <?= $this->text->bytes($file['size']) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif ?>
